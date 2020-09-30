<?php
defined('BASEPATH') or exit('No direct script access allowed');


class MasterSettings extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Common_model');
  }

  public function index()
  {
    // Check if session data(id) is available
    if(isset($_SESSION['id'])){
    
      $header = array(
        'title' => 'Master Settings',
        'header' => 'Master Settings',
        'sub_header' => 'Edit data'
      );

      $data = array(
        'data' => $this->Common_model->getData('*','m_settings','',['id'=>'1'],'')->row()
      );

      // get flashdata
      if($this->session->flashdata('success')){
        $data['notif_sukses'] = $this->session->flashdata('success');
      }elseif($this->session->flashdata('error')){
        $data['notif_gagal'] = $this->session->flashdata('error');
      }

      $this->load->view('common/header',$header);
      $this->load->view('master-settings/editData',$data);
      $this->load->view('common/footer');    

    }else{
        redirect(base_url().'Login');
    }
  }

  public function update()
  {
    if(isset($_SESSION['id'])){
      $id =  $this->input->post('id');
      // new values to update
      $values = array(
        'set_min_exp_day' => htmlspecialchars($this->input->post('set_exp')),
        'set_min_jumlah' => htmlspecialchars($this->input->post('set_jumlah'))
      );
      // doing update user data
      $sql = $this->Common_model->update('m_settings', $values, ['id'=>$id]);
      if($sql){
        // set flashdata success
        $this->session->set_flashdata('success', "<strong> Sukses!</strong> Berhasil mengubah data.");
        redirect(base_url().'MasterSettings');
      }else{
        // set flashdata error
        $this->session->set_flashdata('error', "<strong> Error!</strong> Gagal mengubah data.");
        redirect(base_url().'MasterSettings');
      }
    }else{
        redirect(base_url().'Login');
    }

  }

}


/* End of file ContohController.php */
/* Location: ./application/controllers/ContohController.php */