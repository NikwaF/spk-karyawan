<?php 

class M_range_nilai extends CI_Model {
  public function get_range($id = null,$where = null)
  {
    if($id === null){
      if($where !== null){
        $this->db->where($where);
      }
      $this->db->order_by('nilai','dsc');
      return $this->db->get('parameter')->result();
    } else {
      $this->db->where('id_parameter',$id);
      return $this->db->get('parameter')->row();
    }
  }

  public function insert_range($nm)
  {
    return $this->db->insert('parameter',$nm);
  }

  public function update_range($id,$data)
  {
    $this->db->where('id_parameter',$id);
    return $this->db->update('parameter',$data);
  }  
} 