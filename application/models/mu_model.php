<?php

class Mu_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $data['id'] = $this->input->post('id');
    }

    function insertArticle($author_id, $image)
    {
        $data = array(
        'title'=>$this->input->post('title'),
        'url'=>strtolower(str_replace(" ", "-", preg_replace("/(?![-])\p{P}/u", "", $this->input->post('title')))),
        'image'=>$image,
        'content'=>$this->input->post('content'),
        'author_id'=>$author_id,
        'added_date'=>our_date(),
        'top_article'=>$this->input->post('top'),
        'our_author'=>$this->input->post('our_author'),
        );
        $this->db->insert('articles',$data);
    }
    function updateArticle($author_id, $image)
    {
        $data = array(
        'title'=>$this->input->post('title'),
        'url'=>strtolower(str_replace(" ", "-", preg_replace("/(?![-])\p{P}/u", "", $this->input->post('title')))),
        'image'=>$image,
        'content'=>$this->input->post('content'),
        'edited_by'=>$author_id,
        'edited_date'=>our_date(),
        'top_article'=>$this->input->post('top'),
        'our_author'=>$this->input->post('our_author'),
        );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('articles',$data);
    }
    function updateUser($id, $image)
    {
        $data = array(
        'name'=>$this->input->post('name'),
        'avatar'=>$image,
        'dob'=>$this->input->post('dob'),
        'email'=>$this->input->post('email'),
        'living_place'=>$this->input->post('living'),
        );
        $this->db->where('id', $id);
        $this->db->update('users',$data);
    }
    function insertLikesRelationship($arg2)
    {
        $data = array(
        'user_id'=>$this->input->post('user_id'),
        'comment_id'=>$this->input->post('id'),
        'like_type'=>$arg2,
        );
        $this->db->insert('likes_relationship', $data);
    }
    function updateLine($column_name, $arg, $db_name, $id)
    {
        $data = array(
        $column_name=>$arg,
        );
        $this->db->where('id', $id);
        $this->db->update($db_name,$data);
    }
    function updateLine2($column_name, $arg, $db_name, $id)
    {
        $data = array(
        $column_name=>$arg,
        );
        $this->db->where('id', $id);
        $this->db->update($db_name,$data);
    }
    function insertArticlesCategoriesTags($db_name, $column_name, $post_name, $article_id)
    {
        $data = array(
        $column_name=>$this->input->post($post_name),
        'article_id'=>$article_id,
        );
        $this->db->insert($db_name, $data);
    }
    function deleteFunction($id, $db_name) {
        $this->db->where('id', $id);
        $this->db->delete($db_name); 
    }
    function getPaginatedArticles($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('articles');
        $this->db->order_by("id", "desc");
        $this->db->limit($limit, (($start-1) * $limit));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    function insertShortNews($type) {
        $data = array(
        'title'=>$this->input->post('title'),
        'link'=>$this->input->post('link'),
        'type'=>$type,
        'added_by'=>$this->input->post('author_id'),
        );
        $this->db->insert('short_news', $data);
    }
    function getFunction($db_name)
    {
        $this->db->select('*');
        $this->db->from($db_name);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
    }
    function getFixtures()
    {
        $this->db->select('*');
        $this->db->from('fixtures');
        $this->db->order_by("date", "asc");
        $query = $this->db->get();
        return $query->result();
    }
    function getFixturesDesc()
    {
        $this->db->select('*');
        $this->db->from('fixtures');
        $this->db->order_by("date", "desc");
        $query = $this->db->get();
        return $query->result();
    }
    function updateFixtureRow($column, $post_class)
    {
        $data = array(
        $column=>$this->input->post($post_class),
        );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('fixtures',$data);
    }
    function getArticleByUrl($url) 
    {
        $this->db->select('*');
        $this->db->from('articles');
        $this->db->where('url', $url);
        $query = $this->db->get();
        return $query->row();
    }
    function getByWhereStmt($db_name, $column_name, $arg) 
    {
        $this->db->select('*');
        $this->db->from($db_name);
        $this->db->where($column_name, $arg);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
    }
    function getByWhereStmtRow($db_name, $column_name, $arg) 
    {
        $this->db->select('*');
        $this->db->from($db_name);
        $this->db->where($column_name, $arg);
        $query = $this->db->get();
        return $query->row();
    }
    function getComments($arg) 
    {
        $this->db->select('*');
        $this->db->from('comments');
        $this->db->where('article_id', $arg);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    function randomOrder($db_name)
    {
        $this->db->select('*');
        $this->db->from($db_name);
        $this->db->order_by('id', 'RANDOM');
        $query = $this->db->get();
        return $query->result();
    }
    function getArticles($db_name,$arg,$value)
    {
        $this->db->select('*');
        $this->db->from($db_name);
        $this->db->where($arg, $value);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
    }
    function insertFpImagine($image_type, $image, $author) {
        $data = array(
        $image_type=>$image,
        'description'=>$this->input->post('description'),
        'user_id'=>$author,
        );
        $this->db->insert('fp_imagini',$data);
    }

    function insertFpVideo($author) {
        $data = array(
        'title'=>$this->input->post('title'),
        'video_id'=>getVideoID($this->input->post('video_id'), $this->input->post('video_type')),
        'user_id'=>$author,
        'type'=>$this->input->post('video_type'),
        );
        $this->db->insert('fp_video',$data);
    }

    function insertFpCitat($author) {
        $data = array(
        'citat_text'=>$this->input->post('citat'),
        'citat_autor'=>$this->input->post('autor'),
        'user_id'=>$author,
        );
        $this->db->insert('fp_citate',$data);
    }
    function insertFpComentariu($author, $fp_id) {
        $data = array(
        'nume'=>$author,
        'comentariu'=>$this->input->post('fp_coment'),
        'rating'=>$this->input->post('rating'),
        'user_id'=>$this->input->post('fp_id'),
        );
        $this->db->insert('fp_comentarii',$data);
    }

    function insertComment()
    {
        $data = array(
        'sender_id'=>$this->input->post('sender_id'),
        'message'=>$this->input->post('message'),
        'article_id'=>$this->input->post('article_id'),
        'reply_to_msg_id'=>$this->input->post('reply_to_msg_id'),
        'added_date'=>our_date(),
        );
        $this->db->insert('comments',$data);
    }

    function insertFixture() {
        $data = array(
        'type'=>$this->input->post('type'),
        'play_with'=>$this->input->post('echipa'),
        'play_with_logo'=>strtolower(str_replace(" ", "-", preg_replace("/(?![-])\p{P}/u", "", $this->input->post('echipa')))) . ".png",
        'scor'=>"? - ?",
        'date'=>$this->input->post('data'),
        'hour'=>$this->input->post('ora'),
        'cup'=>$this->input->post('cupa'),
        'season_start'=>2015,
        );
        $this->db->insert('fixtures',$data);
    }

    function insertChatMsg($sender, $avatar)
    {
        $data = array(
        'sender'=>$sender,
        'avatar'=>$avatar,
        'message'=>$this->input->post('chat_text'),
        'date'=>model_data(our_date()),
        );
        $this->db->insert('chat',$data);
    }

    function userRegister()
    {
        $data = array(
        'name'=>$this->input->post('name'),
        'email'=>$this->input->post('email'),
        'password'=>sha1($this->input->post('password')),
        'class'=>0,
        'dob'=>$this->input->post('dob'),
        'avatar'=>"default-avatar.png",
        );
        $this->db->insert('users',$data);
    }

    function getUser($user_id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where("id", $user_id);
        $query = $this->db->get();
        return $query->row();
    }

}

?>