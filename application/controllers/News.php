<?php

/*
    Filename    : News.php
    Location    : application/controllers/News.php
    Purpose     : News Controller
    Created     : 09/04/2019 17:29:08 by Spiderman
    Updated     : 
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class News extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
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
}