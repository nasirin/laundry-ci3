<?php

class Fungsi{

    protected $ci;

    function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->model('M_auth','user');
        // $this->ci->load->model('M_karyawan','kar');  
    }

    function user_login(){
        $user_id = $this->ci->session->userdata('iduser');
        $user_data = $this->ci->user->get($user_id)->row();
        return $user_data;
    }
}