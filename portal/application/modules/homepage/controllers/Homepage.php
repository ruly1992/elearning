<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('article');
        
        saveVisitor();
    }

    public function index()
    {
        $cat_1  = config('homepage_category_1');
        $cat_2  = config('homepage_category_2');
        $cat_3  = config('homepage_category_3');
        $cat_4  = config('homepage_category_4');

        $homepage_category_1_title      = Model\Portal\Category::find($cat_1);
        $homepage_category_1            = Model\Portal\Article::categoryId($cat_1);

        $homepage_category_2_title      = Model\Portal\Category::find($cat_2);
        $homepage_category_2_a          = Model\Portal\Article::categoryId($cat_2);
        $homepage_category_2_b          = Model\Portal\Article::categoryId($cat_2);

        $homepage_category_3_title      = Model\Portal\Category::find($cat_3);
        $homepage_category_3            = Model\Portal\Article::categoryId($cat_3);

        $homepage_category_4_title      = Model\Portal\Category::find($cat_4);
        $homepage_category_4            = Model\Portal\Article::categoryId($cat_4);

        $data = array(
            'homepage_category_1_title' => $homepage_category_1_title ? $homepage_category_1_title->name : 'No Category',
            'homepage_category_1'       => $homepage_category_1->count() ? $homepage_category_1->take(10)->latest('date')->get() : collect([]),
            'homepage_category_1_link'  => $homepage_category_1_title ? portal_url('category/show/' . $homepage_category_1_title->name) : portal_url(),

            'homepage_category_2_title' => $homepage_category_2_title ? $homepage_category_2_title->name : 'No Category',
            'homepage_category_2_a'     => $homepage_category_2_a->count() ? $homepage_category_2_a->take(10)->latest('date')->get() : collect([]),
            'homepage_category_2_b'     => $homepage_category_2_b->count() ? $homepage_category_2_b->take(2)->skip(2)->latest('date')->get() : collect([]),
            'homepage_category_2_link'  => $homepage_category_2_title ? portal_url('category/show/' . $homepage_category_2_title->name) : portal_url(),

            'homepage_category_3_title' => $homepage_category_3_title ? $homepage_category_3_title->name : 'No Category',
            'homepage_category_3'       => $homepage_category_3->count() ? $homepage_category_3->take(5)->latest('date')->get() : collect([]),
            'homepage_category_3_link'  => $homepage_category_3_title ? portal_url('category/show/' . $homepage_category_3_title->name) : portal_url(),

            'homepage_category_4_title' => $homepage_category_4_title ? $homepage_category_4_title->name : 'No Category',
            'homepage_category_4'       => $homepage_category_4->count() ? $homepage_category_4->take(10)->latest('date')->get() : collect([]),
            'homepage_category_4_link'  => $homepage_category_4_title ? portal_url('category/show/' . $homepage_category_4_title->name) : portal_url(),
            
            'links'                     => $this->Mod_link->read(),
            'latest'                    => Model\Portal\Article::latest('date')->limit(10)->get(),
        );

        $this->template->set('slider', true);
        $this->template->set('railnews', true);
        $this->template->set('sidebar', true);
        $this->template->set('sidebarCategory', false);
        $this->template->build('index', $data);
    }

}

/* End of file Homepage.php */
/* Location: ./application/modules/homepage/controllers/Homepage.php */