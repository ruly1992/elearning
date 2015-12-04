<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Carbon\Carbon;

class Api extends CI_Controller {

    public function visitor()
    {
        $data = [
            [$this->gd(2015, 11, 17), 30],
            [$this->gd(2015, 11, 18), 40],
            [$this->gd(2015, 11, 19), 70],
            [$this->gd(2015, 11, 20), 40],
            [$this->gd(2015, 11, 21), 45],
            [$this->gd(2015, 11, 22), 45],
            [$this->gd(2015, 11, 23), 45],
        ];

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    protected function gd($year, $month, $date)
    {
        $datetime = Carbon::createFromDate($year, $month, $date);

        return $datetime->tz('UTC')->timestamp * 1000;
    }

}

/* End of file Api.php */
/* Location: ./application/modules/api/controllers/Api.php */