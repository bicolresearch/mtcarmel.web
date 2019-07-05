<?php

/*
    Filename    : Management.php
    Location    : application/controller/admin/Management.php
    Purpose     : Management controller
    Created     : 06/27/2019 15:11:03 by Spiderman
    Updated     : 07/05/2019 15:10:59 by Spiderman
    Changes     : Class renamed to Management
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