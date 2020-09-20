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
      'tersedia' => $this->Common_model->getDataGroup('o.id, o.kode_obat, o.nama_obat, SUM(dob.qty) as total_qty','m_obat o',['m_detail_obat dob', 'dob.id_obat = o.id'],['dob.qty >' => 0, 'DATEDIFF(dob.exp_date, CURDATE()) >' => 90],['o.id'])->num_rows(),
      'hampir_habis' => $this->Common_model->getDataGroup('o.id, o.kode_obat, o.nama_obat, SUM(dob.qty) as total_qty','m_obat o',['m_detail_obat dob', 'dob.id_obat = o.id'],['dob.qty >' => 0, 'DATEDIFF(dob.exp_date, CURDATE()) >' => 90, 'total_qty <' => 200],['o.id'])->num_rows(),
      'kosong' => $this->Common_model->getData('*','m_obat','',['total_qty' => 0],'')->num_rows(),
      'hampir_kadaluarsa' => $this->Common_model->getDataDistinct('o.id','m_obat o',['m_detail_obat dob','dob.id_obat=o.id'],['dob.qty >' => 0,'DATEDIFF(dob.exp_date, CURDATE()) <=' => 120, 'DATEDIFF(dob.exp_date, CURDATE()) >' => 0],'')->num_rows(),
      'dimusnahkan' => $this->Common_model->getDataGroup('o.id, o.kode_obat, o.nama_obat, SUM(dob.qty) as total_qty','m_obat o',['m_detail_obat dob','dob.id_obat = o.id'],['dob.exp_date <' => date("Y-m-d")],['o.id'])->num_rows()
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