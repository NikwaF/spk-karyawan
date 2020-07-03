<?php 


class M_kriteria extends CI_Model{
  public function get_kriteria($id = null,$where = null)
  {
    if($id === null){
      if($where !== null){
        $this->db->where($where);
      }
      return $this->db->get('kriteria')->result();
    } else {
      $this->db->where('id_kriteria',$id);
      return $this->db->get('kriteria')->row();
    }
  }

  public function insert_kriteria($nm)
  {
    return $this->db->insert('kriteria',$nm);
  }

  public function update_kriteria($id,$data)
  {
    $this->db->where('id_kriteria',$id);
    return $this->db->update('kriteria',$data);
  }    
}