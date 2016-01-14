<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Link extends CI_Controller {

	public function index()
	{
		$link 		= $this->Mod_link->read();
		$linkAll	= $this->Mod_link->getAll();

		$data['links']		= $link;
		$data['linkAll']	= pagination(collect($linkAll), 20, 'link');

		$this->template->set('railnews', FALSE);
		$this->template->set('sidebar', FALSE);
		$this->template->set('single', TRUE);
		$this->template->set('sidebarCategory', TRUE);
		$this->template->build('index', $data);
	}

}

/* End of file Link.php */
/* Location: ./application/modules/link/controllers/Link.php */