<?php 

class M_penilaian extends CI_Model{
  

  public function get_id_periode($periode,$tahun){
    $this->db->select('id_periode');
    $this->db->where(['periode' => $periode, 'tahun' => $tahun]);
    $id = $this->db->get('periode_kriteria')->row();

    if($id !== null){
      return $id->id_periode;
    }
  }

}