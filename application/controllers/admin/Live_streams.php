<?php

/*
    Filename    : Live_streams.php
    Location    : application/controllers/admin/Live_streams.php
    Purpose     : Live streaming controller
    Created     : 08/20/2019 19:03:46 by Spiderman
    Updated     : 
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Live_streams extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if(logged_in()) {
            $view_data = [
                'page_title' => 'Live Streams',
                'page_subtitle' => '',
                'user' => user()
            ];
    
            $this->twig->display('admin/live-streams.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }
    
    // GET request
    public function live_streams() 
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
            $response = $client->get('live_streams', $options);

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
    public function live_stream()
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
            $response = $client->get('live_streams/live_stream', $options);

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
            ->set_rules('title', 'Title', 'trim|required|xss_clean')
            ->set_rules('description', 'Description', 'trim|required|xss_clean')
            ->set_rules('video_id', 'Video Id', 'trim|required|xss_clean')
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
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'video_id' => $this->input->post('video_id'),
                    'user_id' => user('id')
                ]
            ];

            try {
                // POST request
                $response = $client->post('live_streams/create', $options);
    
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
                'title' => form_error('title'),
                'description' => form_error('description'),
                'video_id' => form_error('video_id')
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
            'title' => $this->input->put('title'),
            'description' => $this->input->put('description'),
            'video_id' => $this->input->put('video_id')
        );

        $this->form_validation
            ->set_data($set_data)
            ->set_rules('title', 'Title', 'trim|required|xss_clean')
            ->set_rules('description', 'Description', 'trim|required|xss_clean')
            ->set_rules('video_id', 'Video Id', 'trim|required|xss_clean')
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
                    'title' => $this->input->put('title'),
                    'description' => $this->input->put('description'),
                    'video_id' => $this->input->put('video_id'),
                    'user_id' => user('id')
                ]
            ];

            try {
                // Get the id parameter
                $id = $this->uri->segment(5);

                // PUT request
                $response = $client->put('live_streams/update/id/' . $id, $options);

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
                'title' => form_error('title'),
                'description' => form_error('description'),
                'video_id' => form_error('video_id')
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
            $response = $client->put('live_streams/soft_delete/id/' . $id, $options);

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