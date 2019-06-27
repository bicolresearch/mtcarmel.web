<?php

/*
    Filename    : Management.php
    Location    : application/controller/Management.php
    Purpose     : Management Controller
    Created     : 6/24/2019 by Sherlock Holmes
    Updated     : 6/27/2019 by Sherlock Holmes
    Changes     : Changed commenting format
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Management extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(FALSE);
    }

    public function requests()
    {
        $view_data = [
            'page_title' => 'Requests'
        ];

        $this->twig->display('management/requests.html', $view_data);
    }


    public function news()
    {
        $view_data = [
            'page_title' => 'News & Updates'
        ];

        $this->twig->display('home/news.html', $view_data);
    }

    public function my_schedule()
    {
        $view_data = [
            'page_title' => 'My Schedule"'
        ];

        $this->twig->display('management/my-schedule.html', $view_data);
    }

    public function prayer_request()
    {
        $view_data = [
            'page_title' => 'Prayer Request'
        ];

        $this->twig->display('management/prayer-request.html', $view_data);
    }

    public function mass_request()
    {
        $view_data = [
            'page_title' => 'Mass Request'
        ];

        $this->twig->display('management/mass-request.html', $view_data);
    }

    public function post_news()
    {
        $view_data = [
            'page_title' => 'Post News'
        ];

        $this->twig->display('management/post-news.html', $view_data);
    }

    public function add_project()
    {
        $view_data = [
            'page_title' => 'Add Project'
        ];

        $this->twig->display('management/add-project.html', $view_data);
    }

    public function add_transaction()
    {
        $view_data = [
            'page_title' => 'Add Transaction'
        ];

        $this->twig->display('management/add-transaction.html', $view_data);
    }

    public function collective_schedule()
    {
        $view_data = [
            'page_title' => 'Collective Schedule'
        ];

        $this->twig->display('management/collective-schedule.html', $view_data);
    }

    public function service_schedule()
    {
        $view_data = [
            'page_title' => 'Service Schedule'
        ];

        $this->twig->display('management/service-schedule.html', $view_data);
    }

    public function donations_report()
    {
        $view_data = [
            'page_title' => 'Donations Report'
        ];

        $this->twig->display('management/donations-report.html', $view_data);
    }

    public function edit_news()
    {
        $view_data = [
            'page_title' => 'Edit News'
        ];

        $this->twig->display('management/edit-news.html', $view_data);
    }

    public function live_stream()
    {
        $view_data = [
            'page_title' => 'Live Stream'
        ];

        $this->twig->display('management/live-stream.html', $view_data);
    }

    public function edit_project()
    {
        $view_data = [
            'page_title' => 'Edit Project'
        ];

        $this->twig->display('management/edit-project.html', $view_data);
    }

    public function edit_transaction()
    {
        $view_data = [
            'page_title' => 'Edit Transaction'
        ];

        $this->twig->display('management/edit-transaction.html', $view_data);
    }

    public function add_schedule()
    {
        $view_data = [
            'page_title' => 'Add Schedule'
        ];

        $this->twig->display('management/add-schedule.html', $view_data);
    }

    public function my_availability()
    {
        $view_data = [
            'page_title' => 'My Availability'
        ];

        $this->twig->display('management/my-availability.html', $view_data);
    }

    public function user_roles()
    {
        $view_data = [
            'page_title' => 'User Roles'
        ];

        $this->twig->display('management/user-roles.html', $view_data);
    }

    public function splash_ads()
    {
        $view_data = [
            'page_title' => 'Splash Ads'
        ];

        $this->twig->display('management/splash-ads.html', $view_data);
    }

}