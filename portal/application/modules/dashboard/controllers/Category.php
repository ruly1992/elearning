<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

    public function show($name)
    {
        saveVisitor();
        
        $name               = urldecode($name);
        $category           = Model\Portal\Category::whereName($name)->firstOrFail();
        $paginate           = pagination($category->articles()->onlyRegistered()->get(), 15, 'dashboard/category/show/' . $name);
        $data['category']   = $category;
        $data['articles']   = $paginate;
        $data['links']      = $this->Mod_link->read();

        $this->template->set('active', $category->id);
        $this->template->set_layout('private_category');
        $this->template->build('category', $data);
    }

}

/* End of file Category.php */
/* Location: ./application/modules/dashboard/controllers/Category.php */