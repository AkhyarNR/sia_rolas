<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanBeli extends CI_Controller
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
        'title' => 'Laporan Pembelian',
        'header' => 'Laporan Pembelian',
        'sub_header' => 'List data'
      );

      if($min==NULL && $min==NULL){
      // data for content
        $data = array(  
          'min' => $this->Common_model->getData('MIN(tgl_pembelian) as tgl_min','t_pembelian','','','')->row()->tgl_min,
          'max' => $this->Common_model->getData('MAX(tgl_pembelian) as tgl_max','t_pembelian','','','')->row()->tgl_max,
          'obat' => $this->Common_model->getData('*','m_obat','',['total_qty !=' => 0],'')->result_array(),
          'supplier' => $this->Common_model->getData('*','m_supplier','','','')->result_array(),
          'user' => $this->Common_model->getData('*','m_user','','','')->result_array(),
          'dataTable' => $this->Common_model->getData('b.id, b.no_transaksi, b.tgl_pembelian, o.nama_obat, s.nama_supplier, db.batch, db.exp_date, db.qty, db.harga, db.sub_total, u.nama_user','t_pembelian b',['t_detail_pembelian db','b.id = db.id_pembelian', 'm_obat o', 'o.id = db.id_obat', 'm_supplier s', 's.id = db.id_supplier','m_user u','u.id = b.id_user'],'', ['no_transaksi','ASC'])->result_array()
        );
      }else{
        $data = array(  
          'min' => $min,
          'max' => $max,
          'dataTable' => $this->Common_model->getData('b.id, b.no_transaksi, b.tgl_pembelian, o.nama_obat, s.nama_supplier, db.batch, db.exp_date, db.qty, db.harga, db.sub_total, u.nama_user','t_pembelian b',['t_detail_pembelian db','b.id = db.id_pembelian', 'm_obat o', 'o.id = db.id_obat', 'm_supplier s', 's.id = db.id_supplier','m_user u','u.id = b.id_user'], ['tgl_penjualan >=' => $min, 'tgl_penjualan <=' => $max], ['no_transaksi','ASC'])->result_array()
        );
      }

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
    $this->load->view('laporan-beli/showData',$data);
    $this->load->view('common/footer',$footer);
    }else{
      // redirect to 
      redirect(base_url().'Login'); 
    }
  }

}


/* End of file LaporanBeli.php */
/* Location: ./application/controllers/LaporanBeli.php */