<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ObatKosong extends CI_Controller
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
        'title' => 'Obat Kosong',
        'header' => 'Obat Kosong',
        'sub_header' => 'List data'
      );
      // data for content
      $data = array(  
        'dataTable' => $this->Common_model->getData('id, kode_obat, nama_obat','m_obat','',['total_qty' => 0],['id','ASC'])->result_array()
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
    $this->load->view('obat-kosong/showData',$data);
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
        'dataTable' => $this->Common_model->getData('do.id, o.kode_obat, o.nama_obat, s.nama_supplier, do.batch, do.tgl_pembelian, do.exp_date, do.qty, do.harga_beli','m_detail_obat do',['m_obat o', 'do.id_obat = o.id', 'm_supplier s', 'do.id_supplier = s.id'],['total_qty' => 0],['o.id','ASC'])->result_array()
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
    $this->load->view('obat-kosong/showDataDetail',$data);
    $this->load->view('common/footer',$footer);
    }else{
      // redirect to 
      redirect(base_url().'Login'); 
    }
  }

}


/* End of file ObatTersedia.php */
/* Location: ./application/controllers/ObatTersedia.php */