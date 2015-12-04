<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konsultasi extends Admin {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Mod_konsultasi');
		$this->load->model('Mod_kons_kategori','model');
		$this->load->model('user/Mod_user');

		$this->status = array(
            'open'   => 'Open',
            'close'  => 'Close',
        );
	}

	public function index()
	{
		$data['konsultasi'] = $this->Mod_konsultasi->readKonsultasi();
		$this->template->build('index', $data);
	}

	function status($open,$close)
	{
		if ($open == 'open') {
			$this->db->update('konsultasi', array('status'=>'close'), array('id'=> $close));
		} else {
			$this->db->update('konsultasi', array('status'=>'open'), array('id'=> $close));
		}

		redirect('konsultasi');
	}

	public function detail($id)
	{
		$detail['konsultasi'] 		= $this->Mod_konsultasi->getByIdKonsultasi($id);
		$detail['user_id']    		= $this->Mod_konsultasi->getUserKonsul($id);
		$detail['kategori']    		= $this->Mod_konsultasi->getByKategori($id);


		$this->template->build('detail_konsultasi', $detail);
	}

	public function kategori()
	{
		$group_name = 19;
		$data['kategori'] 		= $this->model->readKategori();
        $data['tenaga_ahli'] 	= $this->Mod_user->getAll();
        $data['users'] 			= $this->model->getUserGroups();

		$this->template->build('kons_kategori_tampil', $data);
	}

	public function addKategori()
	{
		$this->form_validation->set_rules('name', 'Konsultasi Kategori', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['kategori'] = $this->model->readKategori();
			$this->template->build('kons_kategori_tampil', $data);


		} else {
			$konsKategori['name']				= set_value('name');
			$konsKategori['description']		= set_value('description');

			// $tenaga_ahli['user_id']				= set_value('user_id', array());

			$id = $this->model->addKategori($konsKategori);

            set_message_success('Kategori Konsultasi berhasil ditambahkan.');

            redirect('konsultasi/kategori');
		}
	}

	public function updateKategori($id_kategori)
	{
		$this->form_validation->set_rules('name', 'Name', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $param                  = $this->model->getByIdKategori($id_kategori);
            $data['kategori']       = $param->row();

            $this->template->build('kons_kategori_update',$data);
        } else {
            $konsKategori['name']           	  = $this->input->post('name');
            $konsKategori['description']    	  = $this->input->post('description');
            $konsKategori['id_tenaga_ahli']         = $this->input->post('id_tenaga_ahli');
            
            $res = $this->model->updateKategori($id_kategori, $konsKategori);

            if ($res==TRUE) {
                set_message_success('Kategori berhasil diperbarui.');

                redirect('konsultasi/kategori');
            } else {
                set_message_error('Kategori gagal diperbarui.');

                redirect('konsultas/updateKategori');    
            }
        }
	}

	public function deleteKategori($id_kategori)
	{
		$data = $this->model->delete($id_kategori);

		set_message_success('Kategori Konsultasi berhasi dihapus');

		redirect('konsultasi/kategori');
	}

	function pengampu()
	{
		$this->template->build('pengampu');
	}

	function pengampu_tambah($id)
	{       
		$post=$this->input->post('data');
		if(empty($post)){
		$this->template->build('pengampu_tambah');
		}else{
			$data=$this->db->get_where('users_groups',array('user_id'=>$post['user_id']))->result();
			foreach ($data as $d) {$post['group_id']=$d->group_id;}
			$this->db->insert('user_kategori',$post);
			redirect('konsultasi/pengampu');
		}

	}

	function pengampu_kategori_hapus($id)
	{
		$this->db->delete('user_kategori',array('id'=>$id));
		redirect('konsultasi/pengampu');	
	}

}

/* End of file Konsultasi.php */
/* Location: ./application/modules/konsultasi/controllers/Konsultasi.php */
