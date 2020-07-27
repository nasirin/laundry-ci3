<?php

class Order_kiloan extends CI_Controller{

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
        $this->template->load('home/template','menu/order/order_kiloan',$data);
    }

    function add()
    { 
		$post = $this->input->post(null, true);
		if (isset($_POST['add'])) {
			$this->order->add($post);
		}

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success','Data successfully added');
			redirect('order/order_kiloan');
		 }
    }

    public function edit($id)
    {
		$post = $this->input->post(null, true);
		if (isset($_POST['edit'])) {
			$this->order->edit($post);
		}

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success','Data successfully changed');
			redirect('order/order_kiloan');
		 }else{
			$this->session->set_flashdata('success','Data still available, nothing changed');
			redirect('order/order_kiloan');
		 }
    }

    public function del($id) 
	{	
		$this->order->del($id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success','Data successfully deleted');
			redirect('order/order_kiloan');
		}
    }

    function cari()
    {
        // $post = $this->input->post('search');
        // if (isset($_POST['search'])) {
            // $data['order'] = $this->order->cari($post);
            // $data['jumlah'] = count($data['order']);
            // redirect('order/order_kiloan',$data);
        // }
        // $this->template->load('home/template','menu/order/order_kiloan',$data);
        // if ($this->db->affected_rows() > 0) {
        //     redirect('order/order_kiloan',$data);
        // }

        $cari = $this->input->post('search');
        $data = $this->order->cari($cari);
        $hasil = $this->template->load('home/template','menu/order/order_kiloan', array('order_kiloan'=>$data),true);
        $callback = array(
            'hasil' =>$hasil,
        );
        echo json_decode($callback);

    }
}
?>