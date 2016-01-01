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

    public function articles_registered()
    {
        return $this->belongsToMany(Article::class, 'kategori_has_artikel', 'kategori_id', 'artikel_id')->onlyRegistered();
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

    public function generateCheckbox($parent = 0, $checked = array(), $level = 0)
    {
        $html       = '';
        $categories = $this->parentOnly($parent);

        if ($categories->count() > 0) {
            foreach ($categories->get() as $category) {
                if ($level == 0)
                    $html .= '<div class="list-group-item"><label class="c-input c-checkbox">';
                else
                    $html .= '<div class="child"><label class="c-input c-checkbox">';

                $is_checked = in_array($category->id, $checked);
                $html .= form_checkbox('categories[]', $category->id, $is_checked) . ' <span class="c-indicator"></span> ';

                $html .= ' ' . $category->name;
                $html .= '</label>';
                $html .= $this->generateCheckbox($category->id, $checked, $level+1);
                $html .= '</div>';
            }
        } else {
            return '';
        }

        return $html;
    }
}
