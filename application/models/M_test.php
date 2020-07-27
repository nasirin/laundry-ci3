<?php defined('BASEPATH') OR exit('No direct script access allowed');
class M_test extends CI_Model{
    
    function get($id = null){ 
        $this->db->from('order');
        if ($id != null) {
            $this->db->where('id_order',$id);
        }
        $this->db->order_by('id_order','desc');
        $query = $this->db->get()->result();
        return $query;
    }
    private function _get_kode(){
        $code = $this->db->query("SELECT MAX(RIGHT(kode_order,3)) AS kd_order FROM order");
        $kd = "";
        if($code->num_rows()>0){
            foreach($code->result() as $k){
                $tmp = ((int)$k->kd_order)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        return "ORD".'-'.date('my').'-'.$kd;
    }

    public function add($post){

        $params['kode_order'] = $this->_get_kode();
        if (!empty($post['member'])) {
            $params['id_member'] = $post['member'];
        }
        $params['id_product']=$post['idproduct'];
        if (!empty($post['idinventory'])) {
            $params['id_inventory'] = $post['idinventory'];
        }
        if (!empty($post['idpromo'])) {
            $params['id_promo'] = $post['idpromo'];
        }
        $params['kode_order'] = $this->_get_kode();
        if (!empty($post['nama'])) {
            $params['nama_pelanggan'] = $post['nama'];
        }
        $params['berat'] = $post['berat'];
        if (!empty($post['keterangan'])) {
            $params['keterangan'] = $post['keterangan'];
        }
        $params['total_harga'] = $post['total'];
        $params['tanggal_masuk'] = date('d-m-y');
        $params['status'] = 1;
        $params['id_karyawan'] = $this->session->userdata('iduser');
        $this->db->insert('order',$params); 
    }

    public function del($id)
	{
        $this->db->where('id_order',$id);
        $this->db->delete('order');
    }
    
    public function edit($post)
    {
        $params['nama_barang'] = $post['nama'];
        $params['varian'] = $post['varian'];
        $params['quantity'] = $post['qty'];
        $params['harga_beli'] = $post['beli'];
        $params['supplier'] = $post['supplier'];
        $params['updated'] = date('d-m-Y');        
        $this->db->where('id_order', $post['idinv']);
        $this->db->update('order', $params);
    }
}