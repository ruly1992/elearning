<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin
{
	public function index()
	{
		$this->template->build('index');
	}

}

/* End of file Dashboard.php */
/* Location: ./application/modules/dashboard/controllers/Dashboard.php */