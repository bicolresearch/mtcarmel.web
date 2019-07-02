<?php

/*
    Filename    : Home.php
    Location    : application/controllers/Home.php
    Purpose     : Home Controller
    Created     : 6/03/2019 by Spiderman
    Updated     : 7/02/2019 by Spiderman
    Changes     : Add sample implementation of guzzle
                : Added try and catch to properly trap the exception
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    private $api_url = '';
    private $api_key = '';
    private $user_id = '';

    public function __construct()
    {
        parent::__construct();
        $this->api_url = 'https://api.mountcarmel.ph';
        $this->api_key = '365-Days';
        $this->user_id = user('id');
    }

    public function index()
    {
        $view_data = [
            'page_title' => 'Homepage'
        ];
    
        $this->twig->display('home/index.html', $view_data);
    }

    public function news()
    {
        $view_data = [
            'page_title' => 'News & Updates'
        ];

        $this->twig->display('home/news.html', $view_data);
    }

    public function calendar()
    {
        $view_data = [
            'page_title' => 'Calendar'
        ];

        $this->twig->display('home/calendar.html', $view_data);
    }

    public function live_mass()
    {
        $view_data = [
            'page_title' => 'Live Mass'
        ];

        $this->twig->display('home/live-mass.html', $view_data);
    }

    // Sample implementation of GET request using Guzzle
    public function posts() {

        // Create a client with a base URI
        $client = new GuzzleHttp\Client(['base_uri' => $this->api_url]);

        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'X-API-KEY' => $this->api_key
            ]
        ];

        try {
            // GET request
            $response = $client->request('GET', '/posts', $options);

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