<?php
class Coba extends CI_Controller{

    public function index()
    {
        $this->load->model('m_coba');
        $data['nip'] = $this->m_coba->get_kode()->row_array();
        $this->template->load('home/template','menu/coba/coba_data',$data);
    }
}