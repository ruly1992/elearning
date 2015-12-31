<?php

namespace Library\Media;

class Media
{
    protected $basepath = 'media/';
    protected $category;
    protected $media;
    protected $hidden_metadata;

    public function __construct($media = null)
    {
        $this->media    = new Model\Media;
        $this->category = new Model\Category;

        $this->hidden_metadata  = [];

        if ($media)
            $this->setMedia($media);
    }

    public function setMedia($media)
    {
        if ($media instanceof Model\Media) {
            $this->media    = $media;
        } else {
            $this->media    = $this->media->findOrFail($media);
        }

        $this->category = $this->media->category;

        return $this;
    }

    public function setCategory($category)
    {
        if ($category instanceof Model\Category) {
            $this->category = $category;
        } else {
            $this->category = $this->category->findOrFail($category);
        }

        return $this;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getCategories($perPage = 15, $orderBy = 'created_at', $orderMode = 'desc')
    {
        $categories = $this->category->orderBy($orderBy, $orderMode);

        return $categories->paginate($perPage);
    }

    public function getCategoryById($category_id)
    {
        $this->setCategory($category_id);

        return $this->getCategory();
    }

    public function getCategoryByName($category_name)
    {
        $category = $this->category->where('name', $category_name)->firstOrFail();

        return $category;
    }
    
    public function createCategory($name, $description = '')
    {
        $basepath   = $this->basepathCategory($name);

        $category = $this->category->whereName($name)->get();

        if ($category->count()) {
            throw new Exception\CategoryAlreadyExists('Nama kategori sudah tersedia.'); 
        }
        
        if (!is_dir($basepath)) {
            mkdir($basepath, 0775);          
        }

        $category = $this->category->forceCreate([
            'name'          => $name,
            'description'   => $description,
        ]);

        $this->setCategory($category);

        return $this;
    }

    public function basepathCategory($name)
    {
        return PATH_ELIBRARY_UPLOAD . '/' . trim($this->basepath, '/\\') . '/' . trim($name, '/\\');
    }

    public function updateCategory($category_id, $attributes = [])
    {
        $this->setCategory($category_id);

        if (array_key_exists('name', $attributes)) {
            $this->renameCategory($category_id, $attributes['name']);

            unset($attributes['name']);
        }

        $this->category->forceFill($attributes);
        $this->category->save();

        return $this;
    }

    public function renameCategory($category_id, $name)
    {
        $category   = $this->category->findOrFail($category_id);
        $basepath   = $this->basepathCategory($category->name);
        $newpath    = $this->basepathCategory($name);

        if ($category->name === $name) {
            return $this;
        }

        if (is_dir($basepath)) {
            if (is_dir($newpath) || $category->whereName($name)->count()) {
                throw new Exception\CategoryAlreadyExists('Kategori sudah tersedia');                
            }

            rename($basepath, $newpath);

            $category->forceFill(['name' => $name])->save();

            return $this;
        } else {
            throw new Exception\CategoryNotFound('Kategori tidak tersedia' . $basepath);            
        }
    }

    public function deleteCategory($category_id)
    {
        $category   = $this->category->findOrFail($category_id);
        $basepath   = $this->basepathCategory($category->name);
        $media_ids  = $category->media->pluck('id');

        foreach ($media_ids as $media_id) {
            $this->deleteMedia($media_id);
        }

        if (is_dir($basepath)) {
            rmdir($basepath);
        }

        $category->delete();

        return $this;
    }

    public function getMediaByCategory($category_id = null, $perPage = 15, $orderBy = 'name', $orderMode = 'asc')
    {
        if ($category_id) {
            $this->category = $this->category->findOrFail($category_id);
        }

        return $this->category->orderBy($orderBy, $orderMode)->paginate($perPage);
    }

    public function onlyUserId($user_id = null)
    {
        if ($user_id == null)
            $user_id = auth()->user()->id;
        
        $this->media = $this->media->withDrafts()->userId($user_id);

        return $this;
    }

    public function withDrafts()
    {
        $this->media = $this->media->withDrafts();

        return $this;
    }

    public function getMediaById($media_id)
    {
        return $this->media->findOrFail($media_id);
    }

    public function getMedia()
    {
        return $this->media;
    }

    public function latest()
    {
        return $this->media->latest()->get();
    }

    public function popular()
    {
        return $this->media->popular()->get();
    }

    public function uploadMediaDraft($category_id, $file, $metadata = [], $user_id = 0)
    {
        return $this->uploadMedia($category_id, $file, $metadata, 'draft', $user_id);
    }

    public function uploadMedia($category_id, $file, $metadata = [], $status = 'publish', $user_id = 0)
    {
        $category   = $this->category->findOrFail($category_id);
        $basepath   = $this->basepathCategory($category->name);

        $CI =& get_instance();

        $config['upload_path']      = $basepath;
        $config['allowed_types']    = '*';
        $config['max_size']         = '0';
        $config['max_width']        = '0';
        $config['max_height']       = '0';

        $_FILES['filemedia']        = $file;

        $CI->load->library('upload', $config);

        if ( ! $CI->upload->do_upload('filemedia')) {
            $error = $CI->upload->display_errors();            
            
            throw new Exception\Exception($error);
        } else {
            $data = $CI->upload->data();

            $this->media->forceFill([
                'file_name' => $data['file_name'],
                'file_type' => $data['file_type'],
                'file_size' => $data['file_size'],
                'status'    => $status,
                'user_id'   => $user_id,
            ]);

            $this->media->category()->associate($category);
            $this->media->save();

            $this->setMetadata($this->media->id, $metadata);

            $this->setMedia($this->media);

            return $this;
        }
    }

    public function setMetadata($media_id, $metadata)
    {
        $media = $this->media->withDrafts()->findOrFail($media_id);
        $delete_ids = [];

        foreach ($media->metadata as $already) {
            $key = $already->key;

            if (array_key_exists($key, $metadata)) {
                $already->value = $metadata[$key];
                $already->save();

                unset($metadata[$key]);
            } else {
                $delete_ids[] = $already->id;
            }
        }

        foreach ($metadata as $key => $value) {
            $media->metadata()->create([
                'key'   => $key,
                'value' => $value,
            ]);
        }

        if (count($delete_ids))
            $media->metadata()->whereIn('id', $delete_ids)->delete();

        return $this;
    }

    public function setHiddenMetadata($meta_key = [])
    {
        $this->hidden_metadata = $meta_key;
    }

    public function getMetadata()
    {
        return $this->media->metadata()->whereNotIn('key', $this->hidden_metadata)->get();
    }

    public function updateMedia($media_id, $attributes = [])
    {
        $this->setMedia($media_id);

        if (array_key_exists('name', $attributes)) {
            $this->renameMedia($media_id, $attributes['name']);

            unset($attributes['name']);
        }

        $this->media->forceFill($attributes);
        $this->media->save();

        return $this;
    }

    public function renameMedia($media_id, $name)
    {
        $media          = $this->media->withDrafts()->findOrFail($media_id);
        $mediapath      = $this->basepathCategory($media->category->name) . '/' . $media->file_name;
        $mediapath_new  = $this->basepathCategory($media->category->name) . '/' . $name;

        if ($media->name === $name) {
            return $media;
        }

        if (file_exists($mediapath)) {
            rename($mediapath, $mediapath_new);

            $media->file_name = $name;
            $media->save();
        }

        return $this;
    }

    public function deleteMedia($media_id)
    {
        $media          = $this->media->withDrafts()->findOrFail($media_id);
        $mediapath      = $this->basepathCategory($media->category->name) . '/' . $media->file_name;

        if (file_exists($mediapath)) {
            unlink($mediapath);
        }

        $media->metadata()->delete();
        $media->delete();

        return $this;
    }

    public function search($term, $by_category = 0)
    {
        $results = $this->media->where('file_name', 'like', '%' . $term . '%');

        // Search by Category
        if ($by_category) {
            if (is_numeric($by_category))
                $where = 'id';
            else
                $where = 'name';

            $results->whereHas('category', function ($query) use ($by_category, $where) {
                return $query->where($where, $by_category);
            });
        }

        return $results;
    }
}