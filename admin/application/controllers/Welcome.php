<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Symfony\Component\HttpFoundation\Request;
use Carbon\Carbon;

class Welcome extends Admin {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $visitor    = new Library\Visitor\Visitor;

        $data       = [
            'visitor'               => $visitor,
            'visitor_today'         => $visitor->countVisitorToday(),
            'visitor_week'          => $visitor->countVisitorByWeek(),
            'visitor_month'         => $visitor->countVisitorByMonth(),
            'new_visitor_unique'    => $visitor->getVisitorToday()->count(),
            'popular_post'          => Model\Portal\Article::popular()->get(),
            'latest_comment'        => Model\Portal\Comment::latest('date')->get(),
        ];

        $this->template->inject_partial('script', '<script src="'.base_url('assets/admin/js/analytic.js').'"></script>');
        $this->template->build('dashboard', $data);
    }

    public function analytic()
    {
        $analytic = new Library\Analytic\Analytic;

        echo '<pre>';
        print_r ($analytic->visitor()->toArray());
    }
}
