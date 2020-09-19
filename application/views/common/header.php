<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIA ROLAS - <?php if(isset($title)) echo $title; else echo "Title Content" ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Plugins-->
  <!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap.css"> -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/select2/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/all.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-flash-1.6.2/b-html5-1.6.2/b-print-1.6.2/r-2.2.5/sc-2.0.2/sp-1.1.1/datatables.min.css"/>
 
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.4/css/dataTables.responsive.css"> -->
  
  

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/skins/_all-skins.min.css">
  <link href="<?php echo base_url() ?>assets/img/logo-.png" rel='shortcut icon'>
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url()?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>IA</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SIA </b>ROLAS</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url() ?>assets/img/user.jpeg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata('nama');?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url()?>assets/img/user.jpeg" class="img-circle" alt="User Image">
                <p>
                <?php echo $this->session->userdata('nama')."<br><strong>".$this->session->userdata('jabatan')."</strong>"; ?> 
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <!-- <div class="pull-left">
                  <a href="#" class="btn btn-basic btn-flat">Ubah Password</a>
                </div> -->
                <div class="pull-right">
                  <a data-href="<?php echo base_url() ?>Login/ChangePassword" data-toggle='modal' data-target='#change-password' class="btn btn-default btn-flat">Ubah Password</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
          <a data-href="<?php echo base_url() ?>Login/signOut" data-toggle='modal' data-target='#confirm-logout'><i class="fa fa-sign-out"></i> <span>Logout</span></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url()?>assets/img/user.jpeg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo "Sedang Online"?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $this->session->userdata('jabatan'); ?></a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="<?php if(isset($title)) if($title=="Dashboard") echo "active"?>">
          <a href="<?php echo base_url().'Dashboard' ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Data Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if($this->session->userdata('jabatan') == 'ADMIN') { ?> 
              <li><a href="<?php echo base_url()?>MasterUser"><i class="fa fa-circle-o"></i> Data User</a></li>
            <?php } ?>
            <?php if($this->session->userdata('jabatan') != 'PETUGAS APOTEK') { ?>
              <li><a href="<?php echo base_url()?>MasterPasien"><i class="fa fa-circle-o"></i> Data Pasien</a></li>
            <?php } ?>
            <?php if($this->session->userdata('jabatan') != 'DOKTER') { ?> 
              <li><a href="<?php echo base_url()?>MasterSupplier"><i class="fa fa-circle-o"></i> Data Supplier</a></li>
            <?php } ?>
            <?php if($this->session->userdata('jabatan') != 'DOKTER') { ?> 
              <li><a href="<?php echo base_url()?>MasterObat"><i class="fa fa-circle-o"></i> Data Obat</a></li>
            <?php } ?>
              <li><a href="<?php echo base_url()?>MasterResep"><i class="fa fa-circle-o"></i> Data Resep</a></li>
            <?php if($this->session->userdata('jabatan') == 'ADMIN') { ?> 
              <li><a href="<?php echo base_url()?>Setting"><i class="fa fa-circle-o"></i> Setting Data</a></li>
            <?php } ?>
          </ul>
        </li>
      <?php if($this->session->userdata('jabatan') != 'DOKTER') || ($this->session->userdata('jabatan') != 'PERAWAT') || ($this->session->userdata('jabatan') != 'ADMIN') || ($this->session->userdata('jabatan') != 'KEPALA KLINIK') {?> 
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Data Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url()?>TransaksiBeli"><i class="fa fa-circle-o"></i> Pembelian Obat</a></li>
            <li><a href="<?php echo base_url()?>TransaksiJual"><i class="fa fa-circle-o"></i> Penjualan Obat</a></li>
            <li><a href="<?php echo base_url()?>TransaksiRetur"><i class="fa fa-circle-o"></i> Retur Obat</a></li>
          </ul>
        </li>
      <?php } ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span> Ketersediaan Obat</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url()?>ObatTersedia"><i class="fa fa-circle-o"></i> Tersedia</a></li>
            <li><a href="<?php echo base_url()?>ObatHampirHabis"><i class="fa fa-circle-o"></i> Hampir Habis</a></li>
            <li><a href="<?php echo base_url()?>ObatKosong"><i class="fa fa-circle-o"></i> Kosong</a></li>
            <li><a href="<?php echo base_url()?>ObatHampirExp"><i class="fa fa-circle-o"></i> Hampir Kadaluarsa </a></li>
            <li><a href="<?php echo base_url()?>ObatDimusnahkan"><i class="fa fa-circle-o"></i> Dimusnahkan</a></li>
          </ul>
        </li>
      <?php if($this->session->userdata('jabatan') != 'PETUGAS APOTEK') { ?> 
        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url()?>LaporanBeli"><i class="fa fa-circle-o"></i> Laporan Pembelian</a></li>
            <li><a href="<?php echo base_url()?>LaporanJual"><i class="fa fa-circle-o"></i> Laporan Penjualan</a></li>
            <li><a href="<?php echo base_url()?>LaporanRetur"><i class="fa fa-circle-o"></i> Laporan Retur</a></li>
            <li><a href="<?php echo base_url()?>LaporanMutasi"><i class="fa fa-circle-o"></i> Laporan Mutasi</a></li>
            <li><a href="<?php echo base_url()?>LaporanDimusnahkan"><i class="fa fa-circle-o"></i> Laporan Obat Dimusnahkan</a></li>
          </ul>
        </li>
      <?php } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <?php if(isset($header)) echo $header; else echo "Header"; ?>
        <small><?php if(isset($sub_header)) echo $sub_header; else echo "Sub Header"; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <div class="modal fade" id="confirm-logout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4>Keluar dari Halaman</h4>
                      </div>
                      <div class="modal-body">
                          Apakah anda yakin ingin Keluar?
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                          <a class="btn btn-danger btn-ok btn-fill">Keluar</a>
                      </div>
                  </div>
              </div>
            </div>
          <!-- /.modal delete -->

    <div class="modal fade" id="change-password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <form action="<?php echo base_url()?>Login/ChangePassword" method="post">
              <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4>Ubah Password</h4>
                      </div>
                      
                    <div class="modal-body" style="margin:auto; width:80%">
                        <!-- @include('t_log_problem_analisys._form') -->
                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Password Lama</label>
                                <div class="col-md-7">
                                <input type="password" class="form-control" name="password_lama" value="" placeholder="password lama" required>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div> 
                        <!-- end row -->
                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Password Baru</label>
                                <div class="col-md-7">
                                  <input type="password" class="form-control" name="password_baru" value="" placeholder="password baru" required>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div> 
                        <!-- end row -->
                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Konfirmasi Password Baru</label>
                                <div class="col-md-7">
                                  <input type="password" class="form-control" name="konfirmasi_password" value="" placeholder="konfirmasi password baru"required>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div> 
                        <!-- end row -->
                    </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                          <button type="submit" class="btn btn-primary" id="submit">Ubah</button>
                      </div>
                  </div>
              </div>
            </form>
            </div>
          <!-- /.modal change password -->