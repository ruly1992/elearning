<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Author extends CI_Controller 
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
    }

    public function index(){
    	redirect('thread/');
    }

    public function threads()
    {
        if ($this->checkTA()==TRUE){
            $data['addTopic']   = anchor('topic/create', '<i class="fa fa-plus"></i> Topic Baru', 'class="btn btn-primary btn-sm"');
        }

        $user = sentinel()->getUser();
        $data['authorThreads']  = $this->model_thread->get_thread_from_author($user->id);
        $data['comments']       = $this->model_thread->get_count_reply(); 
        $data['visitors']       = $this->model_visitor->get_visitors();
        $data['categoriesHead'] = $this->model_thread->get_categories();
        $data['categoriesSide'] = $this->model_thread->get_categories();
        $data['topics']         = $this->model_topic->get_topics();
        $data['authorSide']     = $this->model_thread->get_thread_from_author($user->id);
        $data['draftSide']	= $this->model_thread->get_draft_threads();
        $data['breadcrumb']		= 'Your Threads';

        $threads            = collect($this->model_thread->get_thread_from_author($user->id));
        $data['threads']    = pagination($threads, 10, 'thread');

        $this->load->view('thread/author_threads',$data);
    }

    public function view($id)
    {
        $get_thread = $this->model_thread->get_thread($id);
        foreach($get_thread as $t){
            $data = array(
                'idCategory'=> $t->category,
                'category'  => $t->category_name,
                'user'      => $t->author,
                'tanggal'   => $t->created_at,
                'title'     => $t->title,
                'message'   => BBCodeParser($t->message)
            );
        }
        $data['author']         = 'author';
        $data['categoriesSide'] = $this->model_thread->get_categories();
        $data['threadSide']     = $this->model_thread->get_all_threads();
        $data['reply']          = $this->model_thread->get_reply($id);
        $data['countReply']     = count($data['reply']);
        $data['id']             = $id;
        
        if($this->session->flashdata('success')){
            $data['success'] = $this->session->flashdata('success');
        }elseif($this->session->flashdata('failed')){
            $data['failed'] = $this->session->flashdata('failed');
        }

        $this->load->view('thread/single',$data);
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
        $data['authorSide']     = $this->model_thread->get_thread_from_author($user->id);
        $data['draftSide']     = $this->model_thread->get_all_drafts();

        $threads           = collect($this->model_thread->get_draft_threads_by_category($idCategory));
        $data['threads']   = pagination($threads, 10, 'thread');

        $this->load->view('thread/author_threads',$data);
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