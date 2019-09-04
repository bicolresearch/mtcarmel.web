<?php

/*
    Filename    : Ads.php
    Location    : application/controllers/admin/Ads.php
    Purpose     : Ads controller
    Created     : 07/11/2019 17:03:40 by Spiderman
    Updated     : 08/15/2019 19:22:16 by Spiderman
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Ads extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if(logged_in()) {
            $view_data = [
                'page_title' => 'Advertisements',
                'page_subtitle' => '',
                'user' => user()
            ];
    
            $this->twig->display('admin/ads.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }
    
    // GET request
    public function ads() 
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
            $response = $client->get('ads', $options);

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
    public function ad()
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
            $response = $client->get('ads/ad', $options);

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
            ->set_rules('media_id', 'Logo', 'trim|required|xss_clean')
            ->set_rules('type_id', 'Ad Type', 'trim|required|xss_clean')
            ->set_rules('url', 'URL', 'trim|xss_clean')
            ->set_rules('expiration', 'Expiration', 'trim|xss_clean')
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
                    'media_id' => $this->input->post('media_id'),
                    'type_id' => $this->input->post('type_id'),
                    'url' => $this->input->post('url'),
                    'expiration' => $this->input->post('expiration'),
                    'user_id' => user('id')
                ]
            ];

            try {
                // POST request
                $response = $client->post('ads/create', $options);
    
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
                'type_id' => form_error('type_id'),
                'url' => form_error('url'),
                'expiration' => form_error('expiration')
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
            'media_id' => $this->input->put('media_id'),
            'type_id' => $this->input->put('type_id'),
            'url' => $this->input->put('url'),
            'expiration' => $this->input->put('expiration')
        );

        $this->form_validation
            ->set_data($set_data)
            ->set_rules('name', 'Name', 'trim|required|xss_clean')
            ->set_rules('description', 'Description', 'trim|required|xss_clean')
            ->set_rules('media_id', 'Logo', 'trim|required|xss_clean')
            ->set_rules('type_id', 'Ad Type', 'trim|required|xss_clean')
            ->set_rules('url', 'URL', 'trim|xss_clean')
            ->set_rules('expiration', 'Expiration', 'trim|xss_clean')
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
                    'name' => $this->input->put('name'),
                    'description' => $this->input->put('description'),
                    'media_id' => $this->input->put('media_id'),
                    'type_id' => $this->input->put('type_id'),
                    'url' => $this->input->put('url'),
                    'expiration' => $this->input->put('expiration'),
                    'user_id' => user('id')
                ]
            ];

            try {
                // Get the id parameter
                $id = $this->uri->segment(5);

                // PUT request
                $response = $client->put('ads/update/id/' . $id, $options);

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
                'type_id' => form_error('type_id'),
                'url' => form_error('url'),
                'expiration' => form_error('expiration')
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
            $response = $client->put('ads/soft_delete/id/' . $id, $options);

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