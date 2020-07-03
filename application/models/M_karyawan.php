<?php 

class M_karyawan extends CI_Model{
  public function get_karyawan($id = null)
  {
    if($id === null){
      $this->db->select('a.*,b.nm_divisi nm_divisi');
      $this->db->from('karyawan a');
      $this->db->join('divisi b','a.id_divisi = b.id_divisi');
      return $this->db->get()->result();
    } else {
      $this->db->select('a.*');
      $this->db->from('karyawan a');
      $this->db->where('id_karyawan',$id);
      return $this->db->get()->row();
    }
  }

  public function insert_karyawan($data)
  {
    return $this->db->insert('karyawan',$data);
  }

  public function update_karyawan($id,$data)
  {
    $this->db->where('id_karyawan',$id);
    return $this->db->update('karyawan',$data);
  }  

  
}