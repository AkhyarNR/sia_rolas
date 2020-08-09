<section class="content">
    <!-- form start -->
    <form action="<?php echo base_url()?>TransaksiBeli/update" method="post" enctype="multipart/form-data" novalidate>
        <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">File Bukti Transaksi</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
            <div class="box-body">
                <div class="row col-md-12">
                <?php if($data->bukti_pembelian!=NULL){ ?>
                    <div class="row" style="padding-bottom: 15px">
                        <div class = "col-md-11">
                            <a href="<?php echo base_url()."uploads/bukti_beli/".$data->id."/".$data->bukti_pembelian; ?>" target="_blank" class="btn btn-block btn-social btn-primary">
                                <i class="fa fa-file-image-o"></i><?php echo $data->bukti_pembelian ?>
                            </a>
                        </div> 
                        <div class = "col-md-1">
                            <a class="btn btn-block btn-danger" data-href="<?php echo base_url().'TransaksiBeli/rmdir/'.$data->id.'/'.$data->bukti_pembelian?>" data-toggle='modal' data-target='#confirm-delete' title="Hapus">
                            <i class="fa fa-trash fa-lg"></i></button>
                            <!-- <a data-href="{{ route('deletelogbook.attachment',['logbook_problem',$attachment->logbook_problem_id,$attachment->storage_path]) }}" class="btn btn-block btn-danger button-delete"  data-id="{{ 'logbook_problem/'.$attachment->logbook_problem_id.'/'.$attachment->storage_path }}">
                                <i class="fa fa-trash"></i> -->
                            </a>    
                        </div>
                    </div>
                <?php }else{?>
                    <div class="row" style="padding-bottom: 15px">
                        <div class = "col-md-12">
                            <button href="#" class="btn btn-block btn-default" disabled>
                                <i class="fa fa-file-image-o"></i>&nbsp;&nbsp;&nbsp;TIDAK ADA BUKTI TRANSAKSI
                            </button>
                            
                        </div>
                    </div>
                <?php } ?>    
                </div>
                <!-- /.row -->
            </div>
      </div>
      <!-- /.end box -->
    
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Form Edit Transaksi</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
            <div class="box-body">
            <div class="row">
            <input type="text" name="id" value="<?php echo $data->id ?>" hidden>
            <input type="text" name="notransaksi" value="<?php echo $data->no_transaksi ?>" hidden>
            <input type="text" name="bukti_old" value="<?php echo $data->bukti_pembelian ?>" hidden>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>No Transaksi</label>
                        <input type="text" class="form-control" name="notransaksi" value="<?php echo $data->no_transaksi ?>" disabled>
                    </div>  
                    
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tanggal Pembelian</label>
                        <input type="date" class="form-control" name="tglbeli" placeholder="Tanggal Pembelian" value="<?php echo $data->tgl_pembelian ?>" required>
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
          <h3 class="box-title">Form Edit Transaksi</h3>

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
                        <div class="form-group" style="width:auto;margin: 10px">
            
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
                                <script>
                                    var jumlah_data = <?php echo $jumlah_data ?>;
                                    var _obat = [];
                                    var _textObat = [];
                                    var _supplier = [];
                                    var _textSupplier = [];
                                    var _batch = [];
                                    var _exp = [];
                                    var _jumlah = [];
                                    var _harga = [];
                                    // alert(jumlah_data);
                                </script>

                                <?php foreach($detail as $key => $value){?>
                                
                                <input type="hidden" name='id_pembelian[]' value="<?php $value['id_pembelian']?>">
                                <script>                                           
                                    var _dataObat = <?php echo $value['id_obat'] ?>;
                                    _obat.push(_dataObat);

                                    var _dataTextObat = "<?php echo $value['kode_obat'].' - '.$value['nama_obat'] ?>";
                                    _textObat.push(_dataTextObat);

                                    var _dataSupplier = <?php echo $value['id_supplier'] ?>;
                                    _supplier.push(_dataSupplier);

                                    var _dataTextSupplier = "<?php echo $value['kode_supplier'].' - '.$value['nama_supplier'] ?>";
                                    _textSupplier.push(_dataTextSupplier);

                                    var _dataBatch = "<?php echo $value['batch'] ?>";
                                    _batch.push(_dataBatch);

                                    var _dataExp = "<?php echo $value['exp_date'] ?>";
                                    _exp.push(_dataExp);

                                    var _dataJumlah = <?php echo $value['qty'] ?>;
                                    _jumlah.push(_dataJumlah);

                                    var _dataHarga = <?php echo $value['harga'] ?>;
                                    _harga.push(_dataHarga);
                                </script>
                                <?php } ?>
                            </tbody>
                            </table>
                        </div>
                 </div>
            </div>
      </div>
      <!-- /.box -->

      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Form Edit Transaksi</h3>

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
                    <input type="submit" onclick="return saveData();" class="btn btn-primary btn-fill pull-right" value="Update">
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
                                    <option disabled>Pilih Obat</option>
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
                                    <option disabled>Pilih Supplier</option>
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
                                    <option disabled>Pilih Obat</option>
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
                                    <option disabled>Pilih Supplier</option>
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
        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4>Hapus File Bukti Transaksi</h4>
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
    </<form>
</section>
