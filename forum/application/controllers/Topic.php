<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Nurmanhabib\WilayahIndonesia\Sources\DatabaseSource;

class Topic extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model(array('model_topic', 'model_thread'));
        $this->load->library('WilayahIndonesia', null, 'wilayah');
        $this->load->helper('thread');

        if(!sentinel()->check()) {
            redirect(login_url());
        }
    }

    public function getWilayah(){
        $hostname = getenv('AUTH_DB_HOST') ?: 'localhost';
        $username = getenv('AUTH_DB_USERNAME') ?: 'root';
        $password = getenv('AUTH_DB_PASSWORD') ?: '';
        $database = getenv('AUTH_DB_DATABASE') ?: 'portal_learning';

        $source = new DatabaseSource($hostname, $username, $password, $database);
        $this->wilayah->setSource($source);

        $source = $this->wilayah->getSource();
        return $source->getAllProvinsi();
    }

    public function index(){
        if($this->session->flashdata('success')){
            $data['success'] = $this->session->flashdata('success');
        }elseif($this->session->flashdata('failed')){
            $data['failed'] = $this->session->flashdata('failed');
        }
        if($this->checkRole()==FALSE){
            $this->session->set_flashdata('failed', 'Maaf, anda tidak dapat mengakses halaman tersebut!');
            redirect('thread/');
        }

        $data['categoriesSide'] = $this->model_thread->get_categories();
        $data['threadSide']     = $this->model_thread->get_all_threads();

        $user               = sentinel()->getUser();
        $data['provinsi']   = $this->getWilayah();
        $topics             = collect($this->model_topic->get_topics_from_id($user->id));
        $data['topics']     = pagination($topics, 10, 'topic');
        $this->load->view('topic/view',$data);
    }

    public function create()
    {
        if($this->checkRole()==FALSE){
            $this->session->set_flashdata('failed', 'Maaf, anda tidak dapat mengakses halaman tersebut!');
            redirect('topic/');
        }

        if($this->session->flashdata('success')){
            $data['success'] = $this->session->flashdata('success');
        }elseif($this->session->flashdata('failed')){
            $data['failed'] = $this->session->flashdata('failed');
        }

        $data['categoriesSide'] = $this->model_thread->get_categories();
        $data['threadSide']     = $this->model_thread->get_all_threads();
        $data['categories']     = $this->model_topic->get_categories();
        $data['provinsi']       = $this->getWilayah();

    	$this->load->view('topic/create', $data);
    }

    public function save(){
        if($this->checkRole()==FALSE){
            $this->session->set_flashdata('failed', 'Maaf, anda tidak dapat mengakses halaman tersebut!');
            redirect('topic/');
        }

        $this->form_validation->set_rules('kategori','Kategori','required');
        $this->form_validation->set_rules('topic','Topic','required');
        $this->form_validation->set_rules('daerah','Daerah','required');

        if($this->form_validation->run()==TRUE){
            $user = sentinel()->getUser();

            $data = array(
                'tenaga_ahli' => $user->id, 
                'category'    => set_value('kategori'),
                'topic'       => set_value('topic'),
                'daerah'      => set_value('daerah'),
                'created_at'  => date('Y-m-d H:i:s')
            );

            $save = $this->model_topic->save($data);

            if($save==TRUE){
                $this->session->set_flashdata('success','New topic has successfully created.');
            }else{
                $this->session->set_flashdata('failed','New topic was failed to be created.');
            }
            redirect('topic/');
        }else{
            $this->session->set_flashdata('failed',validation_error());
            rediect('topic/');
        }
    }

    public function edit($id){
        if($this->checkRole()==FALSE){
            $this->session->set_flashdata('failed', 'Maaf, anda tidak dapat mengakses halaman tersebut!');
            redirect('topic/');
        }

        $getTopic = $this->model_topic->selectTopic($id);
        foreach($getTopic as $t){
            $data = array(
                'idTopic'  => $t->id,
                'kategori' => $t->category,
                'topic'    => $t->topic,
                'daerah'   => $t->daerah
            );
        }

        $data['categoriesSide'] = $this->model_thread->get_categories();
        $data['threadSide']     = $this->model_thread->get_all_threads();
        $data['categories']     = $this->model_topic->get_categories();
        $data['provinsi']       = $this->getWilayah();

        $this->load->view('topic/edit',$data);
    }

    public function update($id){
        if($this->checkRole()==FALSE){
            $this->session->set_flashdata('failed', 'Maaf, anda tidak dapat mengakses halaman tersebut!');
            redirect('topic/');
        }

        $this->form_validation->set_rules('kategori','Kategori','required');
        $this->form_validation->set_rules('topic','Topic','required');
        $this->form_validation->set_rules('daerah','Daerah','required');

        if($this->form_validation->run()==TRUE){
            $user = sentinel()->getUser();

            $data = array(
                'tenaga_ahli' => $user->id,
                'category'    => set_value('kategori'),
                'topic'       => set_value('topic'),
                'daerah'      => set_value('daerah'),
                'updated_at'  => date('Y-m-d H:i:s')
            );

            $update = $this->model_topic->update($id,$data);
            
            if($update==TRUE){
                $this->session->set_flashdata('success','Topic was successfully updated.');
            }else{
                $this->session->set_flashdata('failed','Topic was failed to be updated.');
            }
            redirect('topic/');
        }else{
            $this->session->set_flashdata('success',validation_error());
            redirect('topic/');
        }
    }

    public function delete($id){
        if($this->checkRole()==FALSE){
            $this->session->set_flashdata('failed', 'Maaf, anda tidak dapat mengakses halaman tersebut!');
            redirect('topic/');
        }
        
        $delete = $this->model_topic->delete($id);
        if($delete==TRUE){
            $this->session->set_flashdata('success','Topic was successfully deleted.');
        }else{
            $this->session->set_flashdata('failed','Topic was failed to be deleted.');
        }
        redirect('topic/');
    }

    public function checkRole()
    {
        if (sentinel()->inRole('ta')) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
}