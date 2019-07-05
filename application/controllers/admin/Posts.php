<?php

/*
    Filename    : Posts.php
    Location    : application/controllers/admin/Posts.php
    Purpose     : Posts controller
    Created     : 07/03/2019 15:09:39 by Spiderman
    Updated     : 07/05/2019 16:00:33 by Spiderman
    Changes     : Class renamed to Posts
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Posts extends CI_Controller
{
    private $user_id;
    private $query;

    public function __construct()
    {
        parent::__construct();
        $this->user_id = user('id');
        $this->query = $this->uri->segment(5);
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
    
    public function posts() 
    {
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'X-API-KEY' => $this->guzzle->key()
            ]
        ];

        try {
            // GET request
            $response = $this->guzzle->client()->request('GET', 'posts', $options);

            $response = json_decode($response->getBody()->getContents());

            // Return $response
            echo json_encode($response, true);

        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();

            // Return $response 
            echo $response->getBody()->getContents();
        }
    }

    public function post() 
    {
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'X-API-KEY' => $this->guzzle->key()
            ],
            'query' => [
                'id' => $this->query
            ]
        ];

        try {
            // GET request
            $response = $this->guzzle->client()->request('GET', 'posts/post', $options);

            $response = json_decode($response->getBody()->getContents());

            // Return $response
            echo json_encode($response, true);

        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();

            // Return $response 
            echo $response->getBody()->getContents();
        }
    }

    // Sample implementation of POST request using Guzzle
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
                'branch_id' => $this->input->post('branch_id'),
                'title' => $this->input->post('title'),
                'content' => $this->input->post('content'),
                'media_id' => $this->input->post('media_id'),
                'user_id' => $this->user_id
            ]
        ];

        try {
            // POST request
            $response = $this->guzzle->client()->request('POST', 'posts/create', $options);  
            
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