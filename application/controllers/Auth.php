<?php 

class Auth extends CI_Controller{
  public function __construct()
  {
    parent::__construct();
    
    $this->load->model('M_user','user');
  }

  public function index_hrd()
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

  public function index_ketua()
  {
    check_login();
    $data['judul'] = "Login Ketua Divisi";
    $this->load->view(HEADER,$data);
    $this->load->view('auth/ketua');
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
      $this->load->view('auth/admin');
      $this->load->view(FOOTER);   

      return;
    } 

    $data = $this->user->auth_user($username);


    $this->cek_bener($password,$data,'admin');
    $this->session_login($data);
  }  

  public function aksi_login_hrd()
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
      $data['judul'] = "Login";
      $this->load->view(HEADER,$data);
      $this->load->view('auth/user');
      $this->load->view(FOOTER);   

      return;
    } 

    $data = $this->user->auth_user($username);


    $this->cek_bener($password,$data,'hrd');
    $this->session_login($data);
  }    

  public function aksi_login_ketua()
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
      $data['judul'] = "Login";
      $this->load->view(HEADER,$data);
      $this->load->view('auth/ketua');
      $this->load->view(FOOTER);   

      return;
    } 

    $data = $this->user->auth_user($username);


    $this->cek_bener($password,$data,'/');
    $this->session_login($data);
  }    


  public function cek_bener($password,$data,$target)
  {
    if($data === null){
      $this->session->set_flashdata('danger', 'Username tidak ditemukan');
      $this->session->set_flashdata('key', 'danger');
      redirect($target);
    }

    if(!password_verify($password, $data->password)){
      $this->session->set_flashdata('danger', 'Password Salah');
      $this->session->set_flashdata('key', 'danger');
      redirect($target);
    }
  }

  private function session_login($data)
  {
    if($data->id_role == 1){
      $_SESSION['id_user'] = $data->id_user;
      $_SESSION['role'] = 1;
      redirect('dashboard/admin');
    } else if($data->id_role == 2){ 
      $_SESSION['id_user'] = $data->id_user;
      $_SESSION['role'] = 2;
      redirect('dashboard/hrd');
    } else{ 
      $_SESSION['id_user'] = $data->id_user;
      $sql_id_divisi = "select b.id_divisi from ketua_divisi a inner join divisi b on a.id_ketua_divisi = b.id_ketua_divisi where a.id_user =".$data->id_user;
      $query = $this->db->query($sql_id_divisi)->row();
      $_SESSION['id_divisi'] = $query->id_divisi;
      $_SESSION['role'] = 3;
      redirect('dashboard/ketua');
    }
  }

  public function logout()
  {
    $this->session->sess_destroy();

	  redirect(base_url());
    exit();		
  }
}