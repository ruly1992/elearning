<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_konsultasi extends CI_Model {

	public function readKonsultasi()
    {
        $data = array('konsultasi.*','konsultasi_kategori.name');
        $get  = $this->db->select($data)->from('konsultasi')->join('konsultasi_kategori','konsultasi_kategori.id=konsultasi.id_kategori')->order_by('konsultasi.created_at', 'DESC')->get();
        return $get->result();
    }

    public function getKonsultasiLearner()
    {
        $user_id = sentinel()->getUser()->id; 

        $data = array('konsultasi.*','konsultasi_kategori.name');
        $get  = $this->db->select($data)->from('konsultasi')
                ->join('konsultasi_kategori','konsultasi_kategori.id=konsultasi.id_kategori')
                ->where('konsultasi.user_id', $user_id)
                ->order_by('konsultasi.created_at', 'DESC')->get();
        return $get->result();
    }

    public function getKategori()
    {
        $query = $this->db->get('konsultasi_kategori'); 

        return $query->result();
    }

    public function getKategoriById($kategori_id)
    {
        $this->db->where('konsultasi_kategori.id', $kategori_id);
        $query = $this->db->get('konsultasi_kategori');

        return $query->num_rows() ? $query->row() : FALSE;
    }

    public function getKatByUser()
    {
        $user_id = sentinel()->getUser()->id;

        $data = array('konsultasi_kategori.name', 'konsultasi_kategori.description', 'konsultasi_user_has_kategori.*');
        $get  = $this->db->select($data)
                ->from('konsultasi_user_has_kategori')
                ->join('konsultasi_kategori','konsultasi_user_has_kategori.id_kategori=konsultasi_kategori.id')
                ->where('konsultasi_user_has_kategori.user_id', $user_id)
                ->get();
        
        return $get->result();
    }

    public function getListKat($kategori_id)
    {
        $data = array('konsultasi.*','konsultasi_kategori.name');
        $get  = $this->db->select($data)->from('konsultasi')
                      ->join('konsultasi_kategori','konsultasi_kategori.id=konsultasi.id_kategori')
                      ->where('konsultasi_kategori.id',$kategori_id)
                      ->order_by('konsultasi.created_at', 'DESC')
                      ->get();
        return $get->result();  
    }

    public function getKonsultasiByPrioritas($kategori_id, $prioritas)
    {
        $data = array('konsultasi.*','konsultasi_kategori.name');
        $get  = $this->db->select($data)->from('konsultasi')
                      ->join('konsultasi_kategori','konsultasi_kategori.id=konsultasi.id_kategori')
                      ->where('konsultasi_kategori.id',$kategori_id)
                      ->where('konsultasi.prioritas',$prioritas)
                      ->order_by('konsultasi.created_at', 'DESC')
                      ->get();
        return $get->result(); 
    }

    public function create($data, $categories, $status = 'open')
    {
        $default = array(
            'created_at' => date('Y-m-d H:i:s'),
            'status'     => $status,
        );

        $data  = array_merge($default, $data);

        $this->db->set($data);
        $this->db->insert('konsultasi');

        $konsultasi_id = $this->db->insert_id();

        $relation['id_konsultasi_kategori'] = $categories;
        $relation['id_konsultasi']          = $konsultasi_id;

        $this->db->insert('konsultasi_kategori_has_konsultasi', $relation);

        return $konsultasi_id;
    }

    public function getByIdKonsultasi($id)
    {
        $this->db->select('kons.*', 'konsultasi_kategori.name');
        $this->db->from('konsultasi AS kons');
        $this->db->join('konsultasi_kategori', 'konsultasi_kategori.id = konsultasi.id_kategori');
        $this->db->where('kons.id', $id);

        $query = $this->db->get('konsultasi');

        return $query->num_rows() ? $query->row() : FALSE;
    }

    public function getKatByKons($id)
    {
        $data = array('konsultasi.*','konsultasi_kategori.name');
        $get   = $this->db->select($data)->from('konsultasi')->join('konsultasi_kategori','konsultasi_kategori.id=konsultasi.id_kategori')->where('konsultasi.id',$id)->get();
        return $get->result();
    }

    public function update($id, $data)
    {
        $this->db->set($data);
        $this->db->where('id', $id);        
        $this->db->update('konsultasi', $data);
    }

    public function updateRelation($id, $categories)
    {
        $this->db->set('id_konsultasi_kategori', $categories);
        $this->db->where('id_konsultasi', $id);
        $this->db->update('konsultasi_kategori_has_konsultasi');
    }

    public function updatedAt($updateat, $id_konsultasi)
    {
        $default = array(
            'updated_at' => $updateat,
        ); 

        $data = array_merge($default);

        $this->db->set($data);
        $this->db->where('id', $id_konsultasi);        
        $this->db->update('konsultasi', $data);
    }

    public function deleteAttachment($id, $attachment)
    {
        $this->db->set('attachment', $attachment);
        $this->db->where('id', $id);        
        $this->db->update('konsultasi', $attachment);
    }

    public function deleteAttachmentReply($id, $attachment)
    {
        $this->db->set('attachment', $attachment);
        $this->db->where('id', $id);        
        $this->db->update('reply', $attachment);
    }

    public function deleteReply($idReply)
    {
        $delete = $this->db->delete('reply', array('id'=>$idReply));
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getReply($id)
    {
        $data = array('konsultasi.*','rp.isi', 'rp.id_user', 'rp.attachment', 'rp.created_at', 'rp.id');
        $get   = $this->db->select($data)->from('konsultasi')->join('reply AS rp','rp.id_konsultasi=konsultasi.id')->where('konsultasi.id',$id)->order_by('rp.created_at', 'ASC')->get();
        return $get->result();
    }

    public function sendReply($reply, $id_konsultasi)
    {
        $default = array(
            'created_at' => date('Y-m-d H:i:s'),
        );  

        $data = array_merge($default, $reply);

        $this->db->set($data);
        $this->db->insert('reply');
    }

    public function updateReply($idReply, $data)
    {
        $this->db->set($data);
        $this->db->where('id', $idReply);        
        $this->db->update('reply', $data);
    }

    public function status($id, $open)
    {
        if ($open == 'open') {
            $this->db->update('konsultasi', array('status'=>'close'), array('id'=> $id));
        } else {
            $this->db->update('konsultasi', array('status'=>'open'), array('id'=> $id));
        }
    }

    public function setStatus($id, $status)
    {
        $data['status'] = $status;

        $this->db->where('id', $id);
        $this->db->update('konsultasi', $data);
    }

    public function search($search_term)
    {
        $user_id = sentinel()->getUser()->id;

        $this->db->like('subjek',$search_term);
        $this->db->or_like('konsultasi_kategori.name',$search_term);

        $data = array('konsultasi.*','konsultasi_kategori.name');
        $get   = $this->db->select($data)->from('konsultasi')
                    ->join('konsultasi_kategori','konsultasi_kategori.id=konsultasi.id_kategori')
                    ->order_by('konsultasi.created_at', 'DESC')
                    ->where('konsultasi.user_id', $user_id)
                    ->get();
        return $get->result();
    }

    public function setLimit($limitData)
    {
        $user_id = sentinel()->getUser()->id; 

        $this->db->limit($limitData);
        $data  = array('konsultasi.*','konsultasi_kategori.name');
        $get   = $this->db->select($data)->from('konsultasi')
                    ->join('konsultasi_kategori','konsultasi_kategori.id=konsultasi.id_kategori')
                    ->order_by('konsultasi.created_at', 'DESC')
                    ->where('konsultasi.user_id', $user_id)                    
                    ->get();
        
        return $get->result();
    }
}

/* End of file M_konsultasi.php */
/* Location: ./application/modules/konsultasi/models/M_konsultasi.php */