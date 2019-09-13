
<?php

/*
    Filename    : App_permissions.php
    Location    : application/controller/App_permissions.php
    Purpose     : App Permissions Controller
    Created     : 09/13/2019 14:08:19 by Spiderman
    Updated     : 
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class App_permissions extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(FALSE);
    }

    public function index()
    {
        $view_data = [
            'page_title' => 'App Permissions'
        ];

        $this->twig->display('app/index.html', $view_data);
    }
}