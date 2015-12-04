<?php 

class Model_thread extends CI_Model 
{
    function save_thread($data)
    {
        if($this->db->insert('threads',$data)){
          return TRUE;
        } else {
          return FALSE;
        }
    }
    
    function delete_thread($id)
    {
        $delete = $this->db->delete('threads',array('id'=>$id));
        if($delete){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    function update_thread($id,$data)
    {
        $where="id = '".$id."'"; 
        $update = $this->db->update('threads', $data, $where); 
        
        if($update){
            return TRUE;
        }
        return FALSE;
    }
    
    function count_thread()
    {
        return $this->db->count_all('threads');
    }
    
    function get_thread($id)
    {
        $items = array('threads.*','categories.category_name');
        $get   = $this->db->select($items)->from('threads')->join('categories','categories.id=threads.category')->where('threads.id',$id)->get();
        return $get->result();
    }
    
    function get_category()
    {
        $get = $this->db->get('categories');
        return $get->result();
    }
    
    function get_all_threads()
    {
        $items = array('threads.*','categories.category_name');
        $get   = $this->db->select($items)->from('threads')->join('categories','categories.id=threads.category')->where('reply_to','0')->get();
        return $get->result();
    }

    public function get_reply($id)
    {
        $items = array('threads.*','categories.category_name');
        $get   = $this->db->select($items)->from('threads')->join('categories','categories.id=threads.category')->where('reply_to',$id)->get();
        return $get->result();
    }

}