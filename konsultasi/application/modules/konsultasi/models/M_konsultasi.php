<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_konsultasi extends CI_Model {

	public function readKonsultasi()
    {
        $data = array('konsultasi.*','konsultasi_kategori.name');
        $get   = $this->db->select($data)->from('konsultasi')->join('konsultasi_kategori','konsultasi_kategori.id=konsultasi.id_kategori')->order_by('konsultasi.created_at', 'DESC')->get();
        return $get->result();
    }

    public function getKategori()
    {
        $query = $this->db->get('konsultasi_kategori'); 

        return $query->result();
    }

    public function create($data, $categories, $status = 'open')
    {
        $default = array(
            'created_at' => date('Y-m-d H:i:s'),
            'status'     => $status,
        );

        $data           = array_merge($default, $data);

        $this->db->set($data);
        $this->db->insert('konsultasi');

        $konsultasi_id = $this->db->insert_id();

        $relation['id_konsultasi_kategori'] = $categories;
        $relation['id_konsultasi']          = $konsultasi_id;

        $this->db->insert('konsultasi_kategori_has_konsultasi', $relation);

        return $konsultasi_id;
    }

}

/* End of file M_konsultasi.php */
/* Location: ./application/modules/konsultasi/models/M_konsultasi.php */