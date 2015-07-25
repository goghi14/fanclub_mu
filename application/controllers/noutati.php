<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Noutati extends CI_Controller {

	public function pag()
	{		
		$user = $this->session->userdata('logged_in');
		$data['getUser'] = $this->mu_model->getUser($user['id']);
		$data['user'] = $user;

		//Initializare Paginatie
		$config = array();
        $config["base_url"] = base_url() . "noutati/pag";
        $config["total_rows"] = count($this->mu_model->getFunction('articles'));
        $config["per_page"] = 6;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);
        $config['full_tag_open'] = '';
        $config['full_tag_close'] = '';
        $config['cur_tag_open'] = '<span class="page-numbers current">';
        $config['cur_tag_close'] = '</span>';
        $config['num_tag_open'] = '<span class="page-numbers">';
        $config['num_tag_close'] = '</span>';
        $config['next_tag_open'] = '<span class="next page-numbers">';
        $config['next_tag_close'] = '</span>';
        $config['prev_tag_open'] = '<span class="prev page-numbers">';
        $config['prev_tag_close'] = '</span>';
        $config['first_tag_open'] = '';
        $config['first_tag_close'] = '';
        $config['last_tag_open'] = '';
        $config['last_tag_close'] = '';
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
        $data['articles'] = $this->mu_model->getPaginatedArticles($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		$data['categories'] = $this->mu_model->getFunction('categories');
		$data['categ_leg'] = $this->mu_model->getFunction('articles_categories');

		$this->load->view('header', $data);
		$this->load->view('noutati', $data);
		$this->load->view('sidebar');
		$this->load->view('footer');
	}

	public function articol() {
		$user = $this->session->userdata('logged_in');
		$url = $this->uri->segment(3);
		$data['getUser'] = $this->mu_model->getUser($user['id']);
		$article = $this->mu_model->getArticleByUrl($url);
		$data['authors'] = $this->mu_model->getFunction('users');
		$data['categories'] = $this->mu_model->getFunction('categories');
		$data['categ_leg'] = $this->mu_model->getFunction('articles_categories');
		$data['tags'] = $this->mu_model->getFunction('tags');
		$data['tag_leg'] = $this->mu_model->getFunction('articles_tags');
		$data['random_categ_leg'] = $this->mu_model->randomOrder('articles_categories');
		$data['articles'] = $this->mu_model->getFunction('articles');
		$data['likes_rel'] = $this->mu_model->getFunction('likes_relationship');
		$coments = $this->mu_model->getComments($article->id);
		$data['user'] = $user;
		$data['article'] = $article;
		$data['coments'] = $coments;

		$related_articlesId = array();
		$article_categories = $this->mu_model->getByWhereStmt('articles_categories', 'article_id', $article->id);
		foreach($article_categories as $result) {
			array_push($related_articlesId, $result->category_id);
		}
		$data['related_articlesId'] = $related_articlesId;

		$comments = array();
		foreach($coments as $coment) {
			if($coment->reply_to_msg_id == 0) {
				$comm = array(
					'id' => $coment->id,
					'sender_id' => $coment->sender_id,
					'message' => $coment->message,
					'article_id' => $coment->article_id,
					'like' => $coment->like_up,
					'reply_to' => $coment->reply_to_msg_id,
					'added_date' => $coment->added_date,
					'deleted' => $coment->deleted,
					);
				$reply_id = $coment->id;
				if(!empty(reply_msg($reply_id, $coments))) {
					$repliess = reply_msg($reply_id, $coments);
					array_push($comm, $repliess);
				}
				array_push($comments, $comm);
			}
		}

		$data['comments'] = $comments;


		
		if($this->input->post('submit-like-down') == "submit_down") {
			$arg = $this->input->post('current_like_down') + 1;
			$id_arg = $this->input->post('id'); 
			$this->mu_model->updateLine('like_down', $arg, 'comments', $id_arg);
			$arg2 = "down";
			$this->mu_model->insertLikesRelationship($arg2);
			redirect('noutati/articol/' . $this->input->post('article_url') . '#comments');
		}
		if($this->input->post('add_comment')) {
			$url = $this->input->post('article_url');
			$article = $this->mu_model->getArticleByUrl($url);
			$this->mu_model->insertComment();
			$arg = $article->total_comments + 1;
			$id_arg = $article->id;
			$this->mu_model->updateLine('total_comments', $arg, 'articles', $id_arg);
			redirect('noutati/articol/' . $this->input->post('article_url') . '#comments');
		}


		$this->load->view('header', $data);
		$this->load->view('articol', $data);
		$this->load->view('sidebar');
		$this->load->view('footer');
	}

	public function likeUp() {
		$likes_rel = $this->mu_model->getFunction('likes_relationship');
		$user_id = $this->input->post('user_id');
		$comment_id = $this->input->post('id');

		$like_permission = checkLikedPermission($likes_rel, 'up', $user_id, $comment_id);
		if($like_permission == true) {
			$is_down = checkLikedPermission($likes_rel, 'down', $user_id, $comment_id);
			if($is_down == false) {
				$rel_id = checkLikedId($likes_rel, $user_id, $comment_id);
				$this->mu_model->updateLine2('like_type', 'up', 'likes_relationship', $rel_id);
				$up = $this->input->post('current_like_up') + 1; 
				$this->mu_model->updateLine('like_up', $up, 'comments', $comment_id);
				$down = $this->input->post('current_like_down') - 1; 
				$this->mu_model->updateLine('like_down', $down, 'comments', $comment_id);
			} else {
			$arg = $this->input->post('current_like_up') + 1; 
			$this->mu_model->updateLine('like_up', $arg, 'comments', $comment_id);
			$arg2 = "up";
			$this->mu_model->insertLikesRelationship($arg2);
			}
		}
	}

	public function likeDown() {
		$likes_rel = $this->mu_model->getFunction('likes_relationship');
		$user_id = $this->input->post('user_id');
		$comment_id = $this->input->post('id');
		$like_permission = checkLikedPermission($likes_rel, 'down', $user_id, $comment_id);
		if($like_permission == true) {
			$is_up = checkLikedPermission($likes_rel, 'up', $user_id, $comment_id);
			if($is_up == false) {
				$rel_id = checkLikedId($likes_rel, $user_id, $comment_id);
				$this->mu_model->updateLine2('like_type', 'down', 'likes_relationship', $rel_id);
				$up = $this->input->post('current_like_up') - 1; 
				$this->mu_model->updateLine('like_up', $up, 'comments',$comment_id);
				$down = $this->input->post('current_like_down') + 1; 
				$this->mu_model->updateLine('like_down', $down, 'comments', $comment_id);
			} else {
			$arg = $this->input->post('current_like_down') + 1; 
			$this->mu_model->updateLine('like_down', $arg, 'comments', $comment_id);
			$arg2 = "down";
			$this->mu_model->insertLikesRelationship($arg2);
		}
		}
	}
}