<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\ModelNotFoundException;

class Page extends CI_Controller {

	public function show($slug)
	{
		try {
			$page		= Model\Portal\Page::whereSlug($slug)->firstOrFail();
			$links   	= $this->Mod_link->read();

            $this->template->set('single', TRUE);
            $this->template->set('sidebarCategory', TRUE);
            $this->template->set('railnews', FALSE);
            $this->template->set('sidebar', FALSE);
			$this->template->build('show', compact('page', 'links'));
		} catch (ModelNotFoundException $e) {

		}
	}

}

/* End of file Page.php */
/* Location: ./application/modules/page/controllers/Page.php */