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
              // title: 'Laporan Penjualan Obat',
              messageTop : 'Laporan Penjualan Obat',
              exportOptions: { 
                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9] 
                },
              

                //For repeating heading.
                // repeatingHead: {
                //     logo: 'https://www.google.co.in/logos/doodles/2018/world-cup-2018-day-22-5384495837478912-s.png',
                //     logoPosition: 'right',
                //     logoStyle: '',
                //     title: '<h3>Sample Heading</h3>'
                // }
              customize: function ( win ) {
                  $(win.document.body)
                      .css( 'font-size', '10pt' )
                      .prepend(
                            '<img src="http://localhost/sia_rolas/assets/img/qw.png" style="width: 15%; align:right; height:auto; margin:10px" />'
                        );

                  $(win.document.body).find( 'table' )
                      .addClass( 'compact' )
                      .css( 'font-size', 'inherit' );
                  $(win.document.body).find('h1').hide();
              }
          },
          {
              extend: 'excelHtml5',
              exportOptions: { 
                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9] 
                }
          }
      ]
  });
});