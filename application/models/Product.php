<?php


class Product extends CI_Model
{
    public $table = 'products';
    function __construct()
    {
        parent::__construct();
    }

    function get()
    {
        return $this->db->get($this->table)->result_array();
    }
}