<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Guest {

	public function __construct()
	{
		parent::__construct();
		
        saveVisitor();
	}
}

/* End of file Category.php */
/* Location: ./application/modules/article/controllers/Category.php */