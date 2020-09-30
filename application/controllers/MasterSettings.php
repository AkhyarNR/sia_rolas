<?php
defined('BASEPATH') or exit('No direct script access allowed');


class MasterSettings extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Common_model');
  }

  public function index()
  {
    // Check if session data(id) is available
    if(isset($_SESSION['id'])){
    
      $header = array(
        'title' => 'Master Settings',
        'header' => 'Master Settings',
        'sub_header' => 'Edit data'
      );

      $data = array(
        'data' => $this->Common_model->getData('*','m_settings','',['id'=>'1'],'')->row()
      );

      $this->load->view('common/header',$header);
      $this->load->view('master-settings/editData',$data);
      $this->load->view('common/footer');    

    }else{
        redirect(base_url().'Login');
    }
  }

}


/* End of file ContohController.php */
/* Location: ./application/controllers/ContohController.php */