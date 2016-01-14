<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Symfony\Component\HttpFoundation\Request;
use Illuminate\Database\Capsule\Manager as Capsule;
use Nurmanhabib\WilayahIndonesia\Sources\DatabaseSource;

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->library('WilayahIndonesia', null, 'wilayah');

        $hostname = getenv('AUTH_DB_HOST') ?: 'localhost';
        $username = getenv('AUTH_DB_USERNAME') ?: 'root';
        $password = getenv('AUTH_DB_PASSWORD') ?: '';
        $database = getenv('AUTH_DB_DATABASE') ?: 'portal_learning';

        $source = new DatabaseSource($hostname, $username, $password, $database);
        $this->wilayah->setSource($source);
    }

    public function wilayah()
    {
        echo $this->wilayah->ajax();
    }

    public function index()
    {
        if ($this->ion_auth->logged_in()) {
            redirect('dashboard', 'refresh');
        } else {
            redirect('login', 'refresh');
        }
    }

    public function register()
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
            'Librarian'     => ['librarian1', 'librarian2']
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

    public function register2()
    {
        $edt = [
            'muhammad.achadi@kaderdesa.id',
            'murtodo@kaderdesa.id',
            'nur.kholis@kaderdesa.id',
        ];

        $ctr = [
            'muh.chotib@kaderdesa.id',
            'm.alfu.niam@kaderdesa.id',
            'muh.silahuddin@kaderdesa.id',
            'subhan.anshori@kaderdesa.id',
            'dindin.abdulloh.gazali@kaderdesa.id',
        ];

        $lnr = [
            'hasan.rifiki@kaderdesa.id',
            'hapidz.muslim@kaderdesa.id',
            'misbahudin@kaderdesa.id',
            'tuty.aliyah@kaderdesa.id',
            'nurul.hidayati@kaderdesa.id',
            'winarsih@kaderdesa.id',
            'siti.aisyah@kaderdesa.id',
        ];

        foreach ($edt as $email) {
            $group_id = 3;
            $password   = 'peserta';
            $profile    = [
                'first_name'    => 'User Editor',
                'tempat_lahir'  => 'Yogyakarta',
                'desa_id'       => '34.71.11.1001',
            ];

            $this->ion_auth->register($email, $password, $email, $profile, [$group_id]);
        }

        foreach ($ctr as $email) {
            $group_id = 4;
            $password   = 'peserta';
            $profile    = [
                'first_name'    => 'User Contributor',
                'tempat_lahir'  => 'Yogyakarta',
                'desa_id'       => '34.71.11.1001',
            ];

            $this->ion_auth->register($email, $password, $email, $profile, [$group_id]);
        }

        foreach ($lnr as $email) {
            $group_id = 6;
            $password   = 'peserta';
            $profile    = [
                'first_name'    => 'User Learner',
                'tempat_lahir'  => 'Yogyakarta',
                'desa_id'       => '34.71.11.1001',
            ];

            $this->ion_auth->register($email, $password, $email, $profile, [$group_id]);
        }

        for ($i = 1; $i < 11; $i++) {
            $group_id   = 4;
            $email      = 'peserta' . $i . '@kaderdesa.id';
            $password   = 'peserta';
            $profile    = [
                'first_name'    => 'User Peserta',
                'tempat_lahir'  => 'Yogyakarta',
                'desa_id'       => '34.71.11.1001',
            ];

            $this->ion_auth->register($email, $password, $email, $profile, [$group_id]);
        }
    }

}

/* End of file User.php */
/* Location: ./application/modules/user/controllers/User.php */