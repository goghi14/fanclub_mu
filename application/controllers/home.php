<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$user = $this->session->userdata('logged_in');
		$data['getUser'] = $this->mu_model->getUser($user['id']);
		$data['articles'] = $this->mu_model->getFunction('articles');
		$data['authors'] = $this->mu_model->getFunction('users');
		$data['top_articles'] = $this->mu_model->getArticles('articles','top_article','1');
		$data['author_articles'] = $this->mu_model->getArticles('articles','our_author','1');
		$data['comments'] = $this->mu_model->getFunction('comments');
		$data['short_news'] = $this->mu_model->getFunction('short_news');
		$data['user'] = $user;

		if($this->input->post('submit_news')) {
			$type = "pl";
			$this->mu_model->insertShortNews($type);
			$short_news = $this->mu_model->getByWhereStmt('short_news', 'type', $type) ;
			foreach($short_news as $key => $pl_news) :
				if($key > 4) :
					$this->mu_model->deleteFunction($pl_news->id, 'short_news');
				endif;
			endforeach;
			redirect('home#noutati-pl');
		}
		if($this->input->post('submit_football')) {
			$type = "football";
			$this->mu_model->insertShortNews($type);
			$short_news = $this->mu_model->getByWhereStmt('short_news', 'type', $type) ;
			foreach($short_news as $key => $pl_news) :
				if($key > 4) :
					$this->mu_model->deleteFunction($pl_news->id, 'short_news');
				endif;
			endforeach;
			redirect('home#noutati-fotbal');
		}

		$this->load->view('header', $data);
		$this->load->view('index',$data);
		$this->load->view('sidebar');
		$this->load->view('footer');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */