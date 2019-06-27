
<?php

/*
    Filename    : Admin.php
    Location    : application/controller/admin/Admin.php
    Purpose     : Admin Controller
    Created     : 6/27/2019 by Sherlock Holmes
    Updated     : 
    Changes     : 
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
                'page_title' => 'Admin'
            ];
    
            $this->twig->display('admin/index.html', $view_data);
        } else {
            redirect('auth', 'refresh');
        }
    }

}