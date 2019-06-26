<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    private $id = '';

    public function __construct()
    {
        parent::__construct();
        $this->id = (int)user('id');
    }

    public function index()
    {
        $this->login();
    }

    public function login()
    {
        if (logged_in()) {
            $this->_user_role();
        } else {
            redirect('home', 'refresh');
        }
    }

    public function login_ajax()
    {
        if (!$this->input->is_ajax_request()) {
            redirect('auth', 'refresh');
        }

        $this->form_validation
            ->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean', array('required' => '%s field is required.'))
            ->set_rules('password', 'Password', 'trim|required|xss_clean', array('required' => '%s field is required.'))
            ->set_error_delimiters('<li>', '</li>');

        if ($this->form_validation->run()) {
            if ($this->authme->login(set_value('email'), set_value('password'))) {
                $view_data = [
                    'status' => true
                ];
                echo json_encode($view_data);
            } else {
                $view_data = [
                    'status' => false,
                    'response' => 'Unable to login, please double check your login credentials.',
                ];
                echo json_encode($view_data);
            }
        } else {
            $view_data = [
                'status' => false,
                'response' => validation_errors(),
                'email' => form_error('email'),
                'password' => form_error('password')
            ];
            echo json_encode($view_data);
        }
    }

    public function logout()
    {
        if (logged_in()) {
            redirect('home', 'refresh');
        } else {
            $this->authme->logout('auth');
        }
    }

    #helper
    private function _user_role()
    {
        switch (user('role_id')) {
            case 1:
                redirect('home', 'refresh');
                break;
            case 2:
                redirect('home', 'refresh');
                break;
            default:
                break;
        }
    }
    #end helper
}

/* End of file: Auth.php */
/* Location: application/controller/Auth.php */