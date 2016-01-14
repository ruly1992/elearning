<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Library\Auth\Auth;

class Logout extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// $this->load->model('Mod_user', 'model');
        $this->model = new Auth;
	}

	public function index()
	{
		auth()->logout();

		redirect('/','refresh');
	}

}

/* End of file Logout.php */
/* Location: ./application/modules/user/controllers/Logout.php */