<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller
{
    public function course($course_id)
    {
        $course     = Model\Kelas\Course::withDrafts()
                        ->with('chapters.quiz.questions')
                        ->with('exam.questions')
                        ->findOrFail($course_id);

        $this->output->set_content_type('application/json')->set_output(json_encode($course->toArray()));
    }

    public function attachment($course_id, $chapter_id = null)
    {
        $course     = Model\Kelas\Course::withDrafts()->findOrFail($course_id);
        $chapters   = $course->chapters;

        $attachments    = $chapters->map(function ($chapter, $index) {
            return ['contents' => $chapter->attachments];
        });

        $this->output->set_content_type('application/json')->set_output(json_encode($attachments->toArray()));
    }

}

/* End of file Api.php */
/* Location: ./application/modules/dashboard/controllers/Api.php */