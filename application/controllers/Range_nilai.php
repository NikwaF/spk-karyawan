<?php 


class Range_nilai extends CI_Controller{
  public function __construct()
  {
    parent::__construct();
    not_login();
    $this->load->model('M_range_nilai','range');
  }

  public function index()
  {
    $data['judul'] = 'Range Nilai';
    if(!isset($_POST['tahun-filter']) && !isset($_POST['periode-filter'])){
      if($this->session->flashdata('tahun') && $this->session->flashdata('periode')){
        $data['periode'] =$this->session->flashdata('periode');
        $data['tahun'] =  $this->session->flashdata('tahun');
        $data['isinya'] = $this->get_all_range($this->session->flashdata('tahun'),$this->session->flashdata('periode'));
      } else{
        $data['isinya'] = 'ehem';
      }
    } else{ 
      $data['periode'] = $_POST['periode-filter'];
      $data['tahun'] =  $_POST['tahun-filter'];
      $data['isinya'] = $this->get_all_range($_POST['tahun-filter'],$_POST['periode-filter']);
    }
    $data['mode'] = 'tambah';
    $this->load->view(HEADER, $data);
    $this->load->view(SIDEBAR_ADMIN);
    $this->load->view(ADMIN.'range_nilai/view_range_nilai');
    $this->load->view(FOOTER);
  }

  public function get_kriteria()
  {
    $this->load->model('M_kriteria','kriteria');
    $where = ['b.tahun'=> $_POST['tahun'], 'b.periode' => $_POST['periode'],'a.status'=> 1];
    $data = $this->kriteria->get_kriteria(null,$where);
    echo json_encode($data);    
  }

  public function get_all_range($tahun,$periode)
  {
    $this->load->model('M_kriteria','kriteria');
    $kriteria = $this->kriteria->get_kriteria(null,['b.tahun'=> $tahun, 'b.periode' => $periode,'a.status'=> 1]);
    $aktif = [];
    $nonaktif = [];

    if(count($kriteria) !== 0){
   
      for($i =0; count($kriteria) > $i; $i++){
        $range = $this->range->get_range(null,['a.id_kriteria' => $kriteria[$i]->id_kriteria, 'a.status' => 1]);
          $aktif[$i] = array(
            'kriteria' => $kriteria[$i]->nm_kriteria,
            'parameter' => $range
          );
        }
    } 

    return $aktif;
  }

  public function insert()
  {
    $post = $this->input->post();

    $rules = array( 
      array(
        'field' => 'nama_parameter',
        'label' => 'Nama Parameter',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'nilai',
        'label' => 'Nilai Parameter',
        'rules' => 'trim|numeric|required'
      ),
      array(
        'field' => 'kriteria',
        'label' => 'Kriteria',
        'rules' => 'required'
      ),
      array(
        'field' => 'tahun',
        'label' => 'Tahun',
        'rules' => 'required'
      )

    );

    $this->form_validation->set_message('required','%s tidak boleh kosong');
    $this->form_validation->set_message('numeric','%s harus angka');
    $this->form_validation->set_rules($rules);    

    if($this->form_validation->run() === FALSE){
      $data['judul'] = 'Range Nilai';
      $data['isinya'] = 'ehem';
      $data['mode'] = 'tambah';
      $this->load->view(HEADER, $data);
      $this->load->view(SIDEBAR_ADMIN);
      $this->load->view(ADMIN.'range_nilai/view_range_nilai');
      $this->load->view(FOOTER);

      return;
    }   

    $insertkan = $this->range->insert_range(['id_kriteria' => $post['kriteria'],'nm_parameter' => $post['nama_parameter'],'nilai' => $post['nilai'], 'status' => 1,'created_at' => date('Y-m-d H:i:s')]);

    if($insertkan){
      $this->session->set_flashdata('success', 'Data berhasil Ditambahkan');
      $this->session->set_flashdata('key', 'success');
      $this->session->set_flashdata('tahun',$_POST['tahun']);
      $this->session->set_flashdata('periode',$_POST['periode']);
      redirect('range_nilai');
      return;
    } else{
      $this->session->set_flashdata('danger', 'Data berhasil Ditambahkan');
      $this->session->set_flashdata('key', 'danger');
      $this->session->set_flashdata('tahun',$_POST['tahun']);
      $this->session->set_flashdata('periode',$_POST['periode']);
      redirect('range_nilai');
      return;
    }    
    
  }

  public function edit($id = null)
  {
    if($id === null){
      $this->session->set_flashdata('danger', 'Opps ada kesalahan');
      $this->session->set_flashdata('key', 'danger');
      redirect('range_nilai');  
    }
    $edit_data = $this->range->get_range($id,null);
    if($edit_data === null){
      $this->session->set_flashdata('danger', 'Opps ada kesalahan');
      $this->session->set_flashdata('key', 'danger');
      redirect('range_nilai');      
    }    

    $data['judul'] = 'Range Nilai';
    $data['periode'] = $edit_data->periode;
    $data['tahun'] = $edit_data->tahun;
    $data['isinya'] = $this->get_all_range($edit_data->tahun,$edit_data->periode);
    $data['data_edit'] = $edit_data;
    $data['mode'] = 'edit';
    $this->load->view(HEADER, $data);
    $this->load->view(SIDEBAR_ADMIN);
    $this->load->view(ADMIN.'range_nilai/view_range_nilai');
    $this->load->view(FOOTER);
  } 
  
  public function update()
  {
    $post = $this->input->post();
    $data_edit = ['nm_parameter' => $post['nama_parameter'],'nilai' => $post['nilai'],'updated_at' => date('Y-m-d H:i:s')];
    $rules = array(
      array(
        'field' => 'nama_parameter',
        'label' => 'Nama Parameter',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'nilai',
        'label' => 'Nilai Parameter',
        'rules' => 'trim|numeric|required'
      ),
      array(
        'field' => 'kriteria',
        'label' => 'Kriteria',
        'rules' => 'required'
      ),
      array(
        'field' => 'tahun',
        'label' => 'Tahun',
        'rules' => 'required'
      )
    );

    $this->form_validation->set_message('required','%s tidak boleh kosong');
    $this->form_validation->set_message('numeric','%s harus angka');
    $this->form_validation->set_rules($rules);
    $edit_data = $this->range->get_range($post['id'],null);

    if($this->form_validation->run() === FALSE){
      $data['judul'] = 'Range Nilai';
      $data['data_edit'] = $edit_data;
      $data['periode'] = $edit_data->periode;
      $data['tahun'] = $edit_data->tahun;
      $data['isinya'] = $this->get_all_range($edit_data->tahun,$edit_data->periode);
      $data['mode'] = 'edit';
      $this->load->view(HEADER, $data);
      $this->load->view(SIDEBAR_ADMIN);
      $this->load->view(ADMIN.'range_nilai/view_range_nilai');
      $this->load->view(FOOTER);

      return;
    }  

    $updatekan = $this->range->update_range($post['id'],$data_edit);

    if($updatekan){
      $this->session->set_flashdata('success', 'Data berhasil Diedit');
      $this->session->set_flashdata('key', 'success');
      $this->session->set_flashdata('tahun',$_POST['tahun']);
      $this->session->set_flashdata('periode',$_POST['periode']);
      redirect('range_nilai');
      return;
    } else{
      $this->session->set_flashdata('danger', 'Data gagal Diedit');
      $this->session->set_flashdata('key', 'danger');
      $this->session->set_flashdata('tahun',$_POST['tahun']);
      $this->session->set_flashdata('periode',$_POST['periode']);
      redirect('range_nilai');
      return;
    }   
  }  

  public function nonaktifkan($id = null)
  {
    if($id === null){
      $this->session->set_flashdata('danger', 'Opps ada kesalahan');
      $this->session->set_flashdata('key', 'danger');
      redirect('range_nilai');  
    }
    $edit_data = $this->range->get_range($id,null);
    $updatekan = $this->range->update_range( $id,['status' => 0]);

    if($updatekan){
      $this->session->set_flashdata('danger', 'Data berhasil Dinonaktifkan');
      $this->session->set_flashdata('key', 'danger');
      $this->session->set_flashdata('tahun',$edit_data->tahun);
      $this->session->set_flashdata('periode',$edit_data->periode);
      redirect('range_nilai');
      return;
    } else{
      $this->session->set_flashdata('warning', 'Data gagal Dinonaktifkan');
      $this->session->set_flashdata('key', 'warning');
      $this->session->set_flashdata('tahun',$edit_data->tahun);
      $this->session->set_flashdata('periode',$edit_data->periode);
      redirect('range_nilai');
      return;
    }       
  } 
}