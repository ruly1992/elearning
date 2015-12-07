<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mod_faq');
	}

	public function index()
	{
		$data['list_faq'] = $this->Mod_faq->getAll();

		$this->template->build('index', $data);
	}

	public function create()
	{
		$this->form_validation->set_rules('pertanyaan', 'pertanyaan', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			
			$this->template->build('create');

		} else {
			$data['pertanyaan']			= set_value('pertanyaan');
			$data['jawaban']			= set_value('jawaban');

			$this->Mod_faq->create($data);

            set_message_success('FAQ berhasil ditambahkan.');

            redirect('faq/index');
		}
	}

}

/* End of file Faq.php */
/* Location: ./application/modules/faq/controllers/Faq.php */