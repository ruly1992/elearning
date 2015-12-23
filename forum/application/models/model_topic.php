<?php 

class Model_topic extends CI_Model 
{
    function save($data)
    {
        if($this->db->insert('topics',$data)){
          return TRUE;
        } else {
          return FALSE;
        }
    }
    
    function delete($id)
    {
        $delete = $this->db->delete('topics',array('id'=>$id));
        if($delete){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    function update($id,$data)
    {
        $where="id = '".$id."'"; 
        $update = $this->db->update('topics', $data, $where); 
        
        if($update){
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

    function get_topics_from_id($id)
    {
        $data = array('categories.category_name','topics.*');
        $get = $this->db->select($data)
                        ->from('category_user')
                        ->join('topics', 'topics.category = category_user.category_id')
                        ->join('categories', 'categories.id = category_user.category_id')
                        ->where('category_user.user_id', $id)
                        ->or_where('tenaga_ahli', $id)
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

    function getTopics_by_Category($id)
    {
        $data = array('categories.category_name','topics.*');
        $get = $this->db->select($data)->from('topics')->join('categories','categories.id=topics.category')->where('categories.id', $id)->order_by('topics.id','desc')->get();
        return $get->result();
    }

    function approve_topic($id, $data){
        $approve = $this->db->update('topics', $data, array('id'=>$id));
        if($this->db->affected_rows() == '1'){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}