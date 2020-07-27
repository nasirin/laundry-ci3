<?php

class Employee extends CI_Controller{

    function __construct()
    {
        parent::__construct();
        check_not_login();
		cek_admin();
		$this->load->model('M_employee','empl');

		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = 1048;
		$config['file_name'] = 'KAR-'.date('mY').'-'.substr(md5(rand()),0,10);
		$config['upload_path'] = './assets/img/karyawan';
		$this->load->library('upload',$config);
    }
    
    public function index()
    {	
		$data['datakar'] = $this->empl->get();
        $this->template->load('home/template','menu/employee',$data);
	}

    function add()
    { 
		$post = $this->input->post(null, true);
		if (isset($_POST['add'])) {
			if ($this->empl->cek_email($post['email'])->num_rows() > 0) {
				$this->session->set_flashdata('error', 'Email '. $post['email'] .' has already been registered.');
				redirect('employee');
			}else{
				if (@$_FILES['img']['name'] != null) {
					if ($this->upload->do_upload('img')) {
						$post['img'] = $this->upload->data('file_name');
						$this->empl->add($post);
						if ($this->db->affected_rows() > 0) {
							$this->session->set_flashdata('success','Data successfully added');
							redirect('employee');
						}
					}else{
						$error = $this->upload->display_errors();
						$this->session->set_flashdata('error', $error);
						redirect('employee');
					}
				}else{
					// jika gambar tidak diisi
					$post['img'] = null;
					$this->empl->add($post);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('success','Data successfully added');
					}
					redirect('employee');
				}
			}
		}
    }

	public function edit($id) 
    {
		$post = $this->input->post(null, true);
		if (isset($_POST['edit'])) {
			if ($this->empl->cek_email($post['email'],$post['idkar'])->num_rows() > 0) {
				$this->session->set_flashdata('error', 'Email '. $post['email'] .' has already been registered.');
				redirect('employee');
			}else{
				if (@$_FILES['img']['name'] != null) {
					if ($this->upload->do_upload('img')) {
	
						$img = $this->empl->get($post['idkar'])->row(); //replace gambar
						if ($img->photo != null) {
							$target_file = './assets/img/karyawan/'.$img->photo;
							unlink($target_file);
						}
						
						$post['img'] = $this->upload->data('file_name');
						$this->empl->edit($post);
						if ($this->db->affected_rows() > 0) {
							$this->session->set_flashdata('success','Data successfully changes');
							redirect('employee');
						}
					}else{
						$error = $this->upload->display_errors();
						$this->session->set_flashdata('error',$error);
						redirect('employee');
					}
				}else{
					$post['img'] = null;
					$this->empl->edit($post);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('success','Data successfully changes');
						redirect('employee');
					}else{
						$this->session->set_flashdata('success','Data still available, nothing changed');
						redirect('employee');
					}
				}
			}
		}
    }

    public function del($id) 
	{
		$kar = $this->empl->get($id)->row();
		if ($kar->photo_karyawan != null) {
			$target_file = './assets/img/karyawan/'.$kar->photo_karyawan;
			unlink($target_file);
		}
		
		$this->empl->del($id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
			redirect('employee');
		}
	}
	
	public function debug()
	{
		$data = array(
			'id' => $this->input->post('idkar'),
			'nip' => $this->input->post('nip'),
			'level' => $this->input->post('level'),
			'nama' => $this->input->post('nama'),
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),
			'notelp' => $this->input->post('notelp'),
			'branch' => $this->input->post('branch'),
			'img' => $this->input->post('img'),
			'status' => $this->input->post('status'),
			'alamat' => $this->input->post('alamat')
		);
		print_r($data);
	}
}
?>