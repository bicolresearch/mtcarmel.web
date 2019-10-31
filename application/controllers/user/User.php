<?php

/*
    Filename    : User.php
    Location    : application/controllers/admin/User.php
    Purpose     : User controller
    Created     : 09/23/2019 21:57:47 by Spiderman
    Updated     : 10/25/2019 18:48:53 by Spiderman
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if(logged_in()) {
            $view_data = [
                'page_title' => 'User',
                'page_subtitle' => '',
                'user' => user()
            ];
    
            $this->twig->display('user/index.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }
}