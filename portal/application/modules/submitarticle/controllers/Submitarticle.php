<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Submitarticle extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('dashboard/Mod_sendarticle');

        $this->template->set('sidebarCategory', TRUE);
        $this->template->set('railnews', FALSE);
        $this->template->set('sidebar', FALSE); 
        $this->template->set('single', TRUE);

        $this->template->add_stylesheet('stylesheets/custom.home.css');
        $this->template->add_script('node_modules/cropit/dist/jquery.cropit.js');
        $this->template->add_script('plugins/tinymce/tinymce.jquery.min.js');
        $this->template->add_script('javascript/custom.home.js');
    }

    public function index()
    {
        $data = array(
            'links'         => $this->Mod_link->read(),
            'desa_lists'    => [
                'Wilayah 1',
                'Wilayah 2',
                'Wilayah 3',
            ]
        );

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('email', 'Alamat Email', 'required|valid_email');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');

        if ($this->form_validation->run() == FALSE) {
            keepValidationErrors();
            
            $this->template->build('create', $data);
        } else {
            $data = array(
                'title'         => set_value('title'),
                'content'       => set_value('content', '', FALSE),
            );

            $article = new Library\Article\Article;
            $article->submit(
                $data,
                set_value('nama'),
                set_value('email'),
                set_value('desa'),
                $this->input->post('featured'),
                $this->input->post('custom_avatar')
            );
            
            set_message_success('Artikel Anda sudah diterima dan akan dilakukan moderasi terlebih dahulu.');

            redirect('submitarticle',  'refresh');
        }
    }

}

/* End of file Submitarticle.php */
/* Location: ./application/modules/submit_article/controllers/Submitarticle.php */