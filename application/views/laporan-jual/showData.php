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
                    <th>Tanggal Penjualan</th>
                    <th>No Resep</th>
                    <th>Nama Obat</th>
                    <th>Batch</th>
                    <th>Quantity</th>
                    <th>Harga</th>
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
                        <td><?php echo $value['tgl_penjualan'] ?></td>
                        <td><?php echo $value['no_resep'] ?></td>
                        <td><?php echo $value['nama_obat'] ?></td>
                        <td><?php echo $value['batch'] ?></td>
                        <td><?php echo number_format($value['qty']) ?></td>
                        <td><?php echo number_format($value['harga'])?></td>
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
                    <th>Tanggal Penjualan</th>
                    <th>No Resep</th>
                    <th>Nama Obat</th>
                    <th>Batch</th>
                    <th>Quantity</th>
                    <th>Harga</th>
                    <th>User</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    
    </section>