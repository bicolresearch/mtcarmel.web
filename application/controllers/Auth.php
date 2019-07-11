<?php

/*
    Filename    : Auth.php
    Location    : application/controller/Auth.php
    Purpose     : Auth Controller
    Created     : 06/24/2019 00:34:49 by Spiderman
    Updated     : 07/12/2019 00:34:42 by Spiderman
    Changes     : Add signup
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    private $id = '';
    private $role_id = '';

    public function __construct()
    {
        parent::__construct();
        $this->id = (int)user('id');
        $this->role_id = (int)user('role_id');
    }

    public function index()
    {
        if (logged_in()) {
            $this->_user_role();
        } else {
            redirect('home', 'refresh');
        }
    }

    public function login()
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

    public function signup()
    {
        if (!$this->input->is_ajax_request()) {
            redirect('auth', 'refresh');
        }

        $this->form_validation
            ->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.username]|xss_clean', array('required' => '%s field is required.'))
            ->set_rules('password', 'Password', 'trim|required|max_length[20]|xss_clean', array('required' => '%s field is required.'))
            ->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]|max_length[20]|xss_clean', array('required' => '%s field is required.'))
            ->set_error_delimiters('<li>', '</li>');

        if ($this->form_validation->run()) {
            
            $data = [
                'username' => $this->input->post('email'),
                'password' => hash('sha512', $this->input->post('password')), 
                'branch_id' => 1,
                'role_id' => 2,
                'created_by' => 1,
                'dt_created' => date('Y-m-d H:i:s'),
            ];

            $this->authme_model->_signup($data);
            
            $view_data = [
                'status' => true,
                'response' => 'Account created. <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal">Click here to login</a>'
            ];
            echo json_encode($view_data);
        } else {
            $view_data = [
                'status' => false,
                'response' => validation_errors(),
                'email' => form_error('email'),
                'password' => form_error('password'),
                'passconf' => form_error('passconf')
            ];
            echo json_encode($view_data);
        }
    }

    public function logout()
    {
        $this->authme->logout('home', 'refresh');
    }

    #helper
    private function _user_role()
    {
        switch ($this->role_id) {
            case 1:
                redirect('admin/management/posts', 'refresh');
                break;
            case 2:
                redirect('user', 'refresh');
                break;
            default:
                redirect('home', 'refresh');
                break;
        }
    }
    #end helper
}