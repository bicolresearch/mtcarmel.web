<?php

/*
    Filename    : Admin.php
    Location    : application/controllers/admin/Admin.php
    Purpose     : Admin controller
    Created     : 06/27/2019 15:11:03 by Spiderman
    Updated     : 09/23/2019 21:54:25 by Spiderman
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
                'user' => user()
            ];
    
            $this->twig->display('admin/index.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }
}