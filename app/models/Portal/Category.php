<?php

namespace Model\Portal;

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
        return $this->belongsToMany(User::class, 'editor_kategori', 'kategori_id', 'user_id');
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
}