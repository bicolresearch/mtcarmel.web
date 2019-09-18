<?php

/*
    Filename    : User.php
    Location    : application/controllers/user/User.php
    Purpose     : User Controller
    Created     : 06/27/2019 17:27:57 by Spiderman
    Updated     : 09/17/2019 20:27:14 by Spiderman
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if(logged_in()) {
            $view_data = [
                'page_title' => 'User',
                'user' => user()
            ];

            $this->twig->display('user/index.html', $view_data);
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
                'branch_id' => $_GET['branch_id'],
                'id' => $_GET['id']
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