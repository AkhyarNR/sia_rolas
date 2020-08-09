<section class="content">
    <!-- form start -->
    <form action="<?php echo base_url()?>TransaksiRetur/insert" method="post" enctype="multipart/form-data" novalidate>
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Form Tambah Retur</h3>

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
                        <label>Tanggal Retur</label>
                        <input type="date" class="form-control" name="tglretur" value="<?php echo date("Y-m-d")?>" placeholder="Tanggal Retur" required>
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
          <h3 class="box-title">Form Tambah Retur</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
            <div class="box-body">
                <div class="box box-solid box-default" style="margin:auto; width:100%">
                    <div class="col-md-8 col-md-offset-10" margin-top="10px">
                        <button type="button" name="add" id="add" class="btn btn-success" style="margin-top:10px; margin-bottom:10px;  " data-toggle="modal" data-target="#modal_tambah_retur">Tambah Retur</button>
                    </div>
                        <br>
                        <div class="form-group" style="width:auto;margin: 10px">
            
                            <table class="table" id="tangkap">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Nama Obat</th>
                                    <th scope="col">Batch</th>
                                    <th scope="col">Supplier</th>
                                    <th scope="col">Tanggal Pembelian</th>
                                    <th scope="col">Expired</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Batch Baru</th>
                                    <th scope="col">Expired Baru</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            </table>
                        </div>
                 </div>
            </div>
      </div>
      <!-- /.box -->

      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Form Tambah Retur</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
            <div class="box-body">
                <div class="row" style="margin: 20px;">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Foto bukti retur</label>
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
                    <input type="submit" class="btn btn-primary btn-fill pull-right" value="Simpan">
                </div>
            </div>
            <!-- /.box-footer -->
      </div>
      <!-- /.box -->

      <div class="modal fade" id="modal_tambah_retur" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Retur</h5>
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
                                <label class="col-md-4 control-label">Batch Obat</label>
                                <div class="col-md-7">
                                    <!-- <input type="text" class="form-control" id="batch_id" placeholder="Batch Obat" required> -->
                                    <select class="form-control select2" style="width: 100%;" id="batch_id" onChange="setValueData();" required>
                                    <option value="" disabled selected>Pilih Batch Obat</option>
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
                                    <input type="hidden" class="form-control" id="id_supplier_id" placeholder="Supplier" disabled>
                                    <input type="text" class="form-control" id="supplier_id" placeholder="Supplier" disabled>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div>
                        <!-- end row -->

                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Tanggal Pembelian</label>
                                <div class="col-md-7">
                                    <input type="date" class="form-control" id="tglbeli_id" placeholder="Tanggal Pembelian" disabled>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div>
                        <!-- end row -->

                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Tanggal Expired</label>
                                <div class="col-md-7">
                                    <input type="date" class="form-control" id="exp_id" placeholder="Tanggal Expired" disabled>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div>
                        <!-- end row -->

                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Quantity</label>
                                <div class="col-md-7">
                                    <input type="number" class="form-control" id="qty_id" min="0" placeholder="Jumlah Obat" required>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div>
                        <!-- end row -->

                       <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Harga per-item</label>
                                <div class="col-md-7">
                                    <input type="number" class="form-control" id="harga_id" min="0" placeholder="Harga per-item" disabled>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div>
                        <!-- end row -->

                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Keterangan</label>
                                <div class="col-md-7">
                                <select class="form-control select2" style="width: 100%;" id="keterangan_id" required>
                                <option value="" disabled selected>Pilih Kondisi</option>
                                    <option value="RUSAK">Obat Rusak</option>
                                    <option value="EXP">Obat Kadaluarsa</option>
                                    </select>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div> 
                        <!-- end row -->

                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Batch Baru</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="batchbaru_id" min="0" placeholder="Batch Baru" required>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div>
                        <!-- end row -->

                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Exp Baru</label>
                                <div class="col-md-7">
                                    <input type="date" class="form-control" id="expbaru_id" min="0" placeholder="Tanggal Expired Baru" required>
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

        <div class="modal fade" id="modal_edit_retur" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Retur</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="margin:auto; width:80%">
                        <!-- @include('t_log_problem_analisys._form') -->
                        <div class="row" style="margin: 20px;">
                        <input type="hidden" id="row_id_dimodal" name="id_row_dimodal" value="">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Nama Obat</label>
                                <div class="col-md-7">
                                <select class="form-control select2" style="width: 100%;" id="obat_id_edit" required>
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
                                <label class="col-md-4 control-label">Batch Obat</label>
                                <div class="col-md-7">
                                    <!-- <input type="text" class="form-control" id="batch_id" placeholder="Batch Obat" required> -->
                                    <select class="form-control select2" style="width: 100%;" id="batch_id_edit" onChange="setValueDataEdit();" required>
                                    <option value="" disabled selected>Pilih Batch Obat</option>
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
                                    <input type="hidden" class="form-control" id="id_supplier_id_edit" placeholder="Supplier" disabled>
                                    <input type="text" class="form-control" id="supplier_id_edit" placeholder="Supplier" disabled>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div>
                        <!-- end row -->

                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Tanggal Pembelian</label>
                                <div class="col-md-7">
                                    <input type="date" class="form-control" id="tglbeli_id_edit" placeholder="Tanggal Pembelian" disabled>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div>
                        <!-- end row -->

                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Tanggal Expired</label>
                                <div class="col-md-7">
                                    <input type="date" class="form-control" id="exp_id_edit" placeholder="Tanggal Expired" disabled>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div>
                        <!-- end row -->

                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Quantity</label>
                                <div class="col-md-7">
                                    <input type="number" class="form-control" id="qty_id_edit" min="0" placeholder="Jumlah Obat" required>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div>
                        <!-- end row -->

                       <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Harga per-item</label>
                                <div class="col-md-7">
                                    <input type="number" class="form-control" id="harga_id_edit" min="0" placeholder="Harga per-item" disabled>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div>
                        <!-- end row -->

                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Keterangan</label>
                                <div class="col-md-7">
                                <select class="form-control select2" style="width: 100%;" id="keterangan_id_edit" required>
                                    <option value="" disabled selected>Pilih Kondisi</option>
                                    <option value="RUSAK">Obat Rusak</option>
                                    <option value="EXP">Obat Kadaluarsa</option>
                                    </select>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div> 
                        <!-- end row -->

                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Batch Baru</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="batchbaru_id_edit" min="0" placeholder="Batch Baru" required>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div>
                        <!-- end row -->

                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Exp Baru</label>
                                <div class="col-md-7">
                                    <input type="date" class="form-control" id="expbaru_id_edit" min="0" placeholder="Tanggal Expired Baru" required>
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
    function setValueDataEdit() {
            var id_batch = $("#modal_edit_retur #batch_id_edit").val();
            if(id_batch){
                $.ajax({
                    url: "http://localhost/sia_rolas/TransaksiRetur/api_detailbatch/",
                    type: "POST",
                    data: {
                        'id': id_batch
                    },
                    success: function(data){
                        data = JSON.parse(data);

                        var id = data['id'];
                        var id_supplier = data['id_supplier'];
                        var kode_supplier = data['kode_supplier'];
                        var nama_supplier = data['nama_supplier'];
                        var tgl_pembelian = data['tgl_pembelian'];
                        var exp_date = data['exp_date'];
                        var harga_beli = data['harga_beli'];
                        // alert(nama_supplier);

                        $("#modal_edit_retur #id_supplier_id_edit").val(id_supplier);
                        $("#modal_edit_retur #supplier_id_edit").val(kode_supplier + ' - ' + nama_supplier);
                        $("#modal_edit_retur #tglbeli_id_edit").val(tgl_pembelian);
                        $("#modal_edit_retur #exp_id_edit").val(exp_date);
                        $("#modal_edit_retur #harga_id_edit").val(harga_beli);
                    }
                });
            }
    }

    function setValueData() {
            var id_batch = $("#batch_id").val();
            if(id_batch){
                $.ajax({
                    url: "http://localhost/sia_rolas/TransaksiRetur/api_detailbatch/",
                    type: "POST",
                    data: {
                        'id': id_batch
                    },
                    success: function(data){
                        data = JSON.parse(data);

                        var id = data['id'];
                        var id_supplier = data['id_supplier'];
                        var kode_supplier = data['kode_supplier'];
                        var nama_supplier = data['nama_supplier'];
                        var tgl_pembelian = data['tgl_pembelian'];
                        var exp_date = data['exp_date'];
                        var harga_beli = data['harga_beli'];
                        // alert(nama_supplier);

                        $("#id_supplier_id").val(id_supplier);
                        $("#supplier_id").val(kode_supplier + ' - ' + nama_supplier);
                        $("#tglbeli_id").val(tgl_pembelian);
                        $("#exp_id").val(exp_date);
                        $("#harga_id").val(harga_beli);
                    }
                });
            }
    }
    
    
</script>
</section>
