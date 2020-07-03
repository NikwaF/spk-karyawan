<?php 

class M_divisi extends CI_Model {
  public function get_divisi($id = null,$where = null)
  {
    if($id === null){
      if($where !== null){
        $this->db->where($where);
      }
      return $this->db->get('divisi')->result();
    } else {
      $this->db->where('id_divisi',$id);
      return $this->db->get('divisi')->row();
    }
  }

  public function insert_divisi($nm)
  {
    return $this->db->insert('divisi',$nm);
  }

  public function update_divisi($id,$data)
  {
    $this->db->where('id_divisi',$id);
    return $this->db->update('divisi',$data);
  }  
}