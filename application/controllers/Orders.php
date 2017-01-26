<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Orders extends CI_Controller
{
    public $like_query;
    public $date_filter;

    public function __construct() {
        parent::__construct();
        $this->load->model('order');

        if(isset($_POST['date_filter']))
        {
            $date = $this->getDate($_POST['date_filter']);
            $this->date_filter = $date;
        }else{
            $this->date_filter = '1900-01-01';
        }

        if(isset($_POST['like']))
        {
            $this->like_query = $_POST['like'];
        }else{
            $this->like_query = '';
        }
    }


    public function index()
    {
        $orders = $this->order->get($this->date_filter, $this->like_query);
        $data['orders'] = $orders;
        $this->load->view('orders', $data);
    }

    public function save()
    {
        if($_POST['id'] != '')
        {
            $this->order->update($_POST);
        }else{
            $this->order->add($_POST);
        }
    }

    public function removeOrder(){
        if($_POST['id']){
            $this->order->delete($_POST['id']);
        }
    }
    public function editOrder(){
        if($_POST['id']){
            $this->order->update($_POST['id']);
        }
    }

    public function getOrders($date, $search = ''){
        $date = $this->getDate($date);
        $orders = $this->order->get($date, $search);
        $data['orders'] = $orders;
        $this->load->view('orders', $data);
    }
    public function getDate($date){
        if($date == 'today')
        {
            $date = date('Y-m-d');
        }elseif($date == 'week')
        {
            $date = date('Y-m-d', strtotime('-7 days'));
        }else{
            $date = '1900-01-01';
        }

        return $date;
    }
}