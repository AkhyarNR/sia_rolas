<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanBeli extends CI_Controller
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
        'title' => 'Laporan Pembelian',
        'header' => 'Laporan Pembelian',
        'sub_header' => 'List data'
      );
      // data for content
      $data = array(  
        'dataTable' => $this->Common_model->getData('p.id, p.no_transaksi, p.tgl_pembelian, p.total_qty, p.total_harga, p.bukti_pembelian, p.id_user, u.nama_user','t_pembelian p',['m_user u','u.id = p.id_user'],'',['p.no_transaksi','ASC'])->result_array()
      );

      // data for footer 
      $footer = array(
        'control' => 'transaksi_beli.js',
      );

      // get flashdata
      if($this->session->flashdata('success')){
				$data['notif_sukses'] = $this->session->flashdata('success');
			}elseif($this->session->flashdata('error')){
				$data['notif_gagal'] = $this->session->flashdata('error');
			}
    
    // load view 
    $this->load->view('common/header',$header);
    $this->load->view('laporan-beli/showData',$data);
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
     
    }else{
        redirect(base_url().'Login');
    }
  
  }

  public function insert()
  {
    // Check if session data(id) is available
    if(isset($_SESSION['id'])){

    }else{
        redirect(base_url().'Login');
    }

  }

  // function for call form edit data
  public function edit()
  {
    // Check if session data(id) is available
    if(isset($_SESSION['id'])){
    
    }else{
        redirect(base_url().'Login');
    }

  }

  // function to doing update data from database
  public function update()
  {
    // Check if session data(id) is available
    if(isset($_SESSION['id'])){
      
      }else{
          redirect(base_url().'Login');
      }

  }

  // function to doing delete from database
  public function delete()
  {
    // Check if session data(id) is available
    if(isset($_SESSION['id'])){
     
    }else{
        redirect(base_url().'Login');
    }

  }

  public function detail()
  {
    // Check if session data(id) is available
    if(isset($_SESSION['id'])){
    
    }else{
        redirect(base_url().'Login');
    }
  }

}


/* End of file LaporanBeli.php */
/* Location: ./application/controllers/LaporanBeli.php */