<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_comment extends CI_Model {

    public function create($article_id, $nama, $email, $content, $parent = 0)
    {
        $data = array(
            'artikel_id'    => $article_id,
            'nama'          => $nama,
            'email'         => $email,
            'content'       => $content,
            'date'          => date('Y-m-d H:i:s'),
            'parent'        => $parent,
        );

        $this->db->set($data);
    }

    public function reply($parent, $nama, $email, $content)
    {
        $this->create(0, $nama, $email, $content, $parent);
    }

    public function getByArticle($article_id, $desc = TRUE)
    {
        $this->db->where('artikel_id', $article_id);
        $this->db->order_by('date', $desc ? 'DESC' : 'ASC');

        $query = $this->db->get('komentar');

        return $query->result();
    }

    public function getById($comment_id)
    {
        $this->db->where('id', $comment_id);

        $query = $this->db->get('komentar');

        return $query->num_rows() ? $query->row() : FALSE;
    }

    public function update($comment_id, $data)
    {
        $this->db->set($data);
        $this->db->where('id', $comment_id);

        $query = $this->db->update('komentar');

        return $query;
    }

    public function delete($comment_id)
    {
        $this->db->where('id', $comment_id);
        $this->db->delete('komentar');

        return TRUE;
    }

    public function setStatus($id, $status)
    {
        $data['status']  = $status;

        $this->db->where('id', $id);
        $this->db->update('comment', $data);
    }

}

/* End of file Mod_comment.php */
/* Location: ./application/modules/comment/models/Mod_comment.php */