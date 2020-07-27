<?php defined('BASEPATH') OR exit('No direct script access allowed');
class M_product_kiloan extends CI_Model{ 
    
    function get($id = null){
        $this->db->from('product_kiloan');
        if ($id != null) {
            $this->db->where('id_product_kiloan',$id);
        }
        $this->db->order_by('id_product_kiloan','desc');
        $query = $this->db->get();
        return $query;
    }

    function get_all()
    {
        $this->db->from('product_kiloan');
        $this->db->order_by('id_product_kiloan','desc');
        $query = $this->db->get();
        return $query;
    }

    function get_detail($id = null)
    {
        // WHERE GAK JALAN ???
        $this->db->distinct();
        // $this->db->select('product_kiloan.*','product_kiloan.id_priduct_kiloan as id_product, product_kiloan.nama_product as nama','detail_product.*','inventory.*');
        // $this->db->from('detail_product');
        $this->db->from('product_kiloan');
        $this->db->join('detail_product','detail_product.id_detail_product_kiloan = product_kiloan.id_product_kiloan');
        $this->db->join('inventory','inventory.id_inventory = detail_product.id_detail_inventory');
        if ($id != null) {
            $this->db->where('id_detail_product_kiloan',$id);
        }
        // $this->db->group_by('id_detail_inventory');
        $query = $this->db->get();
        return $query;
    }

    private function _get_kode(){
        $code = $this->db->query("SELECT MAX(RIGHT(kode_product_kiloan,3)) AS kd_product FROM product_kiloan");
        $kd = "";
        if($code->num_rows()>0){
            foreach($code->result() as $k){
                $tmp = ((int)$k->kd_product)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        return "PROD/K".'-'.date('my').'-'.$kd;
    }

    public function add($post)
    {
        $params['kode_product_kiloan'] = $this->_get_kode();
        $params['nama_product_kiloan'] = $post['nama'];
        $params['harga_product_kiloan'] = $post['harga'];
        $params['durasi_kiloan'] = $post['durasi'];
        $params['status_kiloan'] = $post['status'];
        $params['created'] = date('d-m-Y');
        $this->db->insert('product_kiloan',$params); 

        $get_idprod = $this->db->insert_id();
        $result = array();
        $data = $post['idinv'];
        $data = $post['qty'];
        foreach($data as $b => $a){
            $result[] = array(
                'id_detail_product_kiloan' => $get_idprod,
                'id_detail_inventory' => $post['idinv'][$b],
                'jumlah_inventory' => $post['qty'][$b]
            );
        }
        $this->db->insert_batch('detail_product',$result);

    }

    public function del($id)
	{
        $this->db->where('id_product_kiloan',$id);
        $this->db->delete('product_kiloan');
    }
    
    public function edit($post)
    {
        $params['nama_product_kiloan'] = $post['nama'];
        $params['harga_product_kiloan'] = $post['harga'];
        $params['durasi_kiloan'] = $post['durasi'];
        $params['status_kiloan'] = $post['status'];
        $params['updated'] = date('d-m-Y h:i:s');      
        $this->db->where('id_product_kiloan', $post['idproduct']);
        $this->db->update('product_kiloan', $params);

        $edit = $post['idinv'];;
        $edit = $post['qty'];

        if (!empty($edit)) {
            //DELETE DETAIL PRODUCT
            $this->db->where('id_detail_product_kiloan', $post['idproduct']);
            $this->db->delete('detail_product');
    
            $result = array();
            $data = $post['idinv'];
            $data = $post['qty'];
            foreach($data as $key => $val){
                $result[] = array(
                    'id_detail_product_kiloan' => $post['idproduct'],
                    'id_detail_inventory' => $post['idinv'][$key],
                    'jumlah_inventory' => $post['qty'][$key]
                );
            }
            $this->db->insert_batch('detail_product',$result);
        }

    }
}