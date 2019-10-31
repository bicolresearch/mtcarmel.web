<?php

/*
    Filename    : Profile.php
    Location    : application/controllers/user/Profile.php
    Purpose     : Profile Controller
    Created     : 06/27/2019 17:27:57 by Spiderman
    Updated     : 09/17/2019 20:27:14 by Spiderman
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if(logged_in()) {
            $view_data = [
                'page_title' => 'Profile',
                'page_subtitle' => '',
                'user' => user()
            ];

            $this->twig->display('user/profile.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }

    // GET request
    public function info() 
    {
        // Redirect to auth if not ajax request
        if (!$this->input->is_ajax_request()) {
           redirect('auth', 'refresh');
        }
    
        // Create a client with a base URI
        $client = $this->guzzle->client();
    
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'X-API-KEY' => $this->guzzle->key()
            ],
            'query' => [
                'branch_id' => $_GET['branch_id'],
                'id' => $_GET['id']
            ]
        ];
    
        try {
            // GET request
            $response = $client->get('users/user', $options);
    
            $response = json_decode($response->getBody()->getContents());
    
            // Return $response
            echo json_encode($response, true);
    
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
    
            // Return $response 
            echo $response->getBody()->getContents();
        }
    }

    // PUT request
    public function update() 
    {
        // Redirect to auth if not ajax request
        if (!$this->input->is_ajax_request()) {
            redirect('auth', 'refresh');
        }

        $set_data = array(
            'first_name' => $this->input->put('first_name'),
            'last_name' => $this->input->put('last_name'),
            'address_1' => $this->input->put('address_1'),
            'address_2' => $this->input->put('address_2'),
            'city' => $this->input->put('city'),
            'province' => $this->input->put('province'),
            'country' => $this->input->put('country'),
            'landline' => $this->input->put('landline'),
            'mobile' => $this->input->put('mobile')
        );

        $this->form_validation
            ->set_data($set_data)
            ->set_rules('first_name', 'First Name', 'trim|required|xss_clean')
            ->set_rules('last_name', 'Last Name', 'trim|required|xss_clean')
            ->set_rules('address_1', 'Address 1', 'trim|required|xss_clean')  
            ->set_rules('address_2', 'Address 2', 'trim|required|xss_clean')   
            ->set_rules('city', 'City', 'trim|required|xss_clean')   
            ->set_rules('province', 'Province', 'trim|required|xss_clean')   
            ->set_rules('country', 'Country', 'trim|required|xss_clean')   
            ->set_rules('landline', 'Landline', 'trim|required|xss_clean') 
            ->set_rules('mobile', 'Mobile', 'trim|required|xss_clean') 
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
                    'first_name' => $this->input->put('first_name'),
                    'last_name' => $this->input->put('last_name'),
                    'address_1' => $this->input->put('address_1'),
                    'address_2' => $this->input->put('address_2'),
                    'city' => $this->input->put('city'),
                    'province' => $this->input->put('province'),
                    'country' => $this->input->put('country'),
                    'landline' => $this->input->put('landline'),
                    'mobile' => $this->input->put('mobile'),
                    'user_id' => user('id')
                ]
            ];

            try {
                // Get the id parameter
                $id = $this->uri->segment(5);

                // PUT request
                $response = $client->put('users/update/id/' . $id, $options);

                // Return $response  
                echo $response->getBody()->getContents();
            }
            catch (GuzzleHttp\Exception\ClientException $e) {
                $response = $e->getResponse();

                // Return $response 
                echo $response->getBody()->getContents();
            }
        } else {
            $view_data = [
                'status' => false,
                'message' => validation_errors(),
                'first_name' => form_error('first_name'),
                'last_name' => form_error('last_name'),
                'address_1' => form_error('address_1'),
                'address_2' => form_error('address_2'),
                'city' => form_error('city'),
                'province' => form_error('province'),
                'country' => form_error('country'),
                'landline' => form_error('landline'),
                'mobile' => form_error('mobile')
            ];
            echo json_encode($view_data);
        }
    }       
}