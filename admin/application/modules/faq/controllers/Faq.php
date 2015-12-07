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

}

/* End of file Faq.php */
/* Location: ./application/modules/faq/controllers/Faq.php */