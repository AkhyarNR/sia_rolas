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
      $obat = $this->input->post('obat');
      $supplier = $this->input->post('supplier');
      $keterangan = $this->input->post('keterangan');
      $user = $this->input->post('user');

      // data for header    
      $header = array(
        'title' => 'Laporan Retur',
        'header' => 'Laporan Retur',
        'sub_header' => 'List data'
      );
      $filter = array();

      if($min!=NULL && $max!=NULL){
        $filter['r.tgl_retur >='] = $min;
        $filter['r.tgl_retur <='] = $max;
      }

      if($obat!=NULL){
        $filter['dob.id_obat'] = $obat;
      }

      if($supplier!=NULL){
        $filter['drm.id_supplier'] = $supplier;
      }

      if($keterangan!=NULL){
        $filter['drk.keterangan'] = $keterangan;
      }

      if($user!=NULL){
        $filter['r.id_user'] = $user;
      }

        $data = array(  
          'min' => $this->Common_model->getData('MIN(tgl_retur) as tgl_min','t_retur','','','')->row()->tgl_min,
          'max' => $this->Common_model->getData('MAX(tgl_retur) as tgl_max','t_retur','','','')->row()->tgl_max,
          'obat' => $this->Common_model->getDataDistinct('dob.id_obat as id, o.kode_obat, o.nama_obat','t_detail_retur_keluar drk',['m_detail_obat dob','dob.id = drk.id_detail_obat','m_obat o','dob.id_obat = o.id'],'','')->result_array(),
          'supplier' => $this->Common_model->getDataDistinct('drm.id_supplier as id, s.kode_supplier, s.nama_supplier','t_detail_retur_masuk drm',['m_supplier s','drm.id_supplier = s.id'],'','')->result_array(),
          'user' => $this->Common_model->getDataDistinct('r.id_user as id, u.kode_user, u.nama_user','t_retur r',['m_user u','r.id_user = u.id'],'','')->result_array(),
          'keterangan' => $this->Common_model->getData('*','t_detail_retur_keluar','','','')->result_array(),
          'dataTable' => $this->Common_model->getData('r.id, r.no_transaksi, r.tgl_retur, o.nama_obat, s.nama_supplier, dob.batch, dob.exp_date, drm.qty, drm.harga, drk.keterangan, drm.batch as batch_baru, drm.exp_date as exp_date_baru, drm.sub_total, u.nama_user','t_retur r', ['t_detail_retur_masuk drm','r.id = drm.id_retur', 't_detail_retur_keluar drk', 'r.id = drk.id_retur', 'm_detail_obat dob', 'dob.id = drk.id_detail_obat', 'm_obat o', 'o.id = drm.id_obat', 'm_supplier s', 's.id = drm.id_supplier', 'm_user u', 'u.id = r.id_user'],$filter,['no_transaksi','ASC'])->result_array()
        );

      // data for footer 
      $footer = array(
        'control' => 'laporan_retur.js',
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