<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('model_faq');
    }

    public function index(){
        $data['faq'] = $this->model_faq->getFAQs();
        $this->load->view('landing_faq', $data);
    }
}