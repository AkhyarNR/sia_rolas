<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterObat extends CI_Controller
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
        'title' => 'Master Obat',
        'header' => 'Master Obat',
        'sub_header' => 'List data'
      );
      // data for content
      $data = array(  
        'dataTable' => $this->Common_model->getData('*','m_obat','','',['id','ASC'])->result_array()
      );

      // data for footer 
      $footer = array(
        'control' => 'master_obat.js',
      );

      // get flashdata
      if($this->session->flashdata('success')){
        $data['notif_sukses'] = $this->session->flashdata('success');
      }elseif($this->session->flashdata('error')){
        $data['notif_gagal'] = $this->session->flashdata('error');
      }
    
    // load view 
    $this->load->view('common/header',$header);
    $this->load->view('master-obat/showData',$data);
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
        'title' => 'Master Obat',
        'header' => 'Master Obat',
        'sub_header' => 'Tambah data'
      );

      $this->load->view('common/header', $header);
      $this->load->view('master-obat/addData');
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
        'kode_obat' => htmlspecialchars($this->input->post('kode')),
        'nama_obat' => htmlspecialchars($this->input->post('nama')),
        'harga_jual' => htmlspecialchars($this->input->post('hargajual'))
      );
      
      // insert into database
      $sql = $this->Common_model->insert('m_obat',$values);
      // if success do
      if($sql){
        $this->session->set_flashdata('success', "<strong> Sukses!</strong> Berhasil menambahkan data.");
        redirect(base_url().'MasterObat');
      // if error do
      }else{
        $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menambahkan data.");
        redirect(base_url().'MasterObat');
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
        'title' => 'Master Obat',
        'header' => 'Master Obat',
        'sub_header' => 'Edit data'
      );

      $data = array(
        'data' => $this->Common_model->getData('o.id, o.kode_obat, o.nama_obat, MAX(do.harga_beli) as harga_beli, o.harga_jual','m_obat o',['m_detail_obat do','o.id = do.id_obat'],['o.id'=>$id],'')->row()
      );

      $footer = array(
        'control' => 'transaksi_obat_edit.js',
      );

      $this->load->view('common/header',$header);
      $this->load->view('master-obat/editData',$data);
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
        'nama_obat' => htmlspecialchars($this->input->post('nama')),
        'harga_jual' => htmlspecialchars($this->input->post('hargajual'))
      );
      // doing update user data
      $sql = $this->Common_model->update('m_obat', $values, ['id'=>$id]);
      if($sql){
        // set flashdata success
        $this->session->set_flashdata('success', "<strong> Sukses!</strong> Berhasil mengubah data.");
        redirect(base_url().'MasterObat');
      }else{
        // set flashdata error
        $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal mengubah data.");
        redirect(base_url().'MasterObat');
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
      $sql = $this->Common_model->delete('m_obat',['id'=>$id]);
      if($sql){
        // set flashdata success
        $this->session->set_flashdata('success', "<strong> Sukses!</strong> Berhasil menghapus data.");
        redirect(base_url().'MasterObat');
      }else{
        // set flashdata error
        $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menghapus data.");
        redirect(base_url().'MasterObat');
      }
    }else{
        redirect(base_url().'Login');
    }
  }


  public function detail()
  {
    // Check if session data(id) is available
    if(isset($_SESSION['id'])){ 
      // data for header    
      $id = $this->uri->segment(3);

      $header = array(
        'title' => 'Detail Obat',
        'header' => 'Detail Obat',
        'sub_header' => 'List data'
      );
      // data for content
      $data = array(  
        'dataTable' => $this->Common_model->getData('do.id, o.nama_obat, s.nama_supplier, do.batch, do.tgl_pembelian, do.exp_date, do.harga_beli, do.qty','m_detail_obat do',['m_obat o', 'do.id_obat = o.id', 'm_supplier s', 'do.id_supplier = s.id'],['id_obat'=>$id, 'qty >' => 0,'DATEDIFF(do.exp_date, CURDATE()) >' => 90],['id','ASC'])->result_array()
      );

      // data for footer 
      $footer = array(
        'control' => 'detail_master_obat.js',
      );

      // get flashdata
      if($this->session->flashdata('success')){
        $data['notif_sukses'] = $this->session->flashdata('success');
      }elseif($this->session->flashdata('error')){
        $data['notif_gagal'] = $this->session->flashdata('error');
      }
    
    // load view 
    $this->load->view('common/header',$header);
    $this->load->view('master-obat/showDataDetail',$data);
    $this->load->view('common/footer',$footer);
    }else{
      // redirect to 
      redirect(base_url().'Login'); 
    }
  }

  public function update_harga()
  {
    // Check if session data(id) is available
    if(isset($_SESSION['id'])){
      $id =  $this->input->post('id');
      // new values to update
      $values = array(
        'harga_jual' => htmlspecialchars($this->input->post('harga_jual'))
      );
      // doing update user data
      $sql = $this->Common_model->update('t_detail_obat', $values, ['id'=>$id]);
      if($sql){
        // set flashdata success
        $this->session->set_flashdata('success', "<strong> Sukses!</strong> Berhasil mengubah data.");
        redirect(base_url().'MasterObat');
      }else{
        // set flashdata error
        $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal mengubah data.");
        redirect(base_url().'MasterObat');
      }
    }else{
        redirect(base_url().'Login');
    }
  }

}


/* End of file Login.php */
/* Location: ./application/controllers/Login.php */