<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Nurmanhabib\WilayahIndonesia\Sources\DatabaseSource;

class Topic extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('model_topic');
        $this->load->library('WilayahIndonesia', null, 'wilayah');
    }

    public function index(){
        if($this->session->flashdata('success')){
            $data['success'] = $this->session->flashdata('success');
        }elseif($this->session->flashdata('failed')){
            $data['failed'] = $this->session->flashdata('failed');
        }
        $data['topics'] = $this->model_topic->get_topics();
        $this->load->view('topic/view',$data);
    }

    public function create()
    {
        $hostname = getenv('AUTH_DB_HOST') ?: 'localhost';
        $username = getenv('AUTH_DB_USERNAME') ?: 'root';
        $password = getenv('AUTH_DB_PASSWORD') ?: '';
        $database = getenv('AUTH_DB_DATABASE') ?: 'portal_learning';

        $source = new DatabaseSource($hostname, $username, $password, $database);
        $this->wilayah->setSource($source);

        $source = $this->wilayah->getSource();

        if($this->session->flashdata('success')){
            $data['success'] = $this->session->flashdata('success');
        }elseif($this->session->flashdata('failed')){
            $data['failed'] = $this->session->flashdata('failed');
        }
        $data['categories'] = $this->model_topic->get_categories();
        $data['provinsi']   = $source->getAllProvinsi();

    	$this->load->view('topic/create', $data);
    }

    public function save(){
        $this->form_validation->set_rules('kategori','Kategori','required');
        $this->form_validation->set_rules('topic','Topic','required');
        $this->form_validation->set_rules('daerah','Daerah','required');

        if($this->form_validation->run()==TRUE){
            $data = array(
                'tenaga_ahli' => '1', 
                'category'    => set_value('kategori'),
                'topic'       => set_value('topic'),
                'daerah'      => set_value('daerah')
            );
            $save = $this->model_topic->save($data);
            if($save==TRUE){
                $this->session->set_flashdata('success','Topic berhasil dibuat.');
            }else{
                $this->session->set_flashdata('failed','Topic tidak berhasil dibuat.');
            }
            redirect('topic/create');
        }else{
            $this->session->set_flashdata('failed',validation_error());
            rediect('topic/');
        }
    }

    public function delete($id){
        $delete = $this->model_topic->delete($id);
        if($delete==TRUE){
            $this->session->set_flashdata('success','Topic berhasil dihapus.');
        }else{
            $this->session->set_flashdata('failed','Topic tidak berhasil dihapus.');
        }
        redirect('topic/');
    }
}