<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TransaksiRetur extends CI_Controller
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
        'title' => 'Transaksi Retur',
        'header' => 'Transaksi Retur',
        'sub_header' => 'List data'
      );
      // data for content
      $data = array(  
        'dataTable' => $this->Common_model->getData('r.id, r.no_transaksi, r.tgl_retur, r.total_qty, r.total_harga, r.bukti_retur, r.id_user, u.nama_user','t_retur r',['m_user u','u.id = r.id_user'],'',['r.no_transaksi','ASC'])->result_array()
      );

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
    $this->load->view('transaksi-retur/showData',$data);
    $this->load->view('common/footer',$footer);
    }else{
      // redirect to 
      redirect(base_url().'Login'); 
    }
  }

  // function for call form add data
  public function add()
  {
    // Check if session data(id) is available
    if(isset($_SESSION['id'])){
     
      $header = array(
        'title' => 'Transaksi Retur',
        'header' => 'Transaksi Retur',
        'sub_header' => 'Tambah data'
      );
      
      $data = array(
        'obat' => $this->Common_model->getData('*','m_obat','',['total_qty !=' => 0],'')->result_array(),
        'supplier' => $this->Common_model->getData('*','m_supplier','','','')->result_array()
      );

      $footer = array(
        'control' => 'transaksi_retur.js',
      );

      $this->load->view('common/header', $header);
      $this->load->view('transaksi-retur/addData',$data);
      $this->load->view('common/footer',$footer);    

    }else{
        redirect(base_url().'Login');
    }
  }


  // public function yuhu(){
  //   $this->input->post('tglretur');
  //   if(!empty($_FILES['scan_bukti']['name'])){
  //   echo "berisi";
  //   }else{
  //   echo "tidak berisi";
  //   }
  // }

  
  // function for doing insert data into database
  public function insert()
  {
    // Check if session data(id) is available
    if(isset($_SESSION['id'])){

      // cek available data
      // echo $this->input->post('tglbeli');
      // $obat = $this->input->post('obat');
      // if(is_array($obat))
      // print_r($obat);
      // else
      // echo "bukan array";

      // data to insert into database
      $values = array(
        'no_transaksi' => "RTRxxxxxxx",
        'tgl_retur' => $this->input->post('tglretur'),
        'total_qty' => 0,
        'total_harga' => 0,
        'bukti_retur' => '',
        'id_user' => $this->session->userdata('id')
      );
      
      // insert into database
      $sql = $this->Common_model->insert('t_retur',$values);
      // if success do
      if($sql){
        // get last insert id
        $id = $this->db->insert_id();
        // if last insert id < 10
        if($id < 10)
          $kode = 'RTR000000';
        else if($id < 100)
          $kode = 'RTR00000';
        else if($id < 1000)
          $kode = 'RTR0000';
        else if($id < 10000)
          $kode = 'RTR000';
        else if($id < 100000)
          $kode = 'RTR00';
        else if($id < 1000000)
          $kode = 'RTR0';
        else
          $kode = 'RTR';
          // update kode user from database
          if(!empty($_FILES['scan_bukti']['name'])){
            $bukti = $this->Common_model->do_upload($id,$kode.$id,'scan_bukti','bukti_retur',$this->input->post('scan_bukti'));
            $update = $this->Common_model->update('t_retur',array('no_transaksi' => $kode.$id,'bukti_retur'=>$bukti),['id'=>$id]);
          }else
          $update = $this->Common_model->update('t_retur',array('no_transaksi' => $kode.$id),['id'=>$id]);
          
          // if success do
          if($update){
            $row = 0;
            $total_array = count($this->input->post('obat'));
            for($i=0;$i<$total_array;$i++){
              $sub_values_keluar = array(
                'id_retur' => $id,
                'id_detail_obat' => $this->input->post('batch')[$i],
                'qty' => $this->input->post('qty')[$i],
                'keterangan' => $this->input->post('keterangan')[$i]
              );
              $add_detail = $this->Common_model->insert('t_detail_retur_keluar',$sub_values_keluar);
              $qty = $this->input->post('qty')[$i];
              $harga = $this->input->post('harga')[$i];
              $sub_values_masuk = array(
                'id_retur' => $id,
                'id_obat' => $this->input->post('obat')[$i],
                'id_supplier' => $this->input->post('supplier')[$i],
                'batch' => $this->input->post('batchbaru')[$i],
                'exp_date' => $this->input->post('expbaru')[$i],
                'qty' => $qty,
                'harga' => $harga,
                'sub_total' => $qty * $harga
              );
              $add_detail = $this->Common_model->insert('t_detail_retur_masuk',$sub_values_masuk);
              $row++;
            }             
              if($row==$total_array){
                // set flashdata success
                $this->session->set_flashdata('success', "<strong> Sukses!</strong> Berhasil menambahkan data.");
                redirect(base_url().'TransaksiRetur');
              }else{
                // set flashdata error
                $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menambahkan data, detail retur error.");
                redirect(base_url().'TransaksiRetur');
              }
          }else{
            // set flashdata error
            $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menambahkan data, no transaksi error.");
            redirect(base_url().'TransaksiRetur');
          }
        // if error do
      }else{
        $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menambahkan data.");
        redirect(base_url().'TransaksiRetur');
      }
    }else{
        redirect(base_url().'Login');
    }
  }


  // function for call form edit data
  public function edit()
  {
    // Check if session data(id) is available
    if(isset($_SESSION['id'])){
    
      // get data from url
      $id = $this->uri->segment(3);

      $header = array(
        'title' => 'Transaksi Retur',
        'header' => 'Transaksi Retur',
        'sub_header' => 'Edit data'
      );

      $filter = array(
        'dob.id_obat' => 'drm.id_obat',
        'r.id' => $id
      );

      $data = array(
        'data' => $this->Common_model->getData('*','t_retur','',['id'=>$id],'')->row(),
        'detail' => $this->Common_model->getData('drm.id_retur, drm.id_obat, o.kode_obat, o.nama_obat, dob.batch, drm.id_supplier, s.kode_supplier, s.nama_supplier, dob.tgl_pembelian, dob.exp_date, drm.qty, drm.harga, drk.keterangan, drm.batch as batchbaru, drm.exp_date as expbaru','t_detail_retur_masuk drm',['t_retur r','drm.id_retur = r.id','t_detail_retur_keluar drk','drk.id_retur = r.id','m_obat o','drm.id_obat = o.id','m_detail_obat dob','dob.id = drk.id_detail_obat', 'm_supplier s','drm.id_supplier = s.id'],$filter,'')->result_array(),
        'obat' => $this->Common_model->getData('*','m_obat','',['total_qty !=' => 0],'')->result_array(),
        'supplier' => $this->Common_model->getData('*','m_supplier','','','')->result_array(),
        'jumlah_data' => $this->Common_model->getData('*','t_detail_retur_masuk','',['id_retur'=>$id],'')->num_rows()
      );

      $footer = array(
        'control' => 'transaksi_retur_edit.js',
      );

      $this->load->view('common/header',$header);
      $this->load->view('transaksi-retur/editData',$data);
      $this->load->view('common/footer', $footer);    

    }else{
        redirect(base_url().'Login');
    }
  }

  // function to doing update data from database
  public function update()
  {
    // Check if session data(id) is available
    if(isset($_SESSION['id'])){
      
      $id = $this->input->post('id');
      $kode = $this->input->post('notransaksi');
      $file = $this->input->post('bukti_old');
      $tglretur = $this->input->post('tglretur');
          // $jumlah_detail = $this->Common_model->getData('*','t_detail_pembelian','',['id_pembelian_obat'=>$id],'')->num_rows();
            if(!empty($_FILES['scan_bukti']['name'])){
              $rmdir_old = $this->Common_model->removedir($id, $file,'bukti_retur');
              $bukti = $this->Common_model->do_upload($id,$kode,'scan_bukti','bukti_retur',$this->input->post('scan_bukti'));
              $update = $this->Common_model->update('t_retur',array('tgl_retur' => $tglretur,'bukti_retur'=>$bukti),['id'=>$id]);
            }else
              $update = $this->Common_model->update('t_retur',array('tgl_retur' => $tglretur),['id'=>$id]);
            // if success do
            if($updatedetail){
              $jumlah_detail = $this->Common_model->getData('*','t_detail_retur_keluar','',['id_retur' => $id],'')->num_rows();
              $detail_old = $this->Common_model->getData('*','t_detail_retur_keluar','',['id_retur' => $id],'')->result_array();
            for($n=0;$n<$jumlah_detail;$n++){
              $jumlah_old = $this->Common_model->getData('*','m_detail_obat','',['id'=>$detail_old[$n]['id_detail_obat']],'')->row();
              $return_old = $this->Common_model->update('m_detail_obat',['qty'=>($jumlah_old->qty+$detail_old[$n]['qty']),'status'=>1],['id'=>$detail_old[$n]['id_detail_obat']]);
              if($return_old){
                $delete_old = $this->Common_model->delete('t_detail_retur_keluar',['id'=>$detail_old[$n]['id']]);
                }
              }

            $row = 0;
            $total_array = count($this->input->post('obat'));
                for($i=0;$i<$total_array;$i++){
                  $sub_values_keluar = array(
                    'id_retur' => $id,
                    'id_detail_obat' => $this->input->post('batch')[$i],
                    'qty' => $this->input->post('qty')[$i],
                    'keterangan' => $this->input->post('keterangan')[$i]
                    );
                  $add_detail = $this->Common_model->insert('t_detail_retur_keluar',$sub_values_keluar);
                  $qty = $this->input->post('qty')[$i];
                  $harga = $this->input->post('harga')[$i];
                  $sub_values_masuk = array(
                    'id_retur' => $id,
                    'id_obat' => $this->input->post('obat')[$i],
                    'id_supplier' => $this->input->post('supplier')[$i],
                    'batch' => $this->input->post('batchbaru')[$i],
                    'exp_date' => $this->input->post('expbaru')[$i],
                    'qty' => $qty,
                    'harga' => $harga,
                    'sub_total' => $qty * $harga
                    );
                  $add_detail = $this->Common_model->insert('t_detail_retur_masuk',$sub_values_masuk);
                  $row++;
                  }             
                  if($row==$total_array){
                    // set flashdata success
                    $this->session->set_flashdata('success', "<strong> Sukses!</strong> Berhasil menambahkan data.");
                    redirect(base_url().'TransaksiRetur');
                  }else{
                    // set flashdata error
                    $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menambahkan data, detail retur error.");
                    redirect(base_url().'TransaksiRetur');
                  }
            }else{
              // set flashdata error
              $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menambahkan data, no transaksi error.");
              redirect(base_url().'TransaksiRetur');
            }
      }else{
          redirect(base_url().'Login');
      }
  }

  // function to doing delete from database
  public function delete()
  {
    // Check if session data(id) is available
    if(isset($_SESSION['id'])){
      $id = $this->uri->segment(3);
      // doing delete user data
      $sql = $this->Common_model->delete('t_retur',['id'=>$id]);
      $retur = $this->Common_model->getData('*','t_retur','',['id'=>$id],'')->row();

        $jumlah_detail = $this->Common_model->getData('*','t_detail_retur_masuk','',['id_retur' => $retur->id],'')->num_rows();
        $detail_old = $this->Common_model->getData('*','t_detail_retur_masuk','',['id_retur' => $retur->id],'')->result_array();
        $cek = 0;
        for($n=0;$n<$jumlah_detail;$n++){
          $jumlah_old = $this->Common_model->getData('*','m_detail_obat','',['id'=>$detail_old[$n]['id_detail_obat']],'')->row();
          $return_old = $this->Common_model->update('m_detail_obat',['qty'=>($jumlah_old->qty+$detail_old[$n]['qty']),'status'=>1],['id'=>$detail_old[$n]['id_detail_obat']]);
          if($return_old){
            $delete_old = $this->Common_model->delete('t_detail_retur_masuk','',['id'=>$detail_old[$n]['id']]);
          
          }
          $cek++;
        }

      if($cek==$jumlah_detail){
        // set flashdata success
        $this->session->set_flashdata('success', "<strong> Sukses!</strong> Berhasil menghapus data.");
        redirect(base_url().'TransaksiRetur');
      }else{
        // set flashdata error
        $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menghapus data.");
        redirect(base_url().'TransaksiRetur');
      }
    }else{
        redirect(base_url().'Login');
    }
  }

  public function detail()
  {
    // Check if session data(id) is available
    if(isset($_SESSION['id'])){
      $id = $this->uri->segment(3);
      // doing delete user data

      $header = array(
        'title' => 'Transaksi Retur',
        'header' => 'Transaksi Retur',
        'sub_header' => 'Detail Transaksi'
      );
      // data for content
      $data = array(  
        'data' => $this->Common_model->getData('r.id, r.no_transaksi, r.tgl_retur, r.total_qty, r.total_harga, r.bukti_retur, r.id_user, u.nama_user','t_retur r',['m_user u','u.id = r.id_user'],['r.id'=>$id],['r.no_transaksi','ASC'])->row(),
        'dataTableDetail' => $this->Common_model->getData('o.nama_obat, s.nama_supplier, rm.batch, rm.exp_date, rm.qty, rm.harga, rm.sub_total','t_detail_retur_masuk rm',['m_obat o','rm.id_obat = o.id','m_supplier s','s.id = rm.id_supplier'],['rm.id_retur'=>$id],['rm.id','ASC'])->result_array()
      );

      // data for footer 
      $footer = array(
        'control' => 'transaksi_retur.js',
      );

      $this->load->view('common/header',$header);
      $this->load->view('transaksi-retur/detailData',$data);
      $this->load->view('common/footer', $footer); 
    }else{
        redirect(base_url().'Login');
    }
  }

  function dir(){
    echo $this->Common_model->newdir('1','scan_bukti',$this->input->post('scan_bukti'));
  }

  function rmdir(){
    if(isset($_SESSION['id'])){
      $id = $this->uri->segment(3);
      // $dir = '/opt/lampp/htdocs/sia_rolas/uploads/buktiretur/'.$id.'/';
      $file = $this->uri->segment(4);

      $sql = $this->Common_model->removedir($id, $file,'bukti_retur');
      if($sql=="success"){
        $query = $this->Common_model->update('t_retur', array('bukti_retur' => NULL), ['id'=>$id]);
        redirect(base_url().'TransaksiRetur/edit/'.$id);
      }else{
        // set flashdata error
        // $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menghapus data.");
        redirect(base_url().'TransaksiRetur/edit/'.$id);
      }
    }else{
        redirect(base_url().'Login');
    }
  }

  public function api_batch(){
    if(isset($_SESSION['id'])){
      $id = $this->input->post('id');
      // doing delete user data
      $sql = $this->Common_model->getData('id, batch','m_detail_obat','',['id_obat'=>$id],'')->result_array();
      echo json_encode($sql);
    }else{
        redirect(base_url().'Login');
    }
  }

  public function api_detailbatch(){
    if(isset($_SESSION['id'])){
      $id = $this->input->post('id');
      // doing delete user data
      $sql = $this->Common_model->getData('do.id, do.id_supplier, s.kode_supplier, s.nama_supplier, do.tgl_pembelian, do.exp_date, do.harga_beli','m_detail_obat do',['m_supplier s','do.id_supplier = s.id'],['do.id'=>$id],'')->row();
      echo json_encode($sql);
    }else{
        redirect(base_url().'Login');
    }
  }

  function testing()
  {
    $id = $this->uri->segment(3);
    $sql = $this->Common_model->getData('drm.id_retur, drm.id_obat, drm.id_supplier, drm.qty, drm.harga, drk.keterangan, drm.batch as batch_baru, drm.exp_date as exp_date_baru','t_detail_retur_masuk drm',['t_retur r','drm.id_retur = r.id','t_detail_retur_keluar drk','drk.id_retur = r.id'],['r.id'=>$id],'')->result_array();
    echo json_encode($sql);
  }

}


/* End of file TransaksiRetur.php */
/* Location: ./application/controllers/TransaksiRetur.php */