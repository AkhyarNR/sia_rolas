<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Common_model');
  }

  public function index()
  {
    if(isset($_SESSION['id'])){ // Check if session data(id) is available
      redirect(base_url().'Dashboard');
    }else{
      $data = array();
      if($this->session->flashdata('success')){
        $data['notif_sukses'] = $this->session->flashdata('success');
      }elseif($this->session->flashdata('error')){
        $data['notif_gagal'] = $this->session->flashdata('error');
      }
      $this->load->view('login',$data); // Load view
      
    }
  }

  public function signIn()
  {
    if(!isset($_SESSION['id'])){ // Check if session data(id) is unavailable
    htmlspecialchars($username = $this->input->post('username')); // Prevent XSS and HMTL Injection
    $password = $this->input->post('password');

    $where = array(
      'username' => $username,
      'password' => md5($password)
    );

    $cekLogin = $this->Common_model->getData("*","m_user","",['username'=>$username],"")->row();

      if($cekLogin){
        $cekLoginUp = $this->Common_model->getData("*","m_user","",$where,"")->row();
        if($cekLoginUp){
        
        $dataUser = $this->Common_model->getData('u.id, u.kode_user, u.nama_user, u.username, u.id_jabatan, j.nama_jabatan','m_user u',['m_jabatan j','u.id_jabatan = j.id'],$where,['u.kode_user','ASC'])->result_array();
        
        $dataSession = array(
          'id' => $dataUser[0]['id'],
          'nama' => $dataUser[0]['nama_user'],
          'username' => $dataUser[0]['username'],
          'id_jabatan' => $dataUser[0]['id_jabatan'],
          'jabatan' => $dataUser[0]['nama_jabatan']
        );

        $this->session->set_userdata($dataSession);

        redirect(base_url().'Dashboard');

        }else{
          $this->session->set_flashdata('error', "<strong> Error!</strong> Password salah.");
          redirect(base_url().'Login');
        }
      
      }else{
        $this->session->set_flashdata('error', "<strong> Error!</strong> Username tidak terdaftar.");
        redirect(base_url().'Login');
      }
    }else{
      redirect(base_url().'Dashboard');
    }
  }

  public function signOut()
  {
    if(isset($_SESSION['id'])){
      $this->session->sess_destroy();
      redirect(base_url());

    }else{
      redirect(base_url().'Login');
    }
  }

  public function ChangePassword()
  {
    if(isset($_SESSION['id'])){
      $id_user = $this->session->userdata('id');
      $password_lama = $this->input->post('password_lama');
      $password_baru = $this->input->post('password_baru');
      $konfirmasi_password = $this->input->post('konfirmasi_password');

      $password = $this->Common_model->getData('*','m_user','',['id' => $id_user],'')->row()->password;
      if(md5($password_lama) == $password) {
        if ($password_baru == $konfirmasi_password) {

          $update = $this->Common_model->update('m_user',array('password' => md5($password_baru)),['id'=>$id_user]);

        if ($update) {
          $this->session->set_flashdata('success', "<strong> Sukses!</strong> Berhasil mengubah password.");
            redirect(base_url().'Dashboard');
        }else{
          $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal mengubah password.");
            redirect(base_url().'Dashboard');
        }

        }else{
          //password tidak sama
          $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal mengubah password. Password tidak sama.");
            redirect(base_url().'Dashboard');
        }
      }else{ 
        //password lama salah
        $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal mengubah password. Password lama salah.");
            redirect(base_url().'Dashboard');
      }

    }else{
      redirect(base_url().'Login');
    }
  }
}


/* End of file Login.php */
/* Location: ./application/controllers/Login.php */