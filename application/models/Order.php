<?php

class Order extends CI_Model
{
    public $table = 'orders';
    public $order_id = 'id';
    public $product_id = 'product_id';
    public $user_id = 'user_id';
    public $date = 'date';
    public $quantity = 'quantity';

    function __construct()
    {
        parent::__construct();
    }
    function get($date, $like_query)
    {
        $this->db->select('orders.id, users.id as user_id, products.id as product_id, users.name as user_name, products.name as product_name, date, price, quantity');
        $this->db->join('products', 'products.id='.$this->table.'.'.$this->product_id);
        $this->db->join('users', 'users.id='.$this->table.'.'.$this->user_id);
        $this->db->group_start();
        $this->db->like('users.name', $like_query);
        $this->db->or_like('products.name', $like_query);
        $this->db->group_end();
        $this->db->where('date >=', $date);
        return $this->db->get($this->table)->result_array();
    }

    function add($data)
    {
        $this->db->set($this->product_id, $data['product_id']);
        $this->db->set($this->user_id, $data['user_id']);
        $this->db->set($this->date, 'CURDATE()', false);
        $this->db->set($this->quantity, $data['quantity']);
        $this->db->insert($this->table);
        return $this->db->insert_id();
    }

    function update($data)
    {
        if(isset($data['id'])){
            $this->db->set($this->product_id, $data['product_id']);
            $this->db->set($this->user_id, $data['user_id']);
            $this->db->set($this->date, 'CURDATE()', false);
            $this->db->set($this->quantity, $data['quantity']);
            $this->db->where($this->order_id, $data['id']);
            $this->db->update($this->table);
            return $this->db->affected_rows();
        }
        return false;
    }

    function delete($id)
    {
        $this->db->where($this->order_id, $id);
        $this->db->delete($this->table);
    }
}