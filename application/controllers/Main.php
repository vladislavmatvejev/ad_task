<?php

class Main extends CI_Controller
{
    public function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $this->load->model('user');
        $this->load->model('product');
        $users = $this->user->get();
        $products = $this->product->get();
        $data['users'] = $users;
        $data['products'] = $products;
        $this->load->view('main', $data);

    }
}