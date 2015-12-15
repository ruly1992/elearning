<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('model_faq');
        
        if(!sentinel()->check()) {
            redirect(login_url());
        }
    }

    public function index(){
        $data['faq'] = $this->model_faq->getFAQs();
        $this->load->view('user_faq', $data);
    }
}