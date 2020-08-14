<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanJual extends CI_Controller
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
      $obat = $this->input->post('obat');
      $resep = $this->input->post('resep');
      $user = $this->input->post('user');

      // data for header    
      $header = array(
        'title' => 'Laporan Penjualan',
        'header' => 'Laporan Penjualan',
        'sub_header' => 'List data'
      );

      $filter = array();

      if($min!=NULL && $max!=NULL){
        $filter['j.tgl_penjualan >='] = $min;
        $filter['j.tgl_penjualan <='] = $max;
      }

      if($obat!=NULL){
        $filter['dob.id_obat'] = $obat;
      }

      if($resep!=NULL){
        if($resep==1)
          $filter['r.no_resep !='] = NULL;
        else
          $filter['r.no_resep'] = NULL;
      }

      if($user!=NULL){
        $filter['j.id_user'] = $user;
      }

        $data = array(  
          'min' => $this->Common_model->getData('MIN(tgl_penjualan) as tgl_min','t_penjualan','','','')->row()->tgl_min,
          'max' => $this->Common_model->getData('MAX(tgl_penjualan) as tgl_max','t_penjualan','','','')->row()->tgl_max,
          'obat' => $this->Common_model->getDataDistinct('dob.id_obat as id, o.kode_obat, o.nama_obat','t_detail_penjualan dp',['m_detail_obat dob','dob.id = dp.id_detail_obat','m_obat o','dob.id_obat = o.id',],'','')->result_array(),
          'resep' => $this->Common_model->getDataDistinct('p.id_resep as id, r.no_resep','t_penjualan p',['t_resep r', 'p.id_resep = r.id'],'','')->result_array(),
          'user' => $this->Common_model->getDataDistinct('p.id_user as id, u.kode_user, u.nama_user','t_penjualan p',['m_user u','p.id_user = u.id'],'','')->result_array(),
          'dataTable' => $this->Common_model->getJualLeft($filter)
        );
       

      // data for footer 
      $footer = array(
        'control' => 'transaksi_jual.js',
      );

      // get flashdata
      if($this->session->flashdata('success')){
				$data['notif_sukses'] = $this->session->flashdata('success');
			}elseif($this->session->flashdata('error')){
				$data['notif_gagal'] = $this->session->flashdata('error');
			}
    
    // load view 
    $this->load->view('common/header',$header);
    $this->load->view('laporan-jual/showData',$data);
    $this->load->view('common/footer',$footer);
    }else{
      // redirect to 
      redirect(base_url().'Login'); 
    }
  }

}


/* End of file LaporanBeli.php */
/* Location: ./application/controllers/LaporanBeli.php */