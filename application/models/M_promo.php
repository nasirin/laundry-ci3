<?php defined('BASEPATH') OR exit('No direct script access allowed');
class M_promo extends CI_Model{
    
    function get($id = null){ 
        $this->db->from('promo');
        if ($id != null) {
            $this->db->where('id_promo',$id);
        }
        $this->db->order_by('id_promo','desc');
        $query = $this->db->get();
        return $query;
    }

    function get_all()
    {
        $this->db->from('promo');
        $query = $this->db->get();
        return $query;
    }

    private function _get_kode(){
        $code = $this->db->query("SELECT MAX(RIGHT(kode_promo,3)) AS kd_promo FROM promo");
        $kd = "";
        if($code->num_rows()>0){
            foreach($code->result() as $k){
                $tmp = ((int)$k->kd_promo)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        return "ADS".'-'.date('my').'-'.$kd;
    }

    public function add($post){

        $params['kode_promo'] = $this->_get_kode();
        $params['nama_promo'] = $post['nama'];
        $params['value_jenis_promo'] = $post['value'];
        $params['keterangan_promo'] = $post['ket'];
        $params['status_promo'] = $post['status'];
        $params['mulai_promo'] = $post['mulai'];
        $params['akhir_promo'] = $post['akhir'];
        $params['photo_promo'] = $post['img'];
        $params['created'] = date('d-m-Y');
        $this->db->insert('promo',$params); 
    }

    public function del($id)
	{
        $this->db->where('id_promo',$id);
        $this->db->delete('promo');
    }
    
    public function edit($post)
    {
        $params['nama_promo'] = $post['nama'];
        $params['value_jenis_promo'] = $post['value'];
        $params['keterangan_promo'] = $post['ket'];
        $params['status_promo'] = $post['status'];
        $params['mulai_promo'] = $post['mulai'];
        $params['akhir_promo'] = $post['akhir'];
        if (!empty($post['img'])) {
            $params['photo_promo']=$post['img'];
        }        
        $params['updated'] = date('d-m-Y');        
        $this->db->where('id_promo', $post['idpromo']);
        $this->db->update('promo', $params);
    }
}