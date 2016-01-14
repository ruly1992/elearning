<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tags extends Admin {

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->library(array('session'));
		$this->load->model('M_tags');

	}
	public function index()
	{
		$data = array('result' => $this->M_tags->read());
		// $this->load->view('index', $data);
		$this->template->build('index', $data);
	}

	public function create(){
		$this->load->library(array('Form_validation'));
		// $this->load->view('create');

		$this->form_validation->set_rules('tag', 'Tags', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			// $this->load->view('_form');
			$this->template->build('_form');

		} else {
			$data = array('tag' => $this->input->post('tag'));
			if ($this->M_tags->create($data)) {
				$this->session->set_flashdata('item', 'Tags berhasil ditambahkan');
			}else{
				$this->session->set_flashdata('invalid', 'Tags Gagal ditambahkan');
			}

			redirect(current_url());
		} 
	}

	public function update($id){
		$this->load->library('Form_validation');
		$this->load->helper('form');
		// $this->load->view('update');

		$this->form_validation->set_rules('tag', 'tag', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="error"', '</div>');

		if ($this->form_validation->run() == FALSE) {
			if ($this->M_tags->getId($id)) {
				$data['data']=$this->M_tags->getId($id);
				// $this->load->view('_form',$data);
				$this->template->build('_form', $data);

			}else{
				$this->session->set_flashdata('invalid', 'data tidak ada');
				// $this->load->view('_form');
				$this->template->build('_form');

			}
		} else {
			$data = array('tag'=> $this->input->post('tag'));
			if ($this->M_tags->update($data, $id)) {
				$this->session->flashdata('item', 'data berhasil diubah');
			}else{
				$this->session->flashdata('invalid', 'data gagal diubah');
			}
			redirect(current_url());
		}
	}

	public function delete($id){
		$data = array('id' => $id);
		if($this->M_tags->delete($data)){
			$this->session->set_flashdata('item', 'Hapus Data Berhasil');
			redirect('tags/');
		}else{
			$this->session->set_flashdata('invalid', 'Gagal Menghapus Data');
			redirect('tags/');
		}
	}
}

/* End of file Tags.php */
/* Location: ./application/modules/tags/controllers/Tags.php */