<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_settings extends CI_Model {

	public function getById($setting_id)
	{
		$this->db->where('id', $setting_id);

		$query = $this->db->get('settings');

		return $query->row();
	}

	public function get($key)
	{
		$this->db->where('key', $key);

		$query = $this->db->get('settings');

		if ($query->num_rows()) {
			return $query->row()->value;
		} else {
			return '';
		}
	}

	public function set($key, $value)
	{

		$this->db->where('key', $key);
		$query = $this->db->get('settings');

		if ($query->num_rows() > 0) {
			$data['value'] = $value;

			$this->db->where('key', $key);
			$this->db->update('settings', $data);
			
		} else {
			$data['key']	= $key;
			$data['value']  = $value;

			$this->db->insert('settings', $data);
		}

	}
}

/* End of file Mod_setting.php */
/* Location: ./application/modules/setting/Mod_setting.php */