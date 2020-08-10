<section class="content">
    <!-- form start -->
    <form action="<?php echo base_url()?>TransaksiBeli/insert" method="post" enctype="multipart/form-data" novalidate>
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Form Tambah Transaksi</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
            <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>No Transaksi</label>
                        <input type="text" class="form-control" name="notransaksi" placeholder="No Transaksi (Otomatis)" disabled>
                    </div>  
                    
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tanggal Pembelian</label>
                        <input type="date" class="form-control" name="tglbeli" value="<?php echo date("Y-m-d")?>" placeholder="Tanggal Pembelian" required>
                    </div> 

                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            </div>
            <!-- /.box-body -->
            <!-- <div class="box-footer"> 
                <div class="form-group">
                    <button type="submit" class="btn btn-default btn-fill pull-right">Simpan</button>
                </div>
            </div> -->
            <!-- /.box-footer -->
      </div>
      <!-- /.box -->

      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Form Tambah Transaksi</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
            <div class="box-body">
                <div class="box box-solid box-default" style="margin:auto; width:100%">
                    <div class="col-md-8 col-md-offset-10" margin-top="10px">
                        <button type="button" name="add" id="add" class="btn btn-success" style="margin-top:10px; margin-bottom:10px;  " data-toggle="modal" data-target="#modal_tambah_pembelian">Tambah Pembelian</button>
                    </div>
                        <br>
                        <div class="form-group" style="width:auto;margin: 10px;">
                        <!-- <div class="table-responsive"> -->
                            <table class="table" id="tangkap">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Nama Obat</th>
                                    <th scope="col">Supplier</th>
                                    <th scope="col">Batch</th>
                                    <th scope="col">Exp</th>
                                    <th scope="col">Total Qty</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            </table>
                        <!-- </div> -->
                        </div>
                 </div>
            </div>
      </div>
      <!-- /.box -->

      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Form Tambah Transaksi</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
            <div class="box-body">
                <div class="row" style="margin: 20px;">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Foto bukti transaksi</label>
                        <div class="col-md-7">
                        <input type="file" name="scan_bukti" accept=".jpg,.jpeg,.png" class="form-control">
                        </div>
                    </div>  
                    <!-- end form-group -->
                </div> 
                <!-- end row -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer"> 
                <div class="form-group">
                    <button type="button" onclick="goBack();" class="btn btn-default btn-fill">Kembali</button>
                    <input type="submit" onclick="return saveData();" class="btn btn-primary btn-fill pull-right" value="Simpan">
                </div>
            </div>
            <!-- /.box-footer -->
      </div>
      <!-- /.box -->

      <div class="modal fade" id="modal_tambah_pembelian" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Pembelian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="margin:auto; width:80%">
                        <!-- @include('t_log_problem_analisys._form') -->
                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Nama Obat</label>
                                <div class="col-md-7">
                                <select class="form-control select2" style="width: 100%;" id="obat_id" required>
                                    <option value="" disabled selected>Pilih Obat</option>
                                    <?php foreach($obat as $key => $value){ ?> 
                                        <!-- foreach -->
                                    <option value="<?php echo $value['id'];?>"><?php echo $value['kode_obat']." - ". $value['nama_obat'];?></option>
                                    <?php } ?>
                                        <!-- end foreach -->
                                    </select>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div> 
                        <!-- end row -->

                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Nama Supplier</label>
                                <div class="col-md-7">
                                <select class="form-control select2" style="width: 100%;" id="supplier_id" required>
                                    <option value="" disabled selected>Pilih Supplier</option>
                                    <?php foreach($supplier as $key => $value){ ?> 
                                        <!-- foreach -->
                                    <option value="<?php echo $value['id'];?>"><?php echo $value['kode_supplier']." - ". $value['nama_supplier'];?></option>
                                    <?php } ?>
                                        <!-- end foreach -->
                                    </select>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div>
                        <!-- end row -->

                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Batch Obat</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="batch_id" placeholder="Batch Obat" required>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div>
                        <!-- end row -->

                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Tanggal Expired</label>
                                <div class="col-md-7">
                                    <input type="date" class="form-control" id="exp_id" placeholder="Tanggal Expired" required>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div>
                        <!-- end row -->

                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Jumlah Obat</label>
                                <div class="col-md-7">
                                    <input type="number" class="form-control" id="jumlah_id" min="0" placeholder="Jumlah Obat" required>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div>
                        <!-- end row -->

                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Harga per-item</label>
                                <div class="col-md-7">
                                    <input type="number" class="form-control" id="harga_id" min="0" placeholder="Harga per-item" required>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div>
                        <!-- end row -->


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" id="simpan">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->

        <div class="modal fade" id="modal_edit_pembelian" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Pembelian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="margin:auto; width:80%">
                        <!-- @include('t_log_problem_analisys._form') -->
                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                            <input type="hidden" id="row_id_dimodal" name="id_row_dimodal" value="">
                                <label class="col-md-4 control-label">Nama Obat</label>
                                <div class="col-md-7">
                                <select class="form-control select2" style="width: 100%;" id="obat_id" required>
                                    <option value="" disabled selected>Pilih Obat</option>
                                    <?php foreach($obat as $key => $value){ ?> 
                                        <!-- foreach -->
                                    <option value="<?php echo $value['id'];?>"><?php echo $value['kode_obat']." - ". $value['nama_obat'];?></option>
                                    <?php } ?>
                                        <!-- end foreach -->
                                    </select>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div> 
                        <!-- end row -->

                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Nama Supplier</label>
                                <div class="col-md-7">
                                <select class="form-control select2" style="width: 100%;" id="supplier_id" required>
                                    <option value="" disabled selected>Pilih Supplier</option>
                                    <?php foreach($supplier as $key => $value){ ?> 
                                        <!-- foreach -->
                                    <option value="<?php echo $value['id'];?>"><?php echo $value['kode_supplier']." - ". $value['nama_supplier'];?></option>
                                    <?php } ?>
                                        <!-- end foreach -->
                                    </select>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div>
                        <!-- end row -->

                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Batch Obat</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="batch_id" placeholder="Batch Obat" required>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div>
                        <!-- end row -->

                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Tanggal Expired</label>
                                <div class="col-md-7">
                                    <input type="date" class="form-control" id="exp_id" placeholder="Tanggal Expired" required>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div>
                        <!-- end row -->

                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Jumlah Obat</label>
                                <div class="col-md-7">
                                    <input type="number" class="form-control" id="jumlah_id" min="0" placeholder="Jumlah Obat" required>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div>
                        <!-- end row -->

                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Harga per-item</label>
                                <div class="col-md-7">
                                    <input type="number" class="form-control" id="harga_id" min="0" placeholder="Harga per-item" required>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div>
                        <!-- end row -->


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" id="update">Update</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->

    </<form>
        <script>
            function saveData() {
        var attr = $("#tangkap").find('tr').length;
        if(attr==1){
            alert("Data pembelian tidak boleh kosong!");
            return false;
        }
            else
            return true;
        }
        </script>
</section>
