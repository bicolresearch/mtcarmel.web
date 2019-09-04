<?php

/*
    Filename    : Guzzle.php
    Location    : application/libraries/Guzzle.php
    Purpose     : Use guzzle as ci library
    Created     : 07/03/2019 15:25:44 by Spiderman
    Updated     : 09/04/2019 20:58:32 by Spiderman
    Changes     : 
*/

if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . "/vendor/autoload.php";

class Guzzle
{
    private $CI;
    private $endpoint;
    private $key;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    // Return client with a base URI
    public function client() {
        return new GuzzleHttp\Client(['base_uri' => $this->CI->config->item('api_endpoint')], ['time' => 5]);
    }

    // Return key
    public function key() {
        return $this->CI->config->item('api_key');
    }
}