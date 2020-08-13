<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanRetur extends CI_Controller
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
      $min = $this->input->post('min');
      $max = $this->input->post('max');

      // data for header    
      $header = array(
        'title' => 'Laporan Retur',
        'header' => 'Laporan Retur',
        'sub_header' => 'List data'
      );

      if($min==NULL && $min==NULL){
      // data for content
        $data = array(  
          'min' => $this->Common_model->getData('MIN(tgl_retur) as tgl_min','t_retur','','','')->row()->tgl_min,
          'max' => $this->Common_model->getData('MAX(tgl_retur) as tgl_max','t_retur','','','')->row()->tgl_max,
          'dataTable' => $this->Common_model->getReturLeft()
        );
      }else{
        $data = array(  
          'min' => $min,
          'max' => $max,
          'dataTable' => $this->Common_model->getReturLeft()
        );
      }

      // data for footer 
      $footer = array(
        'control' => 'transaksi_retur.js',
      );

      // get flashdata
      if($this->session->flashdata('success')){
				$data['notif_sukses'] = $this->session->flashdata('success');
			}elseif($this->session->flashdata('error')){
				$data['notif_gagal'] = $this->session->flashdata('error');
			}
    
    // load view 
    $this->load->view('common/header',$header);
    $this->load->view('laporan-retur/showData',$data);
    $this->load->view('common/footer',$footer);
    }else{
      // redirect to 
      redirect(base_url().'Login'); 
    }
  }

}


/* End of file LaporanBeli.php */
/* Location: ./application/controllers/LaporanBeli.php */