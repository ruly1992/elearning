<?php 

class Model_topic extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
    }

    function save($data)
    {
        $this->db->insert('topics',$data);
        if($this->db->affected_rows() == 1){
          return TRUE;
        } else {
          return FALSE;
        }
    }
    
    function delete($id)
    {
        $delete = $this->db->delete('topics',array('id'=>$id));
        if($this->db->affected_rows() == 1){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    function update($id,$data)
    {
        $where="id = '".$id."'"; 
        $update = $this->db->update('topics', $data, $where); 
        
        if($this->db->affected_rows() == 1){
            return TRUE;
        }
        return FALSE;
    }
    
    function selectTopic($id)
    {
        $get = $this->db->get_where('topics',array('id'=>$id));
        return $get->result();
    }

    function get_topics()
    {
        $data = array('categories.category_name','topics.*');
        $get = $this->db->select($data)
                        ->from('topics')
                        ->join('categories','categories.id=topics.category')
                        ->order_by('topics.id','desc')
                        ->get();
        return $get->result();
    }

    function get_approved_topics()
    {
        $data = array('categories.category_name','topics.*');
        $get = $this->db->select($data)
                        ->from('topics')
                        ->join('categories','categories.id=topics.category')
                        ->where('status', '1')
                        ->order_by('topics.id','desc')
                        ->get();
        return $get->result();
    }

    function get_topics_from_id($id)
    {
        $data = array('categories.category_name','topics.*');
        $get = $this->db->select($data)
                        ->from('category_user')
                        ->join('topics', 'topics.category = category_user.category_id')
                        ->join('categories', 'categories.id = category_user.category_id')
                        ->where('category_user.user_id', $id)
                        ->or_where('tenaga_ahli', $id)
                        ->group_by(array('topics.topic', 'topics.category'))
                        ->order_by('topics.id', 'desc')
                        ->get();
        return $get->result();
    }

    function get_categories()
    {
        $get = $this->db->get('categories');
        return $get->result();
    }

    function get_categories_by_ta($idTenagaAhli)
    {
        $get = $this->db->select('categories.*')
            ->from('categories')
            ->join('category_user', 'category_user.category_id = categories.id')
            ->where('category_user.user_id', $idTenagaAhli)
            ->get();
        return $get->result();
    }

    function get_userID_by_category($idCategory)
    {
        $get = $this->db->get_where('category_user', array('category_id'=>$idCategory));
        return $get->result();
    }

    function getCategory_by_Wilayah($daerahUser)
    {
        $d          = explode('.', $daerahUser);
        $desa       = $daerahUser;
        $kecamatan  = $d[0].'.'.$d[1].'.'.$d[2].'.0000';
        $kota       = $d[0].'.'.$d[1].'.00.0000';
        $provinsi   = $d[0].'.00.00.0000';
        $default    = '00.00.00.0000';
        $daerah     = array($desa, $kecamatan, $kota, $provinsi, $default);

        $data = array('categories.*');
        $get = $this->db->select($data)
                    ->from('categories')
                    ->join('topics', 'topics.category=categories.id')
                    ->where('topics.status', '1')
                    ->group_by('category_name')
                    ->where_in('daerah', $daerah)
                    ->order_by('categories.id', 'desc')
                    ->get();
        return $get->result();
    }

    function getTopics_by_ta($idUser, $idCategory)
    {
            $data = array('categories.category_name','topics.*');
            $getByTopic = $this->db->select($data)
                        ->from('topics')
                        ->join('categories','categories.id=topics.category')
                        ->where(array(
                            'topics.category'       => $idCategory, 
                            'topics.status'         => '1', 
                            'topics.tenaga_ahli'    => $idUser
                        ))
                        ->order_by('topics.id','desc')
                        ->get()
                        ->result();

            $getByCategory  = $this->db->select($data)
                        ->from('topics')
                        ->join('categories','categories.id=topics.category')
                        ->join('category_user','category_user.category_id=topics.category')
                        ->where(array(
                            'topics.category'       => $idCategory, 
                            'topics.status'         => '1', 
                            'category_user.user_id' => $idUser
                        ))
                        ->order_by('topics.id','desc')
                        ->get()
                        ->result();

            $allTopics      = array();
            foreach($getByTopic as $temp){
                if ( ! in_array($temp, $allTopics)) {
                    $allTopics[] = $temp;
                }
            }
            foreach($getByCategory as $temp){
                if ( ! in_array($temp, $allTopics)) {
                    $allTopics[] = $temp;
                }
            }
            
            return $allTopics;
    }

    function get_public_topics($idCategory)
    {
        $data = array('categories.category_name','topics.*');
        $get = $this->db->select($data)
                    ->from('topics')
                    ->join('categories','categories.id=topics.category')
                    ->where(array(
                        'topics.category' => $idCategory, 
                        'topics.status' => '1', 
                        'topics.daerah' => '00.00.00.0000'
                    ))
                    ->order_by('topics.id','desc')
                    ->get();
        return $get->result();
    }

    function getTopics_by_Category($idCategory, $daerahUser)
    {
            $d          = explode('.', $daerahUser);
            $desa       = $daerahUser;
            $kecamatan  = $d[0].'.'.$d[1].'.'.$d[2].'.0000';
            $kota       = $d[0].'.'.$d[1].'.00.0000';
            $provinsi   = $d[0].'.00.00.0000';
            $default    = '00.00.00.0000';
            $daerah     = array($desa, $kecamatan, $kota, $provinsi, $default);

            $data = array('categories.category_name','topics.*');
            $get = $this->db->select($data)
                        ->from('topics')
                        ->join('categories','categories.id=topics.category')
                        ->where(array('categories.id' => $idCategory, 'topics.status' => '1'))
                        ->where_in('daerah', $daerah)
                        ->order_by('topics.id','desc')
                        ->get();
            return $get->result();
    }

    function approve_topic($id, $data)
    {
        $approve = $this->db->update('topics', $data, array('id'=>$id));
        if($this->db->affected_rows() == 1){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}