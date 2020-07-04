<?php 



class Kriteria extends CI_Controller{
  public function __construct()
  {
    parent::__construct();
    not_login();
    $this->load->model('M_kriteria', 'kriteria');
  }

  public function index()
  {
    $data['judul'] = 'Kriteria';
    if(!isset($_POST['tahun-filter']) && !isset($_POST['periode-filter'])){
      $data['isinya'] = 'ehem';
    } else{ 
      $data['periode'] = $_POST['periode-filter'];
      $data['tahun'] = $_POST['tahun-filter'];
      $data['isinya'] = $this->get_all_kriteria($_POST['tahun-filter'],$_POST['periode-filter']);
    }
    $data['mode'] = 'tambah';    
    $this->load->view(HEADER, $data);
    $this->load->view(SIDEBAR_ADMIN);
    $this->load->view(ADMIN.'kriteria/view_kriteria');
    $this->load->view(FOOTER);
  }

  private function get_all_kriteria($tahun,$periode)
  {
    $where = ['b.tahun'=> $tahun, 'b.periode' => $periode];
    $data = $this->kriteria->get_kriteria(null,$where);
    $aktif = [];
    $nonaktif = [];

    if(count($data) !== 0){
      for($i = 0 ; count($data) > $i ; $i++){
        if($data[$i]->status == 1){
          array_push($aktif,$data[$i]);
        } else{
          array_push($nonaktif,$data[$i]);
        }
      }
    } 

    return ['aktif' => $aktif, 'nonaktif' => $nonaktif];
  }
  
  public function insert()
  {
    $post = $this->input->post();

    $rules = array( 
      array(
        'field' => 'nama_kriteria',
        'label' => 'Nama Kriteria',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'bobot',
        'label' => 'Bobot Kriteria',
        'rules' => 'trim|numeric|required'
      ),
      array(
        'field' => 'periode',
        'label' => 'Periode',
        'rules' => 'required'
      ),
      array(
        'field' => 'tahun',
        'label' => 'Tahun',
        'rules' => 'required'
      ),
    );

    $this->form_validation->set_message('required','%s tidak boleh kosong');
    $this->form_validation->set_message('numeric','%s harus angka');
    $this->form_validation->set_rules($rules);    

    if($this->form_validation->run() === FALSE){
      $data['judul'] = 'Kriteria';
      $data['isinya'] = $this->get_all_kriteria();
      $data['mode'] = 'tambah';    
      $this->load->view(HEADER, $data);
      $this->load->view(SIDEBAR_ADMIN);
      $this->load->view(ADMIN.'kriteria/view_kriteria');
      $this->load->view(FOOTER);

      return;
    }   

    $insertkan = $this->kriteria->insert_kriteria(['nm_kriteria' => $post['nama_kriteria'],'periode' => $post['periode'],'tahun' => $post['tahun'],'bobot' => $post['bobot'],'status' => 1,'created_at' => date('Y-m-d H:i:s')]);

    if($insertkan){
      $this->session->set_flashdata('success', 'Data berhasil Ditambahkan');
      $this->session->set_flashdata('key', 'success');
      redirect('kriteria');
      return;
    } else{
      $this->session->set_flashdata('danger', 'Data berhasil Ditambahkan');
      $this->session->set_flashdata('key', 'danger');
      redirect('kriteria');
      return;
    }    
    
  }

  public function edit($id = null)
  {
    if($id === null){
      $this->session->set_flashdata('danger', 'Opps ada kesalahan');
      $this->session->set_flashdata('key', 'danger');
      redirect('kriteria');  
    }
    $edit_data = $this->kriteria->get_kriteria($id,null);
    if($edit_data === null){
      $this->session->set_flashdata('danger', 'Opps ada kesalahan');
      $this->session->set_flashdata('key', 'danger');
      redirect('kriteria');      
    }    

    $data['judul'] = 'kriteria';
    $data['periode'] = $edit_data->periode;
    $data['tahun'] = $edit_data->tahun;
    $data['isinya'] = $this->get_all_kriteria($edit_data->tahun,$edit_data->periode);
    $data['data_edit'] = $edit_data;
    $data['mode'] = 'edit';
    $this->load->view(HEADER, $data);
    $this->load->view(SIDEBAR_ADMIN);
    $this->load->view(ADMIN.'kriteria/view_kriteria');
    $this->load->view(FOOTER);    
  }  

  public function update()
  {
    $post = $this->input->post();
    $data_edit = ['nm_kriteria' => $post['nama_kriteria'],'bobot' => $post['bobot'],'updated_at' => date('Y-m-d H:i:s'),'periode' => $post['periode'], 'tahun' => $post['tahun']];
    $edit_data = $this->kriteria->get_kriteria($post['id'],null);
    $rules = array(
      array(
        'field' => 'nama_kriteria',
        'label' => 'Nama Kriteria',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'bobot',
        'label' => 'Bobot Kriteria',
        'rules' => 'trim|numeric|required'
      ),
      array(
        'field' => 'periode',
        'label' => 'Periode',
        'rules' => 'required'
      ),
      array(
        'field' => 'tahun',
        'label' => 'Tahun',
        'rules' => 'required'
      ),
    );

    $this->form_validation->set_message('required','%s tidak boleh kosong');
    $this->form_validation->set_message('numeric','%s harus angka');
    $this->form_validation->set_rules($rules);

    if($this->form_validation->run() === FALSE){
      $data['judul'] = 'kriteria';
      $data['data_edit'] = $edit_data;
      $data['periode'] = $edit_data->periode;
      $data['tahun'] = $edit_data->tahun;
      $data['isinya'] = $this->get_all_kriteria($edit_data->tahun,$edit_data->periode);
      $data['mode'] = 'edit';
      $this->load->view(HEADER, $data);
      $this->load->view(SIDEBAR_ADMIN);
      $this->load->view(ADMIN.'kriteria/view_kriteria');
      $this->load->view(FOOTER);

      return;
    }  

    $updatekan = $this->kriteria->update_kriteria($post['id'],$data_edit);

    if($updatekan){
      $this->session->set_flashdata('success', 'Data berhasil Diedit');
      $this->session->set_flashdata('key', 'success');
      redirect('kriteria');
      return;
    } else{
      $this->session->set_flashdata('danger', 'Data gagal Diedit');
      $this->session->set_flashdata('key', 'danger');
      redirect('kriteria');
      return;
    }   

  }  

  public function nonaktifkan($id = null)
  {
    if($id === null){
      $this->session->set_flashdata('danger', 'Opps ada kesalahan');
      $this->session->set_flashdata('key', 'danger');
      redirect('kriteria');  
    }

    $updatekan = $this->kriteria->update_kriteria( $id,['status' => 0]);

    if($updatekan){
      $this->session->set_flashdata('danger', 'Data berhasil Dinonaktifkan');
      $this->session->set_flashdata('key', 'danger');
      redirect('kriteria');
      return;
    } else{
      $this->session->set_flashdata('warning', 'Data gagal Dinonaktifkan');
      $this->session->set_flashdata('key', 'warning');
      redirect('kriteria');
      return;
    }       
  }  

  public function aktifkan($id = null)
  {
    if($id === null){
      $this->session->set_flashdata('danger', 'Opps ada kesalahan');
      $this->session->set_flashdata('key', 'danger');
      redirect('kriteria');  
    }

    $updatekan = $this->kriteria->update_kriteria($id,['status' => 1]);

    if($updatekan){
      $this->session->set_flashdata('success', 'Data berhasil Diaktifkan');
      $this->session->set_flashdata('key', 'success');
      redirect('kriteria');
      return;
    } else{
      $this->session->set_flashdata('danger', 'Data gagal Diaktifkan');
      $this->session->set_flashdata('key', 'danger');
      redirect('kriteria');
      return;
    } 
  }   
} 