<?php

class M_package extends CI_Model{

    function get_package($id = null){ 
        $this->db->from('package');
        if ($id != null) {
            $this->db->where('id_package',$id);
        }
        $this->db->order_by('id_package','desc');
        $query = $this->db->get()->result();
        return $query;
    }
    function get_products($id = null){ 
        $this->db->from('products');
        if ($id != null) {
            $this->db->where('id_product',$id);
        }
        $this->db->order_by('id_product','desc');
        $query = $this->db->get()->result();
        return $query;
    }
    function get_detail($id = null)
    {        
        $this->db->from('detail');
        $this->db->join('products','products.id_product = detail.id_detail_product','left');
        $this->db->join('package','package.id_package = detail.id_detail_package');
        if ($id != null){
            $this->db->where('id_detail',$id);
        }
        $this->db->order_by('id_detail','desc');
        $query = $this->db->get()->result();
        return $query;
    }    

    public function add($post){

        $params['nama_package'] = $post['nama'];
        $this->db->insert('package',$params);

        $get_idinv = $this->db->insert_id();
        $result = array();
        $data = $post['idprod'];
        $data = $post['jumlah'];
        foreach($data as $key => $val){
            $result[] = array(
                'id_detail_package' =>$get_idinv,
                'id_detail_product' =>$post['idprod'][$key],
                'jumlah' =>$post['jumlah'][$key]
            );
        }
        $this->db->insert_batch('detail',$result);
    }
    public function edit($post)
    {
        $params['nama_package'] = $post['nama'];     
        $this->db->where('id_package', $post['idpack']);
        $this->db->update('package', $params);

        //DELETE DETAIL PACKAGE
        $this->db->where('id_detail_package', $post['idpack']);
        $this->db->delete('detail');

        $result = array();
        $data = $post['idprod'];
        $data = $post['jumlah'];
        foreach($data as $key => $val){
            $result[] = array(
                'id_detail_package' => $post['idpack'],
                'id_detail_product' =>$post['idprod'][$key],
                'jumlah' =>$post['jumlah'][$key]
            );
        }
        $this->db->insert_batch('detail',$result);        
    } 

    public function del($id)
	{
        $this->db->where('id_package',$id);
        $this->db->delete('package');
    }
    
}