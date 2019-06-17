<?php

/*
    File      : Controller/Help.php
    Purpose   : Send Help Controller
    Created   : 6/03/2019 by Sherlock Holmes
    Updated   : 6/14/2019 by Constantina
    Changes   : Migrate to new framework
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Help extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(FALSE);
    }

    public function index()
    {
        $view_data = [
            'page_title' => 'Send Help'
        ];

        $this->twig->display('help/index.html', $view_data);
    }

}

/* End of file: Help.php */
/* Location: application/controller/Help.php */