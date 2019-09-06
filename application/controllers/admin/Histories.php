<?php

/*
    Filename    : Histories.php
    Location    : application/controllers/admin/Histories.php
    Purpose     : Histories controller
    Created     : 07/22/2019 23:35:25 by Scarlet Witch 
    Updated     : 09/07/2019 01:21:31 by Spiderman
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Histories extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if(logged_in()) {
            $view_data = [
                'page_title' => 'Histories',
                'page_subtitle' => '',
                'user' => user()
            ];
    
            $this->twig->display('admin/histories.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }
    
    // GET request
    public function histories() 
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
            $response = $client->get('histories', $options);

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
    public function history() 
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
            $response = $client->get('histories/history', $options);

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
            ->set_rules('titular', 'Titular', 'trim|required|xss_clean')
            ->set_rules('diocese', 'Diocese', 'trim|required|xss_clean')
            ->set_rules('date_of_establishment', 'Date of Establishment', 'trim|required|xss_clean')
            ->set_rules('feast_day', 'Feast Day', 'trim|required|xss_clean')
            ->set_rules('content', 'Content', 'trim|required|xss_clean')
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
                    'titular' => $this->input->post('titular'),
                    'diocese' => $this->input->post('diocese'),
                    'date_of_establishment' => $this->input->post('date_of_establishment'),   
                    'feast_day' => $this->input->post('feast_day'),   
                    'content' => $this->input->post('content'),                     
                    'user_id' => user('id')
                ]
            ];

            try {
                // POST request
                $response = $client->post('histories/create', $options);  
    
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
                'titular' => form_error('titular'),
                'diocese' => form_error('diocese'),
                'date_of_establishment' => form_error('date_of_establishment'),
                'feast_day' => form_error('feast_day'),
                'content' => form_error('content')
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
            'titular' => $this->input->put('titular'),
            'diocese' => $this->input->put('diocese'),
            'date_of_establishment' => $this->input->put('date_of_establishment'),
            'feast_day' => $this->input->put('feast_day'),
            'content' => $this->input->put('content')
        );

        $this->form_validation
            ->set_data($set_data)
            ->set_rules('titular', 'Titular', 'trim|required|xss_clean')
            ->set_rules('diocese', 'Diocese', 'trim|required|xss_clean')
            ->set_rules('date_of_establishment', 'Date of Establishment', 'trim|required|xss_clean')
            ->set_rules('feast_day', 'Feast Day', 'trim|required|xss_clean')
            ->set_rules('content', 'Content', 'trim|required|xss_clean')
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
                    'titular' => $this->input->put('titular'),
                    'diocese' => $this->input->put('diocese'),
                    'date_of_establishment' => $this->input->put('date_of_establishment'),
                    'feast_day' => $this->input->put('feast_day'),
                    'content' => $this->input->put('content'),
                    'user_id' => user('id')
                ]
            ];

            try {
                $id = $this->uri->segment(5);

                // PUT request
                $response = $client->put('histories/update/id/' . $id, $options);

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
                'titular' => form_error('titular'),
                'diocese' => form_error('diocese'),
                'date_of_establishment' => form_error('date_of_establishment'),
                'feast_day' => form_error('feast_day'),
                'content' => form_error('content')
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
            $response = $client->put('histories/soft_delete/id/' . $id, $options);

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