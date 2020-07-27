<?php

class Member extends CI_Controller{ 

    function __construct()
    {
        parent::__construct();
        check_not_login();
		$this->load->model('M_member','member');

		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = 1048;
		$config['file_name'] = 'MB-'.date('mY').'-'.substr(md5(rand()),0,10);
		$config['upload_path'] = './assets/img/member';
		$this->load->library('upload',$config);
    }
    
    public function index()
    {
        $data['row'] = $this->member->get();
        $this->template->load('home/template','menu/member', $data); 
    }

    function add()
    { 
		$post = $this->input->post(null, true);
		if (isset($_POST['add'])) {
			if ($this->member->cek_email($post['email'])->num_rows() > 0) {
				$this->session->set_flashdata('error', 'Email '. $post['email'] .' has already been registered.');
				redirect('member');
			}else{
				if (@$_FILES['img']['name'] != null) {
					if ($this->upload->do_upload('img')) {
						$post['img'] = $this->upload->data('file_name');
						$this->member->add($post);
						if ($this->db->affected_rows() > 0) {
							$this->session->set_flashdata('success','Data successfully added');
							redirect('member');
						}
					}else{
						$error = $this->upload->display_errors();
						$this->session->set_flashdata('error', $error);
						redirect('member');
					}
				}else{
					// jika gambar tidak diisi
					$post['img'] = null;
					$this->member->add($post);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('success','Data successfully added');
					}
					redirect('member');
				}
			}
		}
    }

	public function edit($id)
    {
		$post = $this->input->post(null, true);
		if (isset($_POST['edit'])) {
			if ($this->member->cek_email($post['email'],$post['idmb'])->num_rows() > 0) {
				$this->session->set_flashdata('error', 'Email '. $post['email'] .' has already been registered.');
				redirect('member');
			}else{
				if (@$_FILES['img']['name'] != null) {
					if ($this->upload->do_upload('img')) {
	
						$img = $this->member->get($post['idmb'])->row(); //replace gambar
						if ($img->photo != null) {
							$target_file = './assets/img/member/'.$img->photo;
							unlink($target_file);
						}
						
						$post['img'] = $this->upload->data('file_name');
						$this->member->edit($post);
						if ($this->db->affected_rows() > 0) {
							$this->session->set_flashdata('success','Data successfully changes');
							redirect('member');
						}
					}else{
						$error = $this->upload->display_errors();
						$this->session->set_flashdata('error',$error);
						redirect('member');
					}
				}else{
					$post['img'] = null;
					$this->member->edit($post);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('success','Data successfully changes');
						redirect('member');
					}else{
						$this->session->set_flashdata('success','Data still available, nothing changed');
						redirect('member');
					}
				}
			}
		}
    }

    public function del($id) 
	{
		$kar = $this->member->get($id)->row();
		if ($kar->photo_member != null) {
			$target_file = './assets/img/member/'.$kar->photo_member;
			unlink($target_file);
		}
		
		$this->member->del($id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
			redirect('member');
		}else{
			$this->session->set_flashdata('error','Data sedang digunakan');
			redirect('member');
		}
	}
}
?>