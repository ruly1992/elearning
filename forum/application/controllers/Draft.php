<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Draft extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model(array('model_thread','model_visitor','model_topic'));
        $this->load->helper(array('BBCodeParser','visitor','thread'));

        if(!sentinel()->check()) {
            redirect(login_url());
        }
        if($this->checkTA()==FALSE){
            $this->session->set_flashdata('failed', 'Maaf, anda tidak dapat mengakses halaman tersebut!');
            redirect('thread/');
        }
    }

    public function index()
    {
        $user = sentinel()->getUser();
        $data['addTopic']       = anchor('topic/create', '<i class="fa fa-plus"></i> Topic Baru', 'class="btn btn-primary btn-sm"');
        $data['authorThreads']  = $this->model_thread->get_thread_from_author($user->id);
        $data['comments']       = $this->model_thread->get_count_reply(); 
        $data['visitors']       = $this->model_visitor->get_visitors();
        $data['categoriesHead'] = $this->model_thread->get_categories();
        $data['categoriesSide'] = $this->model_thread->get_categories();
        $data['topics']         = $this->model_topic->get_topics();
        $data['draftSide']     = $this->model_thread->get_all_drafts();

        $draftThreads           = collect($this->model_thread->get_draft_threads());
        $data['draftThreads']   = pagination($draftThreads, 10, 'thread');

        $this->load->view('thread/draft_threads',$data);
    }

    public function category($idCategory)
    {
        $getCategory        = $this->model_thread->get_category($idCategory);
        foreach($getCategory as $cat){
            $data['category'] = $cat->category_name;
        }

        $user = sentinel()->getUser();
        $data['addTopic']       = anchor('topic/create', '<i class="fa fa-plus"></i> Topic Baru', 'class="btn btn-primary btn-sm"');
        $data['authorThreads']  = $this->model_thread->get_thread_from_author($user->id);
        $data['comments']       = $this->model_thread->get_count_reply(); 
        $data['visitors']       = $this->model_visitor->get_visitors();
        $data['categoriesHead'] = $getCategory;
        $data['categoriesSide'] = $this->model_thread->get_categories();
        $data['topics']         = $this->model_topic->get_topics();
        $data['draftSide']     = $this->model_thread->get_all_drafts();

        $draftThreads           = collect($this->model_thread->get_draft_threads_by_category($idCategory));
        $data['draftThreads']   = pagination($draftThreads, 10, 'thread');

        $this->load->view('thread/draft_threads',$data);
    }

    public function checkTA()
    {
        if (sentinel()->inRole('ta')) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
}