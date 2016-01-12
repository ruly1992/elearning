<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Draft extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model(array(
            'Model_thread'  => 'model_thread',
            'Model_visitor' => 'model_visitor',
            'Model_topic'   => 'model_topic'
        ));
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
        if($this->session->flashdata('success')){
            $data['success'] = $this->session->flashdata('success');
        }elseif($this->session->flashdata('failed')){
            $data['failed'] = $this->session->flashdata('failed');
        }

        $user = sentinel()->getUser();
        $data['addTopic']       = anchor('topic/create', '<i class="fa fa-plus"></i> Topic Baru', 'class="btn btn-primary btn-sm"');
        $data['dashTopic']      = anchor('topic/', 'Your Topics', 'class="btn btn-primary btn-sm"');
        $data['tenagaAhli']     = $user->id;
        $data['authorSide']     = $this->model_thread->get_thread_from_author($user->id);
        $data['draftSide']      = $this->model_thread->get_all_drafts($user->id);
        $data['threadSide']      = $this->model_thread->get_all_drafts($user->id);
        $data['closeThreads']   = $this->model_thread->get_close_threads($user->id);
        $data['comments']       = $this->model_thread->get_count_reply(); 
        $data['visitors']       = $this->model_visitor->get_visitors();
        $data['categoriesHead'] = $this->model_thread->get_categories();
        $data['categoriesSide'] = $this->model_thread->get_categories();
        $data['topics']         = $this->model_topic->get_approved_topics();
        $data['categoryUsers']  = $this->model_thread->get_category_users($user->id);
        $data['threadMembers']  = $this->model_thread->get_thread_members();
        $data['userID']         = $user->id;

        $draftThreads           = collect($this->model_thread->get_all_drafts($user->id));
        $data['draftThreads']   = pagination($draftThreads, 10, 'draft', 'bootstrap_md');

        $this->load->view('thread/draft_threads',$data);
    }

    public function view($id)
    {
        $get_thread = $this->model_thread->get_thread($id);
        foreach($get_thread as $t){
            $data = array(
                'idCategory'=> $t->category,
                'category'  => $t->category_name,
                'topic'     => $t->topicName,
                'author'    => $t->author,
                'tanggal'   => $t->created_at,
                'title'     => $t->title,
                'status'    => $t->status,
                'message'   => BBCodeParser($t->message)
            );
        }

        $user = sentinel()->getUser();
        $data['draft']          = site_url('draft/');
        $data['home']           = site_url('draft/');
        $data['categoriesSide'] = $this->model_thread->get_categories();
        $data['threadSide']     = $this->model_thread->get_all_drafts($user->id);
        $data['closeThreads']   = $this->model_thread->get_close_threads($user->id);
        $data['authorSide']     = $this->model_thread->get_thread_from_author($user->id);
        $data['draftSide']      = $this->model_thread->get_all_drafts($user->id);
        $data['draftThreads']   = $this->model_thread->get_all_drafts($user->id);
        $data['reply']          = $this->model_thread->get_reply($id);
        $data['countReply']     = count($data['reply']);
        $data['id']             = $id;

        if ($this->checkTA()==TRUE){
            $data['tenagaAhli']   = $user->id;
        }
        
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
        $data['dashTopic']      = anchor('topic/', 'Your Topics', 'class="btn btn-primary btn-sm"');
        $data['tenagaAhli']     = $user->id;
        $data['authorSide']     = $this->model_thread->get_thread_from_author($user->id);
        $data['draftSide']      = $this->model_thread->get_all_drafts($user->id);
        $data['threadSide']     = $this->model_thread->get_all_drafts($user->id);
        $data['closeThreads']   = $this->model_thread->get_close_threads($user->id);
        $data['comments']       = $this->model_thread->get_count_reply(); 
        $data['visitors']       = $this->model_visitor->get_visitors();
        $data['categoriesHead'] = $getCategory;
        $data['categoriesSide'] = $this->model_thread->get_categories();
        $data['topics']         = $this->model_topic->get_approved_topics();
        $data['categoryUsers']  = $this->model_thread->get_category_users($user->id);
        $data['threadMembers']  = $this->model_thread->get_thread_members();
        $data['userID']         = $user->id;

        $draftThreads           = collect($this->model_thread->get_draft_threads_by_category($user->id, $idCategory));
        $data['draftThreads']   = pagination($draftThreads, 10, 'draft', 'bootstrap_md');

        $this->load->view('thread/draft_threads',$data);
    }

    public function approve($id)
    {
        $data = array( 'status' => '1' );
        $approve = $this->model_thread->approve_thread($data, $id);
        $get_thread = $this->model_thread->get_thread($id);
        foreach($get_thread as $t){
            $title  = $t->title;
        }

        if($approve==TRUE){
            $this->session->set_flashdata('success', 'Thread '.$title.' sudah disetujui');
        }else{
            $this->session->set_flashdata('failed', 'Thread '.$title.' gagal disetujui');
        }
        redirect('draft/');
    }

    public function edit($id)
    {
        $thread=$this->model_thread->get_thread($id);
        foreach($thread as $t){
            $data=array(
                'kategori'=> $t->category,
                'topic'   => $t->topic,
                'type'    => $t->type,
                'title'   => $t->title,
                'message' => $t->message,
            );
            $idCategory = $t->idCategory;
        }

        $user = sentinel()->getUser();
        $data['tenagaAhli']     = $user->id;
        $data['draftThreads']   = $this->model_thread->get_all_drafts($user->id);
        $data['controller']     = 'draft';
        $data['categoriesSide'] = $this->model_thread->get_categories();
        $data['threadSide']      = $this->model_thread->get_all_drafts($user->id);
        $data['closeThreads']   = $this->model_thread->get_close_threads($user->id);
        $data['topics']         = $this->model_topic->getTopics_by_Category($idCategory);
        $data['id_thread']      = $id;
        $data['categories']     = $this->model_thread->get_categories();
        $data['authorSide']     = $this->model_thread->get_thread_from_author($user->id);
        $data['draftSide']      = $this->model_thread->get_all_drafts($user->id);
        $this->load->view('thread/edit_thread',$data);
    }

    public function delete($id)
    {
        $data   = array('id' => $id);
        $delete = $this->model_thread->delete_thread($data);

        if($delete==TRUE){
            $this->model_thread->delete_replies($id);
            $this->model_thread->delete_thread_members($id);
            $this->session->set_flashdata('success','Thread berhasil dihapus');
        }else{
            $this->session->set_flashdata('failed','Thread tidak berhasil dihapus');
        }
        redirect('draft/');
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