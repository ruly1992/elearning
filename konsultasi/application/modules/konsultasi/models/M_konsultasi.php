<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_konsultasi extends CI_Model {

	public function readKonsultasi()
    {
        $data = array('konsultasi.*','konsultasi_kategori.name');
        $get  = $this->db->select($data)->from('konsultasi')->join('konsultasi_kategori','konsultasi_kategori.id=konsultasi.id_kategori')->order_by('konsultasi.created_at', 'DESC')->get();
        return $get->result();
    }

    public function getKategori()
    {
        $query = $this->db->get('konsultasi_kategori'); 

        return $query->result();
    }

    public function getKatByUser()
    {
    	$query = $this->db->get_where('konsultasi_kategori', array('id_tenaga_ahli' => 1)); 

        return $query->result();
    }

    public function getListKat($kategori_id)
    {
        $data = array('konsultasi.*','konsultasi_kategori.name');
        $get   = $this->db->select($data)->from('konsultasi')->join('konsultasi_kategori','konsultasi_kategori.id=konsultasi.id_kategori')->where('konsultasi_kategori.id',$kategori_id)->get();
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

    public function update($id)
    {
        $default = array(
            'updated_at' => date('Y-m-d H:i:s'),
        );  

        $data = array_merge($default);

        $this->db->set($data);
        $this->db->where('id', $id);        
        $this->db->update('konsultasi');
    }

    public function getReply($id)
    {
        $data = array('konsultasi.*','rp.isi', 'rp.id_user', 'rp.attachment');
        $get   = $this->db->select($data)->from('konsultasi')->join('reply AS rp','rp.id_konsultasi=konsultasi.id')->where('konsultasi.id',$id)->order_by('rp.created_at', 'DESC')->get();
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

    public function status($id, $open)
    {
        if ($open == 'open') {
            $this->db->update('konsultasi', array('status'=>'close'), array('id'=> $id));
        } else {
            $this->db->update('konsultasi', array('status'=>'open'), array('id'=> $id));
        }
    }
}

/* End of file M_konsultasi.php */
/* Location: ./application/modules/konsultasi/models/M_konsultasi.php */