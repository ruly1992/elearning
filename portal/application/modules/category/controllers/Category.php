<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

    public function show($name)
    {
        saveVisitor();
        
        $name               = urldecode($name);
        $category           = Model\Portal\Category::whereName($name)->firstOrFail();
        $paginate           = pagination($category->articles, 15, 'category/show/' . $name, 'bootstrap');
        $data['category']   = $category;
        $data['articles']   = $paginate;
        $data['links']      = $this->Mod_link->read();

        $this->template->set('active', $category->id);
        $this->template->set('railnews', false);        
        $this->template->set('sidebar', false);
        $this->template->set('single', true);
        $this->template->set('sidebarCategory', true);      
        $this->template->build('show', $data);
    }
}

/* End of file Category.php */
/* Location: ./application/modules/category/controllers/Category.php */