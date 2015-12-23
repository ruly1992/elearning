<?php 

class M_kategori extends CI_Model{

    public function __construct()
    {

        parent ::__construct();
    }

    public function create($data)
    {
        $this->db->insert('kategori', $data);
         if ($this->db->affected_rows() == '1'){
            return TRUE;
        }
        return FALSE;
    }

    public function read()
    {
        $query = $this->db->get('kategori');
        return $query->result();
    }

    public function getById($id)
    {
        $query = $this->db->where('id',$id)->get('kategori');
        return $query;  
    }

    public function getNameById($id)
    {
        $kategori = $this->getById($id);

        if ($kategori->num_rows()) {
            $kategori = $kategori->row();
            return $kategori->name;
        } else {
            return 'No parent category';
        }
    }

    public function getLists($except = 0)
    {
        $this->db->where('id !=', $except);

        if ($except > 0)
            $this->db->where('parent !=', $except);

        $kategori   = $this->read();
        $result     = array();
        $result[0]  = "No Parent Category";

        foreach ($kategori as $row) {
            $result[$row->id] = $row->name;
        }

        return $result;
    }

    public function getByArticle($article_id)
    {
        $this->db->join('kategori_has_artikel AS pivot', 'pivot.kategori_id = kategori.id');
        $this->db->where('pivot.artikel_id', $article_id);
        $query = $this->db->get('kategori');

        return $query->result();
    }

    public function update($id, $data)
    {
        $query = $this->db->where('id', $id)->update('kategori', $data);
        return $query;
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('kategori');
    }

    public function onlyAllowEditor()
    {
        if (sentinel()->inRole('edt')) {
            $user           = sentinel()->getUser();
            $allowed_ids    = $user->editorcategory->pluck('id')->toArray();

            if ($allowed_ids) {
                $this->db
                    ->group_start()
                        ->where_in('id', $allowed_ids)
                        ->or_where_in('parent', $allowed_ids)
                    ->group_end();
            } else {
                $this->db->where('id', -1);
            }
        }

        return $this;
    }

    public function getByParent($parent=0)
    {
        $query = $this->db->where('parent', $parent)->get('kategori');
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

    public function generateUlli($parent = 0)
    {
        $html = '<ul>';

        $data = $this->getByParent($parent);

        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $html .= '<li>' . $row->name . $this->generateUlli($row->id) . '</li>';
            }
        } else {
            return '';
        }   

        $html .= '</ul>';

        return $html;
    }

    public function generateNested($parent = 0)
    {
        $html = '<ol class="dd-list">';

        $data = $this->getByParent($parent);

        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $html .= '<li class="dd-item" data-id="' . $row->id . '">';
                $html .= '<div class="dd-handle">';
                $html .= $row->name;
                $html .= '<a href="'.site_url('kategori/update/'.$row->id).'" class="dd-nodrag icon icon-pencil"></a>';
                $html .= '</div>';
                $html .= $this->generateNested($row->id);
                $html .= '</li>';
            }
        } else {
            return '';
        }   

        $html .= '</ol>';

        return $html;
    }

    public function generateCheckbox($parent = 0, $checked = array(), $level = 0)
    {
        $html = '';

        $this->onlyAllowEditor();

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

?>