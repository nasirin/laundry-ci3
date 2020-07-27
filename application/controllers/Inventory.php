<?php

class Inventory extends CI_Controller{

    function __construct()
    {
        parent::__construct();
		check_not_login();
		cek_admin();
		$this->load->model('M_inventory','inv');
    }
    
    public function index()
    {	

		$data['datainv'] = $this->inv->get();
        $this->template->load('home/template','menu/inventory',$data);
    }

    function add()
    { 
		$post = $this->input->post(null, true);
		if (isset($_POST['add'])) {
			$this->inv->add($post);
		}

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success','Data successfully added');
			redirect('inventory');
		 }
    }

    public function edit($id)
    {
		$post = $this->input->post(null, true);
		if (isset($_POST['edit'])) {
			$this->inv->edit($post);
		}

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success','Data successfully changed');
			redirect('inventory');
		 }else{
			$this->session->set_flashdata('success','Data still available, nothing changed');
			redirect('inventory');
		 }
    }

    public function del($id) 
	{
		// $kar = $this->kar->get($id)->row();
		// if ($kar->images != null) {
		// 	$target_file = './assets/lte/dist/img/karyawan/'.$kar->images;
		// 	unlink($target_file);
		// }
		
		$this->inv->del($id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
			redirect('inventory');
		}else{
			$this->session->set_flashdata('error','Data Sedang digunakan');
			redirect('inventory');
		}
    } 
}
?>