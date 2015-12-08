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

        $this->load->view('header'); 
        $this->load->view('index', $data);
        $this->load->view('footer');
	}

	public function create()
    {
        $this->form_validation->set_rules('subjek', 'Subjek', 'required');
        $this->form_validation->set_rules('pesan', 'Pesan', 'required');

        if ($this->form_validation->run() == FALSE) {

            $data['status']         = $this->status;
            $data['categories']     = $this->M_konsultasi->getKategori();

            $this->load->view('header'); 
            $this->load->view('create', $data); 
            $this->load->view('footer');

        } else {

            $data = array(
                'subjek'                        => set_value('subjek'),
                'pesan'                         => set_value('pesan'),
                'prioritas'                     => set_value('prioritas'),
                'id_kategori'                   => set_value('id_konsultasi_kategori'),
                'user_id'                       => sentinel()->getUser()->id,
            );

            $categories     = set_value('id_konsultasi_kategori');
            $status         = set_value('status', 'open');

            $save = $this->M_konsultasi->create($data, $categories, $status);

            redirect('../konsultasi/index.php/konsultasi/','refresh');
        }
    }

    public function detail($id)
    {
        $this->form_validation->set_rules('isi', 'Isi', 'required');

        if ($this->form_validation->run() == FALSE) {
            
            $detail['konsultasi']       = $this->M_konsultasi->getByIdKonsultasi($id);
            $detail['kategori']         = $this->M_konsultasi->getKatByKons($id);
            $detail['reply']            = $this->M_konsultasi->getReply($id);

            $this->load->view('header'); 
            $this->load->view('detail', $detail);
            $this->load->view('footer');

        } else {
        	
            $replay = array(
                'attachment'    => set_value('attachment'),
                'isi'           => set_value('isi'),
                'id_konsultasi' => $id,
                'id_user'       => sentinel()->getUser()->id,
            );

            $id_konsultasi      = set_value('id_konsultasi');

            $save             = $this->M_konsultasi->sendReplay($replay, $id_konsultasi);
            $updateKonsultasi = $this->M_konsultasi->update($id);

            redirect('../konsultasi/index.php/konsultasi/detail/'.$id);

        }

    }

    public function kategori($kategori_id)
    {
    	$data['konsultasi'] = $this->M_konsultasi->getListKat($kategori_id);

        $this->load->view('header'); 
        $this->load->view('index', $data);
        $this->load->view('footer');
    }

}

/* End of file Konsultasi.php */
/* Location: ./application/modules/konsultasi/controllers/Konsultasi.php */