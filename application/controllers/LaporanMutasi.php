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
      $obat = $this->input->post('obat');
      $supplier = $this->input->post('supplier');
      $user = $this->input->post('user');
      $jenis = $this->input->post('jenis');

      // data for header    
      $header = array(
        'title' => 'Laporan Mutasi',
        'header' => 'Laporan Mutasi',
        'sub_header' => 'List data'
      );
      $data_tanggal = "-";
      $data_obat = "-";
      $data_supplier = "-";
      $data_user = "-";
      $filter = array();

      if($min!=NULL && $max!=NULL){
        $filter['m.tgl_transaksi >='] = $min;
        $filter['m.tgl_transaksi <='] = $max;
        $data_tanggal = "$min"."<b> - </b> "."$max";
      }

      if($obat!=NULL){
        $filter['m.id_obat'] = $obat;
        $qry_obat = $this->Common_model->getData('*','m_obat','',['id',$obat],'')->row();
        $data_obat = $qry_obat->nama_obat;
      }

      if($supplier!=NULL){
        $filter['m.id_supplier'] = $supplier;
        $qry_supplier = $this->Common_model->getData('*','m_supplier','',['id',$supplier],'')->row();
        $data_supplier = $qry_supplier->nama_supplier;
      }

      if($user!=NULL){
        $filter['m.id_user'] = $user;
        $qry_user = $this->Common_model->getData('*','m_user','',['id',$user],'')->row();
        $data_user = $qry_user->nama_user;
      }

      if($jenis!=NULL){
        $filter['m.jenis'] = $jenis;
      }
      
        $data = array(  
          'min' => $this->Common_model->getData('MIN(tgl_transaksi) as tgl_min','t_mutasi','','','')->row()->tgl_min,
          'max' => $this->Common_model->getData('MAX(tgl_transaksi) as tgl_max','t_mutasi','','','')->row()->tgl_max,
          'obat' => $this->Common_model->getDataDistinct('m.id_obat as id, o.kode_obat, o.nama_obat','t_mutasi m',['m_obat o','m.id_obat = o.id'],'','')->result_array(),
          'supplier' => $this->Common_model->getDataDistinct('m.id_supplier as id, s.kode_supplier, s.nama_supplier','t_mutasi m',['m_supplier s','m.id_supplier = s.id'],'','')->result_array(),
          'user' => $this->Common_model->getDataDistinct('m.id_user as id, u.kode_user, u.nama_user','t_mutasi m',['m_user u','m.id_user = u.id'],'','')->result_array(),
          'jenis' => $this->Common_model->getData('*','t_mutasi','','','')->result_array(),
          'dataTable' => $this->Common_model->getData('m.id, m.no_transaksi, m.tgl_transaksi, m.id_obat, o.nama_obat, m.id_supplier, s.nama_supplier , m.batch, m.jenis, m.masuk, m.keluar, m.stok, m.id_user, u.nama_user','t_mutasi m',['m_user u','u.id = m.id_user','m_obat o','o.id = m.id_obat','m_supplier s','s.id = m.id_supplier'],$filter,['m.no_transaksi','ASC'])->result_array()
        );

      // data for footer 
      $footer = array(
        'control' => 'laporan_mutasi.js',
      );

      // get flashdata
      if($this->session->flashdata('success')){
				$data['notif_sukses'] = $this->session->flashdata('success');
			}elseif($this->session->flashdata('error')){
				$data['notif_gagal'] = $this->session->flashdata('error');
			}

      $data['data_tanggal'] = $data_tanggal;
      $data['data_obat'] = $data_obat;
      $data['data_user'] = $data_user;
      $data['data_supplier'] = $data_supplier;
    
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