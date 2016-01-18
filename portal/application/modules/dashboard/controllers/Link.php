<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Link extends CI_Controller {

	public function index()
	{
		$link 		= $this->Mod_link->read();
		$linkAll	= $this->Mod_link->getAll();

		$data['links']		= $link;
		$data['linkAll']	= pagination(collect($linkAll), 20, 'dashboard/link');

		// $this->template->set('sidebar', FALSE);
		$this->template->set_layout('private_category');
        $this->template->build('link', $data);
	}

}

/* End of file Link.php */
/* Location: ./application/modules/dashboard/controllers/Link.php */