<?php

/*
    Filename    : Ads.php
    Location    : application/controllers/user/Ads.php
    Purpose     : Ads Controller
    Created     : 09/24/2019 14:16:45 by Spiderman
    Updated     : 
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
        $view_data = [
            'page_title' => 'Ads',
            'user' => user()
        ];
    
        $this->twig->display('user/ads/index.html', $view_data);
    }

    public function place_ad()
    {
        $view_data = [
            'page_title' => 'Place an Ad',
            'user' => user()
        ];

        $this->twig->display('user/ads/place_ad.html', $view_data);
    }

    public function ad_status()
    {
        $view_data = [
            'page_title' => 'Ad Status',
            'user' => user()
        ];

        $this->twig->display('user/ads/ad_status.html', $view_data);
    }
}