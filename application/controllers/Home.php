<?php

/*
    Filename    : Home.php
    Location    : application/controllers/Home.php
    Purpose     : Home Controller
    Created     : 6/03/2019 by Spiderman
    Updated     : 7/02/2019 by Spiderman
    Changes     : Add sample implementation of guzzle
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(FALSE);
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
        $client = new GuzzleHttp\Client(['base_uri' => 'https://api.mountcarmel.ph']);

        $options = [
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ];

        // GET request with headers
        $response = $client->request('GET', '/posts', $options);

        // Return $response
        echo $response->getBody();
    }

    // Sample implementation of POST request using Guzzle
    public function create() {

        // Create a client with a base URI
        $client = new GuzzleHttp\Client(['base_uri' => 'https://api.mountcarmel.ph']);

        $options = [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded'
            ],
            'form_params' => [
                'branch_id' => 1,
                'title' => 'Sample create post with guzzle',
                'content' => 'Sample create post with guzzle',
                'media_id' => 1,
                'user_id' => 1
            ]
        ];

        $response = $client->request('POST', 'posts/create', $options);

        // Return $response
        echo $response->getBody();
    }
}