<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Link extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Mod_link');
	}

	public function index()
	{
		$data['link'] = $this->Mod_link->read();

		$this->template->build('index', $data);
	}

	public function create()
	{
		$this->form_validation->set_rules('url', 'URL', 'trim|required|prep_url');
		$this->form_validation->set_rules('name', 'Nama', 'trim|required');
		$this->form_validation->set_rules('description', 'Deskripsi', 'required');

		if ($this->form_validation->run() == FALSE) {
			
			$this->template->build('create');

		} else {
			$data['name']			= set_value('name');
			$data['url']			= set_value('url');
			$data['description']	= set_value('description');

			$this->Mod_link->create($data);

            set_message_success('Link berhasil ditambahkan.');

            redirect('link/index');
		}
	}

	public function update($link_id)
	{
		$this->form_validation->set_rules('url', 'URL', 'trim|required|prep_url');
		$this->form_validation->set_rules('name', 'Nama', 'trim|required');
		$this->form_validation->set_rules('description', 'Deskripsi', 'required');

		if ($this->form_validation->run() == FALSE) {
            
            $data['data'] = $this->Mod_link->getById($link_id);

            $this->template->build('update', $data);
			
		} else {
			
			$data = array(
				'url'			=> set_value('url'),
				'name'			=> set_value('name'),
				'description'	=> set_value('description'),
			);

			$links = $this->Mod_link->update($link_id, $data);

			if ($data == TRUE) {

               set_message_success('Link Informasi Desa Berhasi di Ubah');

               redirect('link');
           } else {

                set_message_error('Link Informasi Desa Gagal di Ubah');

                redirect('link/update');

           }
		}
	}

	public function delete($link_id)
	{
		$data = $this->Mod_link->delete($link_id);

		redirect('link', $data);
	}

}

/* End of file Link.php */
/* Location: ./application/modules/link/controllers/Link.php */