<?php

/*
    Filename    : Posts.php
    Location    : application/controllers/admin/Posts.php
    Purpose     : Posts controller
    Created     : 07/03/2019 15:09:39 by Spiderman
    Updated     : 07/10/2019 19:09:10 by Spiderman
    Changes     : Implemented GET, POST, and PUT methods
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Posts extends CI_Controller
{
    private $user_id;

    public function __construct()
    {
        parent::__construct();
        $this->user_id = user('id');
    }

    public function index()
    {
        if(logged_in()) {
            $view_data = [
                'page_title' => 'Posts',
                'page_subtitle' => 'list of posts'
            ];
    
            $this->twig->display('admin/posts.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }
    
    // GET request
    public function posts() 
    {
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
            $response = $client->get('posts', $options);

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
    public function post() 
    {
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
            $response = $client->get('posts/post', $options);

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
        // Create a client with a base URI
        $client = $this->guzzle->client();

        $options = [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'X-API-KEY' => $this->guzzle->key()
            ],
            'form_params' => [
                'branch_id' => 1,
                'title' => $this->input->post('title'),
                'content' => $this->input->post('content'),
                'media_id' => 1,
                'user_id' => user('id')
            ],
            'debug' => fopen('php://stderr', 'w')
        ];

        try {
            // POST request
            $response = $client->post('posts/create', $options);  

            // Return $response  
            echo $response->getBody()->getContents();
        }
        catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();

            // Return $response 
            echo $response->getBody()->getContents();
        }
    }

    // PUT request
    public function update() 
    {
        // Create a client with a base URI
        $client = $this->guzzle->client();

        $options = [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'X-API-KEY' => $this->guzzle->key()
            ],
            'form_params' => [
                'branch_id' => 1,
                'title' => $this->input->put('title'),
                'content' => $this->input->put('content'),
                'media_id' => 1,
                'user_id' => user('id')
            ]
        ];
        
        try {

            $id = $this->uri->segment(5);

            // PUT request
            $response = $client->put('posts/update/id/' . $id, $options);

            // Return $response  
            echo $response->getBody()->getContents();
        }
        catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();

            // Return $response 
            echo $response->getBody()->getContents();
        }
    } 
    
    // PUT request
    public function delete() 
    {
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
            $response = $client->put('posts/soft_delete/id/' . $id, $options);

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