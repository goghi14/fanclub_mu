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

		//Fixtures
		$data['fixtures'] = $this->mu_model->getFixtures();
		$fixturesDesc = $this->mu_model->getFixturesDesc();
		$fixtures = $this->mu_model->getFixtures();
		if($this->input->post('submit_fixture')) :
			$this->mu_model->insertFixture();
		    redirect('home');
		endif;

		//Ultimul meci
		foreach ($fixturesDesc as $fixture) {
			if($fixture->scor != "? - ?") :
				$data['last_score'] = $fixture->scor;
				$data['last_team'] = $fixture->play_with;
				$data['last_team_logo'] = $fixture->play_with_logo;
				$data['last_game_date'] = $fixture->date;
				$data['last_game_hr'] = $fixture->hour;
				$data['last_game_cup'] = $fixture->cup;
				$data['gl_type'] = $fixture->type; 
				break;
			endif;
		}
		//Urmatorul meci
		foreach ($fixtures as $fixtur) {
			if($fixtur->scor == "? - ?") :
				$data['next_score'] = $fixtur->scor;
				$data['next_team'] = $fixtur->play_with;
				$data['next_team_logo'] = $fixtur->play_with_logo;
				$data['next_game_date'] = $fixtur->date;
				$data['next_game_hr'] = $fixtur->hour;
				$data['next_game_cup'] = $fixtur->cup;
				$data['gn_type'] = $fixtur->type;
				break;
			endif;
		}

		$this->load->view('header', $data);
		$this->load->view('index',$data);
		$this->load->view('sidebar',$data);
		$this->load->view('footer');
	}
	public function scoreReset()
	{
		// Create DOM from URL or file
		$html = file_get_html('http://www.livescore.com/soccer/2015-08-08/');

		// Find all images 
		foreach($html->find('div[class=row-gray]') as $key => $element) :
       		$home = $html->find('div[class=ply tright name]', $key)->innertext;
       		$away = $html->find('div[class=ply name]', $key)->innertext;
       		if($home == " Manchester United ")  {
       			$check = 1;
       			$scorul = $html->find('a[class=scorelink]', $key)->innertext;
       			break;
       		}
       		else if($away == " Manchester United ") {
       			$check = 1;
       			$scorul = $html->find('a[class=scorelink]', $key)->innertext;
       			break;
       		} else {
       			$check = 0;
       		}
       	endforeach;
       	
       	if($check == 1) :
	       	$fixtures = $this->mu_model->getFixtures();
	       	foreach($fixtures as $fixture) :
	       		if($fixture->scor == "? - ?") :
	       			$id = $fixture->id;
	       			break;
	   			endif;
	   		endforeach;
			$this->mu_model->updateLine('scor', $scorul, 'fixtures', $id);
			echo('Done');
		endif;

       	die();

	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */