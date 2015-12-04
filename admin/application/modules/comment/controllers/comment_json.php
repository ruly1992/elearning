<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment_json extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here

		$this->load->model('Mod_comment');
	}

	public function status()
	{
		$id 	= $this->input->get('id');
		$status	= $this->input->get('status');

		$this->Mod_comment->setStatus($id, $status);
	}

}

/* End of file comment_json.php */
/* Location: ./application/modules/comment/controllers/comment_json.php */