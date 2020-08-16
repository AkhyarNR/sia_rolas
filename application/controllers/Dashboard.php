<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
      'title' => 'Dashboard',
      'header' => 'Dashboard',
    );

    $data = array(  
      'tersedia' => $this->Common_model->getData('*','m_obat','',['total_qty >' => 0],'')->num_rows(),
      'hampir_habis' => $this->Common_model->getData('*','m_obat','',['total_qty >' => 0,'total_qty <=' => 150],'')->num_rows(),
      'kosong' => $this->Common_model->getData('*','m_obat','',['total_qty' => 0],'')->num_rows()
    );

    $this->load->view('common/header',$header);
    $this->load->view('dashboard',$data);
    $this->load->view('common/footer');
      
    }else{
      redirect(base_url().'Login'); 
    }
  }

}


/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */