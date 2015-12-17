<?php

namespace Model\Portal;

use Model\User;

class Category extends Model
{
    protected $table = 'kategori';
    protected $guarded = [];

    public $timestamps = false;

    public function getLinkAttribute()
    {
        return site_url('category/show/' . $this->name);
    }

    public function childs()
    {
        return $this->hasMany(Category::class, 'parent');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent');
    }

    public function editors()
    {
        $database = $this->getConnection()->getDatabaseName();

        return $this->belongsToMany(User::class, $database.'.kategori_moderator', 'category_id', 'user_id');
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'kategori_has_artikel', 'kategori_id', 'artikel_id');
    }

    public function scopeParentOnly($query, $parent = 0)
    {
        return $query->where('parent', $parent);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public function updateFromNestable($nestable, $parent = 0, $order = 1)
    {
        foreach ($nestable as $nest) {
            $category           = $this->find($nest->id);
            $category->parent   = $parent;
            $category->order    = $order++;
            $category->save();
            
            if (property_exists($nest, 'children')) {
                $this->updateFromNestable($nest->children, $nest->id);
            }
        }
    }

    public function scopeOnlyAllowEditor($query, $user_id = 0)
    {
        $user = $user_id ? Model\User::find($user_id) : sentinel()->getUser();

        return $query->whereIn('id', $user->editorcategory->pluck('id')->toArray());;
    }
}