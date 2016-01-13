<?php

namespace Library\Kelas;

use Model\Kelas\Category;

trait CategoryTrait
{
    protected $category;

    public function setCategory($category)
    {
        if ($category instanceof Category)
            $this->category = $category;
        elseif (is_numeric($category))
            $this->category = $this->category->findOrFail($category);
        elseif (is_string($category))
            $this->category = $this->category->findBySlug($category);
        else
            $this->category = new Category;

        return $this;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getCategoryLists($category = null)
    {
        if ($category) $this->setCategory($category);

        $lists = $this->category->orderBy('name', 'asc')->get()->pluck('name', 'id');

        return $lists->toArray();
    }

    public function getAllCategory()
    {
        $category   = $this->category->newQuery();

        return $category->get();
    }

    public function createCategory($name, $description = '')
    {
        $category               = new Category;
        $category->name         = $name;
        $category->description  = $description;
        $category->save();

        $this->setCategory($category);

        return $this;
    }

    public function updateCategory($name, $description = '', $category = null)
    {
        if ($category) $this->setCategory($category);

        $category               = $this->getCategory();
        $category->name         = $name;
        $category->description  = $description;
        $category->save();

        return $this;
    }

    public function deleteCategory($category = null)
    {
        if ($category) $this->setCategory($category);

        $this->category->courses->each(function ($course) {
            $this->delete($course);
        });

        $this->category->delete();

        return $this;
    }
}