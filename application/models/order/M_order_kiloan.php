<?php defined('BASEPATH') OR exit('No direct script access allowed');
class M_order_kiloan extends CI_Model{
    
    public function get($id = null){  
        $this->db->from('order_kiloan');
        $this->db->join('member','member.id_member = order_kiloan.id_member','left');
        $this->db->join('product_kiloan','product_kiloan.id_product_kiloan = order_kiloan.id_product_kiloan','left');
        $this->db->join('inventory','inventory.id_inventory = order_kiloan.id_inventory','left');
        $this->db->join('promo','promo.id_promo = order_kiloan.id_promo','left');
        $this->db->join('karyawan','karyawan.id_karyawan = order_kiloan.id_karyawan');
        if ($id != null) {
            $this->db->where('id_order_kiloan',$id);
        }
        $this->db->order_by('id_order_kiloan','desc'); 
        $query = $this->db->get()->result();
        return $query;
    }
    private function _get_kode(){
        $code = $this->db->query("SELECT MAX(RIGHT(kode_order_kiloan,3)) AS kd_order FROM order_kiloan");
        $kd = "";
        if($code->num_rows()>0){
            foreach($code->result() as $k){
                $tmp = ((int)$k->kd_order)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        return "ORD/K".'-'.date('my').'-'.$kd;
    }

    public function add($post){

        $params['kode_order_kiloan'] = $this->_get_kode();
        if (!empty($post['member'])) {
            $params['id_member'] = $post['member'];
        }
        $params['id_product_kiloan']=$post['idproduct'];
        if (!empty($post['idinventory'])) {
            $params['id_inventory'] = $post['idinventory'];
        }
        if (!empty($post['idpromo'])) {
            $params['id_promo'] = $post['idpromo'];
        }
        if (!empty($post['nama'])) {
            $params['nama_pelanggan_kiloan'] = $post['nama'];
        }
        $params['berat'] = $post['berat'];
        if (!empty($post['keterangan'])) {
            $params['keterangan_kiloan'] = $post['keterangan'];
        }
        $params['total_harga_kiloan'] = $post['total'];
        $params['tanggal_masuk_kiloan'] = date('d-M-Y');
        $params['tanggal_keluar_kiloan'] = $post['akhir'];
        $params['status_kiloan'] = 1;
        $params['id_karyawan'] = $this->session->userdata('iduser');
        $this->db->insert('order_kiloan',$params); 
    }

    public function del($id)
	{
        $this->db->where('id_order_kiloan',$id);
        $this->db->delete('order_kiloan');
    }
    
    public function edit($post)
    {
        if (!empty($post['member'])) {
            $params['id_member']=$post['member'];
        }
        if (!empty($post['nama'])) {
            $params['nama_pelanggan_kiloan']=$post['nama'];
        }
        if (!empty($post['idinventory'])) {
            $params['id_inventory']=$post['idinventory'];
        }
        $params['keterangan_kiloan'] = $post['keterangan']; 
        $this->db->where('id_order_kiloan', $post['idorder_k']);
        $this->db->update('order_kiloan', $params);
    }

    public function cari($post)
    {   $this->db->join('member','member.id_member = order_kiloan.id_member');
        $this->db->like('kode_order_kiloan',$post);
        $this->db->or_like('nama_member',$post);
        $this->db->or_like('nama_pelanggan_kiloan',$post);
        $query = $this->db->get('order_kiloan')->result();
        return $query;
    }
}