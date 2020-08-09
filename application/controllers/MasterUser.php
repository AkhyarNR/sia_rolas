<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterUser extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    // load model for query
    $this->load->model('Common_model');
  }

  // function to perform list data
  public function index()
  {
    // Check if session data(id) is available
    if(isset($_SESSION['id'])){ 
      // data for header    
      $header = array(
        'title' => 'Master User',
        'header' => 'Master User',
        'sub_header' => 'List data'
      );
      // data for content
      $data = array(  
        'dataTable' => $this->Common_model->getData('u.id, u.kode_user, u.nama_user, u.username, j.nama_jabatan','m_user u',['m_jabatan j','u.id_jabatan = j.id'],'',['u.kode_user','ASC'])->result_array()
      );

      // data for footer 
      $footer = array(
        'control' => 'master_user.js',
      );

      // get flashdata
      if($this->session->flashdata('success')){
				$data['notif_sukses'] = $this->session->flashdata('success');
			}elseif($this->session->flashdata('error')){
				$data['notif_gagal'] = $this->session->flashdata('error');
			}
    
    // load view 
    $this->load->view('common/header',$header);
    $this->load->view('master-user/showData',$data);
    $this->load->view('common/footer',$footer);
    }else{
      // redirect to 
      redirect(base_url().'Login'); 
    }
  }

  // function for call form add data
  public function add()
  {
    // Check if session data(id) is available
    if(isset($_SESSION['id'])){
     
      $header = array(
        'title' => 'Master User',
        'header' => 'Master User',
        'sub_header' => 'Tambah data'
      );
      $data = array(
        'jabatan' => $this->Common_model->getData('*','m_jabatan','','','')->result_array()
      );

      $this->load->view('common/header', $header);
      $this->load->view('master-user/addData', $data);
      $this->load->view('common/footer');    

    }else{
        redirect(base_url().'Login');
    }
  }

  // function for doing insert data into database
  public function insert()
  {
    // Check if session data(id) is available
    if(isset($_SESSION['id'])){

      // data to insert into database
      $values = array(
        'kode_user' => "USRxx",
        'nama_user' => htmlspecialchars($this->input->post('nama')),
        'username' => htmlspecialchars($this->input->post('username')),
        'password' => md5('12345678'),
        'id_jabatan' => $this->input->post('jabatan')
      );
      
      // insert into database
      $sql = $this->Common_model->insert('m_user',$values);
      // if success do
      if($sql){
        // get last insert id
        $id = $this->db->insert_id();
        // if last insert id < 10
        if($id < 10)
          $kode = 'USR0';
        else
          $kode = 'USR';
          // update kode user from database
          $update = $this->Common_model->update('m_user',array('kode_user' => $kode.$id),['id'=>$id]);
          // if success do
          if($update){
            // set flashdata success
            $this->session->set_flashdata('success', "<strong> Sukses!</strong> Berhasil menambahkan data.");
            redirect(base_url().'MasterUser');
          }else{
            // set flashdata error
            $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menambahkan data, kode user error.");
            redirect(base_url().'MasterUser');
          }
      // if error do
      }else{
        $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menambahkan data.");
        redirect(base_url().'MasterUser');
      }

    }else{
        redirect(base_url().'Login');
    }
  }

  // function for call form edit data
  public function edit()
  {
    // Check if session data(id) is available
    if(isset($_SESSION['id'])){
    
      // get data from url
      $id = $this->uri->segment(3);

      $header = array(
        'title' => 'Master User',
        'header' => 'Master User',
        'sub_header' => 'Edit data'
      );

      $data = array(
        'data' => $this->Common_model->getData('*','m_user','',['id'=>$id],'')->row(),
        // list jabatan for select option data
        'jabatan' => $this->Common_model->getData('*','m_jabatan','','','')->result_array()
      );

      $this->load->view('common/header',$header);
      $this->load->view('master-user/editData',$data);
      $this->load->view('common/footer');    

    }else{
        redirect(base_url().'Login');
    }
  }

  // function to doing update data from database
  public function update()
  {
    // Check if session data(id) is available
    if(isset($_SESSION['id'])){
      $id =  $this->input->post('id');
      // new values to update
      $values = array(
        'nama_user' => htmlspecialchars($this->input->post('nama')),
        'username' => htmlspecialchars($this->input->post('username')),
        'id_jabatan' => $this->input->post('jabatan')
      );
      // doing update user data
      $sql = $this->Common_model->update('m_user', $values, ['id'=>$id]);
      if($sql){
        // set flashdata success
        $this->session->set_flashdata('success', "<strong> Sukses!</strong> Berhasil mengubah data.");
        redirect(base_url().'MasterUser');
      }else{
        // set flashdata error
        $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal mengubah data.");
        redirect(base_url().'MasterUser');
      }
    }else{
        redirect(base_url().'Login');
    }
  }

  // function to doing delete from database
  public function delete()
  {
    // Check if session data(id) is available
    if(isset($_SESSION['id'])){
      $id = $this->uri->segment(3);
      // doing delete user data
      $sql = $this->Common_model->delete('m_user',['id'=>$id]);
      if($sql){
        // set flashdata success
        $this->session->set_flashdata('success', "<strong> Sukses!</strong> Berhasil menghapus data.");
        redirect(base_url().'MasterUser');
      }else{
        // set flashdata error
        $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menghapus data.");
        redirect(base_url().'MasterUser');
      }
    }else{
        redirect(base_url().'Login');
    }
  }

  // function to doing reset password user from database
  public function reset_password()
  {
    // Check if session data(id) is available
    if(isset($_SESSION['id'])){
      $id = $this->uri->segment(3);
      $password = md5("12345678");

      // do update user password to default (12345678)
      $sql = $this->Common_model->update('m_user', ['password'=>$password], ['id'=>$id]);
      if($sql){
        // set flashdata success
        $this->session->set_flashdata('success', "<strong> Sukses!</strong> Berhasil me-reset password.");
        redirect(base_url().'MasterUser');
      }else{
        // set flashdata error
        $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal me-reset password.");
        redirect(base_url().'MasterUser');
      }
    }else{
        redirect(base_url().'Login');
    }
  }

}


/* End of file Login.php */
/* Location: ./application/controllers/Login.php */