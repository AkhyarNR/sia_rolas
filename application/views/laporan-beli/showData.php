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
                  <!-- <a href="<?php echo base_url();?>MasterObat/add" role="button" class="btn btn-success btn-fill pull-left" ><i class='fa fa-sliders'></i> &nbsp;FILTER DATA</a> -->
                  <button type="button" name="add" id="add" class="btn btn-success"; data-toggle="modal" data-target="#modal_filter"><i class='fa fa-sliders'></i> &nbsp;FILTER DATA</button>
                </h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="example2" class="display responsive nowrap" style="width:100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>No Transaksi</th>
                    <th>Tanggal Pembelian</th>
                    <th>Nama Obat</th>
                    <th>Supplier</th>
                    <th>Batch</th>
                    <th>Exp Date</th>
                    <th>Quantity</th>
                    <th>Harga</th>
                    <th>Bukti Pembelian</th>
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
                        <td><?php echo $value['tgl_pembelian'] ?></td>
                        <td><?php echo $value['nama_obat'] ?></td>
                        <td><?php echo $value['nama_supplier'] ?></td>
                        <td><?php echo $value['batch'] ?></td>
                        <td><?php echo $value['exp_date'] ?></td>
                        <td><?php echo number_format($value['qty']) ?></td>
                        <td><?php echo number_format($value['harga']) ?></td><?php
                          if($value['bukti_pembelian']!=NULL)
                            echo "<td><a href='uploads/bukti_beli/".$value['id']."/".$value['bukti_pembelian']."'target='_blank'><button class='btn btn-default btn-sm '><i class='fa fa-file-image-o' ></i>   Bukti Transaksi</button></a></td>";
                          else
                            echo "<td><button class='btn btn-default btn-sm ' disabled><i class='fa fa-file-image-o' ></i>   Bukti Transaksi</button></td>";
                          
                        ?>
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
                    <th>Tanggal Pembelian</th>
                    <th>Nama Obat</th>
                    <th>Supplier</th>
                    <th>Batch</th>
                    <th>Exp Date</th>
                    <th>Quantity</th>
                    <th>Harga</th>
                    <th>Bukti Pembelian</th>
                    <th>User</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4>Hapus Data Obat</h4>
                      </div>
                      <div class="modal-body">
                          Apakah anda yakin akan menghapus data ini?
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                          <a class="btn btn-danger btn-ok btn-fill">Hapus</a>
                      </div>
                  </div>
              </div>
            </div>
          <!-- /.modal delete -->
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
                                  <input type="date" class="form-control" name="max" placeholder="Nama Obat" value="<?php echo $max ?>" required>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div> 
                        <!-- end row -->
                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Nama Obat</label>
                                <div class="col-md-7">
                                <select class="form-control select2" style="width: 100%;" id="obat_id" name="obat" required>
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
                                <select class="form-control select2" style="width: 100%;" id="supplier_id" name="supplier" required>
                                    <option value="" disabled selected>Pilih Supplier</option>
                                    <?php foreach($dosis as $key => $value){ ?> 
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