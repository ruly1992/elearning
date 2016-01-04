<?php

class Model_faq extends CI_Model
{
    public function save($data)
    {
        $insert = $this->db->insert('faq', $data);
        if($this->db->affected_rows() == '1'){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function getFAQs(){
        $this->db->order_by('created_at', 'desc');
        $get = $this->db->get('faq');
        return $get->result();
    }

    public function getFaq($id){
        $get = $this->db->get_where('faq', array('id'=>$id));
        return $get->result();
    }

    public function update($id,$data){
        $this->db->where('id',$id);
        $update = $this->db->update('faq',$data);
        if($this->db->affected_rows() == '1'){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function delete($id){
        $delete = $this->db->delete('faq', array('id'=>$id));
        if($this->db->affected_rows() == '1'){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}