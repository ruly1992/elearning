<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as Capsule;
use Nurmanhabib\WilayahIndonesia\Sources\DatabaseSource;

class Wilayah extends CI_Controller {

	public function index()
	{		
        $this->load->library('WilayahIndonesia', null, 'wilayah');

        $hostname = getenv('AUTH_DB_HOST') ?: 'localhost';
        $username = getenv('AUTH_DB_USERNAME') ?: 'root';
        $password = getenv('AUTH_DB_PASSWORD') ?: '';
        $database = getenv('AUTH_DB_DATABASE') ?: 'portal_learning';

        $source = new DatabaseSource($hostname, $username, $password, $database);
        $this->wilayah->setSource($source);

        echo $this->wilayah->ajax();
	}

}

/* End of file Wilayah.php */
/* Location: ./application/modules/api/controllers/Wilayah.php */