<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends Admin {

	public function __construct()
	{
		parent::__construct();
		
        $this->load->model('Mod_settings');
        $this->load->model('kategori/M_kategori');

	}

	public function index()
	{
		$data['kategori_lists'] = $this->M_kategori->getLists();

		$this->template->build('index', $data);
	}

	public function save()
	{
		$data = $this->input->post();

		foreach ($data as $key => $value) {
			$this->Mod_settings->set($key, $value);
		}

		set_message_success('Setting berhasil disimpan.');


		redirect('settings', 'refresh');
	}

}

/* End of file Settings.php */
/* Location: ./application/modules/settings/controllers/Settings.php */