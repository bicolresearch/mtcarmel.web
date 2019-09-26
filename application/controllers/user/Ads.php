<?php

/*
    Filename    : Ads.php
    Location    : application/controllers/user/Ads.php
    Purpose     : Ads Controller
    Created     : 09/24/2019 14:16:45 by Spiderman
    Updated     : 09/26/2019 13:52:40 by Spiderman
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Ads extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if(logged_in()) {
            $view_data = [
                'page_title' => 'Ads',
                'user' => user()
            ];
        
            $this->twig->display('user/ads/index.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }

    public function place_ad()
    {
        if(logged_in()) {
            $view_data = [
                'page_title' => 'Place an Ad',
                'user' => user()
            ];
    
            $this->twig->display('user/ads/place_ad.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }

    public function ad_status()
    {
        if(logged_in()) {
            $view_data = [
                'page_title' => 'Ad Status',
                'user' => user()
            ];
    
            $this->twig->display('user/ads/ad_status.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }
}