<?php

/*
    File      : Controller/Transactions.php
    Purpose   : Transactions Controller
    Created   : 6/03/2019 by Sherlock Holmes
    Updated   : 6/14/2019 by Band Aid
    Changes   : Migrate to new framework
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

/* End of file: Transactions.php */
/* Location: application/controller/Transactions.php */