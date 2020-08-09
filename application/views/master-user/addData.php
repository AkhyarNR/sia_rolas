<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Form Tambah User</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="<?php echo base_url()?>MasterUser/insert" method="post">
            <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Kode User</label>
                        <input type="text" class="form-control" name="kode" placeholder="Kode User (otomatis)" disabled>
                    </div>
                    <div class="form-group">
                        <label>Nama User</label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama User" required>
                    </div>    
                    
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                    </div>  
                    <div class="form-group">
                        <label>Jabatan</label>
                        <select class="form-control select2" style="width: 100%;" name="jabatan" required>
                        <option value="" disabled selected>Pilih Jabatan</option>
                        <?php foreach($jabatan as $key => $value){ ?> 
                            <!-- foreach -->
                        <option value="<?php echo $value['id'];?>"><?php echo $value['nama_jabatan'];?></option>
                        <?php } ?>
                            <!-- end foreach -->
                        </select>
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