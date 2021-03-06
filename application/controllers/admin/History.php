<?php

/*
    Filename    : History.php
    Location    : application/controllers/admin/History.php
    Purpose     : History controller
    Created     : 10/24/2019 17:42:48 by Spiderman
    Updated     : 10/25/2019 18:44:38 by Spiderman
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class History extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if(logged_in()) {
            $view_data = [
                'page_title' => 'History',
                'page_subtitle' => 'Carmel',
                'user' => user()
            ];
    
            $this->twig->display('admin/history.html', $view_data);
        } else {
            redirect('auth', 'refresh');
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
                'branch_id' => $_GET['branch_id']
            ]
        ];

        try {
            // GET request
            $response = $client->get('history', $options);

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
                $response = $client->put('history/update/id/' . $id, $options);

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
}