<?php defined('BASEPATH') OR exit('No direct script access allowed');
class M_employee extends CI_Model{
    
    function get($id = null){ 
        $this->db->select('*');
        $this->db->from('karyawan');
        $this->db->join('level','level.id_level = karyawan.id_level');
        if ($id != null) {
            $this->db->where('id_karyawan',$id);
        }
        $this->db->order_by('id_karyawan','desc');
        $query = $this->db->get();
        return $query;
    }
    private function _get_kode(){
        $nip = $this->db->query("SELECT MAX(RIGHT(NIP,3)) AS kd_kar FROM karyawan");
        $branch = $this->input->post('branch');
        $kd = "";
        if($nip->num_rows()>0){
            foreach($nip->result() as $k){
                $tmp = ((int)$k->kd_kar)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        return "KAR".'-'.$branch.'-'.date('my').'-'.$kd;
    }

    public function add($post){

        $params['NIP'] = $this->_get_kode();
        $params['id_level'] = $post['level'];
        $params['nama_karyawan'] = $post['nama'];
        $params['email'] = $post['email'];
        if (empty($post['password'])) {
            $params['password'] = md5(12345); //default
        }else{
            $params['password'] = md5($post['password']) ; 
        }
        $params['notelp_karyawan'] = $post['notelp'];
        $params['branch'] = $post['branch'];
        $params['alamat_karyawan'] = $post['alamat'];
        $params['photo_karyawan'] = $post['img']; 
        $params['status_karyawan'] = $post['status']; 
        $params['created'] = date('d-m-Y');
        $this->db->insert('karyawan',$params); 
    }

    public function del($id)
	{
        $this->db->where('id_karyawan',$id);
        $this->db->delete('karyawan');
    }
    
    public function edit($post)
    {
        $params['id_level'] = $post['level'];
        $params['nama_karyawan'] = $post['nama'];
        $params['email'] = $post['email'];
        if (!empty($post['password'])) {
            $params['password'] = md5($post['password']);
        }
        $params['notelp_karyawan'] = $post['notelp'];
        $params['alamat_karyawan'] = $post['alamat'];
        if (!empty($post['img'])) {
            $params['photo_karyawan'] = $post['img'];
        }
        $params['status_karyawan'] = $post['status'];
        $params['updated'] = date('d-m-Y');        
        $this->db->where('id_karyawan', $post['idkar']);
        $this->db->update('karyawan', $params);
    }

    public function cek_email($email, $id = null)
    {
        $this->db->from('karyawan');
        $this->db->where('email',$email);
        if ($id != null) {
            $this->db->where('id_karyawan !=',$id);
        }
        $query = $this->db->get();
        return($query);
    }
}