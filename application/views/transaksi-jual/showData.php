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
                  <a href="<?php echo base_url();?>TransaksiJual/add" role="button" class="btn btn-success btn-fill pull-left" ><i class='fa fa-plus'></i> &nbsp;TAMBAH DATA</a>
                </h3>
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
                    <th>Total Quantity</th>
                    <th>Total Harga</th>
                    <th>User</th>
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
                        <td><?php echo $value['no_transaksi'] ?></td>
                        <td><?php echo date_format(new DateTime($value['tgl_penjualan']), 'd-m-Y') ?></td>
                        <td><?php echo $value['no_resep'] ?></td>
                        <td><?php echo number_format($value['total_qty']) ?></td>
                        <td><?php echo number_format($value['total_harga'])?></td>
                        <td><?php echo $value['nama_user'] ?></td>
                        <td>
                          <!--<?php if(date("Y-m-d")==$value['tgl_penjualan'] and $value['no_resep'] == NULL){?>
                          <a title="Edit" class="btn btn-warning btn-sm" href="<?php echo base_url().'TransaksiJual/edit/'.$value['id'];?>"><i class="fa fa-edit fa-unset"></i></a>
                          <?php }else{ ?>  
                            <button class='btn btn-warning btn-sm ' disabled><i class='fa fa-edit fa-unset' ></i></button>
                          <?php } ?>-->
                          <a title="Detail" class="btn btn-primary btn-sm" href="<?php echo base_url().'TransaksiJual/detail/'.$value['id'];?>">&nbsp;<i class="fa fa-info fa-lg" ></i>&nbsp;</a>
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
                    <th>No Transaksi</th>
                    <th>Tanggal Penjualan</th>
                    <th>No Resep</th>
                    <th>Total Quantity</th>
                    <th>Total Harga</th>
                    <th>User</th>
                    <th>Opsi</th>
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