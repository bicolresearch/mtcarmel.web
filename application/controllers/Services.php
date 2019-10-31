<?php

/*
    Filename    : Services.php
    Location    : application/controller/Services.php
    Purpose     : Services Controller
    Created     : 06/24/2019 18:52:23 by Spiderman
    Updated     : 10/25/2019 18:52:33 by Spiderman
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Services extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function join_us()
    {
        $view_data = [
            'page_title' => 'Join Us!',
            'page_subtitle' => ''
        ];

        $this->twig->display('services/join-us.html', $view_data);
    }

    public function request()
    {
        $view_data = [
            'page_title' => 'Make a request',
            'page_subtitle' => ''
        ];

        $this->twig->display('services/request.html', $view_data);
    }

    public function baptism()
    {
        $view_data = [
            'page_title' => 'Baptism',
            'page_subtitle' => ''
        ];

        $this->twig->display('services/baptism.html', $view_data);
    }

    public function communion()
    {
        $view_data = [
            'page_title' => 'Communion',
            'page_subtitle' => ''
        ];

        $this->twig->display('services/communion.html', $view_data);
    }

    public function confirmation()
    {
        $view_data = [
            'page_title' => 'Confirmation',
            'page_subtitle' => ''
        ];

        $this->twig->display('services/confirmation.html', $view_data);
    }

    public function marriage()
    {
        $view_data = [
            'page_title' => 'Marriage',
            'page_subtitle' => ''
        ];

        $this->twig->display('services/marriage.html', $view_data);
    }

    public function passing()
    {
        $view_data = [
            'page_title' => 'Passing',
            'page_subtitle' => ''
        ];

        $this->twig->display('services/passing.html', $view_data);
    }

    public function events()
    {
        $view_data = [
            'page_title' => 'Events',
            'page_subtitle' => ''
        ];

        $this->twig->display('services/events.html', $view_data);
    }
}