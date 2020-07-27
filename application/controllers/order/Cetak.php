<?php
class Cetak extends CI_Controller
{
    function __construct()
    {
        parent:: __construct();
		check_not_login();
        $this->load->model('order/M_order_kiloan','order');
        // $this->load->model('M_promo','promo');
        // $this->load->model('M_member','member');
        // $this->load->model('product/M_product_kiloan','product');
        // $this->load->model('M_inventory','inventory'); 
    }
    
    public function index()
    {
        $data = array(
            'order' => $this->order->get()
            // 'promo' => $this->promo->get_all()->result(),
            // 'member' => $this->member->get_all()->result(),
            // 'product' => $this->product->get_all()->result(),
            // 'inventory' => $this->inventory->get_all()->result()
        );
        $this->template->load('home/template','menu/order/cetak',$data);
    }

}