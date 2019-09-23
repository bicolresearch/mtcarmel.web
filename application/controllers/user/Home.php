<?php

/*
    Filename    : Home.php
    Location    : application/controllers/user/Home.php
    Purpose     : Home Controller
    Created     : 09/23/2019 17:07:32 by Spiderman
    Updated     : 
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $view_data = [
            'page_title' => 'Homepage',
            'user' => user()
        ];
    
        $this->twig->display('user/home/index.html', $view_data);
    }

    public function news()
    {
        $view_data = [
            'page_title' => 'News & Updates',
            'user' => user()
        ];

        $this->twig->display('user/home/news.html', $view_data);
    }

    public function calendar()
    {
        $view_data = [
            'page_title' => 'Calendar',
            'user' => user()
        ];

        $this->twig->display('user/home/calendar.html', $view_data);
    }

    public function live_mass()
    {
        $view_data = [
            'page_title' => 'Live Mass',
            'user' => user()
        ];

        $this->twig->display('user/home/live-mass.html', $view_data);
    }
}