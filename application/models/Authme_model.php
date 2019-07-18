<?php

/*
    Filename    : Authme_model.php
    Location    : application/models/Authme_model.php
    Purpose     : Authme model
    Created     : 6/24/2019 by Sherlock Holmes
    Updated     : 6/28/2019 by Sherlock Holmes
    Changes     : Changed commenting format
*/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Authme_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function _update($id, $data)
    {
        $this->db->trans_begin();

        $this->db
            ->where('id', $id)
            ->update('users', $data);

        ($this->db->trans_status() === false) ? $this->db->trans_rollback() : $this->db->trans_commit();
    }
}