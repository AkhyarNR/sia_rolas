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
                  <a href="<?php echo base_url();?>MasterObat/add" role="button" class="btn btn-success btn-fill pull-left" ><i class='fa fa-plus'></i> &nbsp;TAMBAH DATA</a>
                </h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="example2" class="display responsive nowrap" style="width:100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Obat</th>
                    <th>Nama Obat</th>
                    <th>Total Qty</th>
                    <th>Harga Beli Tertinggi</th>
                    <th>Harga Jual</th>
                    <th>Opsi</th>

                  </tr>
                  </thead>
                  <tbody>
                    <?php
                        $no = 1;
                        foreach($dataTable as $key => $value){
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $value['kode_obat'] ?></td>
                        <td><a title="Detail Obat" href="<?php echo base_url().'MasterObat/detail/'.$value['id'];?>"><?php echo $value['nama_obat'] ?></a></td>
                        <td><?php echo number_format($value['total_qty']) ?></td>
                        <td><?php echo number_format($value['harga_beli_tertinggi']) ?></td>
                        <td><?php echo number_format($value['harga_jual']) ?></td>
                        <td>
                          <a title="Edit" class="btn btn-warning btn-sm" href="<?php echo base_url().'MasterObat/edit/'.$value['id'];?>"><i class="fa fa-edit" ></i></a>
                          <button class="btn btn-danger btn-sm btn-fill" data-href="<?php echo base_url().'MasterObat/delete/'.$value['id'];?>" data-toggle='modal' data-target='#confirm-delete' title="Hapus">
                          <i class="fa fa-trash fa-lg"></i></button>
                        </td>
                    </tr>
                    <?php
                        $no++;
                        }
                    ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Kode Obat</th>
                    <th>Nama Obat</th>
                    <th>Total Qty</th>
                    <th>Harga Beli Tertinggi</th>
                    <th>Harga Jual</th>
                    <th>Opsi</th>
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
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    
    </section>