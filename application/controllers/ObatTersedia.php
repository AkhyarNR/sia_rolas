<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ObatTersedia extends CI_Controller
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
        'title' => 'Obat Tersedia',
        'header' => 'Obat Tersedia',
        'sub_header' => 'List data'
      );
      // data for content
      $data = array(  
        'dataTable' => $this->Common_model->getData('o.id, o.kode_obat, o.nama_obat, s.nama_supplier, dob.batch, dob.tgl_pembelian, dob.exp_date, dob.harga_beli, dob.qty, o.harga_jual','m_detail_obat dob',['m_obat o','dob.id_obat = o.id','m_supplier s','dob.id_supplier = s.id'],['dob.qty !=' => 0],['dob.tgl_pembelian','ASC'])->result_array()
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
    $this->load->view('obat-tersedia/showData',$data);
    $this->load->view('common/footer',$footer);
    }else{
      // redirect to 
      redirect(base_url().'Login'); 
    }
  }

}


/* End of file ObatTersedia.php */
/* Location: ./application/controllers/ObatTersedia.php */