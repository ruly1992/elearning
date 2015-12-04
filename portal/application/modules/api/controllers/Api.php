<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Symfony\Component\HttpFoundation\Request;

class Api extends CI_Controller
{
	protected $request;

	public function __construct()
	{
		parent::__construct();

		$this->request = Request::createFromGlobals();
	}

	public function user()
	{
		$email		= $this->input->post('email');
		$password	= $this->input->post('password');

		$login		= ion_auth()->login($email, $password);

		if ($login) {
			$data = [
				'success'	=> 'TRUE',
				'data'		=> auth()->user(),
			];
		} else {
			$data = [
				'success'	=> 'FALSE',
				'data'		=> [],
			];
		}

		$this->output
			->set_header('Access-Control-Allow-Credentials: true')
			->set_header('Access-Control-Allow-Origin: *')
			->set_header('Access-Control-Allow-Headers: POST, GET, PUT, DELETE, OPTIONS')
			->set_header('Access-Control-Allow-Headers: Content-Type,X-CSRF-Token, X-Requested-With, Accept, Accept-Version, Content-Length, Content-MD5,  Date, X-Api-Version, X-File-Name')
			->set_header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS')
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}
}

/* End of file Api.php */
/* Location: ./application/modules/api/controllers/Api.php */