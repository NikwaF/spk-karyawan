<?php 



class Penilaian extends CI_Controller{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_penilaian','penilaian');
  }

  public function index()
  {
    $data['judul'] = 'Penilaian Karyawan';
    if(isset($_POST['tahun']) && isset($_POST['periode'])){
      $this->session->set_userdata(['tahun-nilai' => $_POST['tahun'],'periode-nilai' => $_POST['periode']]);
      if($this->session->userdata('tahun-nilai') && $this->session->userdata('periode-nilai')){
        $id_periode = $this->penilaian->get_id_periode();

        if($id_periode !== null){
          $data['karyawan'] = $this->get_karyawan();
          $data['kriteria'] = $this->get_kriteria();
          $data['mode'] = 'bisa';
        } else{ 
          $data['kriteria'] = [];
          $data['mode'] = 'ehem';
        }
      } 
    } else{ 
      if($this->session->userdata('tahun-nilai') && $this->session->userdata('periode-nilai')){
        $id_periode = $this->penilaian->get_id_periode();
        if($id_periode !== null){
          $data['mode'] = 'bisa';
          $data['karyawan'] = $this->get_karyawan();
          $data['kriteria'] = $this->get_kriteria();
        } else{
          $data['kriteria'] = [];
          $data['mode'] = 'ehem';
        }
      } else{ 
        $data['kriteria'] = [];
      }
    }
  
    $this->load->view(HEADER, $data);
    $this->load->view(SIDEBAR_KETUA);
    $this->load->view(HRD.'penilaian/view_penilaian');
    $this->load->view(FOOTER);
  }

  private function get_karyawan()
  {
    $this->load->model('M_karyawan', 'karyawan');
    
    $id_periode = $this->get_id_periode(); 
    $where = ['a.status' => 1, 'a.id_divisi' => $_SESSION['id_divisi']];
    $karyawan = $this->karyawan->get_karyawan();
    $sql =  "select id_karyawan from penilaian where id_periode =". $id_periode;
    $query = $this->db->query($sql)->result();

    $karyawannya = [];

    foreach ($karyawan as $ky) {
      if(count($query) > 0){
        if(array_search($ky->id_karyawan, array_column($query, 'id_karyawan')) === false){
         array_push($karyawannya,$ky);
        }
      }else{ 
        array_push($karyawannya,$ky);
      }
    }

    return ['karyawan' => $karyawannya];
  }

  public function testing()
  {
    echo $this->session->userdata('tahun-nilai');
  }

  private function get_id_periode()
  {
    $id = $this->penilaian->get_id_periode();
    return $id;
  }



  private function get_kriteria()
  {
    $id_periode = $this->get_id_periode(); 
    $sql_kriteria = "select id_kriteria,nm_kriteria,status from kriteria where status = 1 AND id_periode=". $id_periode ;
    $exec_kriteria = $this->db->query($sql_kriteria)->result();

    $kumplan = [];

    for($i=0; count($exec_kriteria) > $i ; $i++){
      $kumplan[$i]['id_kriteria'] = $exec_kriteria[$i]->id_kriteria;
      $kumplan[$i]['nama_kriteria'] = $exec_kriteria[$i]->nm_kriteria;
      $sql_range = "select id_parameter,nm_parameter,nilai from parameter where status = 1 AND id_kriteria=".  $exec_kriteria[$i]->id_kriteria. ' order by nilai DESC';
      $exec_range = $this->db->query($sql_range)->result();
      $kumplan[$i]['parameter'] = $exec_range;
    }

    return $kumplan;
  }


  public function insert()
  {
    $post = $this->input->post();
    $id_periode = $this->get_id_periode(); 
    $sql_kriteria = "select id_kriteria from kriteria where status = 1 AND id_periode=". $id_periode ;
    $exec_kriteria = $this->db->query($sql_kriteria)->result();

    $this->db->trans_start();
    $penilaian = ['id_karyawan' => $post['nm_karyawan'], 'id_periode' => $id_periode, 'id_user' => $this->session->userdata('id_user'),'status' => 1, 'created_at' => date('Y-m-d H:i:s')];
    $this->db->insert('penilaian',$penilaian);
    $id_penilaian = $this->db->insert_id();

    foreach ($exec_kriteria as $val) {
      $id_kriteria = $val->id_kriteria;
      $nilai = $post['kriteria'.$id_kriteria];

      $detail = ['id_penilaian' => $id_penilaian, 'id_kriteria' => $id_kriteria, 'nilai' => $nilai]; 
      $this->db->insert('penilaian_detail',$detail);
    }
    $this->db->trans_complete();


    if($this->db->trans_status()){
      $this->session->set_flashdata('success', 'Penilaian Berhasil');
      $this->session->set_flashdata('key', 'success');
      redirect('penilaian');
    } else{ 
      $this->session->set_flashdata('danger', 'Penilaian tidak Berhasil');
      $this->session->set_flashdata('key', 'danger');
      redirect('penilaian');
    }
  }
} 