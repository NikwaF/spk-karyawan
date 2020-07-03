<?php 

class Auth extends CI_Controller{
  public function __construct()
  {
    parent::__construct();
    
    $this->load->model('M_user','user');
  }

  public function index()
  {
    check_login();
    $data['judul'] = "Login HRD";
    $this->load->view(HEADER,$data);
    $this->load->view('auth/user');
    $this->load->view(FOOTER);
  }

  public function index_admin()
  {
    check_login();
    $data['judul'] = "Login Admin";
    $this->load->view(HEADER,$data);
    $this->load->view('auth/admin');
    $this->load->view(FOOTER);    
  }

  public function aksi_login()
  {
    $post = $this->input->post();
    $username = $post['username'];
    $password = $post['password'];
    $rules = array(
      array(
          'field' => 'username',
          'label' => 'Username',
          'rules' => 'required'
      ),
      array(
          'field' => 'password',
          'label' => 'Password',
          'rules' => 'required'
      )
  );    
    $this->form_validation->set_message('required','%s tidak boleh kosong');
    $this->form_validation->set_rules($rules);

    if($this->form_validation->run() === FALSE){
      $data['judul'] = "Login HRD";
      $this->load->view(HEADER,$data);
      $this->load->view('auth/user');
      $this->load->view(FOOTER);          
    } else{ 
      echo 'mantap';
    }
  }

  public function aksi_login_admin()
  {
    $post = $this->input->post();
    $username = $post['username'];
    $password = $post['password'];
    $rules = array(
      array(
          'field' => 'username',
          'label' => 'Username',
          'rules' => 'required'
      ),
      array(
          'field' => 'password',
          'label' => 'Password',
          'rules' => 'required'
      )
  );    
    $this->form_validation->set_message('required','%s tidak boleh kosong');
    $this->form_validation->set_rules($rules);

    if($this->form_validation->run() === FALSE){
      $data['judul'] = "Login Admin";
      $this->load->view(HEADER,$data);
      $this->load->view('auth/user');
      $this->load->view(FOOTER);   


      return;
    } 

    $data = $this->user->auth_user($username);

    if($data === null){
      $this->session->set_flashdata('danger', 'Username tidak ditemukan');
      $this->session->set_flashdata('key', 'danger');
      redirect('admin');
    }

    if(!password_verify($password, $data->password)){
      $this->session->set_flashdata('danger', 'Password Salah');
      $this->session->set_flashdata('key', 'danger');
      redirect('admin');
    }
    
    if($data->id_role == 1){
      $_SESSION['id_user'] = $data->id_user;
      $_SESSION['is_admin'] = true;
      redirect('dashboard/admin');
    } else{ 
      $_SESSION['id_user'] = $data->id_user;
      $_SESSION['is_admin'] = false;
      redirect('dashboard/hrd');
    }
  }  

  public function logout()
  {
    $this->session->sess_destroy();

	  redirect(base_url());
    exit();		
  }
}