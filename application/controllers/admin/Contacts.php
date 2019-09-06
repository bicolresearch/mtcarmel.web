<?php

/*
    Filename    : Contacts.php
    Location    : application/controllers/admin/Contacts.php
    Purpose     : Contacts controller
    Created     : 07/23/2019 11:53:46 by Scarlet Witch
    Updated     : 09/06/2019 22:53:19 by Spiderman
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Contacts extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if(logged_in()) {
            $view_data = [
                'page_title' => 'Contacts',
                'page_subtitle' => '',
                'user' => user()
            ];
    
            $this->twig->display('admin/contacts.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }
    
    // GET request
    public function contacts() 
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
                'branch_id' => $_GET['branch_id']
            ]
        ];

        try {
            // GET request
            $response = $client->get('contacts', $options);

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
    public function contact() 
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
            $response = $client->get('contacts/contact', $options);

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
            ->set_rules('name', 'Name', 'trim|required|xss_clean')
            ->set_rules('description', 'Description', 'trim|required|xss_clean')            
            ->set_rules('address1', 'Address1', 'trim|required|xss_clean')          
            ->set_rules('address2', 'Address2', 'trim|required|xss_clean')          
            ->set_rules('city', 'City', 'trim|required|xss_clean')          
            ->set_rules('province', 'Province', 'trim|required|xss_clean')          
            ->set_rules('country', 'Country', 'trim|required|xss_clean')          
            ->set_rules('landline', 'Landline', 'trim|required|xss_clean')          
            ->set_rules('mobile', 'Mobile', 'trim|required|xss_clean')         
            ->set_rules('email', 'Email', 'trim|required|xss_clean')
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
                    'branch_id' => $this->config->item('branch_id'),
                    'name' => $this->input->post('name'),
                    'description' => $this->input->post('description'),
                    'address1' => $this->input->post('address1'),        
                    'address2' => $this->input->post('address2'),       
                    'city' => $this->input->post('city'),       
                    'province' => $this->input->post('province'),       
                    'country' => $this->input->post('country'),       
                    'landline' => $this->input->post('landline'),       
                    'mobile' => $this->input->post('mobile'),        
                    'email' => $this->input->post('email'),                    
                    'user_id' => user('id')                   
                ]
            ];

            try {
                // POST request
                $response = $client->post('contacts/create', $options);  
    
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
                'description' => form_error('description'),
                'address1' => form_error('address1'),
                'address2' => form_error('address2'),
                'city' => form_error('city'),
                'province' => form_error('province'),
                'country' => form_error('country'),
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
            'name' => $this->input->put('name'),
            'description' => $this->input->put('description'),
            'address1' => $this->input->put('address1'),
            'address2' => $this->input->put('address2'),
            'city' => $this->input->put('city'),
            'province' => $this->input->put('province'),
            'country' => $this->input->put('country'),
            'landline' => $this->input->put('landline'),
            'mobile' => $this->input->put('mobile'),
            'email' => $this->input->put('email')
        );

        $this->form_validation
            ->set_data($set_data)
            ->set_rules('name', 'Name', 'trim|required|xss_clean')
            ->set_rules('description', 'Description', 'trim|required|xss_clean')
            ->set_rules('address1', 'Address1', 'trim|required|xss_clean')
            ->set_rules('address2', 'Address2', 'trim|required|xss_clean')
            ->set_rules('city', 'City', 'trim|required|xss_clean')            
            ->set_rules('province', 'Province', 'trim|required|xss_clean')
            ->set_rules('country', 'Country', 'trim|required|xss_clean')
            ->set_rules('landline', 'Landline', 'trim|required|xss_clean')
            ->set_rules('mobile', 'Mobile', 'trim|required|xss_clean')
            ->set_rules('email', 'Email', 'trim|required|xss_clean')
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
                    'name' => $this->input->put('name'),
                    'description' => $this->input->put('description'),
                    'address1' => $this->input->put('address1'),
                    'address2' => $this->input->put('address2'),
                    'city' => $this->input->put('city'),
                    'province' => $this->input->put('province'),
                    'country' => $this->input->put('country'),
                    'landline' => $this->input->put('landline'),
                    'mobile' => $this->input->put('mobile'),
                    'email' => $this->input->put('email'),
                    'user_id' => user('id')
                ]
            ];

            try {
                $id = $this->uri->segment(5);

                // PUT request
                $response = $client->put('contacts/update/id/' . $id, $options);

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
                'description' => form_error('description'),
                'address1' => form_error('address1'),
                'address2' => form_error('address2'),
                'city' => form_error('city'),
                'province' => form_error('province'),
                'country' => form_error('country'),
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
            $id = $this->uri->segment(5);

            // PUT request
            $response = $client->put('contacts/soft_delete/id/' . $id, $options);

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