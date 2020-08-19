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
                  <button type="button" onclick="goBack();" class="btn btn-success">Kembali</button>
                </h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="example2" class="display responsive nowrap" style="width:100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Obat</th>
                    <th>Nama Supplier</th>
                    <th>Batch</th>
                    <th>Tanggal Pembelian</th>
                    <th>Exp Date</th>
                    <th>Harga Beli</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                        $no = 1;
                        foreach($dataTable as $key => $value){
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $value['nama_obat'] ?></td>
                        <td><?php echo $value['nama_supplier'] ?></td>
                        <td><?php echo $value['batch'] ?></td>
                        <td><?php echo date_format(new DateTime($value['tgl_pembelian']), 'd-m-Y') ?></td>
                        <td><?php echo date_format(new DateTime($value['exp_date']), 'd-m-Y') ?></td>
                        <td><?php echo $value['harga_beli'] ?></td>
                        <td><?php echo number_format($value['qty']) ?></td>
                        <td><?php echo number_format($value['qty'] * $value ['harga_beli']) ?></td>
                    </tr>
                    <?php
                        $no++;
                        }
                    ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Nama Obat</th>
                    <th>Nama Supplier</th>
                    <th>Batch</th>
                    <th>Tanggal Pembelian</th>
                    <th>Exp Date</th>
                    <th>Harga Beli</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
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