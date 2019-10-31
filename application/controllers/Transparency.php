<?php

/*
    Filename    : Transparency.php
    Location    : application/controller/Transparency.php
    Purpose     : Transparency Controller
    Created     : 06/24/2019 18:53:50 by Spiderman
    Updated     : 10/25/2019 18:53:58 by Spiderman
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Transparency extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $view_data = [
            'page_title' => 'Transparency',
            'page_subtitle' => 'total help received online for this year'
        ];

        $this->twig->display('transparency/index.html', $view_data);
    }
}