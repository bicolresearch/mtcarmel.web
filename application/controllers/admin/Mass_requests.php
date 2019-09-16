<?php

/*
    Filename    : Mass_requests.php
    Location    : application/controllers/admin/Mass_requests.php
    Purpose     : Mass requests controller
    Created     : 08/01/2019 19:16:42 by Scarlet Witch
    Updated     : 09/16/2019 22:35:51 by Spiderman
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Mass_requests extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if(logged_in()) {
            $view_data = [
                'page_title' => 'Mass Requests',
                'page_subtitle' => '',
                'user' => user()
            ];
    
            $this->twig->display('admin/mass_requests.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }
    
    // GET request
    public function mass_requests() 
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
            $response = $client->get('mass_requests', $options);

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
            ],
            'query' => [
                'branch_id' => $_GET['branch_id'],
                'id' => $_GET['id']
            ]
        ];

        try {
            // GET request
            $response = $client->get('mass_requests/mass_request', $options);

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
            ->set_rules('purpose_id', 'Purpose', 'trim|required|xss_clean')  
            ->set_rules('dt_offered', 'Date Offered', 'trim|required|xss_clean')   
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
                    'module_id' => 5,
                    'sub_module_id' => 3,
                    'status_id' => $this->input->post('status_id'),
                    'name' => $this->input->post('name'),
                    'purpose_id' => $this->input->post('purpose_id'),
                    'dt_offered' => $this->input->post('dt_offered'),
                    'user_id' => user('id')
                ]
            ];

            try {
                // POST request
                $response = $client->post('mass_requests/create', $options);  
    
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
                'purpose_id' => form_error('purpose_id'),
                'dt_offered' => form_error('dt_offered')
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
            'purpose_id' => $this->input->put('purpose_id'),
            'dt_offered' => $this->input->put('dt_offered')
        );

        $this->form_validation
            ->set_data($set_data)
            ->set_rules('status_id', 'Status', 'trim|required|xss_clean')
            ->set_rules('name', 'Name', 'trim|required|xss_clean')   
            ->set_rules('purpose_id', 'Purpose', 'trim|required|xss_clean')  
            ->set_rules('dt_offered', 'Date Offered', 'trim|required|xss_clean')   
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
                    'purpose_id' => $this->input->put('purpose_id'),
                    'dt_offered' => $this->input->put('dt_offered'),
                    'time_offered' => $this->input->put('time_offered'),
                    'user_id' => user('id')
                ]
            ];

            try {
                // Get the id parameter
                $id = $this->uri->segment(5);

                // PUT request
                $response = $client->put('mass_requests/update/id/' . $id, $options);

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
                'purpose_id' => form_error('purpose_id'),
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
            $response = $client->put('mass_requests/soft_delete/id/' . $id, $options);

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