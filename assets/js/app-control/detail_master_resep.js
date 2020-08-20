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
                columns: [ 0, 1, 2, 3] 
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
                columns: [ 0, 1, 2, 3] 
                }
          }
      ]
  });
});