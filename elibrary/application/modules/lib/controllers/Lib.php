<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lib extends Admin {

    public function show($category, $id, $name)
    {
        $this->medialib = new Library\Media\Media;
        $modelMedia = new Library\Media\Model\Media;
        $user = sentinel()->getUser();

        $name   = urldecode($name);
        $media  = $this->medialib->getMedia()->where('file_name', 'like', $name . '%')->findOrFail($id);
        $data   = [
            'category'  => $media->category,
            'media'     => $media,
        ];

        // echo 'Media id = '.$media->id.'<br>';
        // echo 'User id  = '.$user->id;
        $modelMedia->resolveVisitorUnique($user, $media->id);

        $this->template->build('single', $data);
    }

    public function preview($category, $id, $name)
    {
        try {
            $this->medialib = new Library\Media\Media;

            $name   = urldecode($name);
            $media  = $this->medialib->getMedia()->withDrafts()->where('file_name', 'like', $name . '%')->findOrFail($id);
            $data   = [
                'category'  => $media->category,
                'media'     => $media,
            ];

            $this->template->build('preview', $data);
        } catch (\Exception $e) {

        }
    }

    public function download($category, $id, $name)
    {
        $this->medialib = new Library\Media\Media;

        $name   = urldecode($name);
        $media  = $this->medialib->getMedia()->withDrafts()->where('file_name', 'like', $name . '%')->find($id);      
        $data   = [
            'category'  => $media->category,
            'media'     => $media,
        ];

        $data = file_get_contents($media->getFilepath()); // Read the file's contents
        $name = $media->file_name;

        $this->load->helper('download');
        
        force_download($name, $data);
        // $this->template->build('preview', $data);
    }
}

/* End of file Lib.php */
/* Location: ./application/modules/lib/controllers/Lib.php */