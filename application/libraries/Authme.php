<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Authme
{
    private $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->database();
        $this->CI->load->library('session');
        $this->CI->load->model('authme_model');
    }

    public function logged_in()
    {
        return $this->CI->session->userdata('logged_in');
    }

    public function signin($password)
    {
        $user = $this->CI->authme_model->_signin(hash('sha256', $password));
        if ($user) {
            unset($user->access_code);
            $this->CI->session->set_userdata(array(
                'logged_in' => true,
                'user' => $user
            ));
            return true;
        }
        return false;
    }

    public function signout($redirect = false)
    {
        $this->CI->session->sess_destroy();
        if ($redirect) {
            $this->CI->load->helper('url');
            redirect($redirect, 'refresh');
        }
    }
}

/* End of file: authme.php */
/* Location: application/libraries/authme.php */