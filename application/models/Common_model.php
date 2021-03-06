<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model {

  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set("Asia/Jakarta");
  }


  public function insert($tb, $values)
  {
    return $this->db->insert($tb, $values);
    // INSERT INTO mytable (field, field, field) VALUES ('data', 'data', 'data')
  }

  public function update($tb, $values, $filter)
  {
    return $this->db->update($tb, $values, $filter);
    // UPDATE mytable SET field = 'data', field = 'data' WHERE key = 'data'
  }

  public function delete($tb, $filter)
  {
    return $this->db->delete($tb, $filter);
    // DELETE FROM mytable WHERE key = 'data'
  }

  public function getData($select, $tb, $join, $filter, $order)
  {
    $sql = $this->db->select($select);
    // SELECT field FROM mytable
    
    if($join!="")
    {
      // SELECT * FROM mytable JOIN table ON field.id = field.id
      for($i=0;$i<count($join);$i++){
        // $join = 2
        if($i%2!=0)
        {
          $sql = $this->db->join($join[$i-1],$join[$i]);
          // $this->db->join($i[1]('comments', $i[2]'comments.id = blogs.id');
        }
      }
    }

    if($order!="")
    {
      if(is_array($order)){
        $sql = $this->db->order_by($order[0],$order[1]);
        // SELECT * FROM mytable ORDER BY field DESC/ ASC, field DESC/ ASC
      }
      else{
        $sql = $this->db->order_by($order);
        // SELECT * FROM mytable ORDER BY field DESC/ ASC
      }
    }

    if($filter!="")
    {
      $sql = $this->db->where($filter);
      // SELECT * FROM mytable WHERE field = 'data'
    }

    if(is_array($tb)){
      $sql = $this->db->get($tb[0], $tb[1], $tb[2]);
      // SELECT field, field, field FROM mytable, table
    }
    else{
      $sql = $this->db->get($tb);
      // SELECT * myFROM table
    }

    return $sql;

  }

  public function getDataDistinct($select, $tb, $join, $filter, $order)
  {
    $sql = $this->db->distinct();
    $sql = $this->db->select($select);
    // SELECT field FROM mytable
    
    if($join!="")
    {
      // SELECT * FROM mytable JOIN table ON field.id = field.id
      for($i=0;$i<count($join);$i++){
        // $join = 2
        if($i%2!=0)
        {
          $sql = $this->db->join($join[$i-1],$join[$i]);
          // $this->db->join($i[1]('comments', $i[2]'comments.id = blogs.id');
        }
      }
    }

    if($order!="")
    {
      if(is_array($order)){
        $sql = $this->db->order_by($order[0],$order[1]);
        // SELECT * FROM mytable ORDER BY field DESC/ ASC, field DESC/ ASC
      }
      else{
        $sql = $this->db->order_by($order);
        // SELECT * FROM mytable ORDER BY field DESC/ ASC
      }
    }

    if($filter!="")
    {
      $sql = $this->db->where($filter);
      // SELECT * FROM mytable WHERE field = 'data'
    }

    if(is_array($tb)){
      $sql = $this->db->get($tb[0], $tb[1], $tb[2]);
      // SELECT field, field, field FROM mytable, table
    }
    else{
      $sql = $this->db->get($tb);
      // SELECT * myFROM table
    }

    return $sql;

  }
  
  public function getDataGroup($select, $tb, $join, $filter, $group)
  {
    $sql = $this->db->select($select);
    // SELECT field FROM mytable
    
    if($join!="")
    {
      // SELECT * FROM mytable JOIN table ON field.id = field.id
      for($i=0;$i<count($join);$i++){
        // $join = 2
        if($i%2!=0)
        {
          $sql = $this->db->join($join[$i-1],$join[$i]);
          // $this->db->join($i[1]('comments', $i[2]'comments.id = blogs.id');
        }
      }
    }

    if($group!="")
    {
        $sql = $this->db->group_by($group);
        // SELECT * FROM mytable GROUP BY field DESC/ ASC
    }

    if($filter!="")
    {
      $sql = $this->db->where($filter);
      // SELECT * FROM mytable WHERE field = 'data'
    }

    if(is_array($tb)){
      $sql = $this->db->get($tb[0], $tb[1], $tb[2]);
      // SELECT field, field, field FROM mytable, table
    }
    else{
      $sql = $this->db->get($tb);
      // SELECT * myFROM table
    }

    return $sql;

  }

  // Special model 
  function getResepLeft(){
    $sql = $this->db->select('p.id, p.no_transaksi, p.tgl_penjualan, p.id_resep, r.no_resep, p.total_qty, p.total_harga, u.nama_user');
    $sql = $this->db->join('t_resep r', 'p.id_resep = r.id','left');
    $sql = $this->db->join('m_user u','p.id_user = u.id');
    $sql = $this->db->order_by('no_transaksi','ASC');
    $sql = $this->db->get('t_penjualan p');
    return $sql->result_array();
  }

  function getJualLeft($filter){
    $sql = $this->db->select('j.id, j.no_transaksi, j.tgl_penjualan, r.no_resep, o.nama_obat, dob.batch, dp.qty, dp.harga, dp.sub_total, u.nama_user');
    $sql = $this->db->join('t_detail_penjualan dp','j.id = dp.id_penjualan');
    $sql = $this->db->join('m_detail_obat dob', 'dob.id = dp.id_detail_obat');
    $sql = $this->db->join('m_obat o', 'o.id = dob.id_obat');
    $sql = $this->db->join('m_user u', 'u.id = j.id_user');
    $sql = $this->db->join('t_resep r', 'r.id = j.id_resep','left');
    $sql = $this->db->order_by('no_transaksi','ASC');
    $sql = $this->db->where($filter);
    $sql = $this->db->get('t_penjualan j');
    return $sql->result_array();
  }

  function getDetailLeft($id){
    $sql = $this->db->select('o.nama_obat, s.nama_supplier, dm.batch, dm.exp_date, ds.konsumsi_obat, dp.qty, dp.harga, dp.sub_total');
    $sql = $this->db->join('m_detail_obat dm','dp.id_detail_obat = dm.id');
    $sql = $this->db->join('m_obat o','dm.id_obat = o.id');
    $sql = $this->db->join('m_supplier s','dm.id_supplier = s.id');
    $sql = $this->db->join('t_penjualan p','dp.id_penjualan = p.id');
    $sql = $this->db->join('t_resep rs', 'p.id_resep = rs.id','left');
    $sql = $this->db->join('t_detail_resep dr', 'dr.id_resep = rs.id','left');
    $sql = $this->db->join('m_dosis ds', 'dr.id_dosis = ds.id','left');
    $sql = $this->db->group_by('dp.id');
    $sql = $this->db->where(array('dp.id_penjualan' => $id));
    $sql = $this->db->get('t_detail_penjualan dp');
    return $sql->result_array();
  }

  // ==================

  public function do_upload($id, $kodetrx, $name, $folder)
  {
    $new_dir = 'uploads/'.$folder.'/'.$id;
    if(mkdir($new_dir,0777,true)){
      $config['upload_path']          = $new_dir;
      $config['allowed_types']        = 'jpeg|jpg|png';
      $config['overwrite']            = true;
      $config['file_name']            = 'img_'.$kodetrx;

      $this->load->library('upload', $config);

      if ($this->upload->do_upload($name))
      {
        chmod($this->upload->data('full_path'), 0777);
        return $this->upload->data('file_name');
      }
      else
      {
        // return $this->upload->display_errors();
        return NULL;
      }
    }else{
      return "Error";
    }
  }

  function removedir($id, $file, $folder) {
    $dir = '/opt/lampp/htdocs/sia_rolas/uploads/'.$folder.'/'.$id.'/';
    
    if(file_exists($dir)) {
      if(unlink($dir.$file))
        if(rmdir($dir))
          return 'success';
        else
          return 'error';
      else
        $message = 'error unlink';
    }else{
      if(rmdir($dir))
          return 'success';
        else
          return 'error';
    }
  } 

}

/* End of file Common_model.php */
/* Location: ./application/models/Common_model.php */