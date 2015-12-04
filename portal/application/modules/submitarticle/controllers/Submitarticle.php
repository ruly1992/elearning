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
        $this->template->add_script('plugins/tinymce/tinymce.jquery.min.js');
        $this->template->add_script('javascript/custom.home.js');
    }

    public function index()
    {
        $data = array('links' => $this->Mod_link->read());

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('email', 'Alamat Email', 'required|valid_email');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');

        if ($this->form_validation->run() == FALSE) {
            keepValidationErrors();
            
            $this->template->build('create', $data);
        } else {
            $data = array(
                'nama'          => set_value('nama'),
                'email'         => set_value('email'),
                'title'         => set_value('title'),
                'content'       => set_value('content', '', FALSE),
            );

            if (isset($_FILES['featured']) && $_FILES['featured']['tmp_name']) {
                $featured_image = $_FILES['featured'];
            } else {
                $featured_image = null;
            }

            $id = $this->Mod_sendarticle->send($data, 'draft', 'public', $featured_image, []);

            // $this->Mod_sendarticle->send($data);
            
            set_message_success('Artikel Anda sudah diterima dan akan dilakukan review terlebih dahulu.');

            redirect('submitarticle',  'refresh');
        }
    }

}

/* End of file Submitarticle.php */
/* Location: ./application/modules/submit_article/controllers/Submitarticle.php */