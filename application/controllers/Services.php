<?php

/*
    File      : Controller/Services.php
    Purpose   : Service Controller
    Created   : 6/04/2019 by Band Aid
    Updated   : 6/14/2019 by Band Aid
    Changes   : Migrate to new framework
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Services extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(FALSE);
    }


    public function join_us()
    {
        $view_data = [
            'page_title' => 'Join Us!'
        ];

        $this->twig->display('services/join-us.html', $view_data);
    }

    public function request()
    {
        $view_data = [
            'page_title' => 'Make a request'
        ];

        $this->twig->display('services/request.html', $view_data);
    }

    public function baptism()
    {
        $view_data = [
            'page_title' => 'Baptism'
        ];

        $this->twig->display('services/baptism.html', $view_data);
    }

    public function communion()
    {
        $view_data = [
            'page_title' => 'Communion'
        ];

        $this->twig->display('services/communion.html', $view_data);
    }

    public function confirmation()
    {
        $view_data = [
            'page_title' => 'Confirmation'
        ];

        $this->twig->display('services/confirmation.html', $view_data);
    }

    public function marriage()
    {
        $view_data = [
            'page_title' => 'Marriage'
        ];

        $this->twig->display('services/marriage.html', $view_data);
    }

    public function passing()
    {
        $view_data = [
            'page_title' => 'Passing'
        ];

        $this->twig->display('services/passing.html', $view_data);
    }

    public function events()
    {
        $view_data = [
            'page_title' => 'Events'
        ];

        $this->twig->display('services/events.html', $view_data);
    }

}

/* End of file: Services.php */
/* Location: application/controller/Services.php */