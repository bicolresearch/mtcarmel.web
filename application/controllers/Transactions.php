<?php

/*
    Filename    : Transactions.php
    Location    : application/controller/Transactions.php
    Purpose     : Transactions Controller
    Created     : 06/24/2019 18:52:59 by Spiderman
    Updated     : 10/25/2019 18:53:14 by Spiderman
    Changes     : 
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Transactions extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $view_data = [
            'page_title' => 'My Transactions',
            'page_subtitle' => ''
        ];

        $this->twig->display('transactions/index.html', $view_data);
    }
}