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
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <div class="modal fade" id="modal-edit-obat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4>Edit Harga Jual</h4>
                      </div>
                      <div class="modal-body">
                          <form action="<?php echo base_url()?>MasterObat/update_harga" method="post" enctype="multipart/form-data" novalidate>
                          <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Harga Jual</label>
                                <div class="col-md-7">
                                    <input type="number" class="form-control" id="harga_id" min="0" placeholder="Harga jual" required>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div>
                        <!-- end row -->
                        </<form>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                          <a class="btn btn-danger btn-ok btn-fill">Hapus</a>
                      </div>
                  </div>
              </div>
            </div>
          <!-- /.modal delete -->

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
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    
    </section>