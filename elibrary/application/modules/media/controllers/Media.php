<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Symfony\Component\HttpFoundation\Request;

class Media extends Admin
{
    protected $medialib;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('media_model');
        $this->medialib = new Library\Media\Media;
    }

    public function index()
    {
        $category   = $this->medialib->getCategory();
        $categories = $category->with(['media' => function ($query) {
            $query->userId(sentinel()->getUser()->id)->withDrafts();
        }])->get();

        $data['categories'] = pagination($categories, 15, 'elibrary/media');

        $this->template->build('index', $data);
    }

    public function show($category)
    {
        $user       = sentinel()->getUser();
        $category   = Library\Media\Model\Category::with(['media' => function ($query) use ($user) {
            $query->withDrafts()
                ->userId($user->id)
                ->latest();
        }])->find($category);

        $data['category']   = $category;
        $data['medias']     = pagination($category->media, 15, 'media/show/'. $category->id);

        $this->template->build('show', $data);
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

        for($i=0; $i<$count; $i++){
            if($i==0){
                $idFileName = '';
            }else{
                $idFileName = $i;
            }
            $fileName = $this->input->post('fileName'.$idFileName);

            $_FILES['filemedia']['name']    = $files['filemedia']['name'][$i];
            $_FILES['filemedia']['type']    = $files['filemedia']['type'][$i];
            $_FILES['filemedia']['tmp_name']= $files['filemedia']['tmp_name'][$i];
            $_FILES['filemedia']['error']   = $files['filemedia']['error'][$i];
            $_FILES['filemedia']['size']    = $files['filemedia']['size'][$i];

            $this->upload->initialize($this->set_upload_options($category, $fileName));

            if(!empty($_FILES['filemedia']['name'])){
                $upload     = $this->upload->do_upload('filemedia');
                $user       = sentinel()->getUser();
                $counter    = $counter+1;
                if($upload){
                    $created_at = date('Y-m-d H:i:s');
                    $uploadData = $this->upload->data();
                    $data = array(
                        'file_name'     => $uploadData['file_name'],
                        'file_type'     => $uploadData['file_type'],
                        'file_size'     => $uploadData['file_size'],
                        'category_id'   => $category->id,
                        'status'        => 'draft',
                        'user_id'       => $user->id,
                        'created_at'    => $created_at
                    );
                    $this->media_model->save($data);
                    $dataFiles[]    = array(
                        'file_name'     => $uploadData['file_name'],
                        'user_id'       => $user->id,
                        'status'        => 'draft',
                        'created_at'    => $created_at
                    );
                }
            }
        }
        
        if($counter == ($count-1)){
            $this->fillMeta($dataFiles);
        }else{
            $this->session->flashdata('failed', 'Media gagal diunggah');
            redirect('media/upload');
        }

    }

    private function set_upload_options($category, $fileName)
    {   
        //upload an image options
        $config = array();
        $config['upload_path']   = PATH_ELIBRARY_UPLOAD.'/media/'.$category->name;
        $config['allowed_types'] = '*';
        $config['max_size']      = '5000';
        $config['file_name']     = $fileName;
        $config['overwrite']     = TRUE;

        return $config;
    }

    protected function submitSingle(Library\Media\Model\Category $category, $file, $metadata = [])
    {
        $user = sentinel()->getUser();

        $media = new Library\Media\Media;
        $media->uploadMediaDraft($category->id, $file, $metadata, $user->id);

        return $media->getMedia();
    }

    public function fillMeta($files){

        $mediaFiles = array();
        for($i=0; $i<count($files); $i++){
            $name       = $files[$i]['file_name'];
            $created_at = $files[$i]['created_at'];
            $status     = $files[$i]['status'];
            $userId     = $files[$i]['user_id'];

            $mediaFiles[$i] = $this->media_model->getFileData($name, $created_at, $userId, $status);
        }

        $data['files']  = $mediaFiles;

        $this->template->build('upload_single', $data);
    }

    public function addMeta($jumlah){
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
                            'key'       => $key,
                            'value'     => $value,
                            'media_id'  => $id
                        );
                        $this->media_model->addMeta($dataMeta);
                    }
                }
                redirect(site_url());
            }else{
                //redirect('media/upload');
                echo validation_errors();            
            }
        }

    }

    public function uploadsingle($media)
    {
        //$media = Model\Media::findOrFail($media);

        //$this->load->view('upload_single', compact('media'));
        $this->load->view('upload_single', $data);
    }

    public function edit($media)
    {
        try {
            $user       = sentinel()->getUser();
            $user       = sentinel()->getUser();
            $media      = Library\Media\Model\Media::withDrafts()->userId($user->id)->findOrFail($media);
            $category   = $media->category;
            $data['media']      = $media;
            $data['category']   = $category;

            $this->template->build('edit', $data);
        } catch (\Exception $e) {
            set_message_error('Media tidak tersedia.');

            redirect('media','refresh');
        }
    }

    public function update($media)
    {
        $mediaLib   = new Library\Media\Media;
        $media      = $mediaLib->onlyUserId()->getMediaById($media);

        $request    = Request::createFromGlobals();
        $metadata   = $request->request->get('meta');

        $mediaLib->setMetadata($media->id, $metadata);

        set_message_success('Metadata berhasil diperbarui.');
        
        redirect('media/edit/' . $media->id, 'refresh');
    }

    public function delete($media_id)
    {
        try {
            $user       = sentinel()->getUser();
            $media      = Library\Media\Model\Media::withDrafts()->userId($user->id)->findOrFail($media_id);
            
            $this->medialib->setMedia($media);

            $category   = $media->category;

            $this->medialib->deleteMedia($media_id);

            redirect('media/show/' . $category->id,'refresh');
        } catch (\Exception $e) {
            set_message_error('Media tidak tersedia.');

            redirect('media','refresh');
        }
    }

    public function generatemetadata($media_id)
    {
        $media      = new Library\Media\Media;

        $media->withDrafts()->setMedia($media_id);

        $media->setHiddenMetadata([
            'title',
            'description',
            'full_description'
        ]);

        return $media->getMetadata();
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
}

/* End of file Media.php */
/* Location: ./application/modules/media/controllers/Media.php */