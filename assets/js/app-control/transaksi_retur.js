$(function () {
    $('#example2').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
          // {
          //     extend: 'colvis',
          //     text: 'Export Column'
          // },
          {
              extend: 'print',
              exportOptions: { 
                columns: [ 0, 1, 2, 3, 4, 6] 
                },
              customize: function ( win ) {
                  $(win.document.body)
                      .css( 'font-size', '10pt' );

                  $(win.document.body).find( 'table' )
                      .addClass( 'compact' )
                      .css( 'font-size', 'inherit' );
                  $(win.document.body).find('h1').hide();
              }
          },
          {
              extend: 'excelHtml5',
              exportOptions: { 
                columns: [ 0, 1, 2, 3, 4, 6] 
                }
          }
      ]
  });

// Form pembelian
$('#modal_edit_retur #update').click(function(){
    // alert('hai')
    var nf = new Intl.NumberFormat();
    var rowid =  $("#modal_edit_retur #row_id_dimodal").val();
    var obat =  $("#modal_edit_retur #obat_id").val();
    var text_obat =  $("#modal_edit_retur #obat_id :selected").text();
    var batch =  $("#modal_edit_retur #batch_id").val();
    var text_batch =  $("#modal_edit_retur #batch_id :selected").text();
    var id_supplier =  $("#modal_edit_retur #id_supplier_id").val();
    var supplier =  $("#modal_edit_retur #supplier_id").val();
    var tglbeli =  $("#modal_edit_retur #tglbeli_id").val();
    var exp =  $("#modal_edit_retur #exp_id").val();
    var qty =  $("#modal_edit_retur #qty_id").val();
    var harga =  $("#modal_edit_retur #harga_id").val();
    var sub_total = qty * harga;
    var keterangan =  $("#modal_edit_retur #keterangan_id").val();
    var batchbaru =  $("#modal_edit_retur #batchbaru_id").val();
    var expbaru =  $("#modal_edit_retur #expbaru_id").val();

    // alert(penyebab);

    if(!obat || !batch || !supplier ||!tglbeli || !exp || !qty || !harga || !sub_total || !keterangan || !batchbaru || !expbaru){
        $('#modal_edit_retur #update').attr("data-dismiss","");  
        alert('Data Tidak Boleh Kosong');
        return false;
    }else {
        $('#modal_edit_retur #update').attr("data-dismiss","modal");
        $('#row_doc'+rowid+'').remove();
        $('#tangkap').append('<tr id="row_doc'+i+'" class="dynamic-added"><td>'+ text_obat +' <input name="obat[]" type="hidden" value= "' + obat + '" ></td><td>' + text_batch +' <input name="batch[]" type="hidden" value= "' + batch + '" ></td><td>' + supplier +' <input name="supplier[]" type="hidden" value= "' + id_supplier + '" ></td><td>' + tglbeli +' <input name="tglbeli[]" type="hidden" value= "' + tglbeli + '" ></td><td>' + exp +' <input name="exp[]" type="hidden" value= "' + exp + '" ></td><td>' + nf.format(qty) +' <input name="qty[]" type="hidden" value= "' + qty + '" ></td><td>' + nf.format(harga) +' <input name="harga[]" type="hidden" value= "' + harga + '" ></td><td>' + keterangan +' <input name="keterangan[]" type="hidden" value= "' + keterangan + '" ></td><td>' + batchbaru +' <input name="batchbaru[]" type="hidden" value= "' + batchbaru + '" ></td><td>' + expbaru +' <input name="expbaru[]" type="hidden" value= "' + expbaru + '" ></td><td><button type="button" style="margin:1px;"name="edit" id="'+i+'"  class="btn btn-warning " data-toggle="modal" data-target="#modal_edit_retur" data-obat="'+obat+'" data-batch="'+batch+'" data-id_supplier=id_supplier_id data-supplier="'+supplier+'" data-tglbeli="'+tglbeli+'" data-exp="'+exp+'" data-qty="'+qty+'" data-harga="'+harga+'" data-keterangan="'+keterangan+'" data-batchbaru="'+batchbaru+'" data-expbaru="'+expbaru+'"data-rowid= '+i+'><span class="glyphicon glyphicon-edit"></span></button> <button type="button" style="margin:1px;" name="remove" id="'+i+'" class="btn btn-danger btn_remove_doc"><span class="glyphicon glyphicon-trash"></span></button></td></tr>');
        }
});


$('#modal_edit_retur').on('show.bs.modal', function (event) {
    
    var button = $(event.relatedTarget); // Button that triggered the modal
    var rowid = button.data('rowid');
    var recipient_obat = button.data('obat');
    var recipient_batch = button.data('batch');
    var recipient_supplier = button.data('supplier');
    var recipient_tglbeli = button.data('tglbeli');
    var recipient_exp = button.data('exp');
    var recipient_qty = button.data('qty');
    var recipient_harga = button.data('harga');
    var recipient_keterangan = button.data('keterangan');
    var recipient_batchbaru = button.data('batchbaru');
    var recipient_expbaru = button.data('expbaru');
    // alert(recipient_subpenyebab);

    var modal = $(this)
    modal.find('#row_id_dimodal').val(rowid);
    modal.find('#obat_id_edit').val(recipient_obat).trigger('change');
    
    $('#modal_edit_retur #obat_id_edit').on('change', function() {

                var id_obat = $("#modal_edit_retur #obat_id_edit").val();
                if(id_obat){
                    $.ajax({
                        url: "http://localhost/sia_rolas/TransaksiRetur/api_batch/",
                        type: "POST",
                        data: {
                            'id': id_obat
                        },
                        success: function(data){
                            data = JSON.parse(data);
    
                            var $batch = $('#modal_edit_retur #batch_id_edit');
    
                            $('#modal_edit_retur #batch_id_edit').empty();
                            $batch.append('<option value="" disabled selected>Pilih Batch Obat</option>');
                            for (var i = 0; i < data.length; i++) {
                            $batch.append('<option value=' + data[i].id + '>' + data[i].batch + '</option>');
                            }
    
                            $("#modal_edit_retur #id_supplier_id_edit").val("");
                            $("#modal_edit_retur #supplier_id_edit").val("");
                            $("#modal_edit_retur #tglbeli_id_edit").val("");
                            $("#modal_edit_retur #exp_id_edit").val("");
                            $("#modal_edit_retur #harga_id_edit").val("");
                        }
                    });
                }
    });

    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    

    
        $.ajax({
            url: "http://localhost/sia_rolas/TransaksiRetur/api_batch/",
            type: "POST",
            data: {
                'id': recipient_obat
            },
            success: function(data){
                data = JSON.parse(data);

                var batch = $('#batch_id_edit');

                modal.find('#batch_id_edit').empty();
                for (var i = 0; i < data.length; i++) {
                    batch.append('<option value=' + data[i].id + '>' + data[i].batch + '</option>');
                }
                
                modal.find('#batch_id_edit').val(recipient_batch).trigger('change');
                modal.find('#supplier_id_edit').val(recipient_supplier);
                modal.find('#tglbeli_id_edit').val(recipient_tglbeli);
                modal.find('#exp_id_edit').val(recipient_exp);
                modal.find('#harga_id_edit').val(recipient_harga);
            }
        });
    

    
        
    modal.find('#qty_id_edit').val(recipient_qty);
    
    modal.find('#keterangan_id_edit').val(recipient_keterangan).trigger('change');
    modal.find('#batchbaru_id_edit').val(recipient_batchbaru);
    modal.find('#expbaru_id_edit').val(recipient_expbaru);
    
});

$('#modal_tambah_retur #obat_id').on('change', function() {
    var id_obat = $("#obat_id").val();
            if(id_obat){
                $.ajax({
                    url: "http://localhost/sia_rolas/TransaksiRetur/api_batch/",
                    type: "POST",
                    data: {
                        'id': id_obat
                    },
                    success: function(data){
                        data = JSON.parse(data);

                        var $batch = $('#batch_id');

                        $('#batch_id').empty();
                        $batch.append('<option value="" disabled selected>Pilih Batch Obat</option>');
                        for (var i = 0; i < data.length; i++) {
                        $batch.append('<option value=' + data[i].id + '>' + data[i].batch + '</option>');
                        }

                        $("#id_supplier_id").val("");
                        $("#supplier_id").val("");
                        $("#tglbeli_id").val("");
                        $("#exp_id").val("");
                        $("#harga_id").val("");
                    }
                });
    }
});

var i=1;
$('#modal_tambah_retur #simpan').click(function(){
  var nf = new Intl.NumberFormat();
    // alert('hai')
    var obat =  $("#modal_tambah_retur #obat_id").val();
    var text_obat =  $("#modal_tambah_retur #obat_id :selected").text();
    var batch =  $("#modal_tambah_retur #batch_id").val();
    var text_batch =  $("#modal_tambah_retur #batch_id :selected").text();
    var id_supplier =  $("#modal_tambah_retur #id_supplier_id").val();
    var supplier =  $("#modal_tambah_retur #supplier_id").val();
    var tglbeli =  $("#modal_tambah_retur #tglbeli_id").val();
    var exp =  $("#modal_tambah_retur #exp_id").val();
    var qty =  $("#modal_tambah_retur #qty_id").val();
    var harga =  $("#modal_tambah_retur #harga_id").val();
    var sub_total = qty * harga;
    var keterangan =  $("#modal_tambah_retur #keterangan_id").val();
    var batchbaru =  $("#modal_tambah_retur #batchbaru_id").val();
    var expbaru =  $("#modal_tambah_retur #expbaru_id").val();


    // alert(obat);

    if(!obat || !batch || !supplier ||!tglbeli || !exp || !qty || !harga || !sub_total || !keterangan || !batchbaru || !expbaru){
        // alert(harga);
        $('#modal_tambah_retur #simpan').attr("data-dismiss","");  
        alert('Terdapat data yang belum diisi!');
    } else {
        $('#modal_tambah_retur #simpan').attr("data-dismiss","modal");
        $('#tangkap').append('<tr id="row_doc'+i+'" class="dynamic-added"><td>'+ text_obat +' <input name="obat[]" type="hidden" value= "' + obat + '" ></td><td>' + text_batch +' <input name="batch[]" type="hidden" value= "' + batch + '" ></td><td>' + supplier +' <input name="supplier[]" type="hidden" value= "' + id_supplier + '" ></td><td>' + tglbeli +' <input name="tglbeli[]" type="hidden" value= "' + tglbeli + '" ></td><td>' + exp +' <input name="exp[]" type="hidden" value= "' + exp + '" ></td><td>' + nf.format(qty) +' <input name="qty[]" type="hidden" value= "' + qty + '" ></td><td>' + nf.format(harga) +' <input name="harga[]" type="hidden" value= "' + harga + '" ></td><td>' + keterangan +' <input name="keterangan[]" type="hidden" value= "' + keterangan + '" ></td><td>' + batchbaru +' <input name="batchbaru[]" type="hidden" value= "' + batchbaru + '" ></td><td>' + expbaru +' <input name="expbaru[]" type="hidden" value= "' + expbaru + '" ></td><td><button type="button" style="margin:1px;"name="edit" id="'+i+'"  class="btn btn-warning " data-toggle="modal" data-target="#modal_edit_retur" data-obat="'+obat+'" data-batch="'+batch+'" data-id_supplier=id_supplier_id data-supplier="'+supplier+'" data-tglbeli="'+tglbeli+'" data-exp="'+exp+'" data-qty="'+qty+'" data-harga="'+harga+'" data-keterangan="'+keterangan+'" data-batchbaru="'+batchbaru+'" data-expbaru="'+expbaru+'"data-rowid= '+i+'><span class="glyphicon glyphicon-edit"></span></button> <button type="button" style="margin:1px;" name="remove" id="'+i+'" class="btn btn-danger btn_remove_doc"><span class="glyphicon glyphicon-trash"></span></button></td></tr>');
        i++;

        $("#modal_tambah_retur #obat_id").val('').trigger('change');
        $("#modal_tambah_retur #batch_id").val('').trigger('change');
        $("#modal_tambah_retur #id_supplier_id").val('');
        $("#modal_tambah_retur #supplier_id").val('');
        $("#modal_tambah_retur #tglbeli_id").val('');
        $("#modal_tambah_retur #exp_id").val('');
        $("#modal_tambah_retur #qty_id").val('');
        $("#modal_tambah_retur #harga_id").val('');
        $("#modal_tambah_retur #keterangan_id").val('').trigger('change');
        $("#modal_tambah_retur #batchbaru_id").val('');
        $("#modal_tambah_retur #expbaru_id").val('');
        
        
    }
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