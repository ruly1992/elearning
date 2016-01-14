<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Intervention\Image\ImageManager;
use Hashids\Hashids;

class Mod_user extends CI_Model {

	protected $table = 'users';

	public function __construct()
	{
		parent::__construct();
		
		$this->db = $this->load->database('user', true);
	}

	public function register($username, $password, $email, $role, $profile = array())
	{
		$user = $this->ion_auth->register($username, $password, $email, $role);

		$id 				= $user;
		$profile['user_id'] = $id;

		$this->db->insert('profile', $profile);

		return $this->getById($id);
	}

	public function login($username, $password)
	{
		$user = $this->getByUsername($username);

		if ($user) {
			if (md5($password) == $user->password) {
				return $this->loginById($user->id);
			}
		}

		return FALSE;
	}

	public function loginById($user_id)
	{
		$user = $this->getById($user_id);

		if ($user) {
			$user_data = array(
				'user_id'	=> $user->id,
				'isLogin'	=> 'yes',
				'role_id'	=> $user->user_role_id
			);

			$this->session->set_userdata($user_data);

			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function loginCheck()
	{
		$is_login = $this->session->userdata('isLogin');

		if ($is_login == 'yes')
			return TRUE;
			return FALSE;
	}

	public function logout()
	{
		if ($this->loginCheck()) {
			$user_data = array('user_id', 'isLogin', 'role_id');

			$this->session->unset_userdata($user_data);
		}
	}

	public function getUserLogin()
	{
		if ($this->loginCheck()) {
			$user_id = $this->session->userdata('user_id');

			return $this->getById($user_id);
		} else {
			return FALSE;
		}
	}

	public function getById($user_id)
	{
		$this->db->from($this->table);
		$this->db->join('profile', ''.$this->table.'.id = profile.user_id');
		$this->db->where(''.$this->table.'.id', $user_id);

		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->row();
		} else {
			return FALSE;
		}
	}

	public function getByUsername($username)
	{
		$this->db->from($this->table);
		$this->db->where('username', $username);
		
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->row();
		} else {
			return FALSE;
		}
	}

	public function getByRole($role)
	{
		$this->db->select(''.$this->table.'.*');
		$this->db->from($this->table);
		$this->db->join('user_role', 'user_role.id = '.$this->table.'.user_role_id');

		$query = $this->db->get();

		if ($query->num_rows() >= 0) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function getAll()
	{
		// $this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('profile', 'profile.user_id = '.$this->table.'.id');

		$query = $this->db->get();

		if ($query->num_rows() >= 0) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function update($user_id, $data = array(), $profile = array())
	{
		$this->db->where('id', $user_id);
		$this->db->update($this->table, $data);

		$this->updateProfile($user_id, $profile);

		return TRUE;
	}

	public function updateProfile($user_id, $profile = array())
	{
		$this->db->where('user_id', $user_id);
		$this->db->update('profile', $profile);

		if ($this->db->affected_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}

	public function setAvatar($user_id, $avatar)
	{
		$hashids	= new Hashids('amtek123456');
        $source     = $avatar;
        $filename   = 'avatar_u' . $hashids->encode($user_id);

        $manager    = new ImageManager;
        $upload_dir = PATH_AVATAR;
        $image      = $manager->make($source);

        $image->save($upload_dir . '/' . $filename, 90);

        $data['avatar'] = $filename;

        $this->db->where('user_id', $user_id);
        $this->db->update('profile', $data);
	}

	public function removeAvatar($user_id)
	{
		$user		= Model\User::findOrFail($user_id);
		$filename	= $user->profile->avatar;

		if (file_exists(PATH_AVATAR.'/'.$filename)) {
			unlink(PATH_AVATAR.'/'.$filename);
		}

		$user->profile->update(['avatar' => '']);
	}

	public function changePassword($user_id, $new_password, $old_password)
	{
		$user = auth()->getById($user_id);

		if ($this->ion_auth->hash_check($user, $old_password)) {
			$data = array('password' => $new_password);

			$this->ion_auth->update($user_id, $data);

			return TRUE;
		} else {
			return FALSE;
		}	
	}

	public function setRole($role_id, $user_id = 0)
	{
		$user = $this->getById($user_id);

		if (md5($old_password) == $user->password) {
			$data = array('user_role_id' => $role_id);

			return $this->update($user_id, $data);
		} else {
			return FALSE;
		}
	}

	public function getRole()
	{
		$this->db->from('user_role');

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return array();
		}
	}

	public function getRoleLists()
	{
		$groups = sentinel()->getRoleRepository()->createModel()->all();
		$lists	= array();

		foreach ($groups as $group) {
			$lists[$group->id] = $group->name;
		}

		return $lists;
	}

	public function inRole($role_id, $user_id = 0)
	{
		$user = $this->getById($user_id);

		if ($user) {
			if ($user->user_role_id == $role_id) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	public function delete($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->delete('profile');

		$this->db->where('id', $user_id);
		$this->db->delete($this->table);

		if ($this->db->affected_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

/* End of file Mod_user.php */
/* Location: ./application/modules/user/models/Mod_user.php */