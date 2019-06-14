<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Authme_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function _signin($password)
    {
        $sp = 'call sp_get_password(?)';
        $query = $this->db->query($sp, array('password' => $password));
        return ($query->num_rows() > 0) ? $query->row() : false;
    }
}

/* 
 * end of file 
 * location: models/Authme_model.php
 */