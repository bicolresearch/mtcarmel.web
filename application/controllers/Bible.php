
<?php

/*
    Filename    : Bible.php
    Location    : application/controller/Bible.php
    Purpose     : Bible Controller
    Created     : 06/24/2019 18:54:25 by Spiderman
    Updated     : 10/25/2019 18:54:28 by Spiderman
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Bible extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $view_data = [
            'page_title' => 'Holy Bible',
            'page_subtitle' => 'Revised Standard Version (RSV)'
        ];

        $this->twig->display('bible/index.html', $view_data);
    }
}