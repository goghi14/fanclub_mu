<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('user','',TRUE);
    }

    function index()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

        $currentUrl = $this->input->post('current_url');   

        if($this->form_validation->run() == FALSE)
        {
            //Field validation failed.&nbsp; User redirected to login page
            $check = 0;
        }
        else
        {
            //Go to private area
            $check = 1;
        }
    
        echo($check);

    }

    function check_database($password)
    {
        //Field validation succeeded.&nbsp; Validate against database
        $email = $this->input->post('email');

        //query the database
        $result = $this->user->login($email, $password);

        if($result)
        {
            $sess_array = array();
            foreach($result as $row)
            {
                $sess_array = array(
                    'id' => $row->id,
                    'email' => $row->email,
                    'name' => $row->name,
                    'avatar' => $row->avatar,
                    'dob' => $row->dob,
                    'class' => $row->class,
                    'living_place' => $row->living_place
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('check_database', 'Invalid username or password');
            return false;
        }
    }
}
?>
