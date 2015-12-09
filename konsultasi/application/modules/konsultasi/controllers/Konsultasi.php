<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konsultasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('M_konsultasi');

		$this->status = array(
			'open'	=> 'Open',
			'close'	=> 'Close',
		);

		if (sentinel()->inRole(array('ta'))) {
			redirect('dashboard','refresh');
		}
	}

	public function index()
	{
		$data['konsultasi'] = $this->M_konsultasi->readKonsultasi();

        $this->template->build('index', $data);
	}

	public function create()
    {
        $this->form_validation->set_rules('subjek', 'Subjek', 'required');
        $this->form_validation->set_rules('pesan', 'Pesan', 'required');

        if ($this->form_validation->run() == FALSE) {

            $data['status']         = $this->status;
            $data['categories']     = $this->M_konsultasi->getKategori();

            $this->template->build('create', $data); 

        } else {

            $config['upload_path'] = '../app/files/konsultasi-attachment';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc|xls|xlsx|docx|zip|txt';
            $config['max_size'] = '5000';

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('file')) {
                
                $data = array(
                    'subjek'                        => set_value('subjek'),
                    'pesan'                         => set_value('pesan'),
                    'prioritas'                     => set_value('prioritas'),
                    'id_kategori'                   => set_value('id_konsultasi_kategori'),
                    'user_id'                       => sentinel()->getUser()->id,
                );

            } else {

                $file_data = $this->upload->data();

                $data = array(
                        'attachment'     => $file_data['file_name'],
                        'subjek'         => set_value('subjek'),
                        'pesan'          => set_value('pesan'),
                        'prioritas'      => set_value('prioritas'),
                        'id_kategori'    => set_value('id_konsultasi_kategori'),
                        'user_id'        => sentinel()->getUser()->id,
                );
            }

            $categories     = set_value('id_konsultasi_kategori');
            $status         = set_value('status', 'open');

            $save = $this->M_konsultasi->create($data, $categories, $status);

            redirect('konsultasi/','refresh');
        }
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

            $config['upload_path'] = '../app/files/konsultasi-attachment';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc|xls|xlsx|docx|zip|txt|ppt|pptx';
            $config['max_size'] = '5000';

            $this->load->library('upload', $config);

            if (! $this->upload->do_upload('file')) {
                
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

            $save             = $this->M_konsultasi->sendReply($reply, $id_konsultasi);
            $updateKonsultasi = $this->M_konsultasi->update($id);

            redirect('konsultasi/detail/'.$id);

        }

    }
                                    
}

/* End of file Konsultasi.php */
/* Location: ./application/modules/konsultasi/controllers/Konsultasi.php */