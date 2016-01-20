<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as Capsule;
use Nurmanhabib\WilayahIndonesia\Sources\DatabaseSource;

class User extends Admin
{
    protected $roles = ['su', 'adm'];

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('Mod_user', 'model');
        $this->load->library('WilayahIndonesia', null, 'wilayah');

        $hostname = getenv('AUTH_DB_HOST') ?: 'localhost';
        $username = getenv('AUTH_DB_USERNAME') ?: 'root';
        $password = getenv('AUTH_DB_PASSWORD') ?: '';
        $database = getenv('AUTH_DB_DATABASE') ?: 'portal_learning';

        $source = new DatabaseSource($hostname, $username, $password, $database);
        $this->wilayah->setSource($source);
    }

    public function index()
    {
        $data['list_user'] = $this->model->getAll();

        $this->template->build('view_user', $data);
    }

    public function wilayah()
    {
        echo $this->wilayah->ajax();
    }

    public function create()
    {
        //$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[6]|max_length[10]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|matches[password_confirmation]');
        $this->form_validation->set_rules('password_confirmation', 'Password Confirmation', 'required|matches[password]');

        $data['role_lists'] = $this->model->getRoleLists();

        if ($this->form_validation->run() == FALSE) {
            $this->template->inject_partial('script', $this->wilayah->script(site_url('user/wilayah')));
            $this->template->build('form_create', $data);
        } else {
            $username   = set_value('email');
            $password   = set_value('password');
            $email      = set_value('email');
            $role       = set_value('role');

            $profile    = array(
                'first_name'        => set_value('first_name'),
                'last_name'         => set_value('last_name'),
                'gender'            => set_value('gender'),
                'tempat_lahir'      => set_value('tempat_lahir'),
                'tanggal_lahir'      => set_value('tanggal_lahir'),
                'address'           => set_value('address'),
                'desa_id'           => set_value('desa'),
                'avatar'            => set_value('avatar'),
            );

            $register = $this->model->register($username, $password, $email, $role, $profile);

            $action = $this->input->post('avatar[action]');
            $avatar = $this->input->post('avatar[src]');

            if ($action === 'upload') {
                $this->model->setAvatar($id, $avatar);
            }

            if ($register == FALSE) {
                set_message_error($this->ion_auth->errors());

                $this->template->build('form_create', $data);
            } else {
                redirect('user', 'refresh');
            }
        }
    }

    public function updateProfile($id)
    {
        $source = $this->wilayah->getSource();

        $user               = sentinel()->findById($id);
        $user->wilayah      = $source->getParentByDesa($user->profile->desa_id);
        
        $data['user']       = $user;
        $data['profile']    = $user->profile;
        $data['role_lists'] = $this->model->getRoleLists();

        $this->template->inject_partial('script', $this->wilayah->script(site_url('user/wilayah')));
        $this->template->build('form_update',$data);
    }

    public function saveUpdateProfile($id)
    {
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
        
        $userModel = sentinel()->findById($id);
        $userModel->fill($user);
        $userModel->save();
        $userModel->profile()->update($profile);

        $action = $this->input->post('avatar[action]');
        $avatar = $this->input->post('avatar[src]');

        if ($action === 'upload') {
            $this->model->setAvatar($id, $avatar);
        } elseif ($action === 'remove') {
            $this->model->removeAvatar($id);
        }

        if ($userModel->id) {
            set_message_success('User berhasil diperbarui.');

            redirect('user/updateProfile/'.$id);
        } else {
            set_message_error('User gagal diperbarui.');

            redirect('user/updateProfile/'.$id);
        }
    }

    public function changepassword($user_id)
    {
        $this->form_validation->set_rules('password', 'New Password', 'required|min_length[6]');
        $this->form_validation->set_rules('password_confirmation', 'New Password Confirmation', 'required|min_length[6]|matches[password]');
        $this->form_validation->set_rules('password_old', 'Old Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['user'] = auth()->findById($user_id);

            $this->template->build('formChangePass', $data);
        } else {
            $hasher         = sentinel()->getHasher();

            $password               = set_value('password');
            $password_old           = set_value('password_old');
            $password_confirmation  = set_value('password_confirmation');

            $user = sentinel()->getUser($user_id);

            if (!$hasher->check($password_old, $user->password) || $password != $password_confirmation) {
                set_message_error('Password lama tidak sesuai.');

                redirect('user/changepassword/'.$user_id, 'refresh');
            } else {
                sentinel()->update($user, array('password' => $password));

                set_message_success('Password berhasil diperbarui.');

                redirect('user/updateProfile/'.$user_id, 'refresh');

            }
        }
    }

    public function delete($user_id)
    {
        $data = $this->model->delete($user_id);

        redirect('user', $data);
    }

}

/* End of file User.php */
/* Location: ./application/modules/user/controllers/User.php */
