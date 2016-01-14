<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_category extends CI_Model {

	public function getByArticle($article_id)
	{
		$this->db->join('kategori_has_artikel AS pivot', 'pivot.kategori_id = kategori.id');
		$this->db->where('pivot.artikel_id', $article_id);
		$query = $this->db->get('kategori');

		return $query->result();
	}
	
	public function getByParent($parent=0)
	{
		$query = $this->db->where('parent',$parent)->get('kategori');
		return $query;	
	}

	public function getAll($parent = 0)
	{
		$result = array();
		$kategori = $this->getByParent($parent)->result();

		if (count($kategori)) {
			foreach ($kategori as $row) {
				$row->child = $this->getAll($row->id);
				$result[] = $row;
			}
		} else {
			return array();
		}

		return $result;
	}

	public function generateCheckbox($parent = 0, $checked = array(), $level = 0)
	{
		$html = '';
		$data = $this->getByParent($parent);

		if ($data->num_rows() > 0) {
			foreach ($data->result() as $row) {
				$html .= '<div class="checkbox"><label>';

				$is_checked = in_array($row->id, $checked);
				$html .= form_checkbox('categories[]', $row->id, $is_checked) . ' ';

				for ($i=0; $i < $level; $i++) { 
					$html .= '&mdash;';
				}

				$html .= ' ' . $row->name;
				$html .= '</label></div>';
				$html .= $this->generateCheckbox($row->id, $checked, $level+1);
			}
		} else {
			return '';
		}

		return $html;
	}

}

/* End of file Mod_kategori.php */
/* Location: ./application/modules/category/models/Mod_kategori.php */