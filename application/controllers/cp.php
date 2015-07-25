<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cp extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

	public function article()
	{
		$user = $this->session->userdata('logged_in');
		$data['getUser'] = $this->mu_model->getUser($user['id']);
		$data['user'] = $user;
		$data['categories'] = $this->mu_model->getFunction('categories');
		$data['categ_leg'] = $this->mu_model->getFunction('articles_categories');
		$data['tags'] = $this->mu_model->getFunction('tags');
		$url = $this->uri->segment(3);
		if(!empty($url))
			$data['edit_article'] = $this->mu_model->getArticleByUrl($url);

		if($this->input->post('submit_article')) {
			//If the article has an image and it is not changed during update
			if($this->input->post('cur_image')) :
				$image = $this->input->post('cur_image');
			endif;
			
			//Add new uploaded image
			if (!empty($_FILES['imagine']['name'])):
                $image = md5($_FILES['imagine']['name']).'.png';
                $img = ROOT.'resources/uploads/'.$image;
                move_uploaded_file($_FILES['imagine']['tmp_name'], $img);
                cropAvatar(base_url() . "resources/uploads/", $image, "resources/uploads/thumbnails/");
            endif;

            //Check if form is for updating or inserting
            if(!empty($this->input->post('id'))) :
				$this->mu_model->updateArticle($user['id'],$image);
			else :
				$this->mu_model->insertArticle($user['id'],$image);
			endif;

			$article_url = strtolower(str_replace(" ", "-", preg_replace("/(?![-])\p{P}/u", "", $this->input->post('title'))));
            $thisArticle = $this->mu_model->getArticleByUrl($article_url);
            $tags = $data['tags'];
			if($this->input->post('category') != 0) {
				$this->mu_model->insertArticlesCategoriesTags('articles_categories', 'category_id', 'category', $thisArticle->id);
			}
			foreach($tags as $key => $tag) :
				if($this->input->post('tag' . $key)) 
					$this->mu_model->insertArticlesCategoriesTags('articles_tags', 'tag_id', 'tag'.$key, $thisArticle->id);
			endforeach;

			if(!empty($this->input->post('id'))) :
				redirect('noutati/articol/' . $article_url);
			else :
				redirect('noutati/pag/1');
			endif;
		}

		 $categ_leg = $data['categ_leg'];
		 foreach($categ_leg as $categ_con) :
			if ($this->input->post('submit_delete_categ') == $categ_con->id) {
				$this->mu_model->deleteFunction($categ_con->id, 'articles_categories'); // Delete category attribute
				$article_url = strtolower(str_replace(" ", "-", preg_replace("/(?![-])\p{P}/u", "", $this->input->post('title'))));
				redirect('cp/article/' . $article_url);
			}
		endforeach;

		$this->load->view('header', $data);
		$this->load->view('backend/article');
		$this->load->view('footer');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */