<?php

/*
    Filename    : Admin.php
    Location    : application/controllers/admin/Admin.php
    Purpose     : Admin controller
    Created     : 06/27/2019 15:11:03 by Spiderman
    Updated     : 07/17/2019 22:36:37 by Spiderman
    Changes     : Fix avatar
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if(logged_in()) {
            $view_data = [
                'page_title' => 'Admin',
                'user' => user()
            ];
    
            $this->twig->display('admin/index.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }

    // GET request
    public function profile() 
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
                'id' => $this->uri->segment(4)
            ]
        ];
    
        try {
            // GET request
            $response = $client->get('users/user', $options);
    
            $response = json_decode($response->getBody()->getContents());
    
            // Return $response
            echo json_encode($response, true);
    
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
    
            // Return $response 
            echo $response->getBody()->getContents();
        }
    }
}