<?php

/*
    Filename    : Confraternities.php
    Location    : application/controllers/admin/Confraternities.php
    Purpose     : Confraternities controller
    Created     : 07/31/2019 16:00:09 by Scarlet Witch
    Updated     : 09/01/2019 22:11:20 by Spiderman
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Confraternities extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if(logged_in()) {
            $view_data = [
                'page_title' => 'Confraternities',
                'page_subtitle' => '',
                'user' => user()
            ];
    
            $this->twig->display('admin/confraternities.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }
    
    // GET request
    public function confraternities() 
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
            ]
        ];

        try {
            // GET request
            $response = $client->get('confraternities', $options);

            $response = json_decode($response->getBody()->getContents());

            // Return $response
            echo json_encode($response, true);

        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();

            // Return $response 
            echo $response->getBody()->getContents();
        }
    }

    // GET request
    public function confraternity() 
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
                'id' => $_GET['id']
            ]
        ];

        try {
            // GET request
            $response = $client->get('confraternities/confraternity', $options);

            $response = json_decode($response->getBody()->getContents());

            // Return $response
            echo json_encode($response, true);

        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();

            // Return $response 
            echo $response->getBody()->getContents();
        }
    }

    // POST request
    public function create() 
    {
        // Redirect to auth if not ajax request
        if (!$this->input->is_ajax_request()) {
            redirect('auth', 'refresh');
        }

        $this->form_validation
            ->set_rules('status_id', 'Status', 'trim|required|xss_clean')
            ->set_rules('name', 'Name', 'trim|required|xss_clean')
            ->set_rules('address_1', 'Address 1', 'trim|required|xss_clean')  
            ->set_rules('address_2', 'Address 2', 'trim|required|xss_clean')   
            ->set_rules('city', 'City', 'trim|required|xss_clean')   
            ->set_rules('province', 'Province', 'trim|required|xss_clean')   
            ->set_rules('country', 'Country', 'trim|required|xss_clean')   
            ->set_rules('birthdate', 'Birthdate', 'trim|required|xss_clean') 
            ->set_rules('landline', 'Landline', 'trim|required|xss_clean') 
            ->set_rules('mobile', 'Mobile', 'trim|required|xss_clean') 
            ->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean')
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
                    'branch_id' => 1,
                    'module_id' => 4,
                    'sub_module_id' => 1,
                    'status_id' => $this->input->post('status_id'),
                    'name' => $this->input->post('name'),
                    'address_1' => $this->input->post('address_1'),
                    'address_2' => $this->input->post('address_2'),
                    'city' => $this->input->post('city'),
                    'province' => $this->input->post('province'),
                    'country' => $this->input->post('country'),
                    'birthdate' => $this->input->post('birthdate'),
                    'landline' => $this->input->post('landline'),
                    'mobile' => $this->input->post('mobile'),
                    'email' => $this->input->post('email'),    
                    'user_id' => user('id')
                ]
            ];

            try {
                // POST request
                $response = $client->post('confraternities/create', $options);  
    
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
                'status_id' => form_error('status_id'),
                'name' => form_error('name'),
                'address_1' => form_error('address_1'),
                'address_2' => form_error('address_2'),
                'city' => form_error('city'),
                'province' => form_error('province'),
                'country' => form_error('country'),
                'birthdate' => form_error('birthdate'),
                'landline' => form_error('landline'),
                'mobile' => form_error('mobile'),
                'email' => form_error('email')
            ];
            echo json_encode($view_data);
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
            'status_id' => $this->input->put('status_id'),
            'name' => $this->input->put('name'),
            'address_1' => $this->input->put('address_1'),
            'address_2' => $this->input->put('address_2'),
            'city' => $this->input->put('city'),
            'province' => $this->input->put('province'),
            'country' => $this->input->put('country'),
            'birthdate' => $this->input->put('birthdate'),
            'landline' => $this->input->put('landline'),
            'mobile' => $this->input->put('mobile'),
            'email' => $this->input->put('email')
        );

        $this->form_validation
            ->set_data($set_data)
            ->set_rules('status_id', 'Status', 'trim|required|xss_clean')
            ->set_rules('name', 'Name', 'trim|required|xss_clean')
            ->set_rules('address_1', 'Address 1', 'trim|required|xss_clean')  
            ->set_rules('address_2', 'Address 2', 'trim|required|xss_clean')   
            ->set_rules('city', 'City', 'trim|required|xss_clean')   
            ->set_rules('province', 'Province', 'trim|required|xss_clean')   
            ->set_rules('country', 'Country', 'trim|required|xss_clean')   
            ->set_rules('birthdate', 'Birthdate', 'trim|required|xss_clean') 
            ->set_rules('landline', 'Landline', 'trim|required|xss_clean') 
            ->set_rules('mobile', 'Mobile', 'trim|required|xss_clean') 
            ->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean')
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
                    'status_id' => $this->input->put('status_id'),
                    'name' => $this->input->put('name'),
                    'address_1' => $this->input->put('address_1'),
                    'address_2' => $this->input->put('address_2'),
                    'city' => $this->input->put('city'),
                    'province' => $this->input->put('province'),
                    'country' => $this->input->put('country'),
                    'birthdate' => $this->input->put('birthdate'),
                    'landline' => $this->input->put('landline'),
                    'mobile' => $this->input->put('mobile'),
                    'email' => $this->input->put('email'),
                    'user_id' => user('id')
                ]
            ];

            try {
                // Get the id parameter
                $id = $this->uri->segment(5);

                // PUT request
                $response = $client->put('confraternities/update/id/' . $id, $options);

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
                'status_id' => form_error('status_id'),
                'name' => form_error('name'),
                'address_1' => form_error('address_1'),
                'address_2' => form_error('address_2'),
                'city' => form_error('city'),
                'province' => form_error('province'),
                'country' => form_error('country'),
                'birthdate' => form_error('birthdate'),
                'landline' => form_error('landline'),
                'mobile' => form_error('mobile'),
                'email' => form_error('email')
            ];
            echo json_encode($view_data);
        }
    } 
    
    // PUT request
    public function delete() 
    {
        // Redirect to auth if not ajax request
        if (!$this->input->is_ajax_request()) {
             redirect('auth', 'refresh');
        }

        // Create a client with a base URI
        $client = $this->guzzle->client();

        $options = [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'X-API-KEY' => $this->guzzle->key()
            ],
            'form_params' => [
                'user_id' => user('id')
            ]
        ];
        
        try {
            // Get the id parameter
            $id = $this->uri->segment(5);

            // PUT request
            $response = $client->put('confraternities/soft_delete/id/' . $id, $options);

            // Return $response  
            echo $response->getBody()->getContents();
        }
        catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();

            // Return $response 
            echo $response->getBody()->getContents();
        }
    }
}