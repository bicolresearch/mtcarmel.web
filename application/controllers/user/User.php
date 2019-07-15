<?php

/*
    Filename    : User.php
    Location    : application/controllers/user/User.php
    Purpose     : User Controller
    Created     : 06/27/2019 17:27:57 by Spiderman
    Updated     : 
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
                'avatar' => user('cover_photo')
            ];
    
            $this->twig->display('user/index.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }
}