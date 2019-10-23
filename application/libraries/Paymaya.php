<?php

/*
    Filename    : Paymaya.php
    Location    : application/libraries/Paymaya.php
    Purpose     : Use paymaya as ci library
    Created     : 10/03/2019 13:07:32 by Spiderman
    Updated     : 
    Changes     : 
*/

if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . "/vendor/autoload.php";

class Paymaya
{
    private $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    // Initialize SDK with public-facing API key, secret API key, and the intended environment ("SANDBOX" or "PRODUCTION)
    public function paymaya_init_sdk() {
        return PayMayaSDK::getInstance()->initCheckout("pk-lNAUk1jk7VPnf7koOT1uoGJoZJjmAxrbjpj6urB8EIA", "sk-fzukI3GXrzNIUyvXY3n16cji8VTJITfzylz5o5QzZMC", "SANDBOX");
    }
}