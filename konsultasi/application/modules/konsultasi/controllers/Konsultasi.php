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

        if(!sentinel()->check()) {
            redirect(login_url());
        }
        
        if (sentinel()->inRole(array('ta'))) {
            redirect('dashboard','refresh');
        }

	}

	public function index()
	{
        if($this->session->flashdata('success')){
            $data['success'] = $this->session->flashdata('success');
        }elseif($this->session->flashdata('failed')){
            $data['failed'] = $this->session->flashdata('failed');
        }

		$konsultasi             = collect($this->M_konsultasi->getKonsultasiLearner());
        $data['konsultasi']     = pagination($konsultasi, 10, 'konsultasi');

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
            $config['upload_path']      = PATH_KONSULTASI_ATTACHMENT;
            $config['allowed_types']    = 'gif|jpg|jpeg|png|pdf|doc|xls|xlsx|docx|zip|txt';
            $config['max_size']         = '5000';

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('files')) {                
                $data = array(
                    'subjek'                        => set_value('subjek'),
                    'pesan'                         => set_value('pesan', '', FALSE),
                    'prioritas'                     => set_value('prioritas'),
                    'id_kategori'                   => set_value('id_konsultasi_kategori'),
                    'user_id'                       => sentinel()->getUser()->id,
                );

            } else {
                $file_data = $this->upload->data();

                $data = array(
                        'attachment'     => $file_data['file_name'],
                        'subjek'         => set_value('subjek'),
                        'pesan'          => set_value('pesan', '', FALSE),
                        'prioritas'      => set_value('prioritas'),
                        'id_kategori'    => set_value('id_konsultasi_kategori'),
                        'user_id'        => sentinel()->getUser()->id,
                );
            }

            $categories     = set_value('id_konsultasi_kategori');
            $status         = set_value('status', 'open');

            $save = $this->M_konsultasi->create($data, $categories, $status);

            if($save==TRUE){
                $this->session->set_flashdata('success','Konsultasi baru berhasil dibuat');
            }else{
                $this->session->set_flashdata('failed','Konsultasi baru tidak berhasil dibuat');
            }
            redirect('konsultasi/','refresh');
        }
    }

    public function detail($id)
    {
        if($this->session->flashdata('success')){
            $data['success'] = $this->session->flashdata('success');
        }elseif($this->session->flashdata('failed')){
            $data['failed'] = $this->session->flashdata('failed');
        }

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
                    'isi'           => set_value('isi', '', FALSE),
                    'id_konsultasi' => $id,
                    'id_user'       => sentinel()->getUser()->id,
                );
            } else {
                $file_data = $this->upload->data();

                $reply = array(
                    'attachment'    => $file_data['file_name'],
                    'isi'           => set_value('isi', '', FALSE),
                    'id_konsultasi' => $id,
                    'id_user'       => sentinel()->getUser()->id,
                );
            }                       
            $id_konsultasi      = set_value('id_konsultasi');

            $save             = $this->M_konsultasi->sendReply($reply, $id_konsultasi);

            if($save==TRUE){
                $this->session->set_flashdata('success','Anda berhasil Mereply Konsultasi');
            }else{
                $this->session->set_flashdata('failed','Anda Tidak Berhasil Mereply Konsultasi');
            }

            redirect('konsultasi/detail/'.$id);
        }
    }

    public function update($id)
    {
        $this->form_validation->set_rules('subjek', 'Subjek', 'required');
        $this->form_validation->set_rules('pesan', 'Pesan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $konsultasi             = $this->M_konsultasi->getByIdKonsultasi($id);
            $data['konsultasi']     = $konsultasi;
            $data['categories']     = $this->M_konsultasi->getKategori();

            $this->template->build('konsultasi/update',$data);
        } else {
            $config['upload_path']      = PATH_KONSULTASI_ATTACHMENT;
            $config['overwrite']        = TRUE;
            $config['allowed_types']    = 'gif|jpg|jpeg|png|pdf|doc|xls|xlsx|docx|zip|txt|ppt|pptx';
            $config['max_size']         = '5000';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('files')) {
                $data = array(
                    'attachment'    => $file_data['file_name'],
                    'subjek'        => set_value('subjek'),
                    'pesan'         => set_value('pesan'),
                    'prioritas'     => set_value('prioritas'),
                    'id_kategori'   => set_value('id_konsultasi_kategori'),
                    'user_id'       => sentinel()->getUser()->id,
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
            $update = $this->M_konsultasi->update($id, $data);
            
            if ($update == TRUE) {                
                set_message_error('Konsultasi gagal diperbarui.');

                redirect('konsultasi/update/'.$id);
            } else {
                set_message_success('Konsultasi berhasil diperbarui.');

                redirect('konsultasi/detail/'.$id);    
            }
        }
    }

    public function check()
    {
        $id       = $this->input->get('id');
        $status   = $this->input->get('status');

        $this->M_konsultasi->setStatus($id, $status);
    }

    public function search()
    {
        $search_term        = $this->input->get('search');
        $result             = collect($this->M_konsultasi->search($search_term));
        $data['results']    = pagination($result, 2, 'konsultasi/search')->appends(array('search' => $search_term));
        $this->template->build('search',$data);
    }

    public function setLimit()
    {
        $limitData          = $this->input->post('limit');
        $konsultasi         = collect($this->M_konsultasi->setLimit($limitData));
        $data['konsultasi'] = pagination($konsultasi, $limitData, 'konsultasi') ;

        $this->template->build('index', $data);
    }
                                    
}

/* End of file Konsultasi.php */
/* Location: ./application/modules/konsultasi/controllers/Konsultasi.php */