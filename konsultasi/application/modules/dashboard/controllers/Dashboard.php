<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('konsultasi/M_konsultasi');
    }

    public function index()
    {
        $data['categories'] = $this->M_konsultasi->getKatByUser();
        
        $this->template->build('kategori', $data);
    }

    public function kategori($kategori_id)
    {
        $data['id_kategori']    = $kategori_id;
        $categories             = collect($this->M_konsultasi->getListKat($kategori_id));
        $data['konsultasi']     = pagination($categories, 10, 'dashboard/kategori/'.$kategori_id);

        $this->template->build('listkonsultasi', $data);
    }

    public function detail($id)
    {
        $this->form_validation->set_rules('isi', 'Isi', 'required');

        if ($this->form_validation->run() == FALSE) {            
            $detail['konsultasi']       = $this->M_konsultasi->getByIdKonsultasi($id);
            $detail['kategori']         = $this->M_konsultasi->getKatByKons($id);
            $detail['reply']            = $this->M_konsultasi->getReply($id);

            $this->template->build('detail', $detail);
        } else {
            $config['upload_path']      = PATH_KONSULTASI_ATTACHMENT;
            $config['allowed_types']    = 'gif|jpg|jpeg|png|pdf|doc|xls|xlsx|docx|zip|txt|ppt|pptx';
            $config['max_size']         = '5000';

            $this->load->library('upload', $config);

            if (! $this->upload->do_upload('files')) {                
                $reply = array(
                    'isi'           => set_value('isi'),
                    'id_konsultasi' => $id,
                    'id_user'       => sentinel()->getUser()->id,
                );
            } else {
                $file_data = $this->upload->data();

                $reply = array(
                    'attachment'    => $file_data['file_name'],
                    'isi'           => set_value('isi'),
                    'id_konsultasi' => $id,
                    'id_user'       => sentinel()->getUser()->id,
                );
            }
            
            $id_konsultasi      = set_value('id_konsultasi');
            $save               = $this->M_konsultasi->sendReply($reply, $id_konsultasi);
            $updateKonsultasi   = $this->M_konsultasi->update($id);

            redirect('dashboard/detail/'.$id);
        }

    }

    public function status($open, $kategoriId, $id)
    {
        $update = $this->M_konsultasi->status($id, $open);

        redirect('dashboard/kategori/'.$kategoriId,'refresh');
    }
}

/* End of file Dashboard.php */
/* Location: ./application/modules/dashboard/controller/Dashboard.php */