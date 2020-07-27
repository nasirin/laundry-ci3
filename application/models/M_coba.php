<?php

class M_coba extends CI_Model{

    public function get_kode()
    {
        $kode = 'kar';
        $query = 'SELECT max(nip) as kode_kar from nip';
        $data = $this->db->query($query)->row_array();
        $inis = $data['kode_kar'];
        $max_kode = (int)substr($inis,6);
        $count = $max_kode + 1;
        $branch = 10;//kode toko
        $auto = $kode.'-'.$branch.sprintf('%s',$count);
        return $auto;
    }
}