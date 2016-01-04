<?php

namespace Library\Media\Model;

use Illuminate\Support\Collection;
use Illuminate\Database\Capsule\Manager as DB;
use Model\SearchableTrait;
use Model\User;
use Model\Scopes\Published;

use Symfony\Component\HttpFoundation\Request;

class Media extends Model
{
    use SearchableTrait;
    use Published;

    protected $table = 'media';
    protected $guarded = [];
    protected $appends = ['status_format'];
    protected $hidden_metadata;
    protected $searchable = [
        'columns' => [
            'title'     => 15,
        ],
        'joins' => [
        ],
    ];

    public function getFilepath()
    {
        return attachment('elibrary/media/' . $this->category->name . '/' . $this->file_name);
    }

    public function resolveVisitorUnique($user, $mediaID)
    {
        $ip_address = $this->getRealIpAddr();
        $visitor    = VisitorMedia::checkAccessVisitor($this, $ip_address, $user ?: null);

        if ($visitor->count()) {
            $visitor->incrementTimes();
        } else {
            $visitor = VisitorMedia::create(array(
                'ip_address'    => $ip_address,
                'media_id'      => $mediaID,
                'user_id'       => $user ? $user->id : null,
            ));
        }

        return $visitor;
    }

    protected function getRealIpAddr()
    {
        $request    = Request::createFromGlobals();
        $client_ip  = $request->getClientIp();

        return $client_ip;
    }

    public function delete()
    {
        $return = parent::delete();

        $this->metadata()->delete();

        $filepath = $this->getFilepath();
       
        if (file_exists($filepath))
            unlink($filepath);

        return $return;
    }

    public function getLinkCategoryAttribute()
    {
        return site_url('media/show/' . $this->category->id);
    }

    public function getLinkAttribute()
    {
        return elib_url('lib/' . $this->category->name . '/' . $this->id . '/' . $this->name);
    }

    public function getLinkDelete()
    {
        return site_url('lib/delete/' . $this->category->name . '/' . $this->id . '/' . $this->name);
    }

    public function getNameAttribute()
    {
        return pathinfo($this->file_name, PATHINFO_FILENAME);
    }

    public function getTypeAttribute()
    {
        if (preg_match('/^image\//', $this->file_type)) {
            return 'Image';
        } elseif (preg_match('/^video\/|^audio\/mpeg|^audio\/mp4/', $this->file_type)) {
            return 'Video';
        } elseif ($this->file_type == 'application/octet-stream') {
            return 'Audio';
        } elseif ($this->file_type == 'application/pdf') {
            return 'PDF';
        } elseif (preg_match('/^application\/vnd.ms-excel/', $this->file_type)) {
            return 'Excel';
        } elseif (preg_match('/^application\/vnd.ms-powerpoint/', $this->file_type)) {
            return 'Presentation';
        } else {
            return 'Unknown';
        }
    }

    public function getStatusFormatAttribute()
    {
        $type = 'warning';

        if ($this->status == 'publish') {
            $type = 'success';
        }

        return '<span class="label label-'.$type.'">'.$this->status.'</span>';
    }

    public function getIconAttribute()
    {
        return '<i class="fa fa-' . $this->icon_name . '"></i>';
    }

    public function getIconNameAttribute()
    {
        switch ($this->type) {
            case 'Image':
                return 'file-image-o';
                break;

            case 'Video':
                return 'file-video-o';
                break;

            case 'PDF':
                return 'file-pdf-o';
                break;
            
            default:
                return 'file-o';
                break;
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function metadata()
    {
        return $this->hasMany(Metadata::class);
    }

    public function setMetadata($key, $value = '')
    {
        $metadata = Metadata::byMediaKey($this->id, $key);
        $metadata = $metadata->count() ? $metadata->first() : new Metadata;
        $metadata->fill(compact('key', 'value'));
        $metadata->media()->associate($this);
        $metadata->save();

        return $metadata;
    }

    public function getMetadata($key = null, $default = '')
    {
        $hidden_metadata = [
            'title',
            'description',
            'full_description',
        ];
        $metadata = $this->metadata;

        if ($metadata->count()) {
            if ($key) {
                $metadata = $metadata->where('key', $key);

                return $metadata->count() ? $metadata->first()->value : $default;
            } else {
                return $metadata->reject(function ($meta) use ($hidden_metadata) {
                    return in_array($meta->key, $hidden_metadata);
                });
            }
        } else {
            if (!$key)
                return collect();
            else
                return '';
        }
    }

    public function getThumbnail()
    {
        if ($this->type == 'Image') {
            return;
        }
    }

    public function getLinkDownload()
    {
        return elib_url('lib/download/' . $this->category->name . '/' . $this->id . '/' . $this->name);
    }
    
    public function getFileSizeFormatAttribute()
    {
        $bytes      = $this->file_size;
        $precision  = 2;
        $units      = array('b', 'kb', 'Mb', 'Gb', 'Tb');
      
        $bytes      = max($bytes, 0);
        $pow        = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow        = min($pow, count($units) - 1);
      
        $bytes      /= pow(1024, $pow);
      
        return number_format($bytes, $precision, ',', '.') . ' ' . $units[$pow]; 
    }

    public function getFileurl()
    {
        return attachment('elibrary/media/' . $this->category->name . '/' . $this->file_name);
    }

    public function getLinkPreview()
    {
        return elib_url('lib/preview/' . $this->category->name . '/' . $this->id . '/' . $this->name);
    }

    public function getPreview($width = 600, $height = 500)
    {
        $fileurl = $this->getFileurl();

        if (in_array($this->type, ['PDF', 'DOCX', 'EXCEL'])) {
            return '<iframe src="http://docs.google.com/gview?url='.$fileurl.'&embedded=true" style="width:'.$width.'px; height:'.$height.'px;" frameborder="0"></iframe>';
        }

        else if ($this->type == 'Image') {
            return '<img src="'.$fileurl.'" class="img-thumbnail">';
        }

        elseif ($this->type == 'Video') {
            return '<video id="my-video" class="video-js" controls preload="auto" data-setup="{}">
                <source src="'.$fileurl.'" type="video/mp4">
                </video>';
        }

        elseif ($this->type == 'Audio') {
            return '<audio id="audio_example" class="video-js vjs-default-skin" controls 
                preload="auto" data-setup="{}">
                <source src="'.$fileurl.'" type="audio/mp3"/>
            </audio>';
        }
    }

    public function scopePopular($query, $limit = 6)
    {
        $prefix = getenv('ELIB_DB_PREFIX') ?: '';

        return $query
            ->select($this->getTable() . '.*')
            ->addSelect(DB::connection($this->connection)->raw("COUNT({$prefix}vm.id) AS visitor"))
            ->join('visitor_media AS vm', 'vm.media_id', '=', $this->getTable() . '.id')
            ->groupBy($this->getTable() . '.id')
            ->orderBy('visitor', 'desc');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'publish');
    }

    public function scopeUserId($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }
}
