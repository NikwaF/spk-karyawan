<?php 

class M_range_nilai extends CI_Model {
  public function get_range($id = null,$where = null)
  {
    if($id === null){
      $this->db->select('a.id_parameter,a.id_kriteria,a.nm_parameter,a.nilai,a.status,c.tahun,c.periode');
      if($where !== null){
        $this->db->where($where);
      }
      $this->db->join('kriteria b','a.id_kriteria = b.id_kriteria');
      $this->db->join('periode_kriteria c','b.id_periode = c.id_periode');
      $this->db->order_by('nilai','desc');
      return $this->db->get('parameter a')->result();
    } else {
      $this->db->select('a.id_parameter,a.id_kriteria,a.nm_parameter,a.nilai,a.status,c.tahun,c.periode');
      $this->db->where('id_parameter',$id);
      if($where !== null){
        $this->db->where($where);
      }
      $this->db->join('kriteria b','a.id_kriteria = b.id_kriteria');
      $this->db->join('periode_kriteria c','b.id_periode = c.id_periode');
      return $this->db->get('parameter a')->row();
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