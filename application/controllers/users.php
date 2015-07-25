<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$user = $this->session->userdata('logged_in');
		$data['getUser'] = $this->mu_model->getUser($user['id']);
		$data['user'] = $user;
		$arg = $this->input->post('id_user');
	    $user_profile = $this->mu_model->getByWhereStmtRow('users', 'id', $arg);
		$username = $user_profile->name;
		$dob = $user_profile->dob;
		$email = $user_profile->email;
		$living = $user_profile->living_place;
		$userClass = $user_profile->class;
		echo($user['id'] . '#');
		echo($user_profile->id . '#');
		echo($user_profile->avatar . '#');
		echo($username . '#');
		echo($dob . '#');
		echo($email . '#');
		echo($living . '#');
		echo($userClass);

	}

	public function edit_details() 
	{
		$user = $this->session->userdata('logged_in');
		$data['user'] = $user;
		$data['getUser'] = $this->mu_model->getUser($user['id']);

		if($this->input->post('submit_user_details')) {
			if (!empty($_FILES['avatar']['name'])):
                $image = md5($_FILES['avatar']['name']).'.png';
                $img = ROOT.'resources/images/avatars/'.$image;
                move_uploaded_file($_FILES['avatar']['tmp_name'], $img);
                cropAvatar(base_url() . "resources/images/avatars/", $image, "resources/images/avatars/thumbnails/");
            else :
            	$image = $this->input->post('curAvatar');
            endif;
			$this->mu_model->updateUser($user['id'], $image);
		}

		$this->load->view('header', $data);
		$this->load->view('backend/edit_user_details', $data);
		$this->load->view('footer');
	}

}