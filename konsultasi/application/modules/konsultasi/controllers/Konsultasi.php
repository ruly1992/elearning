<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konsultasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('M_konsultasi');

		$this->status = array(
			'open'	=> 'Open',
			'close'	=> 'Close',
		);
	}

	public function index()
	{
		$data['konsultasi'] = $this->M_konsultasi->readKonsultasi();

        $this->load->view('header'); 
        $this->load->view('index', $data);
        $this->load->view('footer');
	}

}

/* End of file Konsultasi.php */
/* Location: ./application/modules/konsultasi/controllers/Konsultasi.php */