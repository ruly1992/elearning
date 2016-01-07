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

}

/* End of file Mod_user.php */
/* Location: ./application/modules/user/models/Mod_user.php */