<?php 

function tgl_indo($tanggal)
{
  $bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
  $pecahkan = explode('-', $tanggal);
  
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

function not_login(){
  if(!isset($_SESSION['id_user'])){
    redirect(base_url());
  }
}

function check_login(){
  if(isset($_SESSION['id_user'])){
		if($_SESSION['role'] === 1){
			redirect(site_url('dashboard/admin'));
		} else if($_SESSION['role'] === 2){
			redirect(site_url('dashboard/hrd'));
		} else{ 
			redirect(site_url('dashboard/ketua'));

		}
  }
}