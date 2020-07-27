<?php
class M_member extends CI_Model{

    function get($id = null){ 
        $this->db->select('*');
        $this->db->from('member');
        $this->db->join('level','level.id_level = member.id_level');
        if ($id != null) {
            $this->db->where('id_member',$id);
        }
        $this->db->order_by('id_member','desc');
        $query = $this->db->get();
        return $query;
    }

    function get_all(){
        $this->db->from('member');
        // $this->db->join('order_kiloan','order_kiloan.id_member = member.id_member','left');
        $query = $this->db->get();
        return $query;
    }

    private function _get_kode(){
        $nip = $this->db->query("SELECT MAX(RIGHT(kode_member,3)) AS kd_mb FROM member");
        $kd = "";
        if($nip->num_rows()>0){
            foreach($nip->result() as $k){
                $tmp = ((int)$k->kd_mb)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        return "MB".'-'.date('my').'-'.$kd;
    }

    public function add($post){

        $params['kode_member'] = $this->_get_kode();
        $params['id_level'] = 3;
        $params['nama_member'] = $post['nama'];
        $params['gender_member'] = $post['gender'];
        $params['notelp_member'] = $post['notelp'];
        $params['email'] = $post['email'];
        if (empty($post['password'])) {
            $params['password'] = md5(12345); //default
        }else{
            $params['password'] = md5($post['password']) ; 
        }
        $params['status_member'] = $post['status'];
        $params['photo_member'] = $post['img']; 
        $params['alamat_member'] = $post['alamat']; 
        $params['created'] = date('d-m-Y');
        $this->db->insert('member',$params); 
    }

    public function del($id)
	{
        $this->db->where('id_member',$id);
        $this->db->delete('member');
    }
    
    public function edit($post)
    {
        $params['id_level'] = 3;
        $params['nama_member'] = $post['nama'];
        $params['gender_member'] = $post['gender'];
        $params['notelp_member'] = $post['notelp'];
        $params['email'] = $post['email'];
        if (!empty($post['password'])) {
            $params['password'] = md5($post['password']);
        }
        $params['status_member'] = $post['status'];
        if (!empty($post['img'])) {
            $params['photo_member'] = $post['img'];
        }
        $params['alamat_member'] = $post['alamat'];
        $params['updated'] = date('d-m-Y');        
        $this->db->where('id_member', $post['idmb']);
        $this->db->update('member', $params);
    }

    public function cek_email($email, $id = null)
    {
        $this->db->from('member');
        $this->db->where('email',$email);
        if ($id != null) {
            $this->db->where('id_member !=',$id);
        }
        $query = $this->db->get();
        return($query);
    }
}
?>