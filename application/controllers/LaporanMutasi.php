<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanMutasi extends CI_Controller
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
        'title' => 'Laporan Penjualan',
        'header' => 'Laporan Penjualan',
        'sub_header' => 'List data'
      );

      if($min==NULL && $min==NULL){
      // data for content
        $data = array(  
          'min' => $this->Common_model->getData('MIN(tgl_transaksi) as tgl_min','t_mutasi','','','')->row()->tgl_min,
          'max' => $this->Common_model->getData('MAX(tgl_transaksi) as tgl_max','t_mutasi','','','')->row()->tgl_max,
          'dataTable' => $this->Common_model->getData('m.id, m.no_transaksi, m.tgl_transaksi, m.id_obat, o.nama_obat, m.id_supplier, s.nama_supplier , m.batch, m.jenis, m.masuk, m.keluar, m.stok, m.id_user, u.nama_user','t_mutasi m',['m_user u','u.id = m.id_user','m_obat o','o.id = m.id_obat','m_supplier s','s.id = m.id_supplier'],'',['m.no_transaksi','ASC'])->result_array()
        );
      }else{
        $data = array(  
          'min' => $min,
          'max' => $max,
          'dataTable' => $this->Common_model->getData('m.id, m.no_transaksi, m.tgl_transaksi, m.id_obat, o.nama_obat, m.id_supplier, s.nama_supplier , m.batch, m.jenis, m.masuk, m.keluar, m.stok, m.id_user, u.nama_user','t_mutasi m',['m_user u','u.id = m.id_user','m_obat o','o.id = m.id_obat','m_supplier s','s.id = m.id_supplier'],['tgl_transaksi >=' => $min,'tgl_transaksi <=' => $max],['m.no_transaksi','ASC'])->result_array()
        );
      }

      // data for footer 
      $footer = array(
        'control' => 'transaksi_mutasi.js',
      );

      // get flashdata
      if($this->session->flashdata('success')){
				$data['notif_sukses'] = $this->session->flashdata('success');
			}elseif($this->session->flashdata('error')){
				$data['notif_gagal'] = $this->session->flashdata('error');
			}
    
    // load view 
    $this->load->view('common/header',$header);
    $this->load->view('laporan-mutasi/showData',$data);
    $this->load->view('common/footer',$footer);
    }else{
      // redirect to 
      redirect(base_url().'Login'); 
    }
  }

}


/* End of file LaporanBeli.php */
/* Location: ./application/controllers/LaporanBeli.php */