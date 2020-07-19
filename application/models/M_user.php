<?php 

class M_user extends CI_Model{

  public function auth_user($username)
  {
    $this->db->where('username',$username);
    return $this->db->get('user')->row();
  }

  public function cek_user($where)
  {
    $this->db->where($where);
    return $this->db->get('user')->row();
  }  
}