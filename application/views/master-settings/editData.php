<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Form Edit Settings</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="<?php echo base_url()?>MasterSupplier/update" method="post">
            <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                <input type="text" name="id" value="<?php echo $data->id ?>" hidden>
                    <div class="form-group">
                        <label>Minimal Expired (Hari)</label>
                        <input type="number" class="form-control" value="<?php echo $data->set_exp_day ?>" name="set_exp">
                    </div>   
                    
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Minimal Jumlah (Hampir Habis)</label>
                        <input type="number" class="form-control" name="set_jumlah" value="<?php echo $data->set_min_jumlah ?>">
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