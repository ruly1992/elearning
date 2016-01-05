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

	public function status($open,$close)
	{
		$this->Mod_konsultasi->changeStatus($open,$close);
		redirect('konsultasi');
	}

	public function detail($id)
	{
		$detail['konsultasi'] 		= $this->Mod_konsultasi->getByIdKonsultasi($id);
		$detail['kategori']    		= $this->Mod_konsultasi->getByKategori($id);


		$this->template->build('detail_konsultasi', $detail);
	}

	public function kategori()
	{
		$data['kategori'] 		= $this->model->readKategori();
        $data['tenaga_ahli'] 	= $this->Mod_user->getAll();

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
		$data 				= $this->model->delete($id_kategori);
		$deleteKonsultasi 	= $this->model->delete_kategori_has_konsultasi($id_kategori);
		$deleteUser 		= $this->model->delete_kategori_has_user($id_kategori);

		if($data==TRUE){
            $this->Mod_konsultasi->delete_konsultasi_by_kategori($id_kategori);
            set_message_success('Kategori berhasil dihapus');
        }else{
            set_message_success('Kategori tidak berhasil dihapus');
        }

		redirect('konsultasi/kategori');
	}
	
	public function pengampu()
	{
        $data['users']      	= sentinel()->findRoleBySlug('ta')->users->pluck('email', 'id')->toArray();       
        $data['getKategori']    = $this->model->getAllGroupByUser();        
        // $data['getUser']    	= $this->model->getByUser();        
		$data['kategori_list'] 	= $this->model->getKategoriList();

		$this->template->build('pengampu', $data);
	}

	public function pengampu_tambah()
	{   
		$this->form_validation->set_rules('user_id', 'Tenaga Ahli', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
            keepValidationErrors();

        } else {
        	
        	$users 			= $this->input->post('user_id');
        	$kategori_list 	= $this->input->post('id_kategori');

        	$data = array(
        		'user_id' 		=> $users,
        		'id_kategori'	=> $kategori_list,
        	);

            $save = $this->model->addPengampu($data);

            set_message_success('data berhasil ditambahkan.');

            redirect('konsultasi/pengampu', 'refresh');
        }
	}

	function deletePengampu($id)
	{
		$data = $this->model->deletePengampu($id);

		set_message_success('Kategori Konsultasi berhasi dihapus');

		redirect('konsultasi/pengampu');
	}

}

/* End of file Konsultasi.php */
/* Location: ./application/modules/konsultasi/controllers/Konsultasi.php */
