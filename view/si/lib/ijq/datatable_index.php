
    /* Colocar en table id="example" y class="display" 
       Añadir una columna al comienzo para la numeracion <th></th> y <td></td>
    */        
    var table = $('#example').DataTable( {
        "language": { 
                        "url": "<?php echo LANGUAGE_RELATIVE_PATH; ?>Spanish.json"  
        },
        "pagingType": "full_numbers",
        "lengthMenu": [ [ 25, 50, 100, 200, 500, -1], [ 25, 50, 100, 200, 500, "Todos"] ],
        "columnDefs": [ { "searchable": false, "orderable": false, "targets": 0 } ],
        "order": [[ 1, 'asc' ]]
    } );     
    
    table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();



