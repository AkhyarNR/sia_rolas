<section class="content">
      <!-- Info boxes -->

      <div class="row">
        <div class="col-md-12">
        <?php if(isset($notif_sukses) || isset($notif_gagal)){ ?>
          <div class="alert <?php if(isset($notif_sukses)) echo "alert-success"; else echo "alert-danger"; ?> alert-dismissible fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php if(isset($notif_sukses)) echo $notif_sukses; else echo $notif_error; ?>
          </div>
        </div>
        <?php }?>
        <div class="col-md-12">
          <div class="box">
              <div class="box-header">
                <h3 class="box-title">
                <button type="button" name="add" id="add" class="btn btn-success"; data-toggle="modal" data-target="#modal_filter"><i class='fa fa-sliders'></i> &nbsp;FILTER DATA</button>
                </h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="col-md-12">
                <table style="width:100%;"">
                    <tr>
                      <td><p style="font-size:12pt; text-align:left; margin-left:10px;"><b>Tanggal :</b> <?php echo $data_tanggal?></p></td>
                      <td><p style="font-size:12pt; text-align:right; margin-right:10px;"><b>User :</b> <?php echo $data_user?></p></td>
                    </tr>
                    <tr>
                      <td><p style="font-size:12pt;text-align:left; margin-left:10px;"><b>Nama Obat :</b> <?php echo $data_obat?></p></td>
                      <td><p style="font-size:12pt; text-align:right; margin-right:10px;"><b>Supplier :</b> <?php echo $data_supplier?></p></td>
                    </tr>
                  </table>
                  <hr>
              </div>
                <table id="example2" class="display responsive nowrap" style="width:100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>No Transaksi</th>
                    <th>Tanggal Transaksi</th>
                    <?php if($data_obat == "-"){ ?><th>Nama Obat</th><?php }?>
                    <?php if($data_supplier == "-"){ ?><th>Supplier</th><?php }?>
                    <th>Batch</th>
                    <th>Jenis</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                    <th>Stok</th>
                    <?php if($data_user == "-"){ ?><th>User</th><?php }?>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                        $no = 1;
                        foreach($dataTable as $key => $value){
                            if($value['jenis']=="SO"){
                                $jenis = "Non-Resep";
                                $color = "primary";
                            }
                            if($value['jenis']=="SI"){
                                $jenis = "Resep";
                                $color = "info";
                            }
                            if($value['jenis']=="BY"){
                                $jenis = "Pembelian";
                                $color = "success";
                            }
                            if($value['jenis']=="RT"){
                                $jenis = "Retur";
                                $color = "warning";
                            }

                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $value['no_transaksi'] ?></td>
                        <td><?php echo date_format(new DateTime($value['tgl_transaksi']), 'd-m-Y') ?></td>
                        <?php if($data_obat == "-"){ ?><td><?php echo $value['nama_obat'] ?></td><?php } ?>
                        <?php if($data_supplier == "-"){ ?><td><?php echo $value['nama_supplier'] ?></td><?php }?>
                        <td><?php echo $value['batch'] ?></td>
                        <td><medium class="label label-<?php echo $color?>"><?php echo $jenis;?></medium></td>
                        <td><?php echo $value['masuk'] ?></td>
                        <td><?php echo $value['keluar'] ?></td>
                        <td><?php echo $value['stok'] ?></td>
                        <?php if($data_user == "-"){ ?><td><?php echo $value['nama_user'] ?></td><?php }?>
                    </tr>
                    <?php
                        $no++;
                        }
                    ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>No Transaksi</th>
                    <th>Tanggal Transaksi</th>
                    <?php if($data_obat == "-"){ ?><th>Nama Obat</th><?php }?>
                    <?php if($data_supplier == "-"){ ?><th>Supplier</th><?php }?>
                    <th>Batch</th>
                    <th>Jenis</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                    <th>Stok</th>
                    <?php if($data_user == "-"){ ?><th>User</th><?php }?>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
            
          <div class="modal fade" id="modal_filter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <form action="" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Set Filter Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="margin:auto; width:80%">
                        <!-- @include('t_log_problem_analisys._form') -->
                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Mulai Tanggal</label>
                                <div class="col-md-7">
                                <input type="date" class="form-control" name="min" value="<?php echo $min ?>" required>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div> 
                        <!-- end row -->
                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Sampai Tanggal</label>
                                <div class="col-md-7">
                                  <input type="date" class="form-control" name="max" value="<?php echo $max ?>" required>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div> 
                        <!-- end row -->
                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Nama Obat</label>
                                <div class="col-md-7">
                                <select class="form-control select2" style="width: 100%;" id="obat_id" name="obat" >
                                    <option value="" disabled selected>Pilih Obat</option>
                                    <?php foreach($obat as $key => $value){ ?> 
                                        <!-- foreach -->
                                    <option value="<?php echo $value['id'];?>"><?php echo $value['kode_obat']." - ". $value['nama_obat'];?></option>
                                    <?php } ?>
                                        <!-- end foreach -->
                                    </select>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div> 
                        <!-- end row -->

                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Supplier</label>
                                <div class="col-md-7">
                                <select class="form-control select2" style="width: 100%;" id="supplier_id" name="supplier" >
                                    <option value="" disabled selected>Pilih Supplier</option>
                                    <?php foreach($supplier as $key => $value){ ?> 
                                        <!-- foreach -->
                                    <option value="<?php echo $value['id'];?>"><?php echo $value['kode_supplier']." - ". $value['nama_supplier'];?></option>
                                    <?php } ?>
                                        <!-- end foreach -->
                                    </select>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div>
                        <!-- end row -->

                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Jenis Mutasi</label>
                                <div class="col-md-7">
                                <select class="form-control select2" style="width: 100%;" id="mutasi_id" name="jenis">
                                <option value="" disabled selected>Pilih Mutasi</option>
                                    <option value="SO">Penjualan Eksternal</option>
                                    <option value="SI">Penjualan Internal</option>
                                    <option value="BY">Pembelian</option>
                                    <option value="RT">Retur</option>
                                    </select>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div> 
                        <!-- end row -->

                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">User</label>
                                <div class="col-md-7">
                                <select class="form-control select2" style="width: 100%;" id="user_id" name="user" >
                                    <option value="" disabled selected>Pilih User</option>
                                    <?php foreach($user as $key => $value){ ?> 
                                        <!-- foreach -->
                                    <option value="<?php echo $value['id'];?>"><?php echo $value['kode_user']." - ". $value['nama_user'];?></option>
                                    <?php } ?>
                                        <!-- end foreach -->
                                    </select>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div>
                        <!-- end row -->

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="simpan">Cari</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
                <!-- End Modal -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    
    </section>