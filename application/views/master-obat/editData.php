<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Form Edit Obat</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="<?php echo base_url()?>MasterObat/update" method="post">
            <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                <input type="text" name="id" value="<?php echo $data->id ?>" hidden>
                    <div class="form-group">
                        <label>Kode Obat</label>
                        <input type="text" class="form-control" value="<?php echo $data->kode_obat ?>" disabled>
                    </div>
                    
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                   
                <div class="form-group">
                        <label>Nama Obat</label>
                        <input type="text" class="form-control" name="nama" value="<?php echo $data->nama_obat ?>" placeholder="Nama Obat" required>
                    </div>
                    
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Harga Beli Terbaru</label>
                        <input type="text" class="form-control" name="hargabeli" placeholder="Harga Beli" value="<?php echo $data->harga_beli ?>" disabled>
                    </div>  
                    
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Harga Jual</label>
                        <input type="number" min="0" class="form-control" name="hargajual" placeholder="Harga Obat" value="<?php echo $data->harga_jual ?>" required>
                    </div> 

                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            </div>
            <!-- /.box-body -->
        <div class="box-footer"> 
            <div class="form-group">
                <button type="button" onclick="goBack();" class="btn btn-default btn-fill">Kembali</button>
                <button type="submit" class="btn btn-primary btn-fill pull-right">Update</button>
            </div>
        </div>
        <!-- /.box-footer -->
        </form>
         <!-- /.form -->
      </div>
      <!-- /.box -->


    
</section>