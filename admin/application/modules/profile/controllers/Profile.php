<?php

use Nurmanhabib\WilayahIndonesia\Sources\DatabaseSource;

class Profile extends Admin
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

        $this->load->model('user/Mod_user', 'model');
    }

    public function index()
    {
        $id = auth()->user()->id;

        $this->form_validation->set_rules('email', 'Email','required|valid_email');
        $this->form_validation->set_rules('first_name', 'First Name','required');
        // $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        // $this->form_validation->set_rules('address', 'Alamat', 'required');
        // $this->form_validation->set_rules('province', 'Propinsi', 'required');
        // $this->form_validation->set_rules('city', 'Kota', 'required');
        // $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required');
        // $this->form_validation->set_rules('desa', 'Desa/Kelurahan', 'required');

        if ($this->form_validation->run() == FALSE){
            $user           = Model\User::find($id);
            $data['user']   = $user;

            $source             = $this->wilayah->getSource();

            $profile            = $user->profile;
            $profile->wilayah   = $source->getParentByDesa($profile->desa_id);
            $data['profile']    = $user->profile;

            $this->template->inject_partial('script', $this->wilayah->script(site_url('user/wilayah')));
            $this->template->build('edit', $data);
        } else {
            $user       = array(
                'email' => $this->input->post('email')
            );
            
            $profile    = array(
                'first_name'         => set_value('first_name'),
                'last_name'          => set_value('last_name'),
                'gender'             => set_value('gender'),
                'tempat_lahir'       => set_value('tempat_lahir'),
                'tanggal_lahir'      => set_value('tanggal_lahir'),
                'address'            => set_value('address'),
                'desa_id'            => set_value('desa'),
                'avatar'             => set_value('avatar'),
            );
            
            $res = $this->model->update($id, $user, $profile);

            if (isset($_FILES['avatar']) && $_FILES['avatar']['tmp_name']) {
                $this->model->setAvatar($id, $_FILES['avatar']);
            }

            if ($res==TRUE) {
                set_message_success('User berhasil diperbarui.');

                redirect('profile');
            } else {
                set_message_error('User gagal diperbarui.');

                redirect('profile');
            }
        }
    }

    public function changepassword()
    {
        $user_id = auth()->user()->id;

        $this->form_validation->set_rules('password', 'New Password', 'required|min_length[6]');
        $this->form_validation->set_rules('password_confirmation', 'New Password Confirmation', 'required|min_length[6]|matches[password]');
        $this->form_validation->set_rules('password_old', 'Old Password', 'required|min_length[6]');

        if ($this->form_validation->run() == FALSE) {
            $data['profile'] = $this->model->getById($user_id);

            $this->template->build('changepassword', $data);
        } else {
            $password       = set_value('password');
            $password_old   = set_value('password_old');
            $changed        = $this->model->changePassword($user_id, $password, $password_old);

            if ($changed) {
                set_message_success('Password berhasil diperbarui.');

                redirect('profile/changepassword/', 'refresh');
            } else {
                set_message_error('Password lama tidak sesuai.');

                redirect('profile/changepassword/', 'refresh');
            }
        }
    }
}