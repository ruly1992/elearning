<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Symfony\Component\HttpFoundation\Request;

class User extends CI_Controller
{
    public function index()
    {
        if ($this->ion_auth->logged_in()) {
            redirect('dashboard', 'refresh');
        } else {
            redirect('login', 'refresh');
        }
    }

    private function register()
    {
        $username   = [
            'Super Admin'   => ['superadmin1',  'superadmin2'],
            'Admin'         => ['admin1', 'admin2'],
            'Editor'        => ['editor1', 'editor2'],
            'Contributor'   => ['contributor1', 'contributor2'],
            'Instructor'    => ['instructor1', 'instructor2'],
            'Learner'       => ['learner1', 'learner2'],
            'Principal'     => ['principal1', 'principal2'],
            'Moderator'     => ['moderator1', 'moderator2'],
            'Asisten'       => ['asisten1', 'asisten2'],
            'Librarian'     => ['librarian1', 'librarian2'],
            'Tenaga Ahli'   => ['tenagaahli1', 'tenagaahli2'],
        ];

        $group_id = 1;

        foreach ($username as $group_name => $unames) {
            foreach ($unames as $uname) {
                $password   = '123';
                $email      = $uname . '@kaderdesa.id';
                $profile    = [
                    'first_name'    => $group_name,
                    'tempat_lahir'  => 'Yogyakarta',
                    'desa_id'       => '34.71.11.1001',
                ];

                $this->ion_auth->register($uname, $password, $email, $profile, [$group_id]);
            }

            $group_id++;
        }
    }
}

/* End of file User.php */
/* Location: ./application/modules/user/controllers/User.php */