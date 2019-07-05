<?php

/*
    Filename    : Guzzle.php
    Location    : application/libraries/Guzzle.php
    Purpose     : Use guzzle as ci library
    Created     : 07/03/2019 15:25:44 by Spiderman
    Updated     : 07/05/2019 15:58:11 by Spiderman
    Changes     : 
*/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . "/vendor/autoload.php";

class Guzzle
{
    private $endpoint;
    private $key;

    public function __construct()
    {
        // Configure endpoint and key
        $this->endpoint = 'http://localhost/mountcarmel.api/'; 
        $this->key      = '365-Days';
    }

    // Return client with a base URI
    public function client() {
        return new GuzzleHttp\Client(['base_uri' => $this->endpoint]);
    }

    // Return key
    public function key() {
        return $this->key;
    }
}