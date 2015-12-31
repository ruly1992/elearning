<?php

namespace Library\Kelas;

use Model\Kelas\Category;

trait CategoryTrait
{
    public function setCategory($category)
    {
        if ($category instanceof Category)
            $this->category = $category;
        else
            $this->category = $this->category->findOrFail($category);

        return $this->category;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getCategoryLists()
    {
        $lists = $this->category->orderBy('name', 'asc')->get()->pluck('name', 'id');

        return $lists->toArray();
    }

    public function createCategory($name, $description = '')
    {
        $category               = new $this->category;
        $category->name         = $name;
        $category->description  = $description;
        $category->save();

        $this->setCategory($category);

        return $category;
    }

    public function updateCategory($name, $description = '', $id = 0)
    {
        if ($id !== 0)
            $this->setCategory($id);

        $category               = $this->getCategory();
        $category->name         = $name;
        $category->description  = $description;
        $category->save();

        return $category;
    }
}