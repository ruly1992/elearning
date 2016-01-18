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
        $course_member_status   = $repository->courseMemberStatus($slug); //get status member course

        $this->template->build('show', compact('course', 'repository','course_member_status'));
    }

    public function join($slug)
    {
        $this->repository->set($slug);
        
        $course         = $this->repository->get();
        $requirements   = $this->repository->checkRequirements();
        $repository     = $this->repository;

        if (!$requirements->isEmpty()) {
            $this->template->build('requirement', compact('requirements', 'course', 'repository'));
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
            $course_member_status   = $repository->courseMemberStatus($slug); //get status member course
            $this->template->build('chapter', compact('course', 'repository', 'course_member_status'));
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

    public function showquiz($slug, $chapter)
    {
        $chapter        = str_replace('chapter-', '', $chapter);
        $course         = $this->repository->getBySlug($slug);
        $repository     = $this->repository;
        $chapter        = $course->chapters()->whereOrder($chapter)->firstOrFail();
        $quiz           = $chapter->quiz;
        $nextchapter    = $chapter->getNext();

        if (!$repository->memberHasFinishedChapter($chapter)) {
            $repository->startQuiz($quiz);

            if ($repository->checkQuizTimeout($quiz)) {
                if ($repository->memberAllowChapter($chapter)) {
                    $member     = $repository->getMemberSessionQuiz($quiz);

                    $this->template->set_layout('chapter_quiz');
                    $this->template->build('quiz_show', compact('course', 'quiz', 'repository', 'chapter', 'nextchapter', 'member'));
                } else {
                    redirect('course/show/'.$course->slug, 'refresh');
                }
            } else {
                $this->template->build('quiz_timeout', compact('course', 'quiz', 'repository', 'chapter', 'nextchapter', 'member'));
            }
        } else {
            redirect('course/show/'.$course->slug.'/chapter-'.$chapter->order, 'refresh');
        }
    }

    public function submitquiz($slug, $chapter)
    {
        $chapter        = str_replace('chapter-', '', $chapter);
        $course         = $this->repository->getBySlug($slug);
        $repository     = $this->repository;
        $chapter        = $course->chapters()->whereOrder($chapter)->firstOrFail();
        $quiz           = $chapter->quiz;

        $submit         = $this->repository->submitQuizMember($quiz, $this->input->post('answers'));

        if ($submit) {
            redirect('course/showchapter/'.$course->slug.'/chapter-'.$chapter->order, 'refresh');
        } else {
            redirect('course/showchapter/'.$course->slug.'/chapter-'.$chapter->order, 'refresh');
        }
    }

    public function showexam($slug)
    {
        //$chapter
        //$chapter        = str_replace('chapter-', '', $chapter);
        $course         = $this->repository->getBySlug($slug);
        $repository     = $this->repository;
        //$chapter        = $course->chapters()->whereOrder($chapter)->firstOrFail();
        $exam           = $course->exam;
        
        $check = $repository->startExam($exam);

        if ($repository->checkExamTimeout($exam)) {
            //if ($repository->memberAllowChapter($chapter)) {
                $member     = $repository->getMemberSessionExam($exam);

                $this->template->set_layout('exam_layout');
                $this->template->build('exam_show', compact('course', 'exam', 'repository', 'member'));
             //} else {
             //    redirect('course/show/'.$course->slug, 'refresh');
             //}
        } else {
            echo "timeout";
        }
    }

    public function submitexam($slug)
    {
        //$chapter        = str_replace('chapter-', '', $chapter);
        $course         = $this->repository->getBySlug($slug);
        $repository     = $this->repository;
        //$chapter        = $course->chapters()->whereOrder($chapter)->firstOrFail();
        $exam           = $course->exam;

        $submit         = $this->repository->submitExamMember($exam, $this->input->post('answers'));

        if ($submit) {
            redirect('course/show/'.$course->slug, 'refresh');
        } else {
            redirect('course/show/'.$course->slug, 'refresh');
        }
    }
}

/* End of file Course.php */
/* Location: ./application/modules/course/controllers/Course.php */