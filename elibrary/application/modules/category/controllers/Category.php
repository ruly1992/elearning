<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Admin
{
    protected $medialib;

    public function __construct()
    {
        parent::__construct();

        $this->medialib = new Library\Media\Media;
    }

    public function index()
    {
        $data = [
            'categories'    => $this->medialib->getCategories()
        ];

        $this->template->build('index', $data);
    }

    public function show($name)
    {
        try {
            $name       = urldecode($name);
            $category   = $this->medialib->getCategoryByName($name);
            $data       = [
                'category'  => $category,
                'media'     => pagination($category->media, 15, 'category/' . $name),
            ];

            $this->template->build('show', $data);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

}

/* End of file Category.php */
/* Location: ./application/modules/category/controllers/Category.php */