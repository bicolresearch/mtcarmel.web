<?php

/*
    Filename    : Transparency.php
    Location    : application/controller/Transparency.php
    Purpose     : Transparency Controller
    Created     : 6/24/2019 by Sherlock Holmes
    Updated     : 6/27/2019 by Sherlock Holmes
    Changes     : Changed commenting format
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Transparency extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(FALSE);
    }

    public function index()
    {
        $view_data = [
            'page_title' => 'Transparency'
        ];

        $this->twig->display('transparency/index.html', $view_data);
    }

}