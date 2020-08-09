<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterPasien extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Common_model');
  }

  public function index()
  {
    if(isset($_SESSION['id'])){ 
      $header = array(
        'title' => 'Master Pasien',
        'header' => 'Master Pasien',
        'sub_header' => 'List data'
      );
      // data for content
      $data = array(  
        'dataTable' => $this->Common_model->getData('*','m_pasien','','',['no_pasien','ASC'])->result_array()
      );

      // data for footer 
      $footer = array(
        'control' => 'master_pasien.js',
      );

      if($this->session->flashdata('success')){
				$data['notif_sukses'] = $this->session->flashdata('success');
			}elseif($this->session->flashdata('error')){
				$data['notif_gagal'] = $this->session->flashdata('error');
			}
    
    // load view 
    $this->load->view('common/header',$header);
    $this->load->view('master-pasien/showData',$data);
    $this->load->view('common/footer',$footer);
    }else{
      // redirect to 
      redirect(base_url().'Login'); 
    }
  }

  public function add()
  {
    if(isset($_SESSION['id'])){
     
      $header = array(
        'title' => 'Master Pasien',
        'header' => 'Master Pasien',
        'sub_header' => 'Tambah data'
      );
      $data = array(
        'data' => $this->Common_model->getData('*','m_pasien','','','')->result_array()
      );

      $this->load->view('common/header', $header);
      $this->load->view('master-pasien/addData', $data);
      $this->load->view('common/footer');    

    }else{
        redirect(base_url().'Login');
    }
  }

  public function insert()
  {
    // Check if session data(id) is available
    if(isset($_SESSION['id'])){

      // data to insert into database
      if($this->input->post('nobpjs')==NULL)$jenis="UMUM"; else $jenis="BPJS";
      $values = array(
        'no_pasien' => "PXxxxxx",
        'nik' => $this->input->post('nik'),
        'no_bpjs' => $this->input->post('nobpjs'),
        'nama_pasien' => htmlspecialchars($this->input->post('nama')),
        'jenis' => $jenis
      );
      
      // insert into database
      $sql = $this->Common_model->insert('m_pasien',$values);
      // if success do
      if($sql){
        // get last insert id
        $id = $this->db->insert_id();
        // if last insert id < 10 
        if($id < 10)
          $kode = 'PX0000';
        else if($id < 100)
          $kode = 'PX000';
        else if($id < 1000)
          $kode = 'PX00';
        else if($id < 10000)
          $kode = 'PX0';
        else
          $kode = 'PX';
          // update kode user from database
          $update = $this->Common_model->update('m_pasien',array('no_pasien' => $kode.$id),['id'=>$id]);
          // if success do
          if($update){
            // set flashdata success
            $this->session->set_flashdata('success', "<strong> Sukses!</strong> Berhasil menambahkan data.");
            redirect(base_url().'MasterPasien');
          }else{
            // set flashdata error
            $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menambahkan data, nomor pasien error.");
            redirect(base_url().'MasterPasien');
          }
      // if error do
      }else{
        $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menambahkan data.");
        redirect(base_url().'MasterPasien');
      }

    }else{
        redirect(base_url().'Login');
    }
  }

  public function edit()
  {
    // Check if session data(id) is available
    if(isset($_SESSION['id'])){
    
      // get data from url
      $id = $this->uri->segment(3);

      $header = array(
        'title' => 'Master Pasien',
        'header' => 'Master Pasien',
        'sub_header' => 'Edit data'
      );

      $data = array(
        'data' => $this->Common_model->getData('*','m_pasien','',['id'=>$id],'')->row()
      );

      $this->load->view('common/header',$header);
      $this->load->view('master-pasien/editData',$data);
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
      if($this->input->post('nobpjs')==NULL)$jenis="UMUM"; else $jenis="BPJS";
      $values = array(
        'nik' => $this->input->post('nik'),
        'no_bpjs' => $this->input->post('nobpjs'),
        'nama_pasien' => htmlspecialchars($this->input->post('nama')),
        'jenis' => $jenis,
      );
      // doing update user data
      $sql = $this->Common_model->update('m_pasien', $values, ['id'=>$id]);
      if($sql){
        // set flashdata success
        $this->session->set_flashdata('success', "<strong> Sukses!</strong> Berhasil mengubah data.");
        redirect(base_url().'MasterPasien');
      }else{
        // set flashdata error
        $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal mengubah data.");
        redirect(base_url().'MasterPasien');
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
      $sql = $this->Common_model->delete('m_pasien',['id'=>$id]);
      if($sql){
        // set flashdata success
        $this->session->set_flashdata('success', "<strong> Sukses!</strong> Berhasil menghapus data.");
        redirect(base_url().'MasterPasien');
      }else{
        // set flashdata error
        $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menghapus data.");
        redirect(base_url().'MasterPasien');
      }
    }else{
        redirect(base_url().'Login');
    }
  }

   public function resep()
  {
    if(isset($_SESSION['id'])){ 

      $id = $this->uri->segment(3);

      $header = array(
        'title' => 'Master Pasien',
        'header' => 'Master Pasien',
        'sub_header' => 'List data'
      );
      // data for content
      $data = array(  
        'dataTable' => $this->Common_model->getData('r.id, r.no_resep, r.tgl_resep, u.nama_user','t_resep r',['m_user u','r.id_user = u.id'],['id_pasien'=>$id],['no_resep','ASC'])->result_array()
      );

      // data for footer 
      $footer = array(
        'control' => 'master_pasien.js',
      );

      if($this->session->flashdata('success')){
        $data['notif_sukses'] = $this->session->flashdata('success');
      }elseif($this->session->flashdata('error')){
        $data['notif_gagal'] = $this->session->flashdata('error');
      }
    
    // load view 
    $this->load->view('common/header',$header);
    $this->load->view('master-pasien/showDataResep',$data);
    $this->load->view('common/footer',$footer);
    }else{
      // redirect to 
      redirect(base_url().'Login'); 
    }
  }
}
/* End of file ContohController.php */
/* Location: ./application/controllers/ContohController.php */