<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TransaksiJual extends CI_Controller
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
        'title' => 'Transaksi Penjualan',
        'header' => 'Transaksi Penjualan',
        'sub_header' => 'List data'
      );
      // data for content
      $data = array(  
        'dataTable' => $this->Common_model->getResepLeft()
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
    $this->load->view('transaksi-jual/showData',$data);
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
        'title' => 'Transaksi Penjualan',
        'header' => 'Transaksi Penjualan',
        'sub_header' => 'Tambah data'
      );

      $data = array(
        'obat' => $this->Common_model->getData('*','m_obat','',['total_qty !=' => 0],'')->result_array()
      );

      // data for footer 
      $footer = array(
        'control' => 'transaksi_jual.js',
      );

      $this->load->view('common/header', $header);
      $this->load->view('transaksi-jual/addData', $data);
      $this->load->view('common/footer',$footer);    

    }else{
        redirect(base_url().'Login');
    }
  }

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
        'no_transaksi' => "TXJxxxxxx",
        'tgl_penjualan' => $this->input->post('tgljual'),
        'id_resep' => NULL,
        'total_qty' => 0,
        'total_harga' => 0,
        'id_user' => $this->session->userdata('id')
      );
      
      // insert into database
      $sql = $this->Common_model->insert('t_penjualan',$values);
      // if success do
      if($sql){
        // get last insert id
        $id = $this->db->insert_id();
        // if last insert id < 10
        if($id < 10)
          $kode = 'TXJ000000';
        else if($id < 100)
          $kode = 'TXJ00000';
        else if($id < 1000)
          $kode = 'TXJ0000';
        else if($id < 10000)
          $kode = 'TXJ000';
        else if($id < 100000)
          $kode = 'TXJ00';
        else if($id < 1000000)
          $kode = 'TXJ0';
        else
          $kode = 'TXJ';
          // update kode user from database
          $update = $this->Common_model->update('t_penjualan',array('no_transaksi' => $kode.$id),['id'=>$id]);
          
          // if success do
          if($update){
            $row = 0;
            $total_array = count($this->input->post('obat'));
            for($i=0;$i<$total_array;$i++){
              $id_obat = $this->input->post('obat')[$i]; //get id_obat from input
              $qty = $this->input->post('jumlah')[$i]; //check qty from input
              while($qty!=0){
                $cek = $this->Common_model->getData('*','m_detail_obat','',['id_obat'=>$id_obat,'qty !='=> 0 ],['tgl_pembelian','ASC'])->row();
                if($cek->qty >= $qty){
                  $sub_values = array(
                    'id_penjualan' => $id,
                    'id_detail_obat' => $cek->id,
                    'qty' => $qty,
                    'harga' => $this->input->post('harga')[$i],
                    'sub_total' => $this->input->post('total')[$i]
                  );
                  $add_detail = $this->Common_model->insert('t_detail_penjualan',$sub_values);
                  $update_stok = $this->Common_model->update('m_detail_obat',array('qty' => $cek->qty - $qty),['id'=>$cek->id]);
                  $mutasi = $this->Common_model->update('t_mutasi',array('jenis'=>'SO'),['no_transaksi'=>$kode.$id]);
                  $qty = 0;
                }else if($cek->qty < $qty){
                    $sub_values = array(
                      'id_penjualan' => $id,
                      'id_detail_obat' => $cek->id,
                      'qty' => $cek->qty,
                      'harga' => $this->input->post('harga')[$i],
                      'sub_total' => $this->input->post('total')[$i]
                    );
                    $add_detail = $this->Common_model->insert('t_detail_penjualan',$sub_values);
                    $update_stok = $this->Common_model->update('m_detail_obat',array('qty' => 0,'status'=>0),['id'=>$cek->id]);
                    $mutasi = $this->Common_model->update('t_mutasi',array('jenis'=>'SO'),['no_transaksi'=>$kode.$id]);
                    $qty = $qty - $cek->qty;
                  }
              }
              // Update Keterangan Mutasi
              $row++;
            }             
              if($row==$total_array){
                // set flashdata success
                $this->session->set_flashdata('success', "<strong> Sukses!</strong> Berhasil menambahkan data.");
                redirect(base_url().'TransaksiJual');
              }else{
                // set flashdata error
                $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menambahkan data, detail penjualan error.");
                redirect(base_url().'TransaksiJual');
              }
          }else{
            // set flashdata error
            $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menambahkan data, no transaksi error.");
            redirect(base_url().'TransaksiJual');
          }
        // if error do
      }else{
        $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menambahkan data.");
        redirect(base_url().'TransaksiJual');
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
        'title' => 'Transaksi Penjualan',
        'header' => 'Transaksi Penjualan',
        'sub_header' => 'Edit data'
      );

      $data = array(
        'data' => $this->Common_model->getData('*','t_penjualan','',['id'=>$id],'')->row(),
        'detail' => $this->Common_model->getDataGroup('dob.id_obat, o.kode_obat, o.nama_obat, SUM(dp.qty) AS qty, dp.harga','t_detail_penjualan dp',['m_detail_obat dob','dob.id = dp.id_detail_obat', 'm_obat o','dob.id_obat = o.id'],['dp.id_penjualan'=>$id],'dob.id_obat')->result_array(),
        'jumlah_data' => $this->Common_model->getDataGroup('dob.id_obat, o.kode_obat, o.nama_obat, SUM(dp.qty) AS qty, dp.harga','t_detail_penjualan dp',['m_detail_obat dob','dob.id = dp.id_detail_obat', 'm_obat o','dob.id_obat = o.id'],['dp.id_penjualan'=>$id],'dob.id_obat')->num_rows(),
        'obat' => $this->Common_model->getData('*','m_obat','',['total_qty !=' => 0],'')->result_array()
      );

      $footer = array(
        'control' => 'transaksi_jual_edit.js',
      );

      $this->load->view('common/header',$header);
      $this->load->view('transaksi-jual/editData',$data);
      $this->load->view('common/footer',$footer);    

    }else{
        redirect(base_url().'Login');
    }
  }

  // function to doing update data from database
  public function update()
  {
    // Check if session data(id) is available
    if(isset($_SESSION['id'])){
      $id =  $this->input->post('id');
      $kode = $this->input->post('notransaksi');
      $tgl_jual = $this->input->post('tgljual');
      
      // doing update user data
      $update = $this->Common_model->update('t_penjualan',array('tgl_penjualan' => $tgl_jual),['id'=>$id]);
            
      if($update){
        $jumlah_detail = $this->Common_model->getData('*','t_detail_penjualan','',['id_penjualan' => $id],'')->num_rows();
        $detail_old = $this->Common_model->getData('*','t_detail_penjualan','',['id_penjualan' => $id],'')->result_array();
        for($n=0;$n<$jumlah_detail;$n++){
          $jumlah_old = $this->Common_model->getData('*','m_detail_obat','',['id'=>$detail_old[$n]['id_detail_obat']],'')->row();
          $return_old = $this->Common_model->update('m_detail_obat',['qty'=>($jumlah_old->qty+$detail_old[$n]['qty']),'status'=>1],['id'=>$detail_old[$n]['id_detail_obat']]);
          if($return_old){
            $delete_old = $this->Common_model->delete('t_detail_penjualan',['id'=>$detail_old[$n]['id']]);
          }
        }

        $row = 0;
        $total_array = count($this->input->post('obat'));
        for($i=0;$i<$total_array;$i++){
          $id_obat = $this->input->post('obat')[$i]; //get id_obat from input
          $qty = $this->input->post('jumlah')[$i]; //check qty from input
          while($qty!=0){
            $cek = $this->Common_model->getData('*','m_detail_obat','',['id_obat'=>$id_obat,'qty !='=> 0 ],['tgl_pembelian','ASC'])->row();
            if($cek->qty >= $qty){
              $sub_values = array(
                'id_penjualan' => $id,
                'id_detail_obat' => $cek->id,
                'qty' => $qty,
                'harga' => $this->input->post('harga')[$i],
                'sub_total' => $this->input->post('total')[$i]
              );
              $add_detail = $this->Common_model->insert('t_detail_penjualan',$sub_values);
              $update_stok = $this->Common_model->update('m_detail_obat',array('qty' => $cek->qty - $qty),['id'=>$cek->id]);
              $mutasi = $this->Common_model->update('t_mutasi',array('jenis'=>'SO'),['no_transaksi'=>$kode.$id]);
              $qty = 0;
            }else if($cek->qty < $qty){
                $sub_values = array(
                  'id_penjualan' => $id,
                  'id_detail_obat' => $cek->id,
                  'qty' => $cek->qty,
                  'harga' => $this->input->post('harga')[$i],
                  'sub_total' => $this->input->post('total')[$i]
                );
                $add_detail = $this->Common_model->insert('t_detail_penjualan',$sub_values);
                $update_stok = $this->Common_model->update('m_detail_obat',array('qty' => 0,'status'=>0),['id'=>$cek->id]);
                $mutasi = $this->Common_model->update('t_mutasi',array('jenis'=>'SO'),['no_transaksi'=>$kode.$id]);
                $qty = $qty - $cek->qty;
              }
          }
          // Update Keterangan Mutasi
          $row++;
        }             
          if($row==$total_array){
            // set flashdata success
            $this->session->set_flashdata('success', "<strong> Sukses!</strong> Berhasil mengubah data.");
            redirect(base_url().'TransaksiJual');
          }else{
            // set flashdata error
            $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal mengubah data, detail penjualan error.");
            redirect(base_url().'TransaksiJual');
          }
      }else{
        // set flashdata error
        $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal mengubah data, no transaksi error.");
        redirect(base_url().'TransaksiJual');
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
      $sql = $this->Common_model->delete('t_penjualan',['id'=>$id]);
      $penjualan = $this->Common_model->getData('*','t_penjualan','',['id'=>$id],'')->row();

        $jumlah_detail = $this->Common_model->getData('*','t_detail_penjualan','',['id_penjualan' => $penjualan->id],'')->num_rows();
        $detail_old = $this->Common_model->getData('*','t_detail_penjualan','',['id_penjualan' => $penjualan->id],'')->result_array();
        $cek = 0;
        for($n=0;$n<$jumlah_detail;$n++){
          $jumlah_old = $this->Common_model->getData('*','m_detail_obat','',['id'=>$detail_old[$n]['id_detail_obat']],'')->row();
          $return_old = $this->Common_model->update('m_detail_obat',['qty'=>($jumlah_old->qty+$detail_old[$n]['qty']),'status'=>1],['id'=>$detail_old[$n]['id_detail_obat']]);
          if($return_old){
            $delete_old = $this->Common_model->delete('t_detail_penjualan',['id'=>$detail_old[$n]['id']]);
          }
          $cek++;
        }

      if($cek==$jumlah_detail){
        // set flashdata success
        $this->session->set_flashdata('success', "<strong> Sukses!</strong> Berhasil menghapus data.");
        redirect(base_url().'TransaksiJual');
      }else{
        // set flashdata error
        $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menghapus data.");
        redirect(base_url().'TransaksiJual');
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
        'title' => 'Transaksi Penjualan',
        'header' => 'Transaksi Penjualan',
        'sub_header' => 'Detail Transaksi'
      );
      // data for content
      $data = array(  
        'data' => $this->Common_model->getData('p.id, p.no_transaksi, p.tgl_penjualan, p.id_resep, p.total_qty, p.total_harga, p.id_user, u.nama_user','t_penjualan p',['m_user u','u.id = p.id_user'],['p.id'=>$id],['p.no_transaksi','ASC'])->row(),
        'dataTableDetail' => $this->Common_model->getDetailLeft($id)
        );

      // data for footer 
      $footer = array(
        'control' => 'transaksi_jual.js',
      );

      $this->load->view('common/header',$header);
      $this->load->view('transaksi-jual/detailData',$data);
      $this->load->view('common/footer', $footer); 
    }else{
        redirect(base_url().'Login');
    }
  }

  public function api_harga(){
    if(isset($_SESSION['id'])){
      $id = $this->input->post('id');
      // doing delete user data
      $sql = $this->Common_model->getData('harga_jual','m_obat','',['id'=>$id],'')->row();
      echo json_encode($sql);
    }else{
        redirect(base_url().'Login');
    }
  }

  public function testing(){
    $id = 4;
    $sql = $this->Common_model->getDetailLeft($id);
    echo json_encode($sql);
    // echo json_encode($sql);
  }

}


/* End of file TransaksiJual.php */
/* Location: ./application/controllers/TransaksiJual.php */