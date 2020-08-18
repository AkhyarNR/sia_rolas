<section class="content">
      <!-- Info boxes -->

      <div class="row">
        <div class="col-md-12">
        <?php if(isset($notif_sukses) || isset($notif_gagal)){ ?>
          <div class="alert <?php if(isset($notif_sukses)) echo "alert-success"; else echo "alert-danger"; ?> alert-dismissible fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php if(isset($notif_sukses)) echo $notif_sukses; else echo $notif_gagal; ?>
          </div>
        </div>
        <?php }?>
        <div class="col-md-12">
          <div class="box">
              <div class="box-header">
                <h3 class="box-title">
                  <a href="<?php echo base_url();?>TransaksiRetur/add" role="button" class="btn btn-success btn-fill pull-left" ><i class='fa fa-plus'></i> &nbsp;TAMBAH DATA</a>
                </h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="example2" class="display responsive nowrap" style="width:100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>No Transaksi</th>
                    <th>Tanggal Retur</th>
                    <th>Total Quantity</th>
                    <th>Total Harga</th>
                    <th>Bukti Retur</th>
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
                        <td><?php echo date_format(new DateTime($value['tgl_retur']), 'd-m-Y') ?></td>
                        <td><?php echo number_format($value['total_qty']) ?></td>
                        <td><?php echo number_format($value['total_harga']) ?></td>
                        <?php
                          if($value['bukti_retur']!=NULL)
                            echo "<td><a href='uploads/bukti_retur/".$value['id']."/".$value['bukti_retur']."'target='_blank'><button class='btn btn-default btn-sm '><i class='fa fa-file-image-o' ></i>   Bukti Transaksi</button></a></td>";
                          else
                            echo "<td><button class='btn btn-default btn-sm ' disabled><i class='fa fa-file-image-o' ></i>   Bukti Transaksi</button></td>";
                          
                        ?>
                        <td><?php echo $value['nama_user'] ?></td>
                        <td>
                          <a title="Edit" class="btn btn-warning btn-sm" href="<?php echo base_url().'TransaksiRetur/edit/'.$value['id'];?>"><i class="fa fa-edit fa-unset"></i></a>
                          <a title="Detail" class="btn btn-primary btn-sm" href="<?php echo base_url().'TransaksiRetur/detail/'.$value['id'];?>">&nbsp;<i class="fa fa-info fa-lg" ></i>&nbsp;</a>
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
                    <th>Tanggal Retur</th>
                    <th>Total Quantity</th>
                    <th>Total Harga</th>
                    <th>Bukti Retur</th>
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