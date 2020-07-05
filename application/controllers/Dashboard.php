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

  private function total_karyawan()
  {
    $sql = "select count(id_karyawan) total from karyawan where status = 1";

    $query = $this->db->query($sql)->row();
    return $query;
  }

} 