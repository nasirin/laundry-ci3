<?php

class Promo extends CI_Controller{

    function __construct()
    {
        parent::__construct();
		check_not_login();
		$this->load->model('M_promo','promo');

		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = 1048;
		$config['file_name'] = 'ADS-'.date('mY').'-'.substr(md5(rand()),0,10);
		$config['upload_path'] = './assets/img/promo';
		$this->load->library('upload',$config);
    }
    
    public function index()
    {	

		$a = $this->promo->get()->result();
		$data = array(
			'datapromo' => $a,
		);
        $this->template->load('home/template','menu/promo',$data);
    }

    function add() 
    { 
		$post = $this->input->post(null, true);
		if (isset($_POST['add'])) {
			if (@$_FILES['img']['name'] != null) {
				if ($this->upload->do_upload('img')) {
					$post['img'] = $this->upload->data('file_name');
					$this->promo->add($post);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('success','Data successfully added');
						redirect('promo');
					}
				}else{
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('error', $error);
					redirect('promo');
				}
			}else{
				// jika gambar tidak diisi
				$post['img'] = null;
				$this->promo->add($post);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('success','Data successfully added');
				}
				redirect('promo');
			}
		}

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success','Data successfully added');
			redirect('promo');
		}
    }

    public function edit($id)
    {
		$post = $this->input->post(null, true);
		if (isset($_POST['edit'])) {
			if (@$_FILES['img']['name'] != null) {
				if ($this->upload->do_upload('img')) {
					$post['img'] = $this->upload->data('file_name');
					$this->promo->edit($post);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('success','Data successfully added');
						redirect('promo');
					}
				}else{
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('error', $error);
					redirect('promo');
				}
			}else{
				// jika gambar tidak diisi
				$post['img'] = null;
				$this->promo->edit($post);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('success','Data successfully added');
				}
				redirect('promo');
			}
		}

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success','Data successfully changed');
			redirect('promo');
		 }else{
			$this->session->set_flashdata('success','Data still available, nothing changed');
			redirect('promo');
		 }
    }

    public function del($id) 
	{
		$kar = $this->promo->get($id)->row();
		if ($kar->photo_promo != null) {
			$target_file = './assets/img/promo/'.$kar->photo_promo;
			unlink($target_file);
		}
		
		$this->promo->del($id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
			redirect('promo');
		}else{
			$this->session->set_flashdata('error','Data sedang digunakan');
			redirect('promo');
		}
    }


    public function share() {
    	$id = $this->uri->segment(3);
    	$data['tag'] = 'Hai kak, kami mengadakan promo menarik lagi nih AYO cek di: shiplaundry.com';
    	$data['teks'] = $this->db->query("SELECT * FROM promo WHERE id_promo='$id' ")->row_array();
    	$this->template->load('home/template','menu/send_promo',$data);
    }


    public function sending() {
		if(!isset($_POST['phone']) OR !isset($_POST['message'])){ die('Not enough data');}

		// Your API URL
		$apiURL = 'https://eu84.chat-api.com/instance93843/';
		// Your Token
		$token 	= 'jll8s0quucsaxngg';

		$phone		= $this->input->post('phone'); // Phone harus dengan kode negara 6289505414025
		$message 	= $this->input->post('message');


		$data = json_encode(
		    array(
		        'chatId'=>$phone.'@c.us',
		        'body'=>$message
		    )
		);

		$url = $apiURL.'message?token='.$token;
		$options = stream_context_create(
		    array('http' =>
		        array(
		            'method'  => 'POST',
		            'header'  => 'Content-type: application/json',
		            'content' => $data
		        )
		    )
		);
		$response = file_get_contents($url,false,$options);
		if ($response) {
			$this->session->set_flashdata('sending', 'Success sending....');
		}
		redirect(base_url('promo'));
	}

}
?>