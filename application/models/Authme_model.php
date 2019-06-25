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

    /**
     * @param $username
     * @param $password
     * @return bool
     */
    public function _get_by_username($username, $password)
    {

        $query = $this->db->get_where('users', [
            'username' => $username,
            'password' => $password
        ]);
        return ($query->num_rows()) ? $query->row() : false;
    }

    /**
     * @param $id
     * @param $data
     */
    public function _update($id, $data)
    {
        $this->db->trans_begin();

        $this->db
            ->where('id', $id)
            ->update('users', $data);

        ($this->db->trans_status() === false) ? $this->db->trans_rollback() : $this->db->trans_commit();
    }
}

/* 
 * end of file 
 * location: models/Authme_model.php
 */