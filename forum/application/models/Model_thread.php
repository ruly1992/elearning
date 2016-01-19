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
          return $this->db->insert_id();
        } else {
          return FALSE;
        }
    }
    
    function delete_thread($data)
    {
        $delete = $this->db->delete('threads', $data);
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
        $items = array(
                'threads.*',
                'categories.category_name', 
                'categories.id AS idCategory',
                'topics.topic AS topicName'
        );
        $get   = $this->db->select($items)
                        ->from('threads')
                        ->join('categories', 'categories.id=threads.category')
                        ->join('topics', 'topics.id=threads.topic')
                        ->where('threads.id',$id)
                        ->get();
        return $get->result();
    }
    
    function get_categories()
    {
        $this->db->order_by('categories.id', 'desc');
        $get = $this->db->get('categories');
        return $get->result();
    }

    function get_categories_by_ta($id)
    {
        $get    = $this->db->select('categories.*')
                            ->from('categories')
                            ->join('category_user', 'category_user.category_id=categories.id')
                            ->join('topics', 'topics.category=categories.id')
                            ->where(array('category_user.user_id' => $id))
                            ->or_where('topics.daerah', '00.00.00.0000')
                            ->group_by('categories.category_name')
                            ->order_by('categories.id', 'desc')
                            ->get();
        return $get->result();
    }
    
    function get_all_threads($id)
    {
        $data = array('threads.*','categories.category_name');
        $threadsByTACategory    = $this->getThreadsByTACategory($id, $data);
        $threadsByTATopic       = $this->getThreadsByTATopic($id, $data);
        $threadsByTAId          = $this->getThreadsByTAId($id, $data);
        $closeThreads           = $this->getThreadsByClose($id, $data);

        $allThreads             = array();
        foreach ($threadsByTATopic as $tbt) {
            if ( ! in_array($tbt, $allThreads)) {
                $allThreads[] = $tbt;
            }
        }
        foreach($threadsByTACategory as $tbc){
            if ( ! in_array($tbc, $allThreads)) {
                $allThreads[] = $tbc;
            }
        }
        foreach ($closeThreads as $tbi) {
            if ( ! in_array($tbi, $allThreads)) {
                $allThreads[] = $tbi;
            }
        }
        foreach ($threadsByTAId as $tbi) {
            if ( ! in_array($tbi, $allThreads)) {
                $allThreads[] = $tbi;
            }
        }
        $categories     = $this->get_categories();
        $result         = sortThreads($allThreads, $categories);
        return $result;
    }

    private function getThreadsByTACategory($id, $data)
    {
        $result   = $this->db->select($data)->from('threads')
                            ->join('categories', 'categories.id=threads.category')
                            ->join('category_user', 'category_user.category_id=categories.id')
                            ->join('topics', 'topics.id=threads.topic')
                            ->where(array(
                                'user_id'               => $id,
                                'reply_to'              => '0', 
                                'threads.status'        => '1', 
                                'topics.status'         => '1'
                            ))
                            ->order_by('threads.category', 'desc')
                            ->order_by('threads.id', 'desc')
                            ->get()
                            ->result();
        return $result;
    }

    private function getThreadsByTATopic($id, $data)
    {
        $result     = $this->db->select($data)->from('threads')
                            ->join('categories', 'categories.id=threads.category')
                            ->join('topics', 'topics.id=threads.topic')
                            ->where(array(
                                'tenaga_ahli'           => $id,
                                'reply_to'              => '0', 
                                'threads.status'        => '1', 
                                'topics.status'         => '1'
                            ))
                            ->order_by('threads.category', 'desc')
                            ->order_by('threads.id', 'desc')
                            ->get()
                            ->result();
        return $result;
    }

    private function getThreadsByTAId($id, $data)
    {
        $result     = $this->db->select($data)->from('threads')
                            ->join('categories', 'categories.id=threads.category')
                            ->join('topics', 'topics.id=threads.topic')
                            ->where(array(
                                'author'           => $id,
                                'reply_to'         => '0', 
                                'threads.status'   => '1', 
                                'topics.status'    => '1'
                            ))
                            ->order_by('threads.category', 'desc')
                            ->order_by('threads.id', 'desc')
                            ->get()
                            ->result();
        return $result;
    }

    function getThreadsByClose($id, $data){
        $result     = $this->db->select($data)->from('threads')
                            ->join('categories', 'categories.id=threads.category')
                            ->join('topics', 'topics.id=threads.topic')
                            ->join('thread_members', 'thread_members.thread_id=threads.id')
                            ->where(array(
                                'user_id'          => $id,
                                'reply_to'         => '0', 
                                'threads.status'   => '1', 
                                'topics.status'    => '1'
                            ))
                            ->order_by('threads.category', 'desc')
                            ->order_by('threads.id', 'desc')
                            ->get()
                            ->result();
        return $result;
    }

    function get_threads_by_user($daerahUser, $userID)
    {
        $threadsByDaerah    = $this->getUserThreads($daerahUser);
        $memberThreads      = $this->getUserMemberThreads($userID);

        $allThreads             = array();
        foreach ($threadsByDaerah as $tbt) {
            if ( ! in_array($tbt, $allThreads)) {
                $allThreads[] = $tbt;
            }
        }
        foreach ($memberThreads as $tbt) {
            if ( ! in_array($tbt, $allThreads)) {
                $allThreads[] = $tbt;
            }
        }
        return $allThreads;
    }

    function getUserMemberThreads($userID)
    {
        $get    = $this->db->select(array('threads.*', 'categories.category_name'))
                ->from('threads')
                ->join('categories','categories.id=threads.category')
                ->join('thread_members', 'thread_members.thread_id=threads.id')
                ->where(array('author' => $userID, 'type' => 'close', 'reply_to' => '0'))
                ->or_where('thread_members.user_id', $userID)
                ->group_by('threads.id')
                ->order_by('threads.category', 'desc')
                ->order_by('threads.id', 'desc')
                ->get()
                ->result();
        return $get;
    }

    function getUserThreads($daerahUser)
    {
        $d          = explode('.', $daerahUser);
        $desa       = $daerahUser;
        $kecamatan  = $d[0].'.'.$d[1].'.'.$d[2].'.0000';
        $kota       = $d[0].'.'.$d[1].'.00.0000';
        $provinsi   = $d[0].'.00.00.0000';
        $default    = '00.00.00.0000';
        $daerah     = array($desa, $kecamatan, $kota, $provinsi, $default);

        $items = array('threads.*','categories.category_name');
        $get   = $this->db->select($items)->from('threads')
                ->join('categories','categories.id=threads.category')
                ->join('topics', 'topics.id=threads.topic')
                ->where(array('reply_to' => '0', 'threads.status' => '1', 'topics.status' => '1', 'threads.type' => 'public'))
                ->where_in('topics.daerah', $daerah)
                ->order_by('threads.category', 'desc')
                ->order_by('threads.id', 'desc')
                ->get();
        return $get->result();
    }

    function get_close_threads($id){
        $get    = $this->db->select(array('threads.id', 'category'))
                                    ->from('threads')
                                    ->join('thread_members', 'thread_members.thread_id=threads.id')
                                    ->where(array('author' => $id, 'type' => 'close', 'reply_to' => '0'))
                                    ->or_where('thread_members.user_id', $id)
                                    ->group_by('threads.id')
                                    ->get()
                                    ->result();
        return $get;
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
                ->where(array('author' => $id, 'reply_to' => '0'))
                ->order_by('category','desc')
                ->order_by('id', 'desc')
                ->get();
        return $get->result();
    }

    function get_threads_category($idTA, $idCategory)
    {
        $items = array('threads.*','categories.category_name');
        $get   = $this->db->select($items)->from('threads')
                ->join('categories', 'categories.id=threads.category')
                ->join('topics', 'topics.id=threads.topic')
                ->where(array(
                    'reply_to' => '0', 
                    'threads.status' => '1', 
                    'threads.category' => $idCategory,
                    'topics.tenaga_ahli' => $idTA
                ))
                ->order_by('created_at','desc')
                ->get();
        return $get->result();
    }

    function get_threads_category_by_user($idCategory, $daerahUser)
    {
        $d          = explode('.', $daerahUser);
        $desa       = $daerahUser;
        $kecamatan  = $d[0].'.'.$d[1].'.'.$d[2].'.0000';
        $kota       = $d[0].'.'.$d[1].'.00.0000';
        $provinsi   = $d[0].'.00.00.0000';
        $default    = '00.00.00.0000';
        $daerah     = array($desa, $kecamatan, $kota, $provinsi, $default);

        $items = array('threads.*', 'categories.category_name');
        $get   = $this->db->select($items)->from('threads')
                ->join('categories', 'categories.id=threads.category')
                ->join('topics', 'topics.id=threads.topic')
                ->where(array('reply_to' => '0', 'threads.status' => '1', 'threads.category' => $idCategory))
                ->where_in('daerah', $daerah)
                ->order_by('threads.id','desc')
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
        if($this->db->affected_rows() == '1'){
            return $get->result();
        }else{
            return array();
        }
    }

    function save_thread_member($member)
    {
        $save   = $this->db->insert('thread_members', $member);
        if($this->db->affected_rows() == 1){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    function get_thread_members()
    {
        $get    = $this->db->get('thread_members');
        if($this->db->affected_rows() > '0'){
            return $get->result();
        }else{
            return array();
        }
    }

    function get_thread_members_by_id($id)
    {
        $get = $this->db->get_where('thread_members', array('thread_id' => $id));
        if($this->db->affected_rows() > '0'){
            return $get->result();
        }else{
            return array();
        }
    }

}