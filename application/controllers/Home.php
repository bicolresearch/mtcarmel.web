<?php

/*
    File      : Controller/Home.php
    Purpose   : Home Controller
    Created   : 6/03/2019 by Sherlock Holmes
    Updated   : 6/14/2019 by Band Aid
    Changes   : Migrate to new framework
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(FALSE);
    }

    public function index()
    {
        $view_data = [
            'page_title' => 'Homepage'
        ];

        $this->twig->display('home/index.html', $view_data);
    }

    public function news()
    {
        $view_data = [
            'page_title' => 'News & Updates'
        ];

        $this->twig->display('home/news.html', $view_data);
    }

    public function calendar()
    {
        $view_data = [
            'page_title' => 'Calendar'
        ];

        $this->twig->display('home/calendar.html', $view_data);
    }

    public function live_mass()
    {
        $view_data = [
            'page_title' => 'Live Mass'
        ];

        $this->twig->display('home/live-mass.html', $view_data);
    }

    public function news_details()
    {
        $view_data = [
            'page_title' => 'News Details'
        ];

        $this->twig->display('home/news-details.html', $view_data);
    }

}

/* End of file: Home.php */
/* Location: application/controller/Home.php */