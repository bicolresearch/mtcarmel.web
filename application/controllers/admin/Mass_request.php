<?php

/*
    Filename    : Mass_request.php
    Location    : application/controllers/admin/Mass_request.php
    Purpose     : Mass request controller
    Created     : 08/01/2019 19:16:42 by Scarlet Witch
    Updated     : 
    Changes     : 
*/


defined('BASEPATH') or exit('No direct script access allowed');

class Mass_request extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if(logged_in()) {
            $view_data = [
                'page_title' => 'Mass request',
                'page_subtitle' => 'list of mass request',
                'user' => user()
            ];
    
            $this->twig->display('admin/mass_request.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }
    
    // GET request
    public function mass_request() 
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
            $response = $client->get('mass_request', $options);

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
            $response = $client->get('mass_request/medium', $options);

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
            ->set_rules('purpose_mass', 'purpose_mass', 'trim|required|xss_clean')  
            ->set_rules('dt_offered', 'dt_offered', 'trim|required|xss_clean')   
            ->set_rules('time_offered', 'time_offered', 'trim|required|xss_clean') 
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
                    'purpose_mass' => $this->input->post('purpose_mass'),
                    'dt_offered' => $this->input->post('dt_offered'),
                    'time_offered' => $this->input->post('time_offered'), 
                    'user_id' => user('id')
                ]
            ];

            try {
                // POST request
                $response = $client->post('mass_request/create', $options);  
    
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
                'purpose_mass' => form_error('purpose_mass'),
                'dt_offered' => form_error('dt_offered'),
                'time_offered' => form_error('time_offered')
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
            'purpose_mass' => $this->input->put('purpose_mass'),
            'dt_offered' => $this->input->put('dt_offered'),
            'time_offered' => $this->input->put('time_offered')
        );

        $this->form_validation
            ->set_data($set_data)
            ->set_rules('status', 'status', 'trim|required|xss_clean')
            ->set_rules('name', 'name', 'trim|required|xss_clean')
            ->set_rules('purpose_mass', 'purpose_mass', 'trim|required|xss_clean')  
            ->set_rules('dt_offered', 'dt_offered', 'trim|required|xss_clean')   
            ->set_rules('time_offered', 'time_offered', 'trim|required|xss_clean')   
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
                    'status' => $this->input->put('status'),
                    'name' => $this->input->put('name'),
                    'purpose_mass' => $this->input->put('purpose_mass'),
                    'dt_offered' => $this->input->put('dt_offered'),
                    'time_offered' => $this->input->put('time_offered'),
                    'user_id' => user('id')
                ]
            ];

            try {
                // Get the id parameter
                $id = $this->uri->segment(5);

                // PUT request
                $response = $client->put('mass_request/update/id/' . $id, $options);

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
                'purpose_mass' => form_error('purpose_mass'),
                'dt_offered' => form_error('dt_offered'),
                'time_offered' => form_error('time_offered')
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
            $response = $client->put('mass_request/soft_delete/id/' . $id, $options);

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