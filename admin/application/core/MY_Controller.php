<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {}

class Admin extends CI_Controller
{
    protected $roles = array('su', 'adm', 'edt', 'ctr', 'pus');

    public function __construct()
    {
        parent::__construct();

        $this->check();
        $this->generateNavigator();
    }

    public function check()
    {
        if (!sentinel()->check()) {
            redirect('login', 'refresh');
        }

        if (!sentinel()->inRole($this->roles)) {
            redirect(dashboard_url(), 'refresh');
        }
    }

    protected function generateNavigator()
    {
        $role       = sentinel()->getUser()->roles->pluck('slug')->toArray();
        $menus      = $this->getMenusByRole($role);
        $template   = $this->load->view('template/menus', compact('menus'), TRUE);

        $this->template->set('navigator', $template);

        return $template;
    }

    protected function getMenusByRole($role = 'su')
    {
        $menus      = $this->getMenuCollect();

        $filtered   = $menus->filter(function ($menu) use ($role) {
            if (array_key_exists('roles', $menu)) {
                if (in_array('all', $menu['roles']))
                    return true;

                return !array_diff($role, $menu['roles']);
            } else {
                return false;
            }
        });

        $filtered   = $filtered->map(function ($menu, $index) use ($role) {
            if (array_key_exists('child', $menu)) {
                $child      = collect($menu['child']);
                $filtered   = $child->filter(function ($menu) use ($role) {
                    if (array_key_exists('roles', $menu)) {
                        if (in_array('all', $menu['roles']))
                            return true;

                        return !array_diff($role, $menu['roles']);
                    } else {
                        return true;
                    }
                });

                $menu['child']  = $filtered->toArray();
            }

            return $menu;
        });

        return $filtered;
    }

    protected function getMenuCollect()
    {
        $this->config->load('menus');
        
        $menus = $this->config->item('menus');

        return collect($menus);
    }
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */