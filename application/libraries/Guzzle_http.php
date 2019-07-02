<?php

/*
    Filename    : Guzzle_http.php
    Location    : application/libraries/Guzzle_http.php
    Purpose     : To use guzzle as ci library
    Created     : 7/02/2019 by Spiderman
    Updated     : 
    Changes     : 
*/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Guzzle_Http
{
    public function guzzle()
    {
        require APPPATH . "/vendor/autoload.php";
    }
}