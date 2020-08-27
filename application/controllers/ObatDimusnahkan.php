<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ObatDimusnahkan extends CI_Controller
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
        'title' => 'Obat Dimusnahkan',
        'header' => 'Obat Dimusnahkan',
        'sub_header' => 'List data'
      );
      // data for content
      $data = array(  
        'dataTable' => $this->Common_model->getDataDistinct('o.id, o.kode_obat, o.nama_obat, o.total_qty','m_obat o',['m_detail_obat dob','dob.id_obat = o.id'],['dob.exp_date <' => date("Y-m-d")],['o.id','ASC'])->result_array()
      );

      // data for footer 
      $footer = array(
        'control' => 'obat_dimusnahkan.js',
      );

      // get flashdata
      if($this->session->flashdata('success')){
				$data['notif_sukses'] = $this->session->flashdata('success');
			}elseif($this->session->flashdata('error')){
				$data['notif_gagal'] = $this->session->flashdata('error');
			}
    
    // load view 
    $this->load->view('common/header',$header);
    $this->load->view('obat-dimusnahkan/showData',$data);
    $this->load->view('common/footer',$footer);
    }else{
      // redirect to 
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
        'dataTable' => $this->Common_model->getData('dob.id, o.kode_obat, o.nama_obat, s.nama_supplier, dob.batch, dob.tgl_pembelian, dob.exp_date, dob.qty, dob.harga_beli','m_detail_obat dob',['m_obat o', 'dob.id_obat = o.id', 'm_supplier s', 'dob.id_supplier = s.id'],['dob.exp_date <' => date("Y-m-d"), 'dob.id_obat' => $id],['o.id','ASC'])->result_array()
      );

      // data for footer 
      $footer = array(
        'control' => 'detail_obat_dimusnahkan.js',
      );

      // get flashdata
      if($this->session->flashdata('success')){
        $data['notif_sukses'] = $this->session->flashdata('success');
      }elseif($this->session->flashdata('error')){
        $data['notif_gagal'] = $this->session->flashdata('error');
      }
    
    // load view 
    $this->load->view('common/header',$header);
    $this->load->view('obat-dimusnahkan/showDataDetail',$data);
    $this->load->view('common/footer',$footer);
    }else{
      // redirect to 
      redirect(base_url().'Login'); 
    }
  }

}


/* End of file ObatDimusnahkan.php */
/* Location: ./application/controllers/ObatDimusnahkan.php */