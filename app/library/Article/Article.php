<?php

namespace Library\Article;

use Model;
use Carbon\Carbon;
use Hashids\Hashids;
use Intervention\Image\ImageManager;

class Article
{
    protected $model;
    protected $imageManager;
    protected $user;

    public function __construct()
    {
        $this->model            = new Model\Portal\Article;
        $this->imageManager     = new ImageManager;
        $this->user             = sentinel()->check();
    }

    public function submit($article, $name, $email, $desa = 0, $featured = null, $custom_avatar = null)
    {
        $this->set($article);

        $this->model->nama  = $name;
        $this->model->email = $email;
        // $this->model->desa()->associate($desa);

        $this->saveToDraft();

        if ($featured)
            $this->setFeaturedImage($featured);

        if ($custom_avatar)
            $this->setCustomAvatar($custom_avatar);
    }

    public function set($article)
    {
        $this->model->fill($article);

        return $this;
    }

    public function setFeaturedImage($imageData)
    {
        $image = $this->imageManager->make($imageData);

        if ($image->mime == 'image/jpeg')
            $extension = '.jpg';
        elseif ($image->mime == 'image/png')
            $extension = '.png';
        elseif ($image->mime == 'image/gif')
            $extension = '.gif';
        else
            $extension = '';

        $filename = 'article_' . $this->getHashids() . '_' . $this->model->slug . $extension;

        $image->save(PATH_PORTAL_CONTENT.'/featured/'.$filename);

        $this->model->update(['featured_image' => $filename]);

        return $this;
    }

    public function setCustomAvatar($imageData)
    {
        $image = $this->imageManager->make($imageData);

        if ($image->mime == 'image/jpeg')
            $extension = '.jpg';
        elseif ($image->mime == 'image/png')
            $extension = '.png';
        elseif ($image->mime == 'image/gif')
            $extension = '.gif';
        else
            $extension = '';

        $filename = 'custavatar_' . $this->getHashids() . $extension;

        $image->save(PATH_PORTAL_CONTENT.'/custom-avatar/'.$filename);

        $this->model->update(['custom_avatar' => $filename]);

        return $this;
    }

    public function getHashids()
    {        
        $hashids    = new Hashids(HASHIDS_SALT);
        $id         = $hashids->encode($this->model->id);

        return $id;
    }

    public function setPrivate()
    {
        $this->model->type = 'private';

        return $this;
    }

    public function saveToPublish($type = 'public')
    {
        return $this->save('publish', $type);
    }

    public function saveToDraft($type = 'public')
    {
        return $this->save('draft', $type);
    }

    public function save($status = 'publish', $type = 'public')
    {
        if ($this->user)
            $this->model->contributor()->associate($this->user);

        $this->model->status    = $status;
        $this->model->type      = $type;

        if (!$this->model->exists)
            $this->model->date      = Carbon::now();
        
        $this->model->save();

        return $this->model;
    }
}