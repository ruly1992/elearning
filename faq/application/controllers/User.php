<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model(array('Model_faq' => 'model_faq'));
        
        if(!sentinel()->check()) {
            redirect(login_url());
        }
    }

    public function index(){
        $faqs               = collect($this->model_faq->getFAQs());
        $perPage            = 5;
        $data['faq']        = pagination($faqs, $perPage, '/', 'bootstrap_md');
        $data['perPage']    = $perPage;
        $this->load->view('user_faq', $data);
        
    }
}