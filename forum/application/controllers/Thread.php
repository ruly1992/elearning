<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thread extends CI_Controller 
{
    function __construct()
    {
        parent::__construct();
		$this->load->database();
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation','session','pagination'));
		$this->load->model('model_thread');
    }
	
    public function index()
    {
        $data['threads'] = $this->model_thread->get_all_thread();
        $this->load->view('thread/all_threads',$data);
    }
	
	public function newThread()
	{
        if($this->session->flashdata('hasil')){
            $data['breadcrumb'] = $this->session->flashdata('hasil');
        }else{
            $data['breadcrumb'] = 'Post New Thread';
        }
        $data['category']       = $this->model_thread->get_category();
        $this->load->view('thread/post_thread',$data);
    }
	
    public function postThread()
	{
	    $this->form_validation->set_rules('kategori','Kategori','required');
	    $this->form_validation->set_rules('radio','Radio','required');
	    $this->form_validation->set_rules('title','Title','required');
	    $this->form_validation->set_rules('message','Message','required');
		
	    if($this->form_validation->run()==TRUE){	
		    $data=array(
			    'category'  => set_value('kategori'),
			    'type'      => set_value('radio'),
			    'title'     => set_value('title'),
			    'message'   => set_value('message'),
			    'replay_to' => '0',
			    'author'    => '1',
			    'status'    => '0',
			    'created_at'=> date('Y-m-d').' '.date('G:i:s')
		    );
		    $data = $this->security->xss_clean($data); //xss clean
		    $save = $this->model_thread->save_thread($data);
		    if($save==TRUE){
			    $this->session->set_flashdata('hasil','Thread has been posted');
		    }else{
			    $this->session->set_flashdata('hasil','Thread failed to be posted');
		    }
		    redirect('/thread/new_thread');
	    }else{
		    $this->session->set_flashdata('false',validation_errors());
		    redirect('/thread/new_thread');
	    }
    }
	
	public function viewThread($id)
	{
	    $get_thread=$this->model_thread->get_thread($id);
	    foreach($get_thread as $t){
		    $data=array(
			    'user'   => $t->author,
			    'tanggal'=> $t->created_at,
			    'title'  => $t->title,
			    'message'=> $t->message
		    );
	    }
		$data['id'] = $id;
	    $this->load->view('thread/single',$data);
    }
	
	public function deleteThread($id)
    {
	    $delete=$this->model_thread->delete_thread($id);
	    if($delete==TRUE){
		    $this->session->set_flashdata('hasil','Thread was successfully deleted');
	    }else{
		    $this->session->set_flashdata('hasil','Thread has failed to delete');
	    }
	    redirect('/thread/');
    }
	
	public function editThread($id)
    {
	    $thread=$this->model_thread->get_thread($id);
	    foreach($thread as $t){
		    $data=array(
			    'kategori'=> $t->category,
			    'type'    => $t->type,
			    'title'   => $t->title,
			    'message' => $t->message,
		    );
	    }
	    $data['id_thread'] = $id;
	    $data['category']  = $this->model_thread->get_category();
	    $this->load->view('thread/edit_thread',$data);
    }
	
	public function updateThread($id){
	    $this->form_validation->set_rules('kategori','Kategori','required');
	    $this->form_validation->set_rules('radio','Radio','required');
	    $this->form_validation->set_rules('title','Title','required');
	    $this->form_validation->set_rules('message','Message','required');
		
	    if($this->form_validation->run()==TRUE){	
		    $data=array(
			    'category'  => set_value('kategori'),
			    'type'      => set_value('radio'),
			    'title'     => set_value('title'),
			    'message'   => set_value('message'),
			    'author'    => '1',
			    'updated_at'=> date('Y-m-d').' '.date('G:i:s')
		    );
		    $data = $this->security->xss_clean($data); //xss clean
		    $save = $this->model_thread->update_thread($id,$data);
		    if($save==TRUE){
			    $this->session->set_flashdata('hasil','Thread was successfully updated');
		    }else{
			    $this->session->set_flashdata('hasil','Thread has failed to update');
		    }
		    redirect('/thread/');
	    }else{
		    $this->session->set_flashdata('false',validation_errors());
		    redirect('/thread/');
	    }
    }
}
