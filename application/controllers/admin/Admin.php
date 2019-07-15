<?php

/*
    Filename    : Admin.php
    Location    : application/controllers/admin/Admin.php
    Purpose     : Admin controller
    Created     : 06/27/2019 15:11:03 by Spiderman
    Updated     : 07/15/2019 17:58:00 by Spiderman
    Changes     : Class renamed to Admin
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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
                'page_title' => 'Admin',
                'avatar' => user('cover_photo')
            ];
    
            $this->twig->display('admin/index.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }
}