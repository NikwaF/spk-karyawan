<?php 

class Karyawan extends CI_Controller{
  public function __construct()
  {
    parent::__construct();
    not_login();
    $this->load->model('M_karyawan','karyawan');
  }

  public function index()
  {
    $data['judul'] = 'Karyawan';
    $data['divisi'] = $this->get_divisi();
    $data['isinya'] = $this->get_all_karyawan();
    $data['mode'] = 'tambah';
    $this->load->view(HEADER, $data);
    $this->load->view(SIDEBAR_ADMIN);
    $this->load->view(ADMIN.'karyawan/view_karyawan');
    $this->load->view(FOOTER);
  }

  private function get_divisi()
  {
    $this->load->model('M_divisi','divisi');
    $where = ['status'=> 1];
    $data = $this->divisi->get_divisi(null,$where);
    return $data;    
  }

  private function get_all_karyawan()
  {
    $data = $this->karyawan->get_karyawan();
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
        'field' => 'divisi',
        'label' => 'Divisi',
        'rules' => 'trim|required'
      ), 
      array(
        'field' => 'nama_karyawan',
        'label' => 'Nama Karyawan',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'umur',
        'label' => 'Umur',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'no_hp',
        'label' => 'Nomer HP',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'kelamin',
        'label' => 'Kelamin',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'tgl_lahir',
        'label' => 'Tanggal Lahir',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'alamat',
        'label' => 'Alamat',
        'rules' => 'trim|required'
      )
    );

    $this->form_validation->set_message('required','%s tidak boleh kosong');
    $this->form_validation->set_message('numeric','%s harus angka');
    $this->form_validation->set_rules($rules);

    if($this->form_validation->run() === FALSE){
      $data['judul'] = 'Karyawan';
      $data['divisi'] = $this->get_divisi();
      $data['mode'] = 'tambah';
      $this->load->view(HEADER, $data);
      $this->load->view(SIDEBAR_ADMIN);
      $this->load->view(ADMIN.'karyawan/view_karyawan');
      $this->load->view(FOOTER);

      return;
    }     

    $insertkan = $this->karyawan->insert_karyawan(['nama' => $post['nama_karyawan'],'umur' => $post['umur'],'id_divisi' => $post['divisi'],'alamat' => $post['alamat'],'tgl_lahir' => $post['tgl_lahir'],'no_hp' => $post['no_hp'],'umur' => $post['umur'],'jns_kelamin' => $post['kelamin'], 'status' => 1]);

    if($insertkan){
      $this->session->set_flashdata('success', 'Data berhasil Ditambahkan');
      $this->session->set_flashdata('key', 'success');
      redirect('karyawan');
      return;
    } else{
      $this->session->set_flashdata('danger', 'Data berhasil Ditambahkan');
      $this->session->set_flashdata('key', 'danger');
      redirect('karyawan');
      return;
    }
  }


  public function edit($id = null)
  {
    if($id === null){
      $this->session->set_flashdata('danger', 'Opps ada kesalahan');
      $this->session->set_flashdata('key', 'danger');
      redirect('karyawan');  
    }
    $edit_data = $this->karyawan->get_karyawan($id,null);
    if($edit_data === null){
      $this->session->set_flashdata('danger', 'Opps ada kesalahan');
      $this->session->set_flashdata('key', 'danger');
      redirect('karyawan');      
    }    

    $data['judul'] = 'Karyawan';
    $data['divisi'] = $this->get_divisi();
    $data['isinya'] = $this->get_all_karyawan();
    $data['data_edit'] = $edit_data;
    $data['mode'] = 'edit';
    $this->load->view(HEADER, $data);
    $this->load->view(SIDEBAR_ADMIN);
    $this->load->view(ADMIN.'karyawan/view_karyawan');
    $this->load->view(FOOTER);    
  }

  public function update()
  {
    $post = $this->input->post();
    $data_edit = ['nama' => $post['nama_karyawan'],'umur' => $post['umur'],'id_divisi' => $post['divisi'],'alamat' => $post['alamat'],'tgl_lahir' => $post['tgl_lahir'],'no_hp' => $post['no_hp'],'umur' => $post['umur'],'jns_kelamin' => $post['kelamin'], 'status' => 1];
    $rules = array(
      array(
        'field' => 'divisi',
        'label' => 'Divisi',
        'rules' => 'trim|required'
      ), 
      array(
        'field' => 'nama_karyawan',
        'label' => 'Nama Karyawan',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'umur',
        'label' => 'Umur',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'no_hp',
        'label' => 'Nomer HP',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'kelamin',
        'label' => 'Kelamin',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'tgl_lahir',
        'label' => 'Tanggal Lahir',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'alamat',
        'label' => 'Alamat',
        'rules' => 'trim|required'
      )
    );

    $this->form_validation->set_message('required','%s tidak boleh kosong');
    $this->form_validation->set_message('numeric','%s harus angka');
    $this->form_validation->set_rules($rules);

    if($this->form_validation->run() === FALSE){
      $data['judul'] = 'Karyawan';
      $data['divisi'] = $this->get_divisi();
      $data['isinya'] = $this->get_all_karyawan();
      $data['mode'] = 'tambah';
      $this->load->view(HEADER, $data);
      $this->load->view(SIDEBAR_ADMIN);
      $this->load->view(ADMIN.'karyawan/view_karyawan');
      $this->load->view(FOOTER);

      return;
    }  

    $updatekan = $this->karyawan->update_karyawan($post['id'],$data_edit);

    if($updatekan){
      $this->session->set_flashdata('success', 'Data berhasil Diedit');
      $this->session->set_flashdata('key', 'success');
      redirect('karyawan');
      return;
    } else{
      $this->session->set_flashdata('danger', 'Data gagal Diedit');
      $this->session->set_flashdata('key', 'danger');
      redirect('karyawan');
      return;
    }   

  }

  public function nonaktifkan($id = null)
  {
    if($id === null){
      $this->session->set_flashdata('danger', 'Opps ada kesalahan');
      $this->session->set_flashdata('key', 'danger');
      redirect('karyawan');  
    }

    $updatekan = $this->karyawan->update_karyawan( $id,['status' => 0]);

    if($updatekan){
      $this->session->set_flashdata('danger', 'Data berhasil Dinonaktifkan');
      $this->session->set_flashdata('key', 'danger');
      redirect('karyawan');
      return;
    } else{
      $this->session->set_flashdata('warning', 'Data gagal Dinonaktifkan');
      $this->session->set_flashdata('key', 'warning');
      redirect('karyawan');
      return;
    }       
  }  

  public function aktifkan($id = null)
  {
    if($id === null){
      $this->session->set_flashdata('danger', 'Opps ada kesalahan');
      $this->session->set_flashdata('key', 'danger');
      redirect('karyawan');  
    }

    $updatekan = $this->karyawan->update_karyawan($id,['status' => 1]);

    if($updatekan){
      $this->session->set_flashdata('success', 'Data berhasil Diaktifkan');
      $this->session->set_flashdata('key', 'success');
      redirect('karyawan');
      return;
    } else{
      $this->session->set_flashdata('danger', 'Data gagal Diaktifkan');
      $this->session->set_flashdata('key', 'danger');
      redirect('karyawan');
      return;
    }       
  }    


  //divisi,nama_karyawan,no_hp,kelamin,tgl_lahir,alamat
  
} 