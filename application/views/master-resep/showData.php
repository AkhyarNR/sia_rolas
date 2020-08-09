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
                  <a href="<?php echo base_url();?>MasterResep/add" role="button" class="btn btn-success btn-fill pull-left" ><i class='fa fa-plus'></i> &nbsp;TAMBAH DATA</a>
                </h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="example2" class="display responsive nowrap" style="width:100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>No Resep</th>
                    <th>Tanggal</th>
                    <th>Pasien</th>
                    <th>Dokter</th>
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
                        <td><?php echo $value['no_resep'] ?></td>
                        <td><?php echo $value['tgl_resep'] ?></td>
                        <td><?php echo $value['nik']." - ".$value['nama_pasien'] ?></td>
                        <td><?php echo $value['nama_user'] ?></td>
                        <td>
                          <a title="Edit" class="btn btn-warning btn-sm" href="<?php echo base_url().'MasterResep/edit/'.$value['id'];?>"><i class="fa fa-edit" ></i></a>
                          <a title="Detail" class="btn btn-primary btn-sm" href="<?php echo base_url().'MasterResep/detail/'.$value['id'];?>">&nbsp;<i class="fa fa-info fa-lg" ></i>&nbsp;</a>
                          <?php  
                          if($value['status']==1){ ?>
                            <button class="btn btn-success btn-sm btn-fill" data-href="<?php echo base_url().'MasterResep/bayar/'.$value['id'];?>" data-toggle='modal' data-target='#confirm-pay' title="Bayar">
                            <i class="fa fa-check"></i></button>
                          <?php }else{ ?>
                            <a title="Sudah Dibayar" class="btn btn-success btn-sm" disabled><i class="fa fa-check" ></i></a>
                          <?php }?>
                          <button class="btn btn-danger btn-sm btn-fill" data-href="<?php echo base_url().'MasterResep/delete/'.$value['id'];?>" data-toggle='modal' data-target='#confirm-delete' title="Hapus">
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
                    <th>No Resep</th>
                    <th>Tanggal</th>
                    <th>Pasien</th>
                    <th>Dokter</th>
                    <th>Opsi</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
           
          <div class="modal fade" id="confirm-pay" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4>Bayar Resep Ini</h4>
                      </div>
                      <div class="modal-body">
                          Apakah anda yakin akan melakukan pembayaran pada resep ini?
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                          <a class="btn btn-danger btn-ok btn-fill">Bayar</a>
                      </div>
                  </div>
              </div>
            </div>

          <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4>Hapus Data Resep</h4>
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