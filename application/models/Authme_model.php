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

    public function _get_user_by_email($email, $password)
    {
        $sp = 'call sp_user_by_email(?, ?)';
        $query = $this->db->query($sp, array('username' => $email, 'password' => $password));
        return ($query->num_rows() > 0) ? $query->row() : false;
    }
}

/* 
 * end of file 
 * location: models/Authme_model.php
 */