<?php 

class Laporan extends CI_Controller{

  
  public function index()
  {
    $data['judul'] = 'Perangkingan Karyawan';
    $this->load->model('M_divisi','divisi');
    $data['divisi'] = $this->divisi->get_divisi(null,['status' => 1]);
    if(isset($_POST['tahun']) && isset($_POST['periode'])){
      $_SESSION['divisi'] = $_POST['divisi'];
      $this->session->set_userdata(['tahun-nilai' => $_POST['tahun'],'periode-nilai' => $_POST['periode']]);
      if($this->session->userdata('tahun-nilai') && $this->session->userdata('periode-nilai')){
        $id_periode = $this->get_id_periode();

        if($id_periode !== null){
          $rangking = $this->rangking();
          $this->array_sort_by_column($rangking, 'nilai_akhir');
          $data['rangking'] = $rangking;
        } else{ 
          $data['rangking'] = [];
        }
      } 
    } else{ 
      if($this->session->userdata('tahun-nilai') && $this->session->userdata('periode-nilai')){
        $id_periode = $this->get_id_periode();
        if($id_periode !== null){
          $rangking = $this->rangking();
          $this->array_sort_by_column($rangking, 'nilai_akhir');
          $data['rangking'] = $rangking;
        } else{
          $data['rangking'] = [];
        }
      } else{
        $data['rangking'] = [];
      } 
    }

    $this->load->view(HEADER, $data);
    $this->load->view(SIDEBAR_ADMIN);
    $this->load->view(ADMIN.'laporan/view_laporan');
    $this->load->view(FOOTER);
  }  

  private function array_sort_by_column(&$arr, $col, $dir = SORT_DESC){
    $sort_col = array();
    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }

    array_multisort($sort_col, $dir, $arr);
  }
  
  private function get_id_periode()
  {
    $this->load->model('M_penilaian','penilaian');
    $id = $this->penilaian->get_id_periode();
    return $id;
  }
  
  public function rangking()
  {
    $id_periode = $this->get_id_periode();
    
    $sql_karyawan = "select id_karyawan,nama,divisi.nm_divisi,email,agama,foto,jns_kelamin,no_hp,tgl_lahir,tempat_lahir,alamat,status_menikah from karyawan join divisi on divisi.id_divisi = karyawan.id_divisi where karyawan.status = 1";

    if($_SESSION['divisi'] !== 'semua'){
     $sql_karyawan = "select id_karyawan,nama,divisi.nm_divisi,email,agama,foto,jns_kelamin,no_hp,tgl_lahir,tempat_lahir,alamat,status_menikah from karyawan join divisi on divisi.id_divisi = karyawan.id_divisi where karyawan.status = 1 AND karyawan.id_divisi =".$_SESSION['divisi'];
    }

    $exec_karyawan = $this->db->query($sql_karyawan)->result();
    $sql_kriteria = "select id_kriteria,nm_kriteria,bobot from kriteria where status = 1 AND id_periode=".$id_periode;
    $exec_kriteria = $this->db->query($sql_kriteria)->result();
    $sql_sum = "select sum(bobot) bobot from kriteria where status = 1 AND id_periode=".$id_periode;
    $exec_sum = $this->db->query($sql_sum)->row();

    $nilai_utility = [];
    $nilai_akhir = 0;
    for($i=0; count($exec_karyawan) > $i ; $i++){
      $ada_gak = 'ada';
      $nilai_akhir = 0;

      for($j=0; count($exec_kriteria) > $j ; $j++){
        $sql_min = "select min(nilai) nilai_min from parameter where status = 1 AND id_kriteria = ".$exec_kriteria[$j]->id_kriteria;
        $exec_min = $this->db->query($sql_min)->row();
        $sql_max = "select max(nilai) nilai_max from parameter where status = 1 AND id_kriteria = ".$exec_kriteria[$j]->id_kriteria;
        $exec_max = $this->db->query($sql_max)->row();
        
        $sql_nilai = "select b.nilai from penilaian a join penilaian_detail b on a.id_penilaian = b.id_penilaian where a.id_periode=".$id_periode. " AND id_karyawan=".$exec_karyawan[$i]->id_karyawan. ' AND b.id_kriteria='.$exec_kriteria[$j]->id_kriteria;
        $exec_nilai = $this->db->query($sql_nilai)->row();

        if($exec_nilai !== null){
          $nilai_utility[$i]['nilai'][$j]['id_kriteria'] = $exec_kriteria[$j]->id_kriteria;
          $nilai_utility[$i]['nilai'][$j]['nama_kriteria'] = $exec_kriteria[$j]->nm_kriteria;
          $nilai_utility[$i]['nilai'][$j]['bobot_normalisasi'] =round(($exec_kriteria[$j]->bobot / $exec_sum->bobot),2);
          $nilai_utility[$i]['nilai'][$j]['nilai_utility'] = round(($exec_nilai->nilai - $exec_min->nilai_min)/ ($exec_max->nilai_max - $exec_min->nilai_min),2);
          $nilai_utility[$i]['nilai'][$j]['nilai'] = $exec_nilai->nilai;
          $normalisasi_bobot = $exec_kriteria[$j]->bobot / $exec_sum->bobot;

          $nilai_akhir += ($exec_nilai->nilai - $exec_min->nilai_min)/ ($exec_max->nilai_max - $exec_min->nilai_min) * ($exec_kriteria[$j]->bobot / $exec_sum->bobot);
        } else{
          $ada_gak = 'tidak_ada';
          continue;
        }
      }
      if($ada_gak === 'ada'){
        $nilai_utility[$i]['id_alternatif'] = $exec_karyawan[$i]->id_karyawan;
        $nilai_utility[$i]['alternatif'] = $exec_karyawan[$i]->nama;
        $nilai_utility[$i]['agama'] = $exec_karyawan[$i]->agama;
        $nilai_utility[$i]['jns_kelamin'] = $exec_karyawan[$i]->jns_kelamin;
        $nilai_utility[$i]['email'] = $exec_karyawan[$i]->email;
        $nilai_utility[$i]['no_hp'] = $exec_karyawan[$i]->no_hp;
        $nilai_utility[$i]['foto'] = $exec_karyawan[$i]->foto;
        $nilai_utility[$i]['tgl_lahir'] = tgl_indo($exec_karyawan[$i]->tgl_lahir);
        $nilai_utility[$i]['tempat_lahir'] = $exec_karyawan[$i]->tempat_lahir;
        $nilai_utility[$i]['alamat'] = $exec_karyawan[$i]->alamat;
        $nilai_utility[$i]['status_menikah'] = $exec_karyawan[$i]->status_menikah;        
        $nilai_utility[$i]['divisi'] = $exec_karyawan[$i]->nm_divisi;
        $nilai_utility[$i]['nilai_akhir'] = round($nilai_akhir,5);
      }
    }
    return $nilai_utility;
  }
}