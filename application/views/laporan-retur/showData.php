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
                <table id="example1" class="display responsive nowrap" style="width:100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>No Transaksi</th>
                    <th>Tanggal Retur</th>
                    <th>Nama Obat</th>
                    <th>Supplier</th>
                    <th>Batch</th>
                    <th>Exp Date</th>
                    <th>Quantity</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                    <th>Keterangan</th>
                    <th>Batch Baru</th>
                    <th>Exp Baru</th>
                    <th>User</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                        $no = 1;
                        foreach($dataTable as $key => $value){
                    ?>
                   <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $value['no_transaksi'] ?></td>
                        <td><?php echo date_format(new DateTime($value['tgl_retur']), 'd-m-Y') ?></td>
                        <td><?php echo $value['nama_obat'] ?></td>
                        <td><?php echo $value['nama_supplier'] ?></td>
                        <td><?php echo $value['batch'] ?></td>
                        <td><?php echo $value['exp_date'] ?></td>
                        <td><?php echo number_format($value['qty']) ?></td>
                        <td><?php echo number_format($value['harga']) ?></td>
                        <td><?php echo number_format($value['sub_total']) ?></td>
                        <td><?php echo $value['keterangan'] ?></td>
                        <td><?php echo $value['batch_baru'] ?></td>
                        <td><?php echo $value['exp_date_baru'] ?></td>
                        <td><?php echo $value['nama_user'] ?></td>
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
                    <th>Tanggal Retur</th>
                    <th>Nama Obat</th>
                    <th>Supplier</th>
                    <th>Batch</th>
                    <th>Exp Date</th>
                    <th>Quantity</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                    <th>Keterangan</th>
                    <th>Batch Baru</th>
                    <th>Exp Baru</th>
                    <th>User</th>
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
                                <select class="form-control select2" style="width: 100%;" id="obat_id" name="obat">
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
                                <label class="col-md-4 control-label">Keterangan</label>
                                <div class="col-md-7">
                                <select class="form-control select2" style="width: 100%;" id="keterangan_id" name= "keterangan">
                                <option value="" disabled selected>Pilih Kondisi</option>
                                    <option value="RUSAK">Obat Rusak</option>
                                    <option value="EXP">Obat Kadaluarsa</option>
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