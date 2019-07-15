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
            if($this->authme->login(set_value('email'), set_value('password'))) {
                $response = [
                    'status' => true
                ];
                echo json_encode($response);
            }
        } else {
            $response = [
                'status' => false,
                'message' => validation_errors(),
                'email' => form_error('email'),
                'password' => form_error('password')
            ];
            echo json_encode($response);
        }
    }

    public function signup()
    {
        if (!$this->input->is_ajax_request()) {
            redirect('auth', 'refresh');
        }

        $this->form_validation
            ->set_rules('first_name', 'First Name', 'trim|required|max_length[20]|xss_clean', array('required' => '%s field is required.'))
            ->set_rules('last_name', 'Last Name', 'trim|required|max_length[20]|xss_clean', array('required' => '%s field is required.'))
            ->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.username]|xss_clean', array('required' => '%s field is required.'))
            ->set_rules('password', 'Password', 'trim|required|max_length[20]|xss_clean', array('required' => '%s field is required.'))
            ->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]|max_length[20]|xss_clean', array('required' => '%s field is required.'))
            ->set_error_delimiters('<li>', '</li>');

        if ($this->form_validation->run()) {

            // Create a client with a base URI
            $client = $this->guzzle->client();

            $options = [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'X-API-KEY' => $this->guzzle->key()
                ],
                'form_params' => [
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'email' => $this->input->post('email'),
                    'password' => hash('sha512', $this->input->post('password')), 
                    'branch_id' => 1,
                    'role_id' => 2,
                    'user_id' => 1
                ]
            ];

            try {
                // POST request
                $response = $client->post('users/create', $options);  

                // Return $response 
                 echo $response->getBody()->getContents();
            }
            catch (GuzzleHttp\Exception\ClientException $e) {
                $response = $e->getResponse();

                // Return $response 
                echo $response->getBody()->getContents();
            }
        } else {
            $response = [
                'status' => false,
                'message' => validation_errors(),
                'email' => form_error('email'),
                'password' => form_error('password'),
                'passconf' => form_error('passconf')
            ];
            echo json_encode($response);
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
                redirect('admin', 'refresh');
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