<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum extends Admin {

	public function __construct()
	{
		parent::__construct();
	}

	function kategori(){
		$this->template->build('kategori');
	}
	function kategori_tambah(){
		$post=$this->input->post('data');
		if(empty($post)){
		$this->template->build('kategori_tambah');
		}else{
			$this->db->insert('forum_kategori',$post);
			redirect('forum/kategori','refresh');
		}
	}
	function kategori_edit(){
		$post=$this->input->post('data');
		if(empty($post)){
		$this->template->build('kategori_edit');
		}else{	
			$id=$this->input->post('id');
			$this->db->update('forum_kategori',$post,array('id'=>$id));
			redirect('forum/kategori','refresh');			
		}
	}
	function kategori_hapus($id){
		$this->db->delete('forum_kategori',array('id'=>$id));
		redirect('forum/kategori','refresh');
	}

	function pengampu()
	{
		$this->template->build('pengampu');
	}

	function pilih_user()
	{
		$this->template->build('pilih_user');
	}

	function pilih_user_pilih($id)
	{
		$this->template->build('pilih_user_pilih');
	}	

	function pilih_user_save()
	{
		$post=$this->input->post('data');
		$this->db->insert('forum_kategori_user',$post);
		redirect('forum/pengampu');
	}		
	
	function pengampu_tambah($id)
	{       
		$post=$this->input->post('data');
		if(empty($post)){
		$this->template->build('pengampu_tambah');
		}else{
			$this->db->insert('forum_kategori_user',$post);
			redirect('forum/pengampu');
		}

	}

	function pengampu_kategori_hapus($id)
	{
		$this->db->delete('forum_kategori_user',array('id'=>$id));
		redirect('forum/pengampu');	
	}

}

/* End of file Konsultasi.php */
/* Location: ./application/modules/konsultasi/controllers/Konsultasi.php */
