
<?php

/*
    Filename    : Bible.php
    Location    : application/controller/Bible.php
    Purpose     : Bible Controller
    Created     : 6/24/2019 by Sherlock Holmes
    Updated     : 6/27/2019 by Sherlock Holmes
    Changes     : Changed commenting format
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Bible extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(FALSE);
    }

    public function index()
    {
        $view_data = [
            'page_title' => 'Bible'
        ];

        $this->twig->display('bible/index.html', $view_data);
    }

}