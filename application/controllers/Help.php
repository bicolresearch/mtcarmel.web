<?php

/*
    Filename    : Help.php
    Location    : application/controller/Help.php
    Purpose     : Help Controller
    Created     : 06/24/2019 18:54:54 by Spiderman
    Updated     : 10/25/2019 18:54:49 by Spiderman
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Help extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $view_data = [
            'page_title' => 'Send Help',
            'page_subtitle' => ''
        ];

        $this->twig->display('help/index.html', $view_data);
    }
}