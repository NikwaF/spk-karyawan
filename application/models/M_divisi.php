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

  public function dapet_id($id)
  {
    $this->db->select('a.id_divisi divisi,a.id_ketua_divisi ketua,b.id_user user');
    $this->db->from('divisi a');
    $this->db->join('ketua_divisi b', 'a.id_ketua_divisi = b.id_ketua_divisi');
    $this->db->where('a.id_divisi',$id);
    return $this->db->get()->row();
  }

  public function get_divisi_ketua($id = null)
  {
    $this->db->select('a.id_divisi,a.status,c.username,a.nm_divisi,c.nama,b.alamat,b.nohp,a.id_ketua_divisi,b.id_user');
    $this->db->from('divisi a');
    $this->db->join('ketua_divisi b','a.id_ketua_divisi = b.id_ketua_divisi');
    $this->db->join('user c','b.id_user = c.id_user');
    if($id === null){
      return $this->db->get()->result();
    } else {
      $this->db->where('id_divisi',$id);
      return $this->db->get()->row();
    }
  }

  public function insert_divisi($table,$nm)
  {
    return $this->db->insert($table,$nm);
  }

  public function update_divisi($table,$id,$data)
  {
    $this->db->where($id);
    return $this->db->update($table,$data);
  }  
}