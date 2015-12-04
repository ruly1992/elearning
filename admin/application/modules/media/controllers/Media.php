<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends Admin
{
	public function __construct()
	{
		parent::__construct();

		$this->medialib = new Library\Media\Media;
	}

	public function index()
	{
		$this->template->build('index');
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

    public function getmedia()
    {
        $media_id   = $this->input->get('media_id');
        $media_id   = explode(',', $media_id);

        if (count($media_id) > 1) {
            $metadata = [];

            foreach ($media_id as $id) {
                try {
                    $metadata[$id] = Library\Media\Model\Media::wuthDrafts()->findOrFail($id);
                } catch (Exception $e) {

                }
            }
        } else {
            try {
                $metadata = Library\Media\Model\Media::wuthDrafts()->find($media_id[0]);
            } catch (Exception $e) {
                
            }
        }

        $this->output->set_content_type('application/json')->set_output(
            json_encode($metadata)
        );
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

            redirect('elibrary/show/' . $category->id, 'refresh');
        }
    }

    protected function submitSingle(Library\Media\Model\Category $category, $file, $metadata = [])
    {
        $user = auth()->user();

        $media = new Library\Media\Media;
        $media->uploadMedia($category->id, $file, $metadata, 'draft', $user->id);

        return $media->getMedia();
    }
}

/* End of file Media.php */
/* Location: ./application/modules/media/controllers/Media.php */