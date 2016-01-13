<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends Admin
{
    protected $repository;
    protected $roles = [];

    public function __construct()
    {
        parent::__construct();

        $this->repository = new Library\Kelas\CourseRepository;
    }

    public function index()
    {
        $term           = $this->input->get('term');
        $category_id    = $this->input->get('category_id', 0);

        if ($category_id)
            $search_result  = $this->repository->searchWithCategory($term, $category_id)->get();
        else
            $search_result  = $this->repository->search($term)->get();

        $search_result  = pagination($search_result, 15, 'search');
        $categories     = $this->repository->getAllCategory();

        $search_result->appends(compact('term'));

        $this->template->build('search', compact('term', 'search_result', 'categories'));
    }

}

/* End of file Search.php */
/* Location: ./application/modules/search/controllers/Search.php */