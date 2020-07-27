<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{ 
		parent:: __construct();
		check_not_login();
		$this->load->model('order/M_order_kiloan','order');
        $this->load->model('M_promo','promo');
        $this->load->model('M_member','member');
        $this->load->model('product/M_product_kiloan','product');
        $this->load->model('M_inventory','inventory'); 
	}

	public function index()
	{
		$data = array(
            'order' => $this->order->get(),
            'promo' => $this->promo->get_all()->result(),
            'member' => $this->member->get_all()->result(),
            'product' => $this->product->get_all()->result(),
            'inventory' => $this->inventory->get_all()->result()
        );
        $data['bulan']	= $this->db->query("SELECT * FROM bulan")->result_array();
        $data['members']= $this->db->query("SELECT * FROM member")->num_rows();
        $data['promo']	= $this->db->query("SELECT * FROM promo")->num_rows();
        $data['amount']	= $this->db->query("SELECT SUM(total_harga_kiloan) AS total FROM order_kiloan")->result_array();

		if ($this->session->userdata('level') == 1) {
			$this->template->load('home/template','menu/dashboard', $data);
		}elseif($this->session->userdata('level') == 2){
			$this->template->load('home/template','menu/order/order_kiloan',$data);
		}elseif($this->session->userdata('level') == 3){
			$this->template->load('pelanggan/home/template','pelanggan/home/dashboard');
		}
	}
}
 