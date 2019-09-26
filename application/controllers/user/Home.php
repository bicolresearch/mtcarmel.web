<?php

/*
    Filename    : Home.php
    Location    : application/controllers/user/Home.php
    Purpose     : Home Controller
    Created     : 09/23/2019 17:07:32 by Spiderman
    Updated     : 09/26/2019 13:51:02 by Spiderman
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
        if(logged_in()) {
            $view_data = [
                'page_title' => 'Homepage',
                'user' => user()
            ];
        
            $this->twig->display('user/home/index.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }

    public function news()
    {
        if(logged_in()) {
            $view_data = [
                'page_title' => 'News & Updates',
                'user' => user()
            ];
    
            $this->twig->display('user/home/news.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }

    public function calendar()
    {
        if(logged_in()) {
            $view_data = [
                'page_title' => 'Calendar',
                'user' => user()
            ];
    
            $this->twig->display('user/home/calendar.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }

    public function live_mass()
    {
        if(logged_in()) {
            $view_data = [
                'page_title' => 'Live Mass',
                'user' => user()
            ];
    
            $this->twig->display('user/home/live-mass.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }
}