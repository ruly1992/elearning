<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends Admin {

    public function __construct()
    {
        parent::__construct();
        
        $this->medialib = new Library\Media\Media;
    }

    public function index()
    {
        $categories     = $this->medialib->getCategories();
        
        $data = [
            'media_latest'  => $this->medialib->latest()->slice(0, 5),
            'media_popular' => $this->medialib->popular()->slice(0, 5),
            'categories'    => $categories,
        ];

        $this->template->build('index', $data);
    }

}

/* End of file Homepage.php */
/* Location: ./application/modules/homepage/controllers/Homepage.php */