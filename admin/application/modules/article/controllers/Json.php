<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Json extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Mod_artikel');
	}

	public function type()
	{
		$id 	= $this->input->get('id');
		$type 	= $this->input->get('type');

		$this->Mod_artikel->setType($id, $type);
	}

}

/* End of file Json.php */
/* Location: ./application/modules/article/controllers/Json.php */