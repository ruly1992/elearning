<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends Admin
{
    protected $roles = ['su', 'adm', 'pcp'];
    protected $repository;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->repository   = new Library\Kelas\CourseRepository;
    }

    public function index()
    {
        $status     = $this->input->get('status') ?: 'publish';
        $courses    = $this->repository->getByStatus($status);
        $courses    = pagination($courses, 15, 'kelasonline/course');

        $courses->appends(compact('status'));

        $this->template->build('course/index', compact('courses', 'status'));
    }

    public function saveto($course)
    {
        $this->repository->set($course);

        $status = $this->input->get('status', 'publish');
        $course = $this->repository->get();
        $course->update(compact('status'));

        set_message_success('Status Kelas berhasil diperbarui menjadi ' . $status);

        redirect('kelasonline/course/edit/'.$course->id.'/basic', 'refresh');
    }

    public function edit($id, $page = 'basic')
    {
        $this->repository->set($id);

        $course         = $this->repository->get();
        $category_lists = $this->repository->getCategoryLists();
        $repository     = $this->repository;
        $sidebar_active = $page;

        $this->template->set(compact('course', 'category_lists', 'repository', 'sidebar_active', 'page'));

        call_user_func_array([$this, 'edit'.ucfirst($page)], [$id]);
    }

    public function editBasic($id)
    {
        if ($this->input->post()) {
            $name           = set_value('name');
            $description    = set_value('description', '', false);
            $days           = set_value('days', 0);
            $category       = set_value('category_id');
            $status         = set_value('status', '');

            $this->repository->update($name, $description, $days);
            $this->repository->attachCategory($category);

            if (!empty($status)) {
                $this->repository->saveTo($status);
            }

            set_message_success('Kelas berhasil diperbarui');

            redirect('kelasonline/course/edit/'.$id.'/basic', 'refresh');
        } else {
            $this->template->build('course/edit');
        }
    }

    public function editRequirement($id)
    {
        $courses        = $this->repository->allExcept($id);
        $course_lists   = $courses->pluck('name', 'id');

        $this->template->build('course/edit', compact('course_lists'));
    }

    public function editImage($id)
    {
        $this->template->build('course/edit');
    }

    public function editChapter($id)
    {
        $this->template->build('course/edit');
    }

    public function editExam($id)
    {
        $this->template->build('course/edit');
    }

    public function delete($id)
    {
        $this->repository->set($id)->delete();

        set_message_success('Kelas berhasil dihapus');

        redirect('kelasonline/course', 'refresh');
    }
}

/* End of file Course.php */
/* Location: ./application/modules/kelasonline/controllers/Course.php */