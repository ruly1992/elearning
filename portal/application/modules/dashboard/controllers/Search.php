<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends Admin
{
    protected $roles = [];

    public function index()
    {
        $term               = $this->input->get('term');
        $articles           = Model\Portal\Article::onlyRegistered()->search($term)->get();

        $paginate = pagination($articles, 15, 'search');
        $paginate->appends(['term' => $term]);

        $data['searches']   = $paginate;
        $data['term']       = $term;
        $data['links']      = $this->Mod_link->read();

        $this->template->set('sidebar', FALSE);
        $this->template->set('railnews', FALSE);
        $this->template->set('single', TRUE);
        $this->template->set('sidebarCategory', FALSE);
        $this->template->set_layout('single_private');
        $this->template->build('search', $data);
    }

}

/* End of file Search.php */
/* Location: ./application/modules/dashboard/controllers/Search.php */