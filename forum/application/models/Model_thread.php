<?php 

class Model_thread extends CI_Model 
{

    public function __construct()
    {
        parent::__construct();
    }

    function save_thread($data)
    {
        $this->db->insert('threads',$data);
        if($this->db->affected_rows() == 1){
          return TRUE;
        } else {
          return FALSE;
        }
    }
    
    function delete_thread($id)
    {
        $delete = $this->db->delete('threads', array('id'=>$id));
        if($this->db->affected_rows() == 1){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    function delete_thread_by_topic($idTopic)
    {
        $delete = $this->db->delete('threads', array('topic'=>$idTopic));
        if($this->db->affected_rows() >= 1){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    function update_thread($id,$data)
    {
        $this->db->where('id',$id);
        $update = $this->db->update('threads', $data); 
        
        if($this->db->affected_rows() == 1){
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
        $items = array('threads.*', 'categories.category_name', 'categories.id AS idCategory');
        $get   = $this->db->select($items)
                        ->from('threads')
                        ->join('categories','categories.id=threads.category')
                        ->where('threads.id',$id)
                        ->get();
        return $get->result();
    }
    
    function get_categories()
    {
        $get = $this->db->get('categories');
        return $get->result();
    }
    
    function get_all_threads()
    {
        $items = array('threads.*','categories.category_name');
        $get   = $this->db->select($items)->from('threads')
                ->join('categories','categories.id=threads.category')
                ->join('topics', 'topics.id=threads.topic')
                ->where(array('reply_to' => '0', 'threads.status' => '1', 'topics.status' => '1'))
                ->order_by('created_at','desc')
                ->get();
        return $get->result();
    }

    function get_close_threads($id){
        $get    = $this->db->get_where('thread_members', array('user_id' => $id));
        return $get->result();
    }

    function get_all_drafts($id)
    {
        $items = array('threads.*', 'categories.category_name', 'topics.topic AS topic_name');
        $get   = $this->db->select($items)->from('threads')
                ->join('categories', 'categories.id=threads.category')
                ->join('topics', 'topics.id=threads.topic')
                ->join('category_user', 'category_user.category_id=threads.category')
                ->where(array('reply_to'=>'0', 'threads.status'=>'0', 'category_user.user_id'=>$id))
                ->order_by('created_at','desc')
                ->get();
        return $get->result();
    }

    function get_draft_threads()
    {
        $items = array('threads.*', 'categories.category_name', 'topics.topic AS topic_name');
        $get   = $this->db->select($items)->from('threads')
                ->join('categories', 'categories.id=threads.category')
                ->join('topics', 'topics.id=threads.topic')
                ->where(array('reply_to'=>'0', 'threads.status'=>'0'))
                ->order_by('created_at','desc')
                ->get();
        return $get->result();
    }

    function get_draft_threads_by_category($idTA, $idCategory)
    {
        $items = array('threads.*', 'categories.category_name', 'topics.topic AS topic_name');
        $get   = $this->db->select($items)->from('threads')
                ->join('categories', 'categories.id=threads.category')
                ->join('topics', 'topics.id=threads.topic')
                ->join('category_user', 'category_user.category_id=threads.category')
                ->where(array('reply_to'=>'0', 'threads.status'=>'0', 'category_user.user_id'=>$idTA, 'threads.category'=>$idCategory))
                ->order_by('created_at','desc')
                ->get();
        return $get->result();
    }

    function get_thread_from_author($id)
    {
        $items = array('threads.*', 'categories.category_name');
        $get   = $this->db->select($items)->from('threads')
                ->join('categories', 'categories.id=threads.category')
                ->where('author', $id)
                ->order_by('created_at','desc')
                ->get();
        return $get->result();
    }

    function get_threads_category($idCategory)
    {
        $items = array('threads.*','categories.category_name');
        $get   = $this->db->select($items)->from('threads')
                ->join('categories','categories.id=threads.category')
                ->where(array('reply_to' => '0', 'threads.status' => '1', 'threads.category' => $idCategory))
                ->order_by('created_at','desc')
                ->get();
        return $get->result();
    }

    function get_reply($id)
    {
        $items = array('threads.*','categories.category_name');
        $get   = $this->db->select($items)
                        ->from('threads')
                        ->join('categories','categories.id=threads.category')
                        ->where('reply_to',$id)
                        ->get();
        return $get->result();
    }

    function get_count_reply()
    {
        $get = $this->db->select(array('id','reply_to'))->from('threads')->where_not_in('reply_to','0')->get();
        return $get->result();
    }

    function delete_replies($id)
    {
        $this->db->where('reply_to', $id);
        $delete = $this->db->delete('threads');
        if($this->db->affected_rows() >= 1){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    function delete_thread_members($id)
    {
        $this->db->where('thread_id', $id);
        $delete = $this->db->delete('thread_members');
        if($this->db->affected_rows() >= 1){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    function get_category($idCategory)
    {
        $get = $this->db->get_where('categories', array('id'=>$idCategory));
        return $get->result();
    }

    function get_category_users($id){
        $get = $this->db->get_where('category_user', array('user_id'=>$id));
        return $get->result();
    }

    function get_topics_by_user($id){
        $get = $this->db->select('*')
                    ->from('topics')
                    ->where('tenaga_ahli', $id)
                    ->get();
        if($this->db->affected_rows() >= 1){
            return $get->result();
        }else{
            return array();
        }
    }

    function approve_thread($data, $id)
    {   
        $this->db->where('id', $id);
        $update = $this->db->update('threads', $data);
        if($this->db->affected_rows() == 1){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    function get_thread_by_all($where){
        $get = $this->db->get_where('threads', $where);
        if($this->db->affected_rows() >= 1){
            return $get->result();
        }else{
            return array();
        }
    }

    function save_thread_member($member){
        $save   = $this->db->insert('thread_members', $member);
        if($this->db->affected_rows() == 1){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    function get_thread_members(){
        $get = $this->db->get('thread_members');
        if($this->db->affected_rows() >= 1){
            return $get->result();
        }else{
            return array();
        }
    }

}