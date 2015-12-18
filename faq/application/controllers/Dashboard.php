<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('model_faq');

        if(!sentinel()->check()) {
            redirect(login_url());
        }
    }

    public function index(){
    	if($this->session->flashdata('success')){
    		$data['success'] = $this->session->flashdata('success');
    	}elseif($this->session->flashdata('failed')){
    		$data['failed'] = $this->session->flashdata('failed');
    	}
    	$data['faq'] = $this->model_faq->getFAQs();
    	$this->load->view('dashboard',$data);
    }

    public function create(){
    	$this->load->view('post');
    }

    public function save(){
    	$this->form_validation->set_rules('title','Title','required');
    	$this->form_validation->set_rules('pertanyaan','Pertanyaan','required');
    	$this->form_validation->set_rules('jawaban','Jawaban','required');

    	if($this->form_validation->run()==TRUE){

    		$data = array(
    			'title'	     => set_value('title'),
    			'question' => set_value('pertanyaan'),
    			'answer'	 => set_value('jawaban', '', FALSE),
    			'created_at' => date('Y-m-d H:i:s')
    		);

    		$save = $this->model_faq->save($data);

    		if($save==TRUE){
    			$this->session->set_flashdata('success','FAQ baru berhasil ditambahkan');
    		}else{
    			$this->session->set_flashdata('failed','FAQ baru tidak berhasil disimpan');
    		}
    		redirect('dashboard/');

    	}else{

    		$this->session->set_flashdata('failed',validation_error());
    		redirect('dashboard/');

    	}
    }

    public function edit($id){
        $getFAQ= $this->model_faq->getFaq($id);
        foreach($getFAQ as $f){
            $data = array(
                'id'         => $f->id,
                'title'      => $f->title,
                'pertanyaan' => $f->question,
                'jawaban'    => $f->answer
            );
        }
        $this->load->view('edit',$data);
    }

    public function update($id){
        $this->form_validation->set_rules('title','Title','required');
        $this->form_validation->set_rules('pertanyaan','Pertanyaan','required');
        $this->form_validation->set_rules('jawaban','Jawaban','required');

        if($this->form_validation->run()==TRUE){
            $data = array(
                'title'      => set_value('title'),
                'question'   => set_value('pertanyaan'),
                'answer'     => set_value('jawaban', '', FALSE),
                'updated_at' => date('Y-m-d H:i:s')
            );
            $update = $this->model_faq->update($id,$data);

            if($update==TRUE){
                $this->session->set_flashdata('success', 'FAQ berhasil diperbarui');
            }else{
                $this->session->set_flashdata('failed', 'FAQ tidak berhasil diperbarui');
            }
            redirect('dashboard/');
        }else{
            $this->session->set_flashdata('failed',validation_error());
            redirect('dashboard/');
        }
    }

    public function delete($id){
    	$delete = $this->model_faq->delete($id);
    	if($delete==TRUE){
    		$this->session->set_flashdata('success','FAQ berhasil dihapus');
    	}else{
    		$this->session->set_flashdata('failed','FAQ tidak berhasil dihapus');
    	}
    	redirect('dashboard/');
    }
}