<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Symfony\Component\HttpFoundation\Request;

class Elibrary extends Admin
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('media_model');
        $this->load->model('category_model');
        $this->load->model('user/Mod_user');

        $this->medialib = new Library\Media\Media;


    }

    public function index()
    {
        $user_id                    = sentinel()->getUser()->id;
        $data['categoryByUser']     = $this->medialib->getCategoryByUser($user_id);
        $data['categories']         = $this->medialib->getCategories();

        $this->template->build('index', $data);
    }

    public function show($category_id)
    {
        $status             = request()->query->get('status', 'publish');
        $category           = $this->medialib->getCategoryById($category_id);

        if ($status == 'all')
            $filemedia      = $category->media()->withDrafts()->get();
        elseif ($status == 'draft')
            $filemedia      = $category->media()->onlyDrafts()->get();
        elseif ($status == 'publish')
            $filemedia      = $category->media()->get();
        else
            $filemedia      = [];
        
        $data['status']     = $status;
        $data['category']   = $category;
        $data['filemedia']  = pagination($filemedia, 15, 'elibrary/show/'.$category_id)->appends([
            'status' => $status
        ]);

        $this->template->build('show', $data);
    }

    public function edits()
    {
        $ids_asli = $this->input->get('media_id', 0);
        $ids = explode(',', $ids_asli);

        $data['medias'] = $this->medialib->getMedia()->withDrafts()->whereIn('id', $ids)->get();
        $data['media_ids'] = $ids_asli;

        $this->template->add_stylesheet('node_modules/awesomplete/awesomplete.css');
        $this->template->add_stylesheet('node_modules/video.js/dist/video-js.min.css');

        $this->template->add_script('node_modules/vue/dist/vue.min.js');        
        $this->template->add_script('node_modules/awesomplete/awesomplete.min.js');
        $this->template->add_script('node_modules/video.js/dist/video.min.js');
        $this->template->add_script('javascript/jquery.form.min.js');
        $this->template->add_script('javascript/elib.multi.vue.js');
        $this->template->add_script('javascript/elib.js');

        $this->template->build('edits', $data);
    }

    public function edit($media_id)
    {
        $this->form_validation->set_rules('meta', 'Meta', 'required');

        if ($this->form_validation->run() == FALSE) {
            $media      = $this->medialib->getMedia();
            $media      = $media->withDrafts()->findOrFail($media_id);
            $category   = $media->category;

            $data['media']      = $media;
            $data['category']   = $category;

            $this->template->add_stylesheet('node_modules/awesomplete/awesomplete.css');
            $this->template->add_stylesheet('node_modules/video.js/dist/video-js.min.css');

            $this->template->add_script('node_modules/vue/dist/vue.min.js');        
            $this->template->add_script('node_modules/awesomplete/awesomplete.min.js');
            $this->template->add_script('node_modules/video.js/dist/video.min.js');
            $this->template->add_script('javascript/elib.vue.js');
            $this->template->add_script('javascript/elib.js');

            $this->template->build('edit', $data);
        } else {
            
        }
    }

    public function update($media_id, $status = NULL)
    {
        $media      = $this->medialib->getMedia();
        $mediaLib   = new Library\Media\Media;
        $media      = $media->withDrafts()->findOrFail($media_id);

        $full_description   = NULL;
        $request            = Request::createFromGlobals();
        $metadata           = $request->request->get('meta');
        $getMetadata        = $request->request->get('meta');
        $metadata           = array();
        foreach ($getMetadata as $key => $value) {
            if($key != 'full_description'){
                $metaKey = str_replace("_", " ", $key);
            }else{
                $metaKey = $key;
            }
            if($value != ''){
                $metadata[$metaKey] = $value; 
            }
        }

        foreach ($metadata as $key => $value) {
            if ($key == 'title') {
                $title = $value;
                unset($metadata[$key]);
            }
            if ($key == 'description') {
                $description = $value;
                unset($metadata[$key]);
            }
            if ($key == 'full_description'){
                $full_description   = $value;
                unset($metadata[$key]);
            }
        }

        $data = array(
            'title'             => $title,
            'description'       => $description,
            'full_description'  => $full_description,
        );

        $this->media_model->update($media->id, $data);
        $mediaLib->setMetadata($media->id, $metadata);
        
        redirect('elibrary/edit/' . $media->id, 'refresh');
    }

    public function approve($media_id, $status = 'publish')
    {
        $media      = $this->medialib->getMedia();
        $media      = $media->withDrafts()->findOrFail($media_id);
        
        $media->status = $status;
        $media->save();

        if ($this->input->is_ajax_request()) {
            return $media->id;
        } else {
            set_message_success('Media berhasil diperbarui status menjadi ' . $status);

            redirect('elibrary/edit/' . $media_id, 'refresh');
        }
    }

   public function upload()
    {
        $category   = $this->medialib->getCategory();
        $categories = $category->with(['media' => function ($query) {
            $query->userId(sentinel()->getUser()->id)->withDrafts();
        }])->get();
        $data['categories'] = $categories;
        $this->template->build('upload', $data);
    }

    public function submit()
    {
        $this->load->library('upload');
        $kategori   = $this->input->post('kategori');
        $counter    = 0;

        $media      = $this->medialib;
        $category   = $media->setCategory($kategori)->getCategory();

        $files      = $_FILES; 
        $count      = count($_FILES['filemedia']['name']);

        for($i=0; $i<$count; $i++) {

            if($i==0) {
                $idFileName = '';
            } else {
                $idFileName = $i;
            }
            $fileName = $this->input->post('fileName'.$idFileName);
            $nameFile = str_replace(".", " ", $fileName);

            $_FILES['filemedia']['name']    = $files['filemedia']['name'][$i];
            $_FILES['filemedia']['type']    = $files['filemedia']['type'][$i];
            $_FILES['filemedia']['tmp_name']= $files['filemedia']['tmp_name'][$i];
            $_FILES['filemedia']['error']   = $files['filemedia']['error'][$i];
            $_FILES['filemedia']['size']    = $files['filemedia']['size'][$i];

            $this->upload->initialize($this->set_upload_options($category, $nameFile));

            if(!empty($_FILES['filemedia']['name'])) {
                $upload     = $this->upload->do_upload('filemedia');
                $user       = sentinel()->getUser();
                $counter    = $counter+1;
                if($upload) {
                    if($this->checkRole() == TRUE){ //check status user
                        $status = 'publish';
                    }else{
                        $status = 'draft';
                    }
                    $created_at = date('Y-m-d H:i:s');
                    $uploadData = $this->upload->data();
                    $data       = array(
                        'file_name'     => $uploadData['file_name'],
                        'file_type'     => $uploadData['file_type'],
                        'file_size'     => $uploadData['file_size'],
                        'category_id'   => $category->id,
                        'status'        => $status,
                        'user_id'       => $user->id,
                        'created_at'    => $created_at
                    );
                    $this->media_model->save($data);
                    $dataFiles[]    = array(
                        'file_name'     => $uploadData['file_name'],
                        'user_id'       => $user->id,
                        'status'        => $status,
                        'created_at'    => $created_at
                    );
                }
            }
        }

        if($counter == ($count-1)) {
            $this->fillMeta($dataFiles);
        } else {
            $this->session->flashdata('failed', 'Media gagal diunggah');
            redirect('elibrary/upload');
        }
    }

    private function set_upload_options($category, $nameFile)
    {   
        //upload an image options
        $config = array();
        $config['upload_path']   = PATH_ELIBRARY_UPLOAD.'/media/'.$category->name;
        $config['allowed_types'] = '*';
        $config['max_size']      = '20000';
        $config['file_name']     = $nameFile;
        $config['overwrite']     = TRUE;
        return $config;
    }

    public function fillMeta($files)
    {
        $mediaFiles = array();
        for($i=0; $i<count($files); $i++) {
            $name       = $files[$i]['file_name'];
            $created_at = $files[$i]['created_at'];
            $status     = $files[$i]['status'];
            $userId     = $files[$i]['user_id'];

            $mediaFiles[$i] = $this->media_model->getFileData($name, $created_at, $userId, $status);
            foreach($mediaFiles[$i] as $m) { 
                $media   = Library\Media\Model\Media::withDrafts()->userId($userId)->findOrFail($m->id);
            }
            $data['media'][$i] = $media;
        }
        $data['files']  = $mediaFiles;
  
        $this->template->build('add_meta', $data);
    }

    public function addMeta($jumlah)
    {
        $simpan = false;
        for($i=0; $i<$jumlah; $i++){
            $this->form_validation->set_rules('id'.$i, 'Id'.$i, 'required');
            $this->form_validation->set_rules('title'.$i, 'Title'.$i, 'required');
            $this->form_validation->set_rules('description'.$i, 'Description'.$i, 'required');
            $this->form_validation->set_rules('meta'.$i, 'Meta'.$i);
            if($this->form_validation->run()==TRUE){
                $id             = set_value('id'.$i);
                $metadata[$i]   = set_value('meta'.$i);
                $dataFile = array(
                    'title'         => set_value('title'.$i),
                    'description'   => set_value('description'.$i)
                );
                $this->media_model->update($id, $dataFile);
                foreach($metadata[$i] AS $key => $value){
                    $cek = $this->media_model->cekMeta($id, $key, $value);
                    if($cek == FALSE){
                        $dataMeta = array(
                            'key'       => str_replace("_", " ", $key),
                            'value'     => $value,
                            'media_id'  => $id
                        );
                        $this->media_model->addMeta($dataMeta);
                    }
                }
                $simpan = true;
            }else{
                $simpan = validation_errors();            
            }
        }
        if($simpan == true){
            set_message_success('Upload Media dan Add Meta Data Berhasil');

            redirect('elibrary/upload');
        }else{
            set_message_error('Upload Media dan Add Meta Data gagal');

            redirect('elibrary/upload');
        }
    }

    public function delete($media_id, $status)
    {
        try {
            $media      = $this->medialib->getMedia();
            $mediaLib   = new Library\Media\Media;
            $media      = $media->withDrafts()->findOrFail($media_id);

            $category_id   = $media->category;
            $status        = $media->status;

            $this->medialib->deleteMedia($media_id);

            redirect('elibrary/show/'. $category_id->id . '?status=' . $status);
        } catch (Exception $e) {
            set_message_error('Maaf Media tidak tersedia.');

            redirect('elibrary','refresh');
        }
    }

    public function getmetadata()
    {
        $media_id   = $this->input->get('media_id');
        $hidden     = $this->input->get('hidden');

        $media_id   = explode(',', $media_id);

        if (count($media_id) > 1) {
            $metadata = [];

            foreach ($media_id as $id) {
                $metadata['media' . $id] = $this->generatemetadata($id);
            }
        } else {
            $metadata = $this->generatemetadata($media_id[0]);
        }

        $this->output->set_content_type('application/json')->set_output(
            json_encode($metadata)
        );
    }

    public function generatemetadata($media_id)
    {
        $media  = new Library\Media\Media;

        $media->withDrafts()->setMedia($media_id);

        $media->setHiddenMetadata([
            'title',
            'description',
            'full_description',
        ]);

        return $media->getMetadata();
    }

    public function pengampu()
    {
        $data['users']          = sentinel()->findRoleBySlug('pus')->users->pluck('email', 'id')->toArray();
        $pengampu               = collect($this->category_model->getAllGroupByUser());
        $data['getKategori']    = pagination($pengampu, '5', 'elibrary/pengampu');
        $data['kategori_list']  = $this->category_model->getKategoriList();        

        $this->template->build('pengampu', $data);

    }

    public function pengampu_tambah()
    {   
        $this->form_validation->set_rules('user_id', 'Pustakawan', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            keepValidationErrors();
        } else {
            
            $users          = $this->input->post('user_id');
            $category       = $this->input->post('category_id');
            $temp           = FALSE;

            $data           = $this->category_model->getPengampu();

            foreach ($data as $row) {
                if ($row->user_id == $users && $row->category_id == $category) {
                    $temp = TRUE;
                }
            }

            if ($temp == FALSE) {
                $data = array(
                    'user_id'       => $users,
                    'category_id'   => $category,
                );

                $save = $this->category_model->addPengampu($data);
                set_message_success('data berhasil ditambahkan.');            
            } else {
                set_message_error('Data sudah ada.');            
            }

            redirect('elibrary/pengampu', 'refresh');
        }
    }

    public function deletePengampu($id)
    {
        $data = $this->category_model->deletePengampu($id);

        set_message_success('Kategori Konsultasi berhasi dihapus');

        redirect('elibrary/pengampu');
    }

    public function checkRole(){
        if (sentinel()->inRole('adm') OR sentinel()->inRole('pus') OR sentinel()->inRole('su')) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
}

/* End of file Elibrary.php */
/* Location: ./application/modules/elibrary/controllers/Elibrary.php */