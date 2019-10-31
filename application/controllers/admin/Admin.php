<?php

/*
    Filename    : Admin.php
    Location    : application/controllers/admin/Admin.php
    Purpose     : Admin controller
    Created     : 06/27/2019 15:11:03 by Spiderman
    Updated     : 10/25/2019 18:40:16 by Spiderman
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if(logged_in()) {
            $view_data = [
                'page_title' => 'Admin',
                'page_subtitle' => '',
                'user' => user()
            ];
    
            $this->twig->display('admin/index.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }
}