<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends Admin {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mod_faq');
	}

	public function index()
	{
		$data['list_faq'] = $this->Mod_faq->getAll();

		$this->template->build('index', $data);
	}

	public function create()
	{
		$this->form_validation->set_rules('question', 'pertanyaan', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			
			$this->template->build('create');

		} else {
			$data['title']			= set_value('title');
			$data['question']		= set_value('question');
			$data['answer']			= set_value('answer', '', FALSE);
			$data['created_at']		= date('Y-m-d H:i:s');

			$this->Mod_faq->create($data);

            set_message_success('FAQ berhasil ditambahkan.');

            redirect('faq/index');
		}
	}

	

	public function update($faq_id)
	{
		$this->form_validation->set_rules('question', 'pertanyaan', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
            
            $data['data'] = $this->Mod_faq->getById($faq_id);

            $this->template->build('update', $data);
			
		} else {
			
			$data = array(
				'title'				=> set_value('title'),
				'question'			=> set_value('question'),
				'answer'			=> set_value('answer', '', FALSE),
				'updated_at'		=> date('Y-m-d H:i:s')
			);

			$links = $this->Mod_faq->update($faq_id, $data);

			if ($data == TRUE) {

               set_message_success('FAQ Berhasil di Ubah');

               redirect('faq');
           } else {

                set_message_error('FAQ Gagal di Ubah');

                redirect('faq/update');

           }
		}
	}

	public function delete($faq_id)
	{
		$data = $this->Mod_faq->delete($faq_id);

		redirect('faq','refresh');
	}

}

/* End of file Faq.php */
/* Location: ./application/modules/faq/controllers/Faq.php */