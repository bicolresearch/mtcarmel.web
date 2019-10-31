<?php

/*
    Filename    : Basilica.php
    Location    : application/controller/Basilica.php
    Purpose     : Basilica Controller
    Created     : 06/24/2019 00:39:31 by Spiderman
    Updated     : 10/31/2019 14:30:52 by Spiderman
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Basilica extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function mass_schedule()
    {
        $view_data = [
            'page_title' => 'Mass Schedule',
            'page_subtitle' => ''
        ];

        $this->twig->display('basilica/mass-schedule.html', $view_data);
    }

    public function location_map()
    {
        $view_data = [
            'page_title' => 'Location Map',
            'page_subtitle' => 'Boundaries'
        ];

        $this->twig->display('basilica/location-map.html', $view_data);
    }

    public function carmelites()
    {
        $view_data = [
            'page_title' => 'Carmelites',
            'page_subtitle' => ''
        ];

        $this->twig->display('basilica/carmelites.html', $view_data);
    }

    public function contact()
    {
        $view_data = [
            'page_title' => 'Contact Us',
            'page_subtitle' => ''
        ];

        $this->twig->display('basilica/contact.html', $view_data);
    }

    public function history()
    {
        $view_data = [
            'page_title' => 'History',
            'page_subtitle' => 'Details'
        ];

        $this->twig->display('basilica/history.html', $view_data);
    }
}