<?php defined('BASEPATH') OR exit('No direct script access allowed');
class M_auth extends CI_Model{
    
    function get($id = null){
        $this->db->from('karyawan');
        $this->db->join('level','level.id_level = karyawan.id_level');
        if ($id != null) {
            $this->db->where('id_karyawan',$id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function login($post){
        $this->db->from('karyawan');
        // $this->db->from('member');
        $this->db->join('level','level.id_level = karyawan.id_level');
        // $this->db->join('level','level.id_level = member.id_level');
        $this->db->where('email', $post['email']);
        $this->db->where('password',md5($post['password']));
        $query = $this->db->get();
        return $query;
    }

    public function login_member($post)
    {
        $this->db->from('member');
        $this->db->join('level','level.id_level = member.id_level');
        $this->db->where('email', $post['email']);
        $this->db->where('password',md5($post['password']));
        $query = $this->db->get();
        return $query;
    }
     
}