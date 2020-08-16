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
    if($_POST['submit']){
    //membuat variabel untuk menyimpan data inputan yang di isikan di form
    $password_lama      = $_POST['password_lama'];
    $password_baru      = $_POST['password_baru'];
    $konfirmasi_password  = $_POST['konfirmasi_password'];

    //cek dahulu ke database dengan query SELECT
    //kondisi adalah WHERE (dimana) kolom password adalah $password_lama di encrypt m5
    //encrypt -> md5($password_lama)
    $password_lama  = md5($password_lama);
    $cek      = $conn->query("SELECT password FROM m_user WHERE password='$password_lama'");
    
    if($cek->num_rows){
      //kondisi ini jika password lama yang dimasukkan sama dengan yang ada di database
      //membuat kondisi minimal password adalah 5 karakter
      if(strlen($password_baru) >= 5){
        //jika password baru sudah 5 atau lebih, maka lanjut ke bawah
        //membuat kondisi jika password baru harus sama dengan konfirmasi password
        if($password_baru == $konfirmasi_password){
          //jika semua kondisi sudah benar, maka melakukan update kedatabase
          //query UPDATE SET password = encrypt md5 password_baru
          //kondisi WHERE id user = session id pada saat login, maka yang di ubah hanya user dengan id tersebut
          $password_baru  = md5($password_baru);
          $id_user    = $_SESSION['id_user']; //ini dari session saat login
          
          $update     = $conn->query("UPDATE m_user SET password='$password_baru' WHERE id_user='$id_user'");
          if($update){
            //kondisi jika proses query UPDATE berhasil
            echo 'Password berhasil di rubah';
          }else{
            //kondisi jika proses query gagal
            echo 'Gagal merubah password';
          }         
        }else{
          //kondisi jika password baru beda dengan konfirmasi password
          echo 'Konfirmasi password tidak cocok';
        }
      }else{
        //kondisi jika password baru yang dimasukkan kurang dari 5 karakter
        echo 'Minimal password baru adalah 5 karakter';
      }
    }else{
      //kondisi jika password lama tidak cocok dengan data yang ada di database
      echo 'Password lama tidak cocok';
    }
  }

}


/* End of file Login.php */
/* Location: ./application/controllers/Login.php */