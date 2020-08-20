<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterResep extends CI_Controller
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
        'title' => 'Master Resep',
        'header' => 'Master Resep',
        'sub_header' => 'List data'
      );
      // data for content
      $data = array(  
        'dataTable' => $this->Common_model->getData('r.id, r.no_resep, r.tgl_resep, p.nik, p.nama_pasien, r.id_user, u.nama_user, r.status','t_resep r',['m_pasien p','p.id = r.id_pasien','m_user u','u.id = r.id_user'],'',['r.id','ASC'])->result_array()
      );

      // data for footer 
      $footer = array(
        'control' => 'master_resep.js',
      );

      // get flashdata
      if($this->session->flashdata('success')){
        $data['notif_sukses'] = $this->session->flashdata('success');
      }elseif($this->session->flashdata('error')){
        $data['notif_gagal'] = $this->session->flashdata('error');
      }
    
    // load view 
    $this->load->view('common/header',$header);
    $this->load->view('master-resep/showData',$data);
    $this->load->view('common/footer', $footer);
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
        'title' => 'Master Resep',
        'header' => 'Master Resep',
        'sub_header' => 'Tambah data'
      );

      $data = array(
        'id_pasien' => $this->Common_model->getData('*','m_pasien','','','')->result_array(),
        'obat' => $this->Common_model->getData('*','m_obat','',['total_qty !=' => 0],'')->result_array(),
        'dosis' => $this->Common_model->getData('*','m_dosis','','','')->result_array()
      );

      // data for footer 
      $footer = array(
        'control' => 'master_resep.js',
      );

      $this->load->view('common/header', $header);
      $this->load->view('master-resep/addData', $data);
      $this->load->view('common/footer', $footer);    

    }else{
        redirect(base_url().'Login');
    }
  }

  // function for doing insert data into database
  public function insert()
  {
    // Check if session data(id) is available
    if(isset($_SESSION['id'])){

      // data to insert into database

      $values = array(
        'no_resep' => "RSP000001",
        'tgl_resep' => $this->input->post('tanggal'),
        'id_pasien' => $this->input->post('id_pasien'),
        'id_user' => $this->session->userdata('id')
      );
      
      // insert into database
       $sql = $this->Common_model->insert('t_resep',$values);
      // if success do
       if($sql){
         // get last insert id
         $id = $this->db->insert_id();
         // if last insert id < 10 
         if($id < 10)
           $kode = 'RSP00000';
         else if($id < 100)
           $kode = 'RSP0000';
         else if($id < 1000)
           $kode = 'RSP000';
         else if($id < 10000)
           $kode = 'RSP00';
         else if($id < 100000)
           $kode = 'RSP0';
         else
           $kode = 'RSP';
           // update kode user from database
           $update = $this->Common_model->update('t_resep',array('no_resep' => $kode.$id),['id'=>$id]);
           // if success do
           if($update){
            $row = 0;
            $total_array = count($this->input->post('obat'));
            for($i=0;$i<$total_array;$i++){
              $sub_values = array(
                'id_resep' => $id,
                'id_obat' => $this->input->post('obat')[$i],
                'qty' => $this->input->post('jumlah')[$i],
                'id_dosis' => $this->input->post('dosis')[$i]
                );
              $add_detail = $this->Common_model->insert('t_detail_resep',$sub_values);
              $row++;
            }
            if($row==$total_array){
             // set flashdata success
             $this->session->set_flashdata('success', "<strong> Sukses!</strong> Berhasil menambahkan data.");
             redirect(base_url().'MasterResep');
           }else{
             // set flashdata error
             $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menambahkan data, nomor resep error.");
             redirect(base_url().'MasterResep');
           }
       // if error do
       }else{
         $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menambahkan data.");
         redirect(base_url().'MasterResep');
       }

    }else{
        redirect(base_url().'Login');
    }
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
        'title' => 'Master Resep',
        'header' => 'Master Resep',
        'sub_header' => 'Edit data'
      );

      $data = array(
        'data' => $this->Common_model->getData('*','t_resep','',['id'=>$id],'')->row(),
        'id_pasien' => $this->Common_model->getData('*','m_pasien','','','')->result_array(),
        'obat' => $this->Common_model->getData('*','m_obat','',['total_qty !=' => 0],'')->result_array(),
        'dosis' => $this->Common_model->getData('*','m_dosis','','','')->result_array(),
        'detail' => $this->Common_model->getData('dr.id, dr.id_resep, dr.id_obat, o.kode_obat, o.nama_obat, dr.qty, dr.id_dosis, d.konsumsi_obat','t_detail_resep dr',['m_obat o','o.id = dr.id_obat','m_dosis d','d.id = dr.id_dosis'],['id_resep'=>$id],'')->result_array(),
        'jumlah' => $this->Common_model->getData('*','t_detail_resep','',['id_resep'=>$id],'')->num_rows()

      );

      $footer = array(
        'control' => 'master_resep_edit.js',
      );

      $this->load->view('common/header',$header);
      $this->load->view('master-resep/editData',$data);
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

     $id =  $this->input->post('id');
     $tgl_resep = $this->input->post('tanggal');
     $id_pasien = $this->input->post('id_pasien');
      $update = $this->Common_model->update('t_resep',array('tgl_resep' => $tgl_resep),['id'=>$id]);
           // if success do
           if($update){
             //hapus data detail awal
            $delete_detail = $this->Common_model->delete('t_detail_resep',['id_resep' => $id]);
            $row = 0;
            $total_array = count($this->input->post('obat'));
            for($i=0;$i<$total_array;$i++){
              $sub_values = array(
                'id_resep' => $id,
                'id_obat' => $this->input->post('obat')[$i],
                'qty' => $this->input->post('jumlah')[$i],
                'id_dosis' => $this->input->post('dosis')[$i]
                );
              $add_detail = $this->Common_model->insert('t_detail_resep',$sub_values);
              $row++;
            }
            if($row==$total_array){
             // set flashdata success
             $this->session->set_flashdata('success', "<strong> Sukses!</strong> Berhasil mengubah data.");
             redirect(base_url().'MasterResep');
           }else{
             // set flashdata error
             $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal mengubah data, nomor resep error.");
             redirect(base_url().'MasterResep');
           }
       // if error do
       }else{
         $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal mengubah data.");
         redirect(base_url().'MasterResep');
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
      $sql = $this->Common_model->delete('t_resep',['id'=>$id]);
      if($sql){
        // set flashdata success
        $this->session->set_flashdata('success', "<strong> Sukses!</strong> Berhasil menghapus data.");
        redirect(base_url().'MasterResep');
      }else{
        // set flashdata error
        $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menghapus data.");
        redirect(base_url().'MasterResep');
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
        'title' => 'Master Resep',
        'header' => 'Master Resep',
        'sub_header' => 'Detail Data'
      );
      // data for content
      $data = array(  
        'data' => $this->Common_model->getData('r.id, r.no_resep, r.tgl_resep, r.id_pasien, p.nama_pasien, r.id_user, u.nama_user,','t_resep r',['m_pasien p','p.id = r.id_pasien','m_user u','u.id = r.id_user'],['r.id'=>$id],['r.no_resep','ASC'])->row(),
        'dataTableDetail' => $this->Common_model->getData('o.nama_obat, dr.qty, d.konsumsi_obat','t_detail_resep dr',['m_obat o','dr.id_obat = o.id','m_dosis d','dr.id_dosis = d.id'],['dr.id_resep'=>$id],['dr.id','ASC'])->result_array()
      );

      // data for footer 
      $footer = array(
        'control' => 'master_resep.js'
      );

      $this->load->view('common/header',$header);
      $this->load->view('master-resep/detailData',$data);
      $this->load->view('common/footer', $footer); 
    }else{
        redirect(base_url().'Login');
    }
  }

  public function bayar()
  {
    // Check if session data(id) is available
    if(isset($_SESSION['id'])){
      $id_uri = $this->uri->segment(3);

      // $data = array(
      //   'id_resep' => $this->Common_model->getData('*','t_detail_resep','','','')->row(),
      //   'id_obat' => $this->Common_model->getData('*','t_detail_resep','','','')->result_array(),
      //   'qty' => $this->Common_model->getData('*','t_detail_resep','','','')->result_array(),
      //   'harga' => $this->Common_model->getData('*','m_obat','','','')->result_array(),
      // );

        // data to insert into database
      $values = array(
        'no_transaksi' => "TXJxxxxxx",
        'tgl_penjualan' => date('Y-m-d'),
        'id_resep' => $id_uri,
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
            $input = $this->Common_model->getData('*','t_detail_resep','',['id_resep'=>$id_uri],'')->result_array();
            $total_array = $this->db->affected_rows();
            for($i=0;$i<$total_array;$i++){
              $id_obat = $input[$i]['id_obat']; //get id_obat from input
              $qty = $input[$i]['qty']; //check qty from input
              $harga = $this->Common_model->getData('*','m_obat','',['id'=>$id_obat],'')->row()->harga_jual;
              $sub_total = $qty * $harga;
              while($qty!=0){
                $cek = $this->Common_model->getData('*','m_detail_obat','',['id_obat'=>$id_obat,'qty !='=> 0 ],['tgl_pembelian','ASC'])->row();
                if($cek->qty >= $qty){
                  $sub_values = array(
                    'id_penjualan' => $id,
                    'id_detail_obat' => $cek->id,
                    'qty' => $qty,
                    'harga' => $harga,
                    'sub_total' => $sub_total
                  );
                  $add_detail = $this->Common_model->insert('t_detail_penjualan',$sub_values);
                  if($add_detail)
                  $row++;
                  $update_stok = $this->Common_model->update('m_detail_obat',array('qty' => $cek->qty - $qty),['id'=>$cek->id]);
                  $qty = 0;
                }else if($cek->qty < $qty){
                  $sub_values = array(
                    'id_penjualan' => $id,
                    'id_detail_obat' => $cek->id,
                    'qty' => $cek->qty,
                    'harga' => $harga,
                    'sub_total' => $sub_total
                  );
                    $add_detail = $this->Common_model->insert('t_detail_penjualan',$sub_values);
                    if($add_detail)
                    $row++;
                    $update_stok = $this->Common_model->update('m_detail_obat',array('qty' => 0),['id'=>$cek->id]);
                    $qty = $qty - $cek->qty;
                  }
              } 
               $update_stok = $this->Common_model->update('t_resep',array('status' => 0),['id'=>$id_uri]); 
            }             
              if($row==$total_array){
                // set flashdata success
                $this->session->set_flashdata('success', "<strong> Sukses!</strong> Berhasil menambahkan data.");
                redirect(base_url().'TransaksiJual');
              }else if(($row==0)){
                // set flashdata error
                $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menambahkan data, detail penjualan error.");
                redirect(base_url().'TransaksiJual');
              }else{
                // set flashdata error
                $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menambahkan data, data detail penjualan kurang.");
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

  public function testing(){
    $input = $this->Common_model->getData('*','t_detail_resep','',['id_resep'=>11],'')->result_array();
    echo "Ini jumlah ",$this->db->affected_rows(),"<br>";
    echo "Ini data ", $input[0]['id_obat'],'<br>'; 
    echo $asd = $this->Common_model->getData('harga_jual','m_obat','',['id'=>3],'')->row()->harga_jual;
    // echo $asd->harga_jual;
  }

}


/* End of file Login.php */
/* Location: ./application/controllers/Login.php */