<?php

/*
    Filename    : Transactions.php
    Location    : application/controller/Transactions.php
    Purpose     : Transactions Controller
    Created     : 6/24/2019 by Sherlock Holmes
    Updated     : 6/27/2019 by Sherlock Holmes
    Changes     : Changed commenting format
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Transactions extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(FALSE);
    }

    public function index()
    {
        $view_data = [
            'page_title' => 'My Transactions'
        ];

        $this->twig->display('transactions/index.html', $view_data);
    }

}