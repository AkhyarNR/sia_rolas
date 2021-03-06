<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Form Tambah Pasien</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="<?php echo base_url()?>MasterPasien/insert" method="post">
            <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>No Pasien</label>
                        <input type="text" class="form-control" name="no" placeholder="No Pasien (Otomatis)" disabled>
                    </div>
                     <div class="form-group">
                        <label>NIK</label>
                        <input type="text" class="form-control" name="nik" placeholder="No KTP" required>
                    </div>
                  
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                      <div class="form-group">
                        <label>No BPJS</label>
                        <input type="text" class="form-control" name="nobpjs" placeholder="No BPJS">
                    </div>
                    <div class="form-group">
                        <label>Nama Pasien</label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama Pasien" required>
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
                <button type="submit" class="btn btn-primary btn-fill pull-right">Simpan</button>
            </div>
        </div>
        <!-- /.box-footer -->
        </form>
         <!-- /.form -->
      </div>
      <!-- /.box -->


    
</section>