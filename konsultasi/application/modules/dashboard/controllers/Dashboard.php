<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
    	$data['konsultasi'] = $this->M_konsultasi->getListKat($kategori_id);

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
        	
            $replay = array(
                'attachment'    => set_value('attachment'),
                'isi'           => set_value('isi'),
                'id_konsultasi' => $id,
                'id_user'       => sentinel()->getUser()->id,
            );

            $id_konsultasi      = set_value('id_konsultasi');

            $save             = $this->M_konsultasi->sendReplay($replay, $id_konsultasi);
            $updateKonsultasi = $this->M_konsultasi->update($id);

            redirect('dashboard/detail/'.$id);

        }

    }

}

/* End of file Dashboard.php */
/* Location: ./application/modules/dashboard/controller/Dashboard.php */