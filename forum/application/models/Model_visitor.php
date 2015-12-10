<?php

class Model_visitor extends CI_Model
{

    public function saveVisitor($data)
    {
            $dataWhere = array(
                'thread'     => $data['thread'],
                'ip_address' => $data['ip_address'],
                'access_url' => $data['access_url'],
                'user_id'    => $data['user_id']
            );

        $check = $this->db->get_where('visitors',$dataWhere)->result();
        if(count($check)>0){
            foreach($check as $c){
                $dataUpdate = array(
                    'times'      => $c->times+1,
                    'updated_at' => date('Y-m-d').' '.date('G:i:s')
                );
            }
            $data = array_merge($data,$dataUpdate);
            $save = $this->incrementTimes($dataWhere,$data);
        }else{
            $data = array_merge($data,array('times'=>1));
            $save = $this->newVisitor($data);
        }

        return $save;
    }

    public function incrementTimes($dataWhere, $data)
    {
        $this->db->where($dataWhere);
        $update = $this->db->update('visitors',$data);
        if($update){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function newVisitor($data)
    {        
        $insert = $this->db->insert('visitors',$data);
        if($insert){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    function get_visitors(){
        $get = $this->db->get('visitors');
        return $get->result();
    }
}