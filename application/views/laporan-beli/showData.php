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
                <div class="row">
                <form action="" method="post">
                  <div class="col-md-5">
                      <div class="form-group">
                          <label>Mulai Tanggal</label>
                          <input type="date" class="form-control" name="min" placeholder="Kode Obat" value="<?php echo $min ?>" required>
                      </div>  
                      
                  </div>
                  <!-- /.col -->
                  <div class="col-md-5">
                      <div class="form-group">
                          <label>Sampai Tanggal</label>
                          <input type="date" class="form-control" name="max" placeholder="Nama Obat" value="<?php echo $max ?>" required>
                      </div> 
                      <!-- /.form-group -->
                  </div>
                  <div class="col-md-2">
                      <div class="form-group">
                          <label>&nbsp;</label>
                          <button type="submit" class="form-control btn btn-success" name="simpan"><i class="fa fa-search"></i>&nbsp;<strong>CARI</strong></button>
                      </div> 
                      <!-- /.form-group -->
                  </div>
                  <!-- /.col -->
                </form>
                </div>
                <!-- /.row -->
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
                          <h4>Hapus Data Transaksi</h4>
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
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    
    </section>