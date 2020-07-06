<?php 

class M_penilaian extends CI_Model{
  

  public function get_id_periode(){
    $periode = $this->session->userdata('periode-nilai');
    $tahun = $this->session->userdata('tahun-nilai');
    $this->db->select('id_periode');
    $this->db->where(['periode' => $periode, 'tahun' => $tahun]);
    $id = $this->db->get('periode_kriteria')->row();

    if($id !== null){
      return $id->id_periode;
    } else{
      return null;
    }
  }

}