<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends Admin
{
    protected $repository;
    protected $roles = [];

    public function __construct()
    {
        parent::__construct();

        $this->template->set_layout('chapter');
        
        $this->repository = new Library\Kelas\CourseRepository;
    }

    public function show($slug)
    {
        $course     = $this->repository->getBySlug($slug);
        $repository = $this->repository;

        $this->template->build('show', compact('course', 'repository'));
    }

    public function join($slug)
    {
        $this->repository->set($slug);
        $requirements = $this->repository->checkRequirements();

        if (!$requirements->isEmpty()) {
            $this->template->build('requirement', compact('requirements'));
        } else {
            $this->repository->addMember(sentinel()->getUser());
            $course = $this->repository->get();

            redirect('course/show/'.$course->slug, 'refresh');
        }
    }

    public function chapter($slug)
    {
        $course     = $this->repository->getBySlug($slug);
        $repository = $this->repository;

        if ($this->repository->isMember('active')) {
            $this->template->build('chapter', compact('course', 'repository'));
        } else {
            redirect('course/show/' . $course->slug, 'refresh');
        }
    }

    public function showchapter($slug, $chapter)
    {
        $chapter        = str_replace('chapter-', '', $chapter);
        $course         = $this->repository->getBySlug($slug);
        $repository     = $this->repository;
        $chapter        = $course->chapters()->whereOrder($chapter)->firstOrFail();
        $nextchapter    = $chapter->getNext();

        if ($repository->memberAllowChapter($chapter)) {
            $this->template->build('chapter_show', compact('course', 'repository', 'chapter', 'nextchapter'));
        } else {
            redirect('course/show/'.$course->slug, 'refresh');
        }
    }

    public function quiz($quiz)
    {
        
    }
}

/* End of file Course.php */
/* Location: ./application/modules/course/controllers/Course.php */