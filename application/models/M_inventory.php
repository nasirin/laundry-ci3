<?php defined('BASEPATH') OR exit('No direct script access allowed');
class M_inventory extends CI_Model{
    
    function get($id = null){ 
        $this->db->from('inventory');
        $this->db->join('karyawan','karyawan.id_karyawan = inventory.id_karyawan');
        if ($id != null) {
            $this->db->where('id_inventory',$id);
        }
        $this->db->order_by('id_inventory','desc');
        $query = $this->db->get()->result();
        return $query;
    }

    function get_all()
    {
        $this->db->select('varian_inventory,id_inventory,quantity_inventory');
        $this->db->from('inventory');
        $query = $this->db->get();
        return $query;
    }

    private function _get_kode(){
        $code = $this->db->query("SELECT MAX(RIGHT(kode_inventory,3)) AS kd_inv FROM inventory");
        $kd = "";
        if($code->num_rows()>0){
            foreach($code->result() as $k){
                $tmp = ((int)$k->kd_inv)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        return "INV".'-'.date('my').'-'.$kd;
    }

    public function add($post){

        $params['kode_inventory'] = $this->_get_kode();
        $params['id_karyawan'] = $this->session->userdata('iduser');
        $params['nama_barang'] = $post['nama'];
        $params['varian_inventory'] = $post['varian'];
        $params['quantity_inventory'] = $post['qty'];
        $params['harga_beli'] = $post['beli'];
        $params['supplier_inventory'] = $post['supplier'];
        $params['created'] = date('d-m-Y');
        $this->db->insert('inventory',$params); 
    }

    public function del($id)
	{
        $this->db->where('id_inventory',$id);
        $this->db->delete('inventory');
    }
    
    public function edit($post)
    {
        $params['nama_barang'] = $post['nama'];
        $params['varian_inventory'] = $post['varian'];
        $params['quantity_inventory'] = $post['qty'];
        $params['harga_beli'] = $post['beli'];
        $params['supplier_inventory'] = $post['supplier'];
        $params['updated'] = date('d-m-Y');        
        $this->db->where('id_inventory', $post['idinv']);
        $this->db->update('inventory', $params);
    }
}