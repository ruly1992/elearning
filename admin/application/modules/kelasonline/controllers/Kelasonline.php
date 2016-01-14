<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelasonline extends Admin {

	public function __construct()
	{
		parent::__construct();

		$this->kelas        = new Library\Kelas\Kelas;
	
	}

	public function index()
	{
		
	}

	public function course($value='')
	{
		$data['records'] = Model\Kelas\Course::onlyDrafts()->get();
		
		$this->template->build('course_index', $data);
	}

	public function updateStatus($id)
	{
	
		$course = Model\Kelas\Course::withDrafts()->where('id', $id)->update(['status' => 'publish']);
		
		set_message_success('Course berhasil dipublish.');

		redirect('kelasonline/course','refresh');
		
	}

}

/* End of file Kelasonline.php */
/* Location: ./application/modules/kelasonline/controllers/Kelasonline.php */