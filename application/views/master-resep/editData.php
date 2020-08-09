<section class="content">
<form action="<?php echo base_url()?>MasterResep/update" method="post" enctype="multipart/form-data" novalidate>
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Form Tambah Resep</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
            <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                <input type="text" name="id" value="<?php echo $data->id ?>" hidden>
                <div class="form-group">
                        <label>No Resep</label>
                        <input type="text" class="form-control" name="kode" value="<?php echo $data->no_resep ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type=date class="form-control" name=tanggal placeholder="Tanggal" value="<?php echo date("Y-m-d")?>" required>
                    </div> 
                       
                    
                </div>
                <!-- /.col -->
                <div class="col-md-6"> 
                    <div class="form-group">
                        <label>Pasien</label>
                        <select class="form-control select2" style="width: 100%;" name="id_pasien" required>
                        <option disabled>Pilih Pasien</option>
                        <?php foreach($id_pasien as $key => $value){ ?> 
                            <!-- foreach -->
                        <option value="<?php echo $value['id'];?>"><?php echo $value['nik']." - ". $value['nama_pasien'];?></option>
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
      </div>
      <!-- /.box -->

      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Form Tambah Detail Resep</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
            <div class="box-body">
                <div class="box box-solid box-default" style="margin:auto; width:100%">
                    <div class="col-md-8 col-md-offset-10" margin-top="10px">
                        <button type="button" name="add" id="add" class="btn btn-success" style="margin-top:10px; margin-bottom:10px;  " data-toggle="modal" data-target="#modal_tambah_detailresep">Tambah Detail Resep</button>
                    </div>
                        <br>
                        <div class="form-group" style="width:auto;margin: 10px">
            
                            <table class="table" id="tangkap">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Nama Obat</th>
                                    <th scope="col">Total Qty</th>
                                    <th scope="col">Dosis</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                              <script>
                                    var jumlah = <?php echo $jumlah ?>;
                                    var _obat = [];
                                    var _textObat = [];
                                    var _qty = [];
                                    var _dosis = [];
                                    var _textDosis = [];
                              </script>

                              <?php foreach($detail as $key => $value){?>
                                <script>                                           
                                    var _dataObat = <?php echo $value['id_obat'] ?>;
                                    _obat.push(_dataObat);

                                    var _dataTextObat = "<?php echo $value['kode_obat'].' - '.$value['nama_obat'] ?>";
                                    _textObat.push(_dataTextObat);

                                    var _dataQty = "<?php echo $value['qty'] ?>";
                                    _qty.push(_dataQty);

                                    var _dataDosis = "<?php echo $value['id_dosis'] ?>";
                                    _dosis.push(_dataDosis);

                                    var _dataTextDosis = "<?php echo $value['konsumsi_obat'] ?>";
                                    _textDosis.push(_dataTextDosis);

                                </script>
                                <?php } ?>
                            </tbody>
                            </table>
                        </div>
                 </div>
            </div>
            <!-- /.box-body -->
        <div class="box-footer"> 
            <div class="form-group">
                <button type="button" onclick="goBack();" class="btn btn-default btn-fill">Kembali</button>
                <input type="submit" onclick="return saveData();" class="btn btn-primary btn-fill pull-right" value="Update">
            </div>
        </div>
        <!-- /.box-footer -->
    
        <!-- /.form -->
      </div>
      <!-- /.box -->

          <div class="modal fade" id="modal_tambah_detailresep" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Detail Resep</h5>
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
                                <label class="col-md-4 control-label">Jumlah Obat</label>
                                <div class="col-md-7">
                                    <input type="number" class="form-control" id="jumlah_id" placeholder="Jumlah Obat" required>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div>
                        <!-- end row -->

                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Dosis</label>
                                <div class="col-md-7">
                                <select class="form-control select2" style="width: 100%;" id="dosis_id" required>
                                    <option disabled>Pilih Dosis</option>
                                    <?php foreach($dosis as $key => $value){ ?> 
                                        <!-- foreach -->
                                    <option value="<?php echo $value['id'];?>"><?php echo $value['konsumsi_obat'];?></option>
                                    <?php } ?>
                                        <!-- end foreach -->
                                    </select>
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

        <div class="modal fade" id="modal_edit_detailresep" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Detail Resep</h5>
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
                                <label class="col-md-4 control-label">Jumlah Obat</label>
                                <div class="col-md-7">
                                    <input type="number" class="form-control" id="jumlah_id" placeholder="Jumlah Obat" required>
                                </div>
                            </div>  
                            <!-- end form-group -->
                        </div>
                        <!-- end row -->

                        <div class="row" style="margin: 20px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Dosis</label>
                                <div class="col-md-7">
                                <select class="form-control select2" style="width: 100%;" id="dosis_id" required>
                                    <option disabled>Pilih Dosis</option>
                                    <?php foreach($dosis as $key => $value){ ?> 
                                        <!-- foreach -->
                                    <option value="<?php echo $value['id'];?>"><?php echo $value['konsumsi_obat'];?></option>
                                    <?php } ?>
                                        <!-- end foreach -->
                                    </select>
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
        </form>
        <script>
            function saveData() {
                var attr = $("#tangkap").find('tr').length;
                if(attr==1){
                    alert("Data penjualan tidak boleh kosong!");
                    return false;
                }
                    else
                    return true;
                }
        </script>
</section>