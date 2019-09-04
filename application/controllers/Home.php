<?php

/*
    Filename    : Home.php
    Location    : application/controllers/Home.php
    Purpose     : Home Controller
    Created     : 07/03/2019 17:14:23 by Spiderman
    Updated     : 09/04/2019 17:14:38 by Spiderman
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
}