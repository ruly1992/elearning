<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Elibrary extends Admin
{
    public function __construct()
    {
        parent::__construct();

        $this->medialib = new Library\Media\Media;
    }

    public function index()
    {

        $data['categories'] = $this->medialib->getCategories();

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
            $mediaLib   = new Library\Media\Media;
            $media      = $media->withDrafts()->findOrFail($media_id);

            $request    = Request::createFromGlobals();
            $metadata   = $request->request->get('meta');

            $mediaLib->setMetadata($media->id, $metadata);

            set_message_success('Metadata berhasil diperbarui.');
            
            redirect('elibrary/edit/' . $media->id, 'refresh');
        }
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

    public function upload($category_id)
    {
        $category   = $this->medialib->getCategoryById($category_id);

        $data       = [
            'media'     => $category->media,
            'category'  => $category,
        ];

        $this->template->add_stylesheet('node_modules/jquery-file-upload/css/uploadfile.css');
        $this->template->add_script('node_modules/jquery-file-upload/js/jquery.uploadfile.min.js');
        $this->template->add_script('javascript/elib.fileupload.admin.js');
        $this->template->build('upload', $data);
    }
}

/* End of file Elibrary.php */
/* Location: ./application/modules/elibrary/controllers/Elibrary.php */