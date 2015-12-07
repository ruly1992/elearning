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

    public function create()
    {
        $hostname = getenv('AUTH_DB_HOST') ?: 'localhost';
        $username = getenv('AUTH_DB_USERNAME') ?: 'root';
        $password = getenv('AUTH_DB_PASSWORD') ?: '';
        $database = getenv('AUTH_DB_DATABASE') ?: 'portal_learning';

        $source = new DatabaseSource($hostname, $username, $password, $database);
        $this->wilayah->setSource($source);

        $source = $this->wilayah->getSource();

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
                'category' => set_value('kategori'),
                'topic'    => set_value('topic'),
                'daerah'   => set_value('daerah')
            );
            $save = $this->model_topic->save_topic($data);
            if($save==TRUE){
                $this->session->set_flashdata('success','Topic berhasil dibuat');
            }else{
                $this->session->set_flashdata('failed','Topic tidak berhasil dibuat');
            }
            redirect('topic/create');
        }else{
            $this->session->set_flashdata('failed',validation_error());
            rediect('topic/create');
        }
    }
}