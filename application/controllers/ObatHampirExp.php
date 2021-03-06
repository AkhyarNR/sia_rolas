<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ObatHampirExp extends CI_Controller
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
        'title' => 'Obat Hampir Kadaluarsa',
        'header' => 'Obat Hampir Kadaluarsa',
        'sub_header' => 'List data'
      );

      $settings = $this->Common_model->getData('*','m_settings','',['id'=>1],'')->row();
      // data for content
      $data = array(  
        // 'obat' => $this->Common_model->getDataDistinct('o.id, o.kode_obat, o.nama_obat, o.total_qty','m_obat o',['m_detail_obat dob', 'dob.id_obat = o.id'],['dob.qty >' => 0],'')->result_array(),
        'dataTable' => $this->Common_model->getDataGroup('o.id, o.kode_obat, o.nama_obat, SUM(dob.qty) as total_qty','m_obat o',['m_detail_obat dob', 'dob.id_obat = o.id'],['dob.qty >' => 0, 'DATEDIFF(dob.exp_date, CURDATE()) <=' => $settings->set_min_exp_day, 'DATEDIFF(dob.exp_date, CURDATE()) >' => 0],['o.id'])->result_array()
      );

      // data for footer 
      $footer = array(
        'control' => 'obat_hampir_exp.js',
      );

      // get flashdata
      if($this->session->flashdata('success')){
				$data['notif_sukses'] = $this->session->flashdata('success');
			}elseif($this->session->flashdata('error')){
				$data['notif_gagal'] = $this->session->flashdata('error');
			}
    
    // load view 
    $this->load->view('common/header',$header);
    $this->load->view('obat-hampir-exp/showData',$data);
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

      $settings = $this->Common_model->getData('*','m_settings','',['id'=>1],'')->row();
      // data for content
      $data = array(  
        'dataTable' => $this->Common_model->getData('dob.id, o.kode_obat, o.nama_obat, s.nama_supplier, dob.batch, dob.tgl_pembelian, dob.exp_date, DATEDIFF(dob.exp_date, CURDATE()) as countdown, dob.harga_beli, dob.qty','m_detail_obat dob',['m_obat o', 'o.id = dob.id_obat', 'm_supplier s', 's.id = dob.id_supplier'],['dob.qty >' => 0, 'DATEDIFF(dob.exp_date, CURDATE()) <=' => $settings->set_min_exp_day, 'DATEDIFF(dob.exp_date, CURDATE()) >' => 0, 'dob.id_obat' => $id],['id','ASC'])->result_array()
      );

      // data for footer 
      $footer = array(
        'control' => 'detail_obat_hampir_exp.js',
      );

      // get flashdata
      if($this->session->flashdata('success')){
        $data['notif_sukses'] = $this->session->flashdata('success');
      }elseif($this->session->flashdata('error')){
        $data['notif_gagal'] = $this->session->flashdata('error');
      }
    
    // load view 
    $this->load->view('common/header',$header);
    $this->load->view('obat-hampir-exp/showDataDetail',$data);
    $this->load->view('common/footer',$footer);
    }else{
      // redirect to 
      redirect(base_url().'Login'); 
    }
  }

}


/* End of file ObatHampirExp.php */
/* Location: ./application/controllers/ObatHampirExp.php */