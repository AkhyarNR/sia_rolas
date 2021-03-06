<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TransaksiBeli extends CI_Controller
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
        'title' => 'Transaksi Pembelian',
        'header' => 'Transaksi Pembelian',
        'sub_header' => 'List data'
      );
      // data for content
      $data = array(  
        'dataTable' => $this->Common_model->getData('p.id, p.no_transaksi, p.tgl_pembelian, p.total_qty, p.total_harga, p.bukti_pembelian, p.id_user, u.nama_user','t_pembelian p',['m_user u','u.id = p.id_user'],'',['p.no_transaksi','ASC'])->result_array()
      );

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
    $this->load->view('transaksi-beli/showData',$data);
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
        'title' => 'Transaksi Pembelian',
        'header' => 'Transaksi Pembelian',
        'sub_header' => 'Tambah data'
      );
      
      $data = array(
        'obat' => $this->Common_model->getData('*','m_obat','','','')->result_array(),
        'supplier' => $this->Common_model->getData('*','m_supplier','','','')->result_array()
      );

      $footer = array(
        'control' => 'transaksi_beli.js',
      );

      $this->load->view('common/header', $header);
      $this->load->view('transaksi-beli/addData',$data);
      $this->load->view('common/footer',$footer);    

    }else{
        redirect(base_url().'Login');
    }
  }


  public function yuhu(){
    $this->input->post('tglbeli');
    if(!empty($_FILES['scan_bukti']['name'])){
    echo "berisi";
    }else{
    echo "tidak berisi";
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
        'no_transaksi' => "TXBxxxxxx",
        'tgl_pembelian' => $this->input->post('tglbeli'),
        'total_qty' => 0,
        'total_harga' => 0,
        'bukti_pembelian' => '',
        'id_user' => $this->session->userdata('id')
      );
      
      // insert into database
      $sql = $this->Common_model->insert('t_pembelian',$values);
      // if success do
      if($sql){
        // get last insert id
        $id = $this->db->insert_id();
        // if last insert id < 10
        if($id < 10)
          $kode = 'TXB000000';
        else if($id < 100)
          $kode = 'TXB00000';
        else if($id < 1000)
          $kode = 'TXB0000';
        else if($id < 10000)
          $kode = 'TXB000';
        else if($id < 100000)
          $kode = 'TXB00';
        else if($id < 1000000)
          $kode = 'TXB0';
        else
          $kode = 'TXB';
          // update kode user from database
          if(!empty($_FILES['scan_bukti']['name'])){
            $bukti = $this->Common_model->do_upload($id,$kode.$id,'scan_bukti','bukti_beli',$this->input->post('scan_bukti'));
            $update = $this->Common_model->update('t_pembelian',array('no_transaksi' => $kode.$id,'bukti_pembelian'=>$bukti),['id'=>$id]);
          }else
          $update = $this->Common_model->update('t_pembelian',array('no_transaksi' => $kode.$id),['id'=>$id]);
          
          // if success do
          if($update){
            $row = 0;
            $total_array = count($this->input->post('obat'));
            for($i=0;$i<$total_array;$i++){
              $sub_values = array(
                'id_pembelian' => $id,
                'id_obat' => $this->input->post('obat')[$i],
                'id_supplier' => $this->input->post('supplier')[$i],
                'batch' => $this->input->post('batch')[$i],
                'exp_date' => $this->input->post('exp')[$i],
                'qty' => $this->input->post('jumlah')[$i],
                'harga' => $this->input->post('harga')[$i],
                'sub_total' => $this->input->post('total')[$i]
              );
              $add_detail = $this->Common_model->insert('t_detail_pembelian',$sub_values);
              $row++;
            }             
              if($row==$total_array){
                // set flashdata success
                $this->session->set_flashdata('success', "<strong> Sukses!</strong> Berhasil menambahkan data.");
                redirect(base_url().'TransaksiBeli');
              }else{
                // set flashdata error
                $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menambahkan data, detail pembelian error.");
                redirect(base_url().'TransaksiBeli');
              }
          }else{
            // set flashdata error
            $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menambahkan data, no transaksi error.");
            redirect(base_url().'TransaksiBeli');
          }
        // if error do
      }else{
        $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menambahkan data.");
        redirect(base_url().'TransaksiBeli');
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
        'title' => 'Transaksi Pembelian',
        'header' => 'Transaksi Pembelian',
        'sub_header' => 'Edit data'
      );

      $data = array(
        'data' => $this->Common_model->getData('*','t_pembelian','',['id'=>$id],'')->row(),
        'detail' => $this->Common_model->getData('dp.id, dp.id_pembelian, dp.id_obat, o.kode_obat, o.nama_obat, dp.id_supplier, s.kode_supplier, s.nama_supplier, dp.batch, dp.exp_date, dp.qty, dp.harga','t_detail_pembelian dp',['m_obat o','dp.id_obat = o.id','m_supplier s','dp.id_supplier = s.id'],['dp.id_pembelian'=>$id],'')->result_array(),
        'obat' => $this->Common_model->getData('*','m_obat','','','')->result_array(),
        'supplier' => $this->Common_model->getData('*','m_supplier','','','')->result_array(),
        'jumlah_data' => $this->Common_model->getData('*','t_detail_pembelian','',['id_pembelian'=>$id],'')->num_rows()
      );

      $footer = array(
        'control' => 'transaksi_beli_edit.js',
      );

      $this->load->view('common/header',$header);
      $this->load->view('transaksi-beli/editData',$data);
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
      $tgl_beli = $this->input->post('tglbeli');
      
          // $jumlah_detail = $this->Common_model->getData('*','t_detail_pembelian','',['id_pembelian'=>$id],'')->num_rows();
            if(!empty($_FILES['scan_bukti']['name'])){
              $rmdir_old = $this->Common_model->removedir($id, $file,'bukti_beli');
              $bukti = $this->Common_model->do_upload($id,$kode,'scan_bukti','bukti_beli',$this->input->post('scan_bukti'));
              $update = $this->Common_model->update('t_pembelian',array('tgl_pembelian' => $tgl_beli,'bukti_pembelian'=>$bukti),['id'=>$id]);
            }else
              $update = $this->Common_model->update('t_pembelian',array('tgl_pembelian' => $tgl_beli),['id'=>$id]);
            // if success do
            if($update){
              $delete_detail = $this->Common_model->delete('t_detail_pembelian',['id_pembelian' => $id]);
                $row = 0;
                $total_array = count($this->input->post('obat'));
                for($i=0;$i<$total_array;$i++){
                  $sub_values = array(
                    'id_pembelian' => $id,
                    'id_obat' => $this->input->post('obat')[$i],
                    'id_supplier' => $this->input->post('supplier')[$i],
                    'batch' => $this->input->post('batch')[$i],
                    'exp_date' => $this->input->post('exp')[$i],
                    'qty' => $this->input->post('jumlah')[$i],
                    'harga' => $this->input->post('harga')[$i],
                    'sub_total' => $this->input->post('total')[$i]
                  );
                  $add_detail = $this->Common_model->insert('t_detail_pembelian',$sub_values);
                  $row++;
                }             
                  if($row==$total_array){
                    // set flashdata success
                    $this->session->set_flashdata('success', "<strong> Sukses!</strong> Berhasil mengubah data.");
                    redirect(base_url().'TransaksiBeli');
                  }else{
                    // set flashdata error
                    $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal mengubah data, detail pembelian error.");
                    redirect(base_url().'TransaksiBeli');
                  }
            }else{
              // set flashdata error
              $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal mengubah data, no transaksi error.");
              redirect(base_url().'TransaksiBeli');
            }
      }else{
          redirect(base_url().'Login');
      }
  }

  // function to doing delete from database
  public function delete()
  {
    // // Check if session data(id) is available
    // if(isset($_SESSION['id'])){
    //   $id = $this->uri->segment(3);
    //   // doing delete user data
    //   $sql = $this->Common_model->delete('t_pembelian',['id'=>$id]);
    //   $pembelian = $this->Common_model->getData('*','t_pembelian','',['id'=>$id],'')->row();

    //     $jumlah_detail = $this->Common_model->getData('*','t_detail_pembelian','',['id_pembelian' => $pembelian->id],'')->num_rows();
    //     $detail_old = $this->Common_model->getData('*','t_detail_pembelian','',['id_pembelian' => $pembelian->id],'')->result_array();
    //     $cek = 0;
    //     for($n=0;$n<$jumlah_detail;$n++){
    //       $jumlah_old = $this->Common_model->getData('*','m_detail_obat','',['id'=>$detail_old[$n]['id_detail_obat']],'')->row();
    //       $return_old = $this->Common_model->update('m_detail_obat',['qty'=>($jumlah_old->qty+$detail_old[$n]['qty']),'status'=>1],['id'=>$detail_old[$n]['id_detail_obat']]);
    //       if($return_old){
    //         $delete_old = $this->Common_model->delete('t_detail_pembelian',['id'=>$detail_old[$n]['id']]);
    //       }
    //       $cek++;
    //     }

    //   if($cek==$jumlah_detail){
    //     // set flashdata success
    //     $this->session->set_flashdata('success', "<strong> Sukses!</strong> Berhasil menghapus data.");
    //     redirect(base_url().'TransaksiBeli');
    //   }else{
    //     // set flashdata error
    //     $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menghapus data.");
    //     redirect(base_url().'TransaksiBeli');
    //   }
    // }else{
    //     redirect(base_url().'Login');
    // }
  }

  public function detail()
  {
    // Check if session data(id) is available
    if(isset($_SESSION['id'])){
      $id = $this->uri->segment(3);
      // doing delete user data

      $header = array(
        'title' => 'Transaksi Pembelian',
        'header' => 'Transaksi Pembelian',
        'sub_header' => 'Detail Transaksi'
      );
      // data for content
      $data = array(  
        'data' => $this->Common_model->getData('p.id, p.no_transaksi, p.tgl_pembelian, p.total_qty, p.total_harga, p.bukti_pembelian, p.id_user, u.nama_user','t_pembelian p',['m_user u','u.id = p.id_user'],['p.id'=>$id],['p.no_transaksi','ASC'])->row(),
        'dataTableDetail' => $this->Common_model->getData('o.nama_obat, s.nama_supplier, dp.batch, dp.exp_date, dp.qty, dp.harga, dp.sub_total','t_detail_pembelian dp',['m_obat o','dp.id_obat = o.id','m_supplier s','dp.id_supplier = s.id'],['dp.id_pembelian'=>$id],['dp.id','ASC'])->result_array()
      );

      // data for footer 
      $footer = array(
        'control' => 'transaksi_beli.js',
      );

      $this->load->view('common/header',$header);
      $this->load->view('transaksi-beli/detailData',$data);
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
      // $dir = '/opt/lampp/htdocs/sia_rolas/uploads/bukti_beli/'.$id.'/';
      $file = $this->uri->segment(4);

      $sql = $this->Common_model->removedir($id, $file,'bukti_beli');
      if($sql=="success"){
        $query = $this->Common_model->update('t_pembelian', array('bukti_pembelian' => NULL), ['id'=>$id]);
        redirect(base_url().'TransaksiBeli/edit/'.$id);
      }else{
        // set flashdata error
        // $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menghapus data.");
        redirect(base_url().'TransaksiBeli/edit/'.$id);
      }
    }else{
        redirect(base_url().'Login');
    }
  }


}


/* End of file TransaksiBeli.php */
/* Location: ./application/controllers/TransaksiBeli.php */