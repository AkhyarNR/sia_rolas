$(function () {

    var no = 1;
    for (var i = 0; i < jumlah_data; i++) 
    {
    // alert(_textpenyebab[i]);
    var _total = _jumlah[i] * _harga[i];
    var nf = new Intl.NumberFormat();
    $('#tangkap').append('<tr id="row_doc'+no+'" class="dynamic-added"><td>'+ _textObat[i] +' <input name="obat[]" type="hidden" value= "' + _obat[i] + '" ></td><td>' + nf.format(_jumlah[i]) +' <input name="jumlah[]" type="hidden" value= "' + _jumlah[i] + '" ></td><td>' + nf.format(_harga[i]) +' <input name="harga[]" type="hidden" value= "' + _harga[i] + '" ></td><td>' + nf.format(_total) +' <input name="total[]" type="hidden" value= "' + _total + '" ></td><td><button type="button" style="margin:1px;"name="edit" id="'+no+'"  class="btn btn-warning " data-toggle="modal" data-target="#modal_edit_penjualan" data-obat="'+_obat[i]+'" data-jumlah="'+_jumlah[i]+'" data-harga="'+_harga[i]+'"data-rowid= '+no+'><span class="glyphicon glyphicon-edit"></span></button> <button type="button" style="margin:1px;" name="remove" id="'+no+'" class="btn btn-danger btn_remove_doc"><span class="glyphicon glyphicon-trash"></span></button></td></tr>');
    no++;
    }  

  // Form pemnjualan
  $('#modal_edit_penjualan #update').click(function(){
    // alert('hai')
    var nf = new Intl.NumberFormat();
    var rowid =  $("#modal_edit_penjualan #row_id_dimodal_edit").val();
    var obat =  $("#modal_edit_penjualan #obat_id_edit").val();
    var text_obat =  $("#modal_edit_penjualan #obat_id_edit :selected").text();
    var jumlah =  $("#modal_edit_penjualan #jumlah_id_edit").val();
    var harga =  $("#modal_edit_penjualan #harga_id_edit").val();
    var total = jumlah * harga;


    // alert(penyebab);

    if(!obat ||jumlah < 1 || harga < 1){
        $('#modal_edit_penjualan #update').attr("data-dismiss","");  
        alert('Terdapat data yang kosong!');
        return false;
    }else {
        $('#modal_edit_penjualan #update').attr("data-dismiss","modal");
        $('#row_doc'+rowid+'').remove();
        $('#tangkap').append('<tr id="row_doc'+i+'" class="dynamic-added"><td>'+ text_obat +' <input name="obat[]" type="hidden" value= "' + obat + '" ></td><td>' + nf.format(jumlah) +' <input name="jumlah[]" type="hidden" value= "' + jumlah + '" ></td><td>' + nf.format(harga) +' <input name="harga[]" type="hidden" value= "' + harga + '" ></td><td>' + nf.format(total) +' <input name="total[]" type="hidden" value= "' + total + '" ></td><td><button type="button" style="margin:1px;"name="edit" id="'+i+'"  class="btn btn-warning " data-toggle="modal" data-target="#modal_edit_penjualan" data-obat="'+obat+'" data-jumlah="'+jumlah+'" data-harga="'+harga+'"data-rowid= '+i+'><span class="glyphicon glyphicon-edit"></span></button> <button type="button" style="margin:1px;" name="remove" id="'+i+'" class="btn btn-danger btn_remove_doc"><span class="glyphicon glyphicon-trash"></span></button></td></tr>');
        }
    });


    $('#modal_edit_penjualan').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var rowid = button.data('rowid');
        var recipient_obat = button.data('obat');
        var recipient_jumlah = button.data('jumlah');
        var recipient_harga = button.data('harga');
        // alert(recipient_subpenyebab);

        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)

        // var $select = modal.find('#tindakan_pencegahan');
        // var selectize = $select[0].selectize;
        // selectize.setValue(recipient_pencegahan);
        // //set pencegahan

        modal.find('#row_id_dimodal_edit').val(rowid);
        modal.find('#obat_id_edit').val(recipient_obat).trigger('change');
        modal.find('#jumlah_id_edit').val(recipient_jumlah);
        modal.find('#harga_id_edit').val(recipient_harga);
        
    });


    var i= jumlah_data + 1;
    $('#modal_tambah_penjualan #simpan').click(function(){
    var nf = new Intl.NumberFormat();
        // alert('hai')
        var obat =  $("#modal_tambah_penjualan #obat_id").val();
        var text_obat =  $("#modal_tambah_penjualan #obat_id :selected").text();
        var jumlah =  $("#modal_tambah_penjualan #jumlah_id").val();
        var harga =  $("#modal_tambah_penjualan #harga_id").val();
        var total = jumlah * harga;


        // alert(obat);

        if(!obat || jumlah < 1 || harga < 1){
            
            // alert(harga);
            $('#modal_tambah_penjualan #simpan').attr("data-dismiss","");  
            alert('Terdapat data yang kosong!');
        } else {
            $('#modal_tambah_penjualan #simpan').attr("data-dismiss","modal");
        $('#tangkap').append('<tr id="row_doc'+i+'" class="dynamic-added"><td>'+ text_obat +' <input name="obat[]" type="hidden" value= "' + obat + '" ></td><td>' + nf.format(jumlah) +' <input name="jumlah[]" type="hidden" value= "' + jumlah + '" ></td><td>' + nf.format(harga) +' <input name="harga[]" type="hidden" value= "' + harga + '" ></td><td>' + nf.format(total) +' <input name="total[]" type="hidden" value= "' + total + '" ></td><td><button type="button" style="margin:1px;"name="edit" id="'+i+'"  class="btn btn-warning " data-toggle="modal" data-target="#modal_edit_penjualan" data-obat="'+obat+'" data-jumlah="'+jumlah+'" data-harga="'+harga+'"data-rowid= '+i+'><span class="glyphicon glyphicon-edit"></span></button> <button type="button" style="margin:1px;" name="remove" id="'+i+'" class="btn btn-danger btn_remove_doc"><span class="glyphicon glyphicon-trash"></span></button></td></tr>');
            i++;
        }

        $("#modal_tambah_penjualan #obat_id").val("").trigger('change');
        $("#modal_tambah_penjualan #jumlah_id").val('');
        $("#modal_tambah_penjualan #harga_id").val('');
    });

    $(document).on('click', '.btn_remove_doc', function(event){
    event.preventDefault();
    // alert(event.preventDefault())
    var result = confirm("Ingin menghapus data dokumen ini?");
    if (result) {
        //Logic to delete the item
        var button_id = $(this).attr("id");
        $('#row_doc'+button_id+'').remove();
    }
    return false;

    });

});