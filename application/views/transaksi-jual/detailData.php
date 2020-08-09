<section class="content">
      <!-- Info boxes -->

      <div class="row">
        <div class="col-md-12">
          <div class="box">
              <div class="box-header">
                <h3 class="box-title">Detail Transaksi Penjualan</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <button type="button" onclick="goBack();" class="btn btn-default btn-fill">Kembali</button>
                <input type="button" style="margin-left:5px;" class="btn btn-fill btn-primary" onclick="printDiv('printableArea')" value="Print" />
                <hr style="margin-bottom:10px">
                <div id="printableArea">
                <div class="col-md-12">
                  <table style="width:100%">
                    <tr>
                      <td><p style="font-size:12pt"><b>Transaksi :</b> <?php echo $data->no_transaksi?></p></td>
                      <td><p style="font-size:12pt; text-align:center"><b>Tanggal :</b> <?php echo $data->tgl_penjualan?></p></td>
                      <td><p style="font-size:12pt; text-align:right"><b>User :</b> <?php echo $data->nama_user?></p></td>
                    </tr>
                  </table>
                  <hr style="margin:2px">
                </div>
                  <table id="example" class="display responsive nowrap" style="width:100%">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Obat</th>
                      <th>Supplier</th>
                      <th>Batch</th>
                      <th>Expired</th>
                      <?php if($data->id_resep!=NULL){?>
                        <th>Dosis</th>
                      <?php }?>
                      <th>Quantity</th>
                      <th>Harga</th>
                      <th>Sub Total</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                          $no = 1;
                          foreach($dataTableDetail as $key => $value){
                      ?>
                      <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $value['nama_obat'] ?></td>
                          <td><?php echo $value['nama_supplier'] ?></td>
                          <td><?php echo $value['batch'] ?></td>
                          <td><?php echo $value['exp_date'] ?></td>
                          <?php if($data->id_resep!=NULL){?>
                            <td><?php echo $value['konsumsi_obat'] ?></td>
                          <?php }?>
                          <td style="text-align:right"><?php echo number_format($value['qty']) ?></td>
                          <td style="text-align:right"><?php echo number_format($value['harga']) ?></td>
                          <td style="text-align:right"><?php echo number_format($value['sub_total']) ?></td>
                      </tr>
                      <?php
                          $no++;
                          }
                      ?>
                      <tr>
                          <td colspan='<?php if($data->id_resep!=NULL) echo '6'; else echo '5'; ?>'  style="text-align:center"><b>Jumlah Total</b></td>
                          <td style="text-align:right"><b><?php echo number_format($data->total_qty); ?></b></td>
                          <td style="text-align:right"><b> - </b></td>
                          <td style="text-align:right"><b><?php echo number_format($data->total_harga); ?></b></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
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