<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Symfony\Component\HttpFoundation\Request;

class Search extends CI_Controller {

    public function index()
    {
        $request            = Request::createFromGlobals();
        $term               = $request->query->get('term');
        $articles           = Model\Portal\Article::search($term)->get();

        $paginate = pagination($articles, 15, 'search');
        $paginate->appends(['term' => $term]);

        $data['searches']   = $paginate;
        $data['term']       = $term;
        $data['links']      = $this->Mod_link->read();

        $this->template->set('sidebar', FALSE);
        $this->template->set('railnews', FALSE);
        $this->template->set('single', TRUE);
        $this->template->set('sidebarCategory', TRUE);
        $this->template->build('index', $data);
    }

}

/* End of file Search.php */
/* Location: ./application/modules/search/controllers/Search.php */