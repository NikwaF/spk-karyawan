<?php 


class M_kriteria extends CI_Model{
  public function get_kriteria($id = null,$where = null)
  {
    if($id === null){
      $this->db->select('a.id_kriteria,a.bobot,a.id_periode,a.nm_kriteria,a.status,b.tahun,b.periode');
      if($where !== null){
        $this->db->where($where);
      }
      $this->db->join('periode_kriteria b','b.id_periode = a.id_periode');
      return $this->db->get('kriteria a')->result();
    } else {
      $this->db->select('a.id_kriteria,a.bobot,a.id_periode,a.nm_kriteria,a.status,b.tahun,b.periode');
      $this->db->where('a.id_kriteria',$id);
      if($where !== null){
        $this->db->where($where);
      }
      $this->db->join('periode_kriteria b','a.id_periode = b.id_periode');
      return $this->db->get('kriteria a')->row();
    }
  }

  private function get_id_periode($periode,$tahun){
    $this->db->select('id_periode');
    $this->db->where(['periode' => $periode, 'tahun' => $tahun]);
    $id = $this->db->get('periode_kriteria')->row();

    if($id !== null){
      return $id->id_periode;
    }

    $this->db->insert('periode_kriteria',['periode' => $periode, 'tahun' => $tahun, 'status' => 1]);
    $idnya = $this->db->insert_id();

    return $idnya;
  }
  
  public function insert_kriteria($nm)
  {
    $nm['id_periode'] = $this->get_id_periode($nm['periode'],$nm['tahun']);
    unset($nm['periode']);
    unset($nm['tahun']);
    return $this->db->insert('kriteria',$nm);
  }

  public function update_kriteria($id,$data)
  {
    if(isset($data['periode']) && isset($data['tahun'])){
      $data['id_periode'] = $this->get_id_periode($data['periode'],$data['tahun']);
      unset($data['periode']);
      unset($data['tahun']);
    }
    $this->db->where('id_kriteria',$id);
    return $this->db->update('kriteria',$data);
  }    
}