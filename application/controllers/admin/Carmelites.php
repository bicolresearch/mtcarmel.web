<?php

/*
    Filename    : Carmelites.php
    Location    : application/controllers/admin/Carmelites.php
    Purpose     : Carmelites controller
    Created     : 07/23/2019 13:03:17 by Scarlet Witch
    Updated     : 09/06/2019 20:49:46 by Spiderman
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Carmelites extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if(logged_in()) {
            $view_data = [
                'page_title' => 'Carmelites',
                'page_subtitle' => '',
                'user' => user()
            ];
    
            $this->twig->display('admin/carmelites.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }
    
    // GET request
    public function carmelites() 
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
            $response = $client->get('carmelites', $options);

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
    public function carmelite() 
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
            $response = $client->get('carmelites/carmelite', $options);

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
            ->set_rules('position', 'Position', 'trim|xss_clean')
            ->set_rules('congregation', 'Congregation', 'trim|xss_clean')
            ->set_rules('sequence', 'Sequence', 'trim|required|xss_clean')
            ->set_rules('type_id', 'Clergy Type', 'trim|required|xss_clean')
            ->set_rules('media_id', 'Image', 'trim|required|xss_clean')
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
                    'position' => $this->input->post('position'),
                    'congregation' => $this->input->post('Congregation'),
                    'sequence' => $this->input->post('sequence'),      
                    'type_id' => $this->input->post('clergy_type_id'),           
                    'media_id' => $this->input->post('media_id'),    
                    'user_id' => user('id')
                ]
            ];

            try {
                // POST request
                $response = $client->post('carmelites/create', $options);  
    
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
                'position' => form_error('position'),
                'congregation' => form_error('congregation'),
                'sequence' => form_error('sequence'),
                'type_id' => form_error('type_id')
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
            'position' => $this->input->put('position'),
            'congregation' => $this->input->put('congregation'),
            'sequence' => $this->input->put('sequence'),
            'type_id' => $this->input->put('clergy_type_id'),
            'media_id' => $this->input->put('media_id')
        );

        $this->form_validation
            ->set_data($set_data)
            ->set_rules('name', 'Name', 'trim|required|xss_clean')
            ->set_rules('position', 'Position', 'trim|xss_clean')
            ->set_rules('congregation', 'Congregation', 'trim|xss_clean')
            ->set_rules('sequence', 'Sequence', 'trim|required|xss_clean')
            ->set_rules('type_id', 'Clergy Type', 'trim|required|xss_clean')
            ->set_rules('media_id', 'Image', 'trim|required|xss_clean')
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
                    'position' => $this->input->put('position'),
                    'congregation' => $this->input->put('congregation'),
                    'sequence' => $this->input->put('sequence'),
                    'type_id' => $this->input->put('clergy_type_id'),
                    'media_id' => $this->input->put('media_id'),
                    'user_id' => user('id')
                ]
            ];

            try {
                $id = $this->uri->segment(5);

                // PUT request
                $response = $client->put('carmelites/update/id/' . $id, $options);

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
                'position' => form_error('position'),
                'congregation' => form_error('congregation'),
                'sequence' => form_error('sequence'),
                'type_id' => form_error('type_id')
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
            $response = $client->put('carmelites/soft_delete/id/' . $id, $options);

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