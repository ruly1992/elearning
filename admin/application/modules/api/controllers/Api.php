<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Carbon\Carbon;
use Model\Portal\Visitor;
use Model\Portal\Article;

class Api extends CI_Controller {

    public function visitor()
    {
        $visitors       = Visitor::all();

        $groupByDate    = $visitors->groupBy(function ($visitor) {
            return $visitor->created_at->format('Y-m-d');
        });

        $countingByDate = $groupByDate->map(function ($visitor, $date) {
            return [$this->gd($date), $visitor->sum('times')];
        });

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($countingByDate->values()));
    }

    public function post()
    {
        $articles       = Article::all();

        $groupByDate    = $articles->groupBy(function ($article) {
            return $article->date->format('Y-m-d');
        });

        $countingByDate = $groupByDate->map(function ($articles, $date) {
            return [$this->gd($date), $articles->count()];
        });

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($countingByDate->values()));
    }

    protected function gd($year, $month = 0, $date = 0)
    {
        if (is_string($year)) {
            $datetime = Carbon::parse($year);
        } else {
            $datetime = Carbon::createFromDate($year, $month, $date);
        }

        return $datetime->tz('UTC')->timestamp * 1000;
    }

}

/* End of file Api.php */
/* Location: ./application/modules/api/controllers/Api.php */