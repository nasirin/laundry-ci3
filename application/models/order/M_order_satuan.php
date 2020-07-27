<?php defined('BASEPATH') OR exit('No direct script access allowed');
class M_order_satuan extends CI_Model{
    
    public function get($id = null){  
        $this->db->from('order_satuan');
        $this->db->join('member','member.id_member = order_satuan.id_member','left');
        $this->db->join('product_satuan','product_satuan.id_product_satuan = order_satuan.id_product_satuan','left');
        $this->db->join('inventory','inventory.id_inventory = order_satuan.id_inventory','left');
        $this->db->join('promo','promo.id_promo = order_satuan.id_promo','left');
        $this->db->join('karyawan','karyawan.id_karyawan = order_satuan.id_karyawan');
        if ($id != null) {
            $this->db->where('id_order_satuan',$id);
        }
        $this->db->order_by('id_order_satuan','desc'); 
        $query = $this->db->get()->result();
        return $query;
    }
    private function _get_kode(){
        $code = $this->db->query("SELECT MAX(RIGHT(kode_order_satuan,3)) AS kd_order FROM order_satuan");
        $kd = "";
        if($code->num_rows()>0){
            foreach($code->result() as $k){
                $tmp = ((int)$k->kd_order)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        return "ORD/S".'-'.date('my').'-'.$kd;
    }

    public function add($post){

        $params['kode_order_satuan'] = $this->_get_kode();
        if (!empty($post['member'])) {
            $params['id_member'] = $post['member'];
        }
        $params['id_product_satuan']=$post['idproduct'];
        if (!empty($post['idinventory'])) {
            $params['id_inventory'] = $post['idinventory'];
        }
        if (!empty($post['idpromo'])) {
            $params['id_promo'] = $post['idpromo'];
        }
        if (!empty($post['nama'])) {
            $params['nama_pelanggan_satuan'] = $post['nama'];
        }
        $params['jumlah_satuan'] = $post['jumlah'];
        if (!empty($post['keterangan'])) {
            $params['keterangan_satuan'] = $post['keterangan'];
        }
        $params['total_harga_satuan'] = $post['total'];
        $params['tanggal_masuk_satuan'] = date('d-M-Y');
        $params['tanggal_keluar_satuan'] = $post['akhir'];
        $params['status_satuan'] = 1;
        $params['id_karyawan'] = $this->session->userdata('iduser');
        $this->db->insert('order_satuan',$params); 
    }

    public function del($id)
	{
        $this->db->where('id_order_satuan',$id);
        $this->db->delete('order_satuan');
    }
    
    public function edit($post)
    {
        if (!empty($post['member'])) {
            $params['id_member']=$post['member'];
        }
        if (!empty($post['nama'])) {
            $params['nama_pelanggan_satuan']=$post['nama'];
        }
        if (!empty($post['idinventory'])) {
            $params['id_inventory']=$post['idinventory'];
        }
        $params['keterangan_satuan'] = $post['keterangan']; 
        $this->db->where('id_order_satuan', $post['idorder_k']);
        $this->db->update('order_satuan', $params);
    }

    public function cari($post)
    {   $this->db->join('member','member.id_member = order_satuan.id_member');
        $this->db->like('kode_order_satuan',$post);
        $this->db->or_like('nama_member',$post);
        $this->db->or_like('nama_pelanggan_satuan',$post);
        $query = $this->db->get('order_satuan')->result();
        return $query;
    }
}