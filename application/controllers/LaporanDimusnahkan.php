<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanDimusnahkan extends CI_Controller
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
      $id = $this->uri->segment(3);

      $header = array(
        'title' => 'Berita Acara Obat Dimusnahkan',
        'header' => 'Berita Acara Obat Dimusnahkan',
        'sub_header' => ''
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
    $this->load->view('laporan-dimusnahkan/detailData',$data);
    $this->load->view('common/footer',$footer);
    }else{
      // redirect to 
      redirect(base_url().'Login'); 
    }
  }


 // public function detail()
  
}


/* End of file LaporanBeli.php */
/* Location: ./application/controllers/LaporanBeli.php */