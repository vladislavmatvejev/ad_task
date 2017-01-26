<?php


class User extends CI_Model
{
    public $table = 'users';

    function __construct()
    {
        parent::__construct();
    }

    function get()
    {
        return $this->db->get($this->table)->result_array();
    }
}