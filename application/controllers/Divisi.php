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
    $this->load->view(SIDEBAR_HRD);
    $this->load->view(ADMIN.'divisi/view_divisi');
    $this->load->view(FOOTER);
  }

  public function get_all_divisi()
  {
    $data = $this->divisi->get_divisi_ketua();
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
    $post = $this->input->post();
    $rules = array(
      array(
          'field' => 'nama_divisi',
          'label' => 'Nama Divisi',
          'rules' => 'trim|required'
      ),
      array(
        'field' => 'nama_ketua',
        'label' => 'Nama Ketua',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'username_ketua',
        'label' => 'Username Ketua',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'nohp_ketua',
        'label' => 'No hp Ketua',
        'rules' => 'trim|required'
      ),      array(
        'field' => 'alamat',
        'label' => 'Alamat Ketua',
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
      $this->load->view(SIDEBAR_HRD);
      $this->load->view(ADMIN.'divisi/view_divisi');
      $this->load->view(FOOTER);      

      return;
    } 

    $this->load->model('M_user','user');
    $usename_cek = $this->user->auth_user(strtolower($post['username_ketua']));

    if($usename_cek !== null){
      $this->session->set_flashdata('danger', 'Username Yang Sama Ditemukan! usename tidak boleh sama');
      $this->session->set_flashdata('key', 'danger');
      redirect('divisi');
      return;
    }
    

    $this->db->trans_start();
    $ins_ketua = $this->divisi->insert_divisi('user',['id_role' => 3, 'nama' => $post['nama_ketua'], 'username' => strtolower($post['username_ketua']), 'password' => password_hash('coba', PASSWORD_DEFAULT)]);
    $id_user = $this->db->insert_id();
    $ins_ketua = $this->divisi->insert_divisi('ketua_divisi',['id_user' => $id_user , 'nohp' => $post['nohp_ketua'], 'alamat' => $post['alamat']]);
    $id_ketua = $this->db->insert_id();
    $ins_divisi = $this->divisi->insert_divisi('divisi',['nm_divisi' => $nama, 'status' => 1, 'id_ketua_divisi' => $id_ketua]);
    $this->db->trans_complete();

    if($this->db->trans_status() === true){
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
    $edit_data = $this->divisi->get_divisi_ketua($id);
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
    $this->load->view(SIDEBAR_HRD);
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
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'nama_ketua',
        'label' => 'Nama Ketua',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'username_ketua',
        'label' => 'Username Ketua',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'nohp_ketua',
        'label' => 'No hp Ketua',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'alamat',
        'label' => 'Alamat Ketua',
        'rules' => 'trim|required'
      )
    );    

    $this->form_validation->set_message('required','%s tidak boleh kosong');
    $this->form_validation->set_rules($rules);

    if($this->form_validation->run() === FALSE){
      $data['judul'] = 'Divisi';
      $edit_data = $this->divisi->get_divisi_ketua($post['id']);
      $data['isinya'] = $this->get_all_divisi();
      $data['data_edit'] = $edit_data;
      $data['mode'] = 'edit';
      $this->load->view(HEADER, $data);
      $this->load->view(SIDEBAR_HRD);
      $this->load->view(ADMIN.'divisi/view_divisi');
      $this->load->view(FOOTER);      

      return;
    } 

    $get_id  = $this->divisi->dapet_id($post['id']);
    $this->load->model('M_user','user');
    $usename_cek = $this->user->cek_user(['id_user !=' => $get_id->user, 'username' => strtolower($post['username_ketua']) ]);

    if($usename_cek !== null){
      $this->session->set_flashdata('danger', 'Username Yang Sama Ditemukan! usename tidak boleh sama');
      $this->session->set_flashdata('key', 'danger');
      redirect('divisi');
      return;
    }        

    $this->db->trans_start();
    $this->divisi->update_divisi('divisi',['id_divisi' => $post['id']],['nm_divisi' => $post['nama_divisi']]);
    $this->divisi->update_divisi('user',['id_user' => $get_id->user],['nama' => $post['nama_ketua'],'username' => strtolower($post['username_ketua'])]);
    $this->divisi->update_divisi('ketua_divisi',['id_ketua_divisi' => $get_id->ketua],['nohp' => $post['nohp_ketua'],'alamat' => $post['alamat']]);
    $this->db->trans_complete();

    if($this->db->trans_status() === true){
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

    $get_id  = $this->divisi->dapet_id($id);

    if($get_id == null){
      $this->session->set_flashdata('danger', 'Oops, ada yang salah');
      $this->session->set_flashdata('key', 'danger');
      redirect('divisi');
      return;
    }            

    $updatekan = $this->divisi->update_divisi( 'divisi',['id_divisi' => $id],['status' => 0]);
    $update_lg = $this->divisi->update_divisi('user',['id_user'=>$get_id->user],['status' => 0]);

    if($updatekan && $update_lg){
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

    $get_id  = $this->divisi->dapet_id($id);

    if($get_id == null){
      $this->session->set_flashdata('danger', 'Oops, ada yang salah');
      $this->session->set_flashdata('key', 'danger');
      redirect('divisi');
      return;
    }           

    $updatekan = $this->divisi->update_divisi( 'divisi',['id_divisi' => $id],['status' => 1]);
    $update_lg = $this->divisi->update_divisi('user',['id_user' => $get_id->user],['status' => 1]);

    if($updatekan && $update_lg){
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