<?php

/*
    Filename    : Confraternity.php
    Location    : application/controllers/admin/Confraternity.php
    Purpose     : Confraternity controller
    Created     : 07/31/2019 16:00:09 by Scarlet Witch
    Updated     : 08/01/2019 16:21:31 by Scarlet Witch
    Changes     : update fields
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Confraternity extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if(logged_in()) {
            $view_data = [
                'page_title' => 'Confraternity',
                'page_subtitle' => 'list of confraternity',
                'user' => user()
            ];
    
            $this->twig->display('admin/confraternity.html', $view_data);
        } else {
            redirect('auth', 'refresh');
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
            ]
        ];

        try {
            // GET request
            $response = $client->get('confraternity', $options);

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
    public function medium() 
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
                'id' => $this->uri->segment(5)
            ]
        ];

        try {
            // GET request
            $response = $client->get('confraternity/medium', $options);

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
            ->set_rules('name', 'name', 'trim|required|xss_clean')
            ->set_rules('address_1', 'address_1', 'trim|required|xss_clean')  
            ->set_rules('address_2', 'address_2', 'trim|required|xss_clean')   
            ->set_rules('barangay', 'barangay', 'trim|required|xss_clean')   
            ->set_rules('city', 'city', 'trim|required|xss_clean')   
            ->set_rules('province', 'province', 'trim|required|xss_clean')   
            ->set_rules('country', 'country', 'trim|required|xss_clean')   
            ->set_rules('dt_birth', 'dt_birth', 'trim|required|xss_clean') 
            ->set_rules('landline', 'landline', 'trim|required|xss_clean') 
            ->set_rules('mobile', 'mobile', 'trim|required|xss_clean') 
            ->set_rules('email', 'email', 'trim|required|xss_clean') 
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
                    'name' => $this->input->post('name'),
                    'address_1' => $this->input->post('address_1'),
                    'address_2' => $this->input->post('address_2'),
                    'barangay' => $this->input->post('barangay'),
                    'city' => $this->input->post('city'),
                    'province' => $this->input->post('province'),
                    'country' => $this->input->post('country'),
                    'dt_birth' => $this->input->post('dt_birth'),
                    'landline' => $this->input->post('landline'),
                    'mobile' => $this->input->post('mobile'),
                    'email' => $this->input->post('email'),    
                    'user_id' => user('id')
                ]
            ];

            try {
                // POST request
                $response = $client->post('confraternity/create', $options);  
    
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
                'name' => form_error('name'),
                'address_1' => form_error('address_1'),
                'address_2' => form_error('address_2'),
                'barangay' => form_error('barangay'),
                'city' => form_error('city'),
                'province' => form_error('province'),
                'country' => form_error('country'),
                'dt_birth' => form_error('dt_birth'),
                'landline' => form_error('landline'),
                'mobile' => form_error('mobile'),
                'email' => form_error('email')
            ];
            echo json_encode($view_data);
            //echo $this->form_validation->get_json();
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
            'status' => $this->input->put('status'),
            'name' => $this->input->put('name'),
            'address_1' => $this->input->put('address_1'),
            'address_2' => $this->input->put('address_2'),
            'barangay' => $this->input->put('barangay'),
            'city' => $this->input->put('city'),
            'province' => $this->input->put('province'),
            'country' => $this->input->put('country'),
            'dt_birth' => $this->input->put('dt_birth'),
            'landline' => $this->input->put('landline'),
            'mobile' => $this->input->put('mobile'),
            'email' => $this->input->put('email')

        );

        $this->form_validation
            ->set_data($set_data)
            ->set_rules('status', 'status', 'trim|required|xss_clean')
            ->set_rules('name', 'name', 'trim|required|xss_clean')
            ->set_rules('address_1', 'address_1', 'trim|required|xss_clean')  
            ->set_rules('address_2', 'address_2', 'trim|required|xss_clean')   
            ->set_rules('barangay', 'barangay', 'trim|required|xss_clean')   
            ->set_rules('city', 'city', 'trim|required|xss_clean')   
            ->set_rules('province', 'province', 'trim|required|xss_clean')   
            ->set_rules('country', 'country', 'trim|required|xss_clean')   
            ->set_rules('dt_birth', 'dt_birth', 'trim|required|xss_clean') 
            ->set_rules('landline', 'landline', 'trim|required|xss_clean') 
            ->set_rules('mobile', 'mobile', 'trim|required|xss_clean') 
            ->set_rules('email', 'email', 'trim|required|xss_clean')
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
                    'status' => $this->input->put('status'),
                    'name' => $this->input->put('name'),
                    'address_1' => $this->input->put('address_1'),
                    'address_2' => $this->input->put('address_2'),
                    'barangay' => $this->input->put('barangay'),
                    'city' => $this->input->put('city'),
                    'province' => $this->input->put('province'),
                    'country' => $this->input->put('country'),
                    'dt_birth' => $this->input->put('dt_birth'),
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
                $response = $client->put('confraternity/update/id/' . $id, $options);

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
                'status' => form_error('status'),
                'name' => form_error('name'),
                'address_1' => form_error('address_1'),
                'address_2' => form_error('address_2'),
                'barangay' => form_error('barangay'),
                'city' => form_error('city'),
                'province' => form_error('province'),
                'country' => form_error('country'),
                'dt_birth' => form_error('dt_birth'),
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
            $response = $client->put('confraternity/soft_delete/id/' . $id, $options);

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