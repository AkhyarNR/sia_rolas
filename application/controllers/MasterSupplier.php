<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Controller ContohController
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @author    Raul Guerrero <r.g.c@me.com>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class MasterSupplier extends CI_Controller
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
        'title' => 'Master Supplier',
        'header' => 'Master Supplier',
        'sub_header' => 'List data'
      );
      // data for content
      $data = array(  
        'dataTable' => $this->Common_model->getData('*','m_supplier','','',['kode_supplier','ASC'])->result_array()
      );

      // data for footer 
      $footer = array(
        'control' => 'master_supplier.js',
      );

      if($this->session->flashdata('success')){
				$data['notif_sukses'] = $this->session->flashdata('success');
			}elseif($this->session->flashdata('error')){
				$data['notif_gagal'] = $this->session->flashdata('error');
			}
    
    // load view 
    $this->load->view('common/header',$header);
    $this->load->view('master-supplier/showData',$data);
    $this->load->view('common/footer',$footer);
    }else{
      // redirect to 
      redirect(base_url().'Login'); 
    }
  }

  public function add()
  {
    if(isset($_SESSION['id'])){
     
      $header = array(
        'title' => 'Master Supplier',
        'header' => 'Master Supplier',
        'sub_header' => 'Tambah data'
      );
      $data = array(
        'dataTable' => $this->Common_model->getData('*','m_supplier','','','')->result_array()
      );

      $this->load->view('common/header', $header);
      $this->load->view('master-supplier/addData', $data);
      $this->load->view('common/footer');    

    }else{
        redirect(base_url().'Login');
    }
  }

  public function insert()
  {
    // Check if session data(id) is available
    if(isset($_SESSION['id'])){

      // data to insert into database
      $values = array(
        'kode_supplier' => "SUPxxx",
        'nama_supplier' => htmlspecialchars($this->input->post('nama'))
      );
      
      // insert into database
      $sql = $this->Common_model->insert('m_supplier',$values);
      // if success do
      if($sql){
        // get last insert id
        $id = $this->db->insert_id();
        // if last insert id < 10 
        if($id < 10)
          $kode = 'SUP00';
        else if($id < 100)
          $kode = 'SUP0';
        else
          $kode = 'SUP';
          // update kode user from database
          $update = $this->Common_model->update('m_supplier',array('kode_supplier' => $kode.$id),['id'=>$id]);
          // if success do
          if($update){
            // set flashdata success
            $this->session->set_flashdata('success', "<strong> Sukses!</strong> Berhasil menambahkan data.");
            redirect(base_url().'MasterSupplier');
          }else{
            // set flashdata error
            $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menambahkan data, kode supplier error.");
            redirect(base_url().'MasterSupplier');
          }
      // if error do
      }else{
        $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menambahkan data.");
        redirect(base_url().'MasterSupplier');
      }

    }else{
        redirect(base_url().'Login');
    }
  }

  public function edit()
  {
    // Check if session data(id) is available
    if(isset($_SESSION['id'])){
    
      // get data from url
      $id = $this->uri->segment(3);

      $header = array(
        'title' => 'Master Supplier',
        'header' => 'Master Supplier',
        'sub_header' => 'Edit data'
      );

      $data = array(
        'data' => $this->Common_model->getData('*','m_supplier','',['id'=>$id],'')->row()
      );

      $this->load->view('common/header',$header);
      $this->load->view('master-supplier/editData',$data);
      $this->load->view('common/footer');    

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
      // new values to update
      $values = array(
        'nama_supplier' => htmlspecialchars($this->input->post('nama'))
      );
      // doing update user data
      $sql = $this->Common_model->update('m_supplier', $values, ['id'=>$id]);
      if($sql){
        // set flashdata success
        $this->session->set_flashdata('success', "<strong> Sukses!</strong> Berhasil mengubah data.");
        redirect(base_url().'MasterSupplier');
      }else{
        // set flashdata error
        $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal mengubah data.");
        redirect(base_url().'MasterSupplier');
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
      $sql = $this->Common_model->delete('m_supplier',['id'=>$id]);
      if($sql){
        // set flashdata success
        $this->session->set_flashdata('success', "<strong> Sukses!</strong> Berhasil menghapus data.");
        redirect(base_url().'MasterSupplier');
      }else{
        // set flashdata error
        $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal menghapus data.");
        redirect(base_url().'MasterSupplier');
      }
    }else{
        redirect(base_url().'Login');
    }
  }
}
/* End of file ContohController.php */
/* Location: ./application/controllers/ContohController.php */