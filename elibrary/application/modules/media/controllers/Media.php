<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Symfony\Component\HttpFoundation\Request;

class Media extends Admin
{
    protected $medialib;

    public function __construct()
    {
        parent::__construct();

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

    public function upload($category)
    {
        $category   = Library\Media\Model\Category::find($category);
        $data       = [
            'media'     => $category->media,
            'category'  => $category,
        ];

        $this->template->add_stylesheet('node_modules/jquery-file-upload/css/uploadfile.css');
        $this->template->add_script('node_modules/jquery-file-upload/js/jquery.uploadfile.min.js');
        $this->template->add_script('javascript/elib.fileupload.js');
        // $this->template->set_layout('bootstrap');
        $this->template->build('upload', $data);
    }

    public function submit($category)
    {
        $media      = $this->medialib;
        $category   = $media->setCategory($category)->getCategory();
        $uploaded   = [];
        $input_name = 'filemedia';

        if (is_array($_FILES[$input_name]['name'])) {
            foreach ($_FILES[$input_name]['name'] as $i => $name) {
                $filemedia['name']     = $_FILES[$input_name]['name'][$i];
                $filemedia['type']     = $_FILES[$input_name]['type'][$i];
                $filemedia['tmp_name'] = $_FILES[$input_name]['tmp_name'][$i];
                $filemedia['error']    = $_FILES[$input_name]['error'][$i];
                $filemedia['size']     = $_FILES[$input_name]['size'][$i];
                
                $uploaded[] = $this->submitSingle($category, $filemedia, $metadata);
            }
        } else {
            $uploaded[] = $this->submitSingle($category, $_FILES[$input_name], set_value('meta', []));
        }

        if ($this->input->is_ajax_request()) {
            echo json_encode($uploaded);
        } else {
            set_message_success('Media berhasil diunggah.');

            redirect('media/show/' . $category->id, 'refresh');
        }
    }

    protected function submitSingle(Library\Media\Model\Category $category, $file, $metadata = [])
    {
        $user = sentinel()->getUser();

        $media = new Library\Media\Media;
        $media->uploadMediaDraft($category->id, $file, $metadata, $user->id);

        return $media->getMedia();
    }

    public function uploadsingle($media)
    {
        $media = Model\Media::findOrFail($media);

        $this->load->view('upload_single', compact('media'));
    }

    public function edit($media)
    {
        try {
            $user       = sentinel()->getUser();
            $media      = Model\Elib\Media::withDrafts()->userId($user->id)->findOrFail($media);
            $category   = $media->category;

            $this->template->add_stylesheet('node_modules/awesomplete/awesomplete.css');
            $this->template->add_stylesheet('node_modules/jquery-file-upload/css/uploadfile.css');
            $this->template->add_script('node_modules/jquery-file-upload/js/jquery.uploadfile.min.js');
            $this->template->add_script('node_modules/awesomplete/awesomplete.min.js');
            $this->template->add_script('node_modules/vue/dist/vue.min.js');
            $this->template->add_script('javascript/elib.vue.js');
            $this->template->add_script('javascript/elib.fileupload.js');

            $this->template->build('edit', compact('media', 'category'));
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
            $media      = Model\Elib\Media::withDrafts()->userId($user->id)->findOrFail($media_id);
            
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