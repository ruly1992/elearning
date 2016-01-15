<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin
{
    public function index()
    {
        $status     = $this->input->get('status', 'publish');

        if ($status == 'draft') {
            $this->indexDraft();
        } else {
            $courses    = Model\Kelas\Course::onlyInstructor(sentinel()->getUser())->get();
            $drafts     = Model\Kelas\Course::onlyInstructor(sentinel()->getUser())->onlyDrafts()->get();

            $courses    = pagination($courses, 15, 'dashboard');
            $drafts     = pagination($drafts, 15, 'dashboard')->appends(['status' => 'draft']);
            
            $this->template->build('index', compact('courses', 'drafts'));
        }
    }

    public function indexDraft()
    {
        $courses    = Model\Kelas\Course::onlyInstructor(sentinel()->getUser())->onlyDrafts()->get();
        $courses    = pagination($courses, 15, 'dashboard')->appends(['status' => 'draft']);
        
        $this->template->build('index_draft', compact('courses'));
    }
}

/* End of file Dashboard.php */
/* Location: ./application/modules/dashboard/controllers/Dashboard.php */