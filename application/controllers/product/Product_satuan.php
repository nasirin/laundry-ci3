<?php

class Product_satuan extends CI_Controller{

    function __construct()
    {
        parent::__construct();
		check_not_login();
		$this->load->model('product/M_product_satuan','product'); 
		$this->load->model('M_inventory','inventory');
    }
    
    public function index()
    {	
		$product = $this->product->get_all()->result();
		$detail = $this->product->get_detail()->result();
		$inventory = $this->inventory->get();
		$data = array(
			'dataproduct' => $product,
			'inventory' => $inventory,
			'detail' => $detail
		);
        $this->template->load('home/template','menu/product/product_satuan',$data);
    }

    function add()
    { 
		$post = $this->input->post(null, true);
		if (isset($_POST['add'])) {
			$this->product->add($post);
		}

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success','Data successfully added');
			redirect('product/product_satuan');
		 }
    }

    public function edit($id)
    {
		$post = $this->input->post(null, true);
		if (isset($_POST['edit'])) {
			$this->product->edit($post);
		}

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success','Data successfully changed');
			redirect('product/product_satuan');
		 }else{
			$this->session->set_flashdata('success','Data still available, nothing changed');
			redirect('product/product_satuan');
		 }
    }

    public function del($id) 
	{
		$this->product->del($id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
			redirect('product/product_satuan');
		}
    }
}
?>