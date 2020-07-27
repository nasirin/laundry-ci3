<?php

class Test extends CI_Controller{

    function __construct()
    {
        parent:: __construct();
        check_not_login();
        // $this->load->model('M_order','order');
        // $this->load->model('M_promo','promo');
        // $this->load->model('M_member','member');
        // $this->load->model('M_product','product');
        // $this->load->model('M_inventory','inventory');
    }
    
    public function index()
    {
        // $data = array(
        //     'order' => $this->order->get(),
        //     'promo' => $this->promo->get_all()->result(),
        //     'member' => $this->member->get_all()->result(),
        //     'product' => $this->product->get_all()->result(),
        //     'inventory' => $this->inventory->get_all()->result()
        // );
        $this->template->load('home/template','test/test');
    }

    function add()
    { 
		$post = $this->input->post(null, true);
		if (isset($_POST['add'])) {
			$this->order->add($post);
		}

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success','Data successfully added');
			redirect('test');
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
			redirect('test');
		 }else{
			$this->session->set_flashdata('success','Data still available, nothing changed');
			redirect('test');
		 }
    }

    public function del($id) 
	{
		// $kar = $this->kar->get($id)->row();
		// if ($kar->images != null) {
		// 	$target_file = './assets/lte/dist/img/karyawan/'.$kar->images;
		// 	unlink($target_file);
		// }
		
		$this->order->del($id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success','Data successfully deleted');
			redirect('test');
		}
    }
}
?>