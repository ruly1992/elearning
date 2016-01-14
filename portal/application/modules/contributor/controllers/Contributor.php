<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contributor extends CI_Controller {

	public function submitArticle()
	{
		$this->form_validation->set_rules('name', 'Nama Lengkap', 'required');
		$this->form_validation->set_rules('email', 'Alamat Email', 'required|valid_email');

		if ($this->form_validation->run() == FALSE) {
			$this->template->build('create');
		} else {
			$data = array(
				
			);
		}
	}

}

/* End of file Contributor.php */
/* Location: ./application/modules/contributor/controllers/Contributor.php */