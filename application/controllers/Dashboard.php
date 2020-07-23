<?php 

class Dashboard extends CI_Controller{
  public function __construct()
  {
    parent::__construct();
    not_login();
  }

  
  public function hrd()
  {
    $data['judul'] = 'Dashboard Admin';
    $data['tot_karyawan'] = $this->total_karyawan();
    $this->load->view(HEADER, $data);
    $this->load->view(SIDEBAR_HRD);
    $this->load->view(HRD.'dashboard');
    $this->load->view(FOOTER);    
  }

  public function admin()
  {
    $data['judul'] = 'Dashboard Admin';
    $data['tot_karyawan'] = $this->total_karyawan();
    $this->load->view(HEADER, $data);
    $this->load->view(SIDEBAR_ADMIN);
    $this->load->view(ADMIN.'dashboard');
    $this->load->view(FOOTER);
  }

  public function ketua()
  {
    $data['judul'] = 'Dashboard Ketua';
    $data['tot_karyawan'] = $this->total_karyawan_ketua();
    $data['divisi'] = $this->nama_divisi();
    $this->load->view(HEADER, $data);
    $this->load->view(SIDEBAR_KETUA);
    $this->load->view(KETUA.'dashboard');
    $this->load->view(FOOTER);
  }  

  public function nama_divisi()
  {
    $sql = "select nm_divisi from divisi where id_divisi=".$_SESSION['id_divisi']; 
    $query = $this->db->query($sql)->row();
    return $query;
  }

  private function total_karyawan_ketua()
  {
    $sql = "select count(id_karyawan) total from karyawan where status = 1 AND id_divisi =".$_SESSION['id_divisi'];
    $query = $this->db->query($sql)->row();
    return $query;
  }  

  private function total_karyawan()
  {
    $sql_divisi = "select id_divisi,nm_divisi from divisi where status=1";
    $exec_divisi = $this->db->query($sql_divisi)->result();
    
    
    if(count($exec_divisi) > 0){
      $hasil = [];
      
      foreach ($exec_divisi as $val) {
        $sql_total = "select count(id_karyawan) total from karyawan where status = 1 AND id_divisi = ".$val->id_divisi;
        $exec_total = $this->db->query($sql_total)->row();
        
        $brow = ['nm_divisi' => $val->nm_divisi, 'total' => $exec_total->total];
        
        array_push($hasil,$brow);
      }

      return $hasil;
      
      
      
    } else{ 
      return [];
    }


  }

} 