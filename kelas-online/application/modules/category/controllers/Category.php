<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Admin
{
    protected $repository;
    protected $roles = [];

    public function __construct()
    {
        parent::__construct();

        $this->repository = new Library\Kelas\CourseRepository;
    }

    public function show($slug)
    {
        try {
            $category   = $this->repository->setCategory($slug)->getCategory();
            $courses    = $this->repository->getByCategory($slug);
            $categories = $this->repository->getAllCategory();

            $courses    = pagination($courses, 15, 'category/show/'.$slug);

            $this->template->build('course_list', compact('category', 'courses', 'categories'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            show_error('Category not found', 404);
        }
    }

}

/* End of file Category.php */
/* Location: ./application/modules/category/controllers/Category.php */