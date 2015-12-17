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
    
    function selectTopic($id){
        $get = $this->db->get_where('topics',array('id'=>$id));
        return $get->result();
    }

    function get_topics(){
        $data = array('categories.category_name','topics.*');
        $get = $this->db->select($data)->from('topics')->join('categories','categories.id=topics.category')->order_by('topics.id','desc')->get();
        return $get->result();
    }

    function get_topics_from_id($id){
        $data = array('categories.category_name','topics.*');
        $get = $this->db->select($data)->from('topics')->join('categories','categories.id=topics.category')->where('tenaga_ahli', $id)->order_by('topics.id','desc')->get();
        return $get->result();
    }

    function get_categories(){
        $get = $this->db->get('categories');
        return $get->result();
    }
}