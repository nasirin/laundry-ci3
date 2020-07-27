<?php

function check_already_login(){
    $ci =& get_instance();
    $user_session = $ci->session->userdata('iduser');
    if ($user_session) {
        redirect('dashboard');
    }
}

function check_not_login(){
    $ci =& get_instance();
    $user_session = $ci->session->userdata('iduser');
    if (!$user_session) {
        redirect('auth');
    }
}

function cek_admin(){
    $ci =& get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_login()->id_level != 1) {
        redirect('dashboard');
    }
}

function indo_currency($nominal){
    $result = "Rp. " . number_format($nominal,2,',','.');
    return $result;
}
function convert_berat($nominal){
    $result = number_format($nominal*1000).'/mg';
    return $result;
}

function indo_date($date){
    $d = substr($date,8,2);
    $m = substr($date,5,2);
    $y = substr($date,0,4);
    return $d.'/'.$m.'/'.$y;
}