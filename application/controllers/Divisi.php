<?php 


class Divisi extends  CI_Controller{
  public function __construct()
  {
    parent::__construct();
    not_login();
    $this->load->model('M_divisi','divisi');
  }


  public function index()
  {
    $data['judul'] = 'Divisi';
    $data['isinya'] = $this->get_all_divisi();
    $data['mode'] = 'tambah';
    $this->load->view(HEADER, $data);
    $this->load->view(SIDEBAR_ADMIN);
    $this->load->view(ADMIN.'divisi/view_divisi');
    $this->load->view(FOOTER);
  }

  public function get_all_divisi()
  {
    $data = $this->divisi->get_divisi();
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
    $nama = $this->input->post('nama_divisi');
    $rules = array(
      array(
          'field' => 'nama_divisi',
          'label' => 'Nama Divisi',
          'rules' => 'trim|required'
      )
    );    

    $this->form_validation->set_message('required','%s tidak boleh kosong');
    $this->form_validation->set_rules($rules);

    if($this->form_validation->run() === FALSE){
      $data['judul'] = 'Divisi';
      $data['isinya'] = $this->get_all_divisi();
      $data['mode'] = 'tambah';
      $this->load->view(HEADER, $data);
      $this->load->view(SIDEBAR_ADMIN);
      $this->load->view(ADMIN.'divisi/view_divisi');
      $this->load->view(FOOTER);      

      return;
    } 
    
    $insertkan = $this->divisi->insert_divisi(['nm_divisi' => $nama, 'status' => 1]);

    if($insertkan){
      $this->session->set_flashdata('success', 'Data berhasil Ditambahkan');
      $this->session->set_flashdata('key', 'success');
      redirect('divisi');
      return;
    } else{
      $this->session->set_flashdata('danger', 'Data berhasil Ditambahkan');
      $this->session->set_flashdata('key', 'danger');
      redirect('divisi');
      return;
    }
  }

  public function edit($id = null)
  {
    if($id === null){
      $this->session->set_flashdata('danger', 'Opps ada kesalahan');
      $this->session->set_flashdata('key', 'danger');
      redirect('divisi');  
    }
    $edit_data = $this->divisi->get_divisi($id);
    if($edit_data === null){
      $this->session->set_flashdata('danger', 'Opps ada kesalahan');
      $this->session->set_flashdata('key', 'danger');
      redirect('divisi');      
    }

    $data['judul'] = 'Divisi';
    $data['isinya'] = $this->get_all_divisi();
    $data['data_edit'] = $edit_data;
    $data['mode'] = 'edit';
    $this->load->view(HEADER, $data);
    $this->load->view(SIDEBAR_ADMIN);
    $this->load->view(ADMIN.'divisi/view_divisi');
    $this->load->view(FOOTER);
  }

  public function edit_action()
  {
    $post = $this->input->post();
    $data_edit = ['id' => $post['id'], 'nama' => $post['nama_divisi']];

    $rules = array(
      array(
          'field' => 'nama_divisi',
          'label' => 'Nama Divisi',
          'rules' => 'required'
      )
    );    

    $this->form_validation->set_message('required','%s tidak boleh kosong');
    $this->form_validation->set_rules($rules);

    if($this->form_validation->run() === FALSE){
      $data['judul'] = 'Divisi';
      $edit_data = $this->divisi->get_divisi($post['id']);
      $data['isinya'] = $this->get_all_divisi();
      $data['data_edit'] = $edit_data;
      $data['mode'] = 'edit';
      $this->load->view(HEADER, $data);
      $this->load->view(SIDEBAR_ADMIN);
      $this->load->view(ADMIN.'divisi/view_divisi');
      $this->load->view(FOOTER);      

      return;
    } 
    
    $updatekan = $this->divisi->update_divisi( $post['id'],['nm_divisi' => $post['nama_divisi']]);

    if($updatekan){
      $this->session->set_flashdata('success', 'Data berhasil Diedit');
      $this->session->set_flashdata('key', 'success');
      redirect('divisi');
      return;
    } else{
      $this->session->set_flashdata('danger', 'Data gagal Diedit');
      $this->session->set_flashdata('key', 'danger');
      redirect('divisi');
      return;
    }    
  }

  public function nonaktifkan($id = null)
  {
    if($id === null){
      $this->session->set_flashdata('danger', 'Opps ada kesalahan');
      $this->session->set_flashdata('key', 'danger');
      redirect('divisi');  
    }

    $updatekan = $this->divisi->update_divisi( $id,['status' => 0]);

    if($updatekan){
      $this->session->set_flashdata('danger', 'Data berhasil Dinonaktifkan');
      $this->session->set_flashdata('key', 'danger');
      redirect('divisi');
      return;
    } else{
      $this->session->set_flashdata('warning', 'Data gagal Dinonaktifkan');
      $this->session->set_flashdata('key', 'warning');
      redirect('divisi');
      return;
    }       
  }

  public function aktifkan($id = null)
  {
    if($id === null){
      $this->session->set_flashdata('danger', 'Opps ada kesalahan');
      $this->session->set_flashdata('key', 'danger');
      redirect('divisi');  
    }

    $updatekan = $this->divisi->update_divisi($id,['status' => 1]);

    if($updatekan){
      $this->session->set_flashdata('success', 'Data berhasil Diaktifkan');
      $this->session->set_flashdata('key', 'success');
      redirect('divisi');
      return;
    } else{
      $this->session->set_flashdata('danger', 'Data gagal Diaktifkan');
      $this->session->set_flashdata('key', 'danger');
      redirect('divisi');
      return;
    }       
  }  


}