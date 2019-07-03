<?php

/*
    Filename    : News.php
    Location    : application/controller/admin/News.php
    Purpose     : News controller
    Created     : 7/03/2019 by Spiderman
    Updated     : 
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class News extends CI_Controller
{

    private $api_url = '';
    private $api_key = '';
    private $user_id = '';

    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(FALSE);
        $this->api_url = 'http://localhost/mountcarmel.api/';
        $this->api_key = '365-Days';
        $this->user_id = user('id');
    }

    public function index()
    {
        if(logged_in()) {
            $view_data = [
                'page_title' => 'News & Updates'
            ];
    
            $this->twig->display('admin/news.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }
    
    // Sample implementation of GET request using Guzzle
    public function posts() {

        // Create a client with a base URI
        $client = new GuzzleHttp\Client(['base_uri' => $this->api_url]);

        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'X-API-KEY' => $this->api_key
            ]
        ];

        try {
            // GET request
            $response = $client->request('GET', 'posts', $options);

            // Return $response
            echo $response->getBody()->getContents();

        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();

            // Return $response 
            echo $response->getBody()->getContents();
        }
    }

    // Sample implementation of POST request using Guzzle
    public function create() {

        // Create a client with a base URI
        $client = new GuzzleHttp\Client(['base_uri' => $this->api_url]);

        $options = [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'X-API-KEY' => $this->api_key
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
            $response = $client->request('POST', '/posts/create', $options);  
            
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