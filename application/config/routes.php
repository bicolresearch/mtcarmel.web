<?php

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
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

// Home
$route['news'] = 'home/news';
$route['calendar'] = 'home/calendar';
$route['live-mass'] = 'home/live_mass';

// Basilica
$route['mass-schedule'] = 'basilica/mass_schedule';
$route['location-map'] = 'basilica/location_map';
$route['carmelites'] = 'basilica/carmelites';
$route['contact'] = 'basilica/contact';
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

// Admin
$route['admin'] = 'admin/admin/index';

// User
$route['user'] = 'user/user/index';
$route['user/news'] = 'user/home/news';
$route['user/calendar'] = 'user/home/calendar';
$route['user/live-mass'] = 'user/home/live_mass';
$route['user/prayer_request'] = 'user/make_request/prayer_request';
$route['user/mass_request'] = 'user/make_request/mass_request';
$route['user/place_ad'] = 'user/ads/place_ad';
$route['user/ad_status'] = 'user/ads/ad_status';