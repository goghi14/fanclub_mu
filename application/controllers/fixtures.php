<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fixtures extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

	public function playWith()
	{
		$this->mu_model->updateFixtureRow("play_with", "play-with-post");
		echo $this->input->post('play-with-post');
	}
	public function date()
	{
		$this->mu_model->updateFixtureRow("date", "date-post");
		echo $this->input->post('date-post');
	}
	public function hr()
	{
		$this->mu_model->updateFixtureRow("hr", "hr-post");
		echo $this->input->post('hr-post');
	}
	public function scor()
	{
		$this->mu_model->updateFixtureRow("scor", "scor-post");
		echo $this->input->post('scor-post');
	}
	public function cup()
	{
		$this->mu_model->updateFixtureRow("cup", "cup-post");
		echo $this->input->post('cup-post');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */