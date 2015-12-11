<?php

namespace Model\Portal;

use Model\Scopes\Published;
use Model\User;

use Carbon\Carbon;
use Illuminate\Database\Capsule\Manager as DB;
use Symfony\Component\HttpFoundation\Request;

class Article extends Model
{
    use SearchableTrait;
    use Published;

    protected $table = 'artikel';
    protected $hidden = ['password'];
    protected $guarded = [];

    public $dates = ['date'];
    public $timestamps = false;

    protected $searchable = [
        'columns' => [
            'title'     => 15,
            'content'   => 5,
        ],
        'joins' => [
        ],
    ];

    public static function boot()
    {
        parent::boot();

        Article::creating(function ($article) {
            if (!property_exists($article, 'slug')) {
                $article->slug = $article->generateSlug($article->title);
            }
        });
    }

    public function generateSlug($title, $i = 0)
    {
        try {
            $slugged    = \Illuminate\Support\Str::slug($title . ($i ? '-' . $i : ''), '-');
            $article    = Article::withDrafts()->slug($slugged);

            return $this->generateSlug($title, ++$i);
        } catch (\Exception $e) {
            return $slugged;
        }
    }

    public function getLinkAttribute()
    {
        return home_url('/article/' . $this->slug);
    }

    public function getVisitorAttribute()
    {
        return $this->getCountVisitor();
    }

    public function hasFeaturedImage()
    {
        if ($this->has_featured_image)
            return true;
        else
            return false;
    }

    public function getFeaturedImageAttribute($featured_image)
    {
        if (!$featured_image) {
            $this->has_featured_image = false;

            return asset('images/portal/img-default.jpg');
        } else {
            $this->has_featured_image = true;

            return asset('portal-content/featured/' . $featured_image);
        }
    }

    public function getExcerpt($max = 100, $trailing = '...')
    {
        return truncate($this->content, $max, $trailing);
    }

    public function onSchedule()
    {
        if ($this->published != '0000-00-00 00:00:00')
            return $this->published > Carbon::now();
            return false;
    }

    public function getStatusLabel()
    {
        $status = ucwords($this->status);

        if ($this->onSchedule()) {
            $status = 'On Schedule';
            $type = 'warning';
        }
        elseif ($this->status == 'draft')
            $type = 'info';
        else
            $type = 'success';

        $html = '<div class="label label-'.$type.'">'.$status.'</div>';

        return $html;
    }

    public function getAuthorNameAttribute()
    {
        if ($this->contributor_id != 0) {
            return $this->contributor->full_name;
        } elseif ($this->nama) {
            return $this->nama;
        } else {
            return 'Tidak diketahui';
        }
    }

    public function getAuthorEmailAttribute()
    {
        if ($this->contributor_id != 0) {
            return $this->contributor->email;
        } else {
            return $this->email;
        }
    }

    public function getAuthorAvatarAttribute()
    {
        if ($this->contributor_id != 0) {
            return $this->contributor->avatar;
        } elseif ($this->custom_avatar) {
            return asset('portal-content/custom-avatar/'.$this->custom_avatar);
        } else {
            return asset('images/default_avatar_male.jpg');
        }
    }

    public function contributor()
    {
        return $this->belongsTo(User::class, 'contributor_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'artikel_id')->orderBy('date', 'asc')->parentOnly();
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'editor_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'kategori_has_artikel', 'artikel_id', 'kategori_id');
    }

    public function visitors()
    {
        return $this->hasMany(VisitorArticle::class, 'artikel_id');
    }

    public function getCountVisitor()
    {
        return $this->visitors->count();
    }

    public function scopeByCategory($query, $category_id, $limit = 0)
    {
        return $query->latest('date')->whereHas('categories', function ($query) use ($category_id) {
            return $query->where('id', $category_id);
        });
    }

    public function scopeOnlyAllowEditor($query, $user_id = 0)
    {
        $user = $user_id ? Model\User::find($user_id) : sentinel()->getUser();

        return $query->whereHas('categories', function ($query) use ($user) {
            return $query->whereIn($query->getModel()->getTable().'.id', $user->editorcategory->pluck('id')->toArray());
        });
    }

    public function scopeCategoryId($query, $category_id)
    {
        return $query->whereHas('categories', function ($query) use ($category_id) {
            return $query->where('kategori.id', $category_id);
        });
    }

    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug)->firstOrFail();
    }

    public function scopeSlider($query)
    {
        return $query->where('slider', '!=', '');
    }

    public function scopePopular($query, $limit = 6)
    {
        $prefix = getenv('PORTAL_DB_PREFIX') ?: '';

        return $query
            ->select($this->getTable() . '.*')
            ->addSelect(DB::connection('portal')->raw("COUNT({$prefix}va.id) AS visitor"))
            ->join('visitor_artikel AS va', 'va.artikel_id', '=', $this->getTable() . '.id')
            ->groupBy($this->getTable() . '.id')
            ->orderBy('visitor', 'desc');
    }

    public function scopeContributor($query, $contributor_id)
    {
        return $query->where('contributor_id', $contributor_id);
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeScheduled($query)
    {
        return $query->whereNotNull('published')->where('published', '>', Carbon::now());
    }

    public function scopePublished($query)
    {
        $query = $query->where('status', 'publish')->where(function ($query) {
            return $query->whereNull('published')->orWhere('published', '<=', Carbon::now());
        });

        return $query;
    }

    public function scopePublic($query)
    {
        return $query->where('type', 'public');
    }

    public function scopeRegistered($query)
    {
        return $query->where('type', 'private');
    }

    public function choice()
    {
        return $this->belongsTo(User::class, 'editor_choice');
    }

    public function scopeEditorChoice($query)
    {
        return $query->where('editor_choice', '>', 0);
    }

    public function resolveVisitorUnique()
    {
        $user = auth()->getUser();

        $ip_address = $this->getRealIpAddr();
        $visitor    = VisitorArticle::checkAccessVisitor($this, $ip_address, $user ?: null);

        if ($visitor->count()) {
            $visitor->incrementTimes();
        } else {
            $visitor = VisitorArticle::create(array(
                'ip_address'    => $ip_address,
                'artikel_id'    => $this->id,
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
}