<?php

/*
    Filename    : Management.php
    Location    : application/controller/admin/Management.php
    Purpose     : Management controller
    Created     : 6/27/2019 by Spiderman
    Updated     : 7/03/2019 by Spiderman
    Changes     : Renamed from Admin to Management
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Management extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(FALSE);
    }

    public function index()
    {
        if(logged_in()) {
            $view_data = [
                'page_title' => 'Management'
            ];
    
            $this->twig->display('admin/index.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }
}