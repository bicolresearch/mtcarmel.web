<?php

/*
    File      : config/routes.php
    Purpose   : routes
    Created   : 6/04/2019 by Sherlock Holmes
    Updated   : 6/14/2019 by Constantina
    Changes   : Add Services and Management
*/

defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes with
| underscores in the controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';

// Home
$route['news'] = 'home/news';
$route['calendar'] = 'home/calendar';
$route['live-mass'] = 'home/live_mass';
$route['news-details'] = 'home/news_details';

// Basilica
$route['mass-schedule'] = 'basilica/mass_schedule';
$route['location-map'] = 'basilica/location_map';
$route['carmelite-priests'] = 'basilica/carmelite_priests';
$route['contact-details'] = 'basilica/contact_details';
$route['history'] = 'basilica/history';

// Services
$route['join-us'] = 'services/join_us';
$route['request'] = 'services/request';
$route['baptism'] = 'services/baptism';
$route['communion'] = 'services/communion';
$route['confirmation'] = 'services/confirmation';
$route['marriage'] = 'services/marriage';
$route['passing'] = 'services/passing';
$route['events'] = 'services/events';

// Management
$route['requests'] = 'management/requests';
$route['my-schedule'] = 'management/my_schedule';
$route['prayer-request'] = 'management/prayer_request';
$route['mass-request'] = 'management/mass_request';
$route['post-news'] = 'management/post_news';
$route['add-project'] = 'management/add_project';
$route['add-transaction'] = 'management/add_transaction';
$route['collective-schedule'] = 'management/collective_schedule';
$route['service-schedule'] = 'management/service_schedule';
$route['donations-report'] = 'management/donations_report';
$route['edit-news'] = 'management/edit_news';
$route['live-stream'] = 'management/live_stream';
$route['edit-project'] = 'management/edit_project';
$route['edit-transaction'] = 'management/edit_transaction';
$route['add-schedule'] = 'management/add_schedule';
$route['my-availability'] = 'management/my_availability';
$route['user-roles'] = 'management/user_roles';
$route['splash-ads'] = 'management/splash_ads';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
