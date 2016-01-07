<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Symfony\Component\HttpFoundation\Request;
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

        $hostname = getenv('AUTH_DB_HOST') ?: 'localhost';
        $username = getenv('AUTH_DB_USERNAME') ?: 'root';
        $password = getenv('AUTH_DB_PASSWORD') ?: '';
        $database = getenv('AUTH_DB_DATABASE') ?: 'portal_learning';

        $source = new DatabaseSource($hostname, $username, $password, $database);
        $this->wilayah->setSource($source);
    }

    public function wilayah(){
        echo $this->wilayah->ajax();
    }

    public function getWilayah(){
        $source = $this->wilayah->getSource();
        return $source->getAllProvinsi();
    }

    public function index(){
        if($this->session->flashdata('success')){
            $data['success'] = $this->session->flashdata('success');
        }elseif($this->session->flashdata('failed')){
            $data['failed'] = $this->session->flashdata('failed');
        }
        if($this->checkTA()==FALSE){
            $this->session->set_flashdata('failed', 'Maaf, anda tidak dapat mengakses halaman tersebut!');
            redirect('thread/');
        }

        $user                   = sentinel()->getUser();
        $data['categoriesSide'] = $this->model_thread->get_categories();
        $data['threadSide']     = $this->model_thread->get_all_threads();
        $data['closeThreads']   = $this->model_thread->get_close_threads($user->id);
        $data['tenagaAhli']     = $user->id;
        $data['draftSide']      = $this->model_thread->get_all_drafts($user->id);
        $data['authorSide']     = $this->model_thread->get_thread_from_author($user->id);
        $data['provinsi']       = $this->getWilayah();

        $topics             = collect($this->model_topic->get_topics_from_id($user->id));
        $data['topics']     = pagination($topics, 5, 'topic', 'bootstrap_md');
        $this->load->view('topic/view',$data);
    }

    public function create()
    {
        if($this->checkTA()==FALSE){
            $this->session->set_flashdata('failed', 'Maaf, anda tidak dapat mengakses halaman tersebut!');
            redirect('topic/');
        }

        if($this->session->flashdata('success')){
            $data['success'] = $this->session->flashdata('success');
        }elseif($this->session->flashdata('failed')){
            $data['failed'] = $this->session->flashdata('failed');
        }

        $user                   = sentinel()->getUser();
        $data['sideTopics']     = $this->model_topic->get_topics_from_id($user->id);
        $data['categoriesSide'] = $this->model_thread->get_categories();
        $data['threadSide']     = $this->model_thread->get_all_threads();
        $data['closeThreads']   = $this->model_thread->get_close_threads($user->id);
        $data['categories']     = $this->model_topic->get_categories();
        $data['draftSide']      = $this->model_thread->get_all_drafts($user->id);
        $data['authorSide']     = $this->model_thread->get_thread_from_author($user->id);
        $data['tenagaAhli']     = $user->id;

    	$this->load->view('topic/create', $data);
    }

    public function save(){
        if($this->checkTA()==FALSE){
            $this->session->set_flashdata('failed', 'Maaf, anda tidak dapat mengakses halaman tersebut!');
            redirect('topic/');
        }

        $this->form_validation->set_rules('kategori','Kategori','required');
        $this->form_validation->set_rules('topic','Topic','required');
        $this->form_validation->set_rules('desa','Daerah','required');

        if($this->form_validation->run()==TRUE){
            $category           = set_value('kategori'); 
            $getUsersCategory   = $this->model_topic->get_userID_by_category($category);
            $user               = sentinel()->getUser();

            foreach($getUsersCategory AS $u){
                if($u->user_id == $user->id){
                    $status = '1';
                }else{
                    $status = '0';
                }
            }

            $data = array(
                'tenaga_ahli' => $user->id, 
                'category'    => $category,
                'topic'       => set_value('topic'),
                'daerah'      => set_value('desa'),
                'created_at'  => date('Y-m-d H:i:s'),
                'status'      => $status
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
        if($this->checkTA()==FALSE){
            $this->session->set_flashdata('failed', 'Maaf, anda tidak dapat mengakses halaman tersebut!');
            redirect('topic/');
        }

        $getTopic = $this->model_topic->selectTopic($id);
        foreach($getTopic as $t){
            $daerah = explode('.', $t->daerah);
            $data = array(
                'idTopic'  => $t->id,
                'kategori' => $t->category,
                'topic'    => $t->topic,
                'provinsi' => $daerah[0].'.00.00.0000',
                'kabkota'  => $daerah[0].'.'.$daerah[1].'.00.0000',
                'kecamatan'=> $daerah[0].'.'.$daerah[1].'.'.$daerah[2].'.0000',
                'desa'     => $t->daerah
            );
        }

        $user                   = sentinel()->getUser();
        $data['sideTopics']     = $this->model_topic->get_topics_from_id($user->id);
        $data['categoriesSide'] = $this->model_thread->get_categories();
        $data['threadSide']     = $this->model_thread->get_all_threads();
        $data['closeThreads']   = $this->model_thread->get_close_threads($user->id);
        $data['categories']     = $this->model_topic->get_categories();
        $data['draftSide']      = $this->model_thread->get_all_drafts($user->id);
        $data['authorSide']     = $this->model_thread->get_thread_from_author($user->id);
        $data['tenagaAhli']     = $user->id;

        $this->load->view('topic/edit',$data);
    }

    public function update($id){
        if($this->checkTA()==FALSE){
            $this->session->set_flashdata('failed', 'Maaf, anda tidak dapat mengakses halaman tersebut!');
            redirect('topic/');
        }

        $this->form_validation->set_rules('kategori','Kategori','required');
        $this->form_validation->set_rules('topic','Topic','required');
        $this->form_validation->set_rules('desa','Daerah','required');

        if($this->form_validation->run()==TRUE){
            $user = sentinel()->getUser();

            $data = array(
                'tenaga_ahli' => $user->id,
                'category'    => set_value('kategori'),
                'topic'       => set_value('topic'),
                'daerah'      => set_value('desa'),
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
        if($this->checkTA()==FALSE){
            $this->session->set_flashdata('failed', 'Maaf, anda tidak dapat mengakses halaman tersebut!');
            redirect('topic/');
        }
        
        $delete = $this->model_topic->delete($id);
        if($delete==TRUE){
            $deleteThread = $this->model_thread->delete_thread_by_topic($id);
            $this->session->set_flashdata('success','Topic was successfully deleted.');
        }else{
            $this->session->set_flashdata('failed','Topic was failed to be deleted.');
        }
        redirect('topic/');
    }

    public function approve($id)
    {
        $getTopic = $this->model_topic->selectTopic($id);
        foreach($getTopic as $top){
            $topic = $top->topic;
        }

        $data = array('status' => '1');
        $approve = $this->model_topic->approve_topic($id, $data);
        if($approve == TRUE){
            $this->session->set_flashdata('success', 'Topic '.$topic.' sudah disetujui');
        }else{
            $this->session->set_flashdata('failed', 'Topic '.$topic.' tidak berhasil disetujui');
        }
        redirect('topic/');
    }

    public function checkTA()
    {
        if (sentinel()->inRole('ta')) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
}