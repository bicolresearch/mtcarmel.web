
<?php

/*
    Filename    : User.php
    Location    : application/controller/user/User.php
    Purpose     : User Controller
    Created     : 6/27/2019 by Sherlock Holmes
    Updated     : 
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(FALSE);
    }

    public function index()
    {
        if(logged_in() && user('role_id') === 2) {
            $view_data = [
                'page_title' => 'User'
            ];
    
            $this->twig->display('user/index.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }

}