
var table = $('.tablaClientes').DataTable({
	"ajax":"ajax/datatable-clientes.ajax.php",

	"columnDefs": [ {
            "className": 'details-control',
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='btn-group-xs'><button class='btn btn-warning btnEditarCliente' data-toggle='modal' data-target='#modalEditarCliente' idCliente><i class='far fa-edit'></i></button><button class='btn btn-success btnAtencionCliente' idCliente><i class='fas fa-glasses'></i></button><button class='btn btn-danger btnEliminarCliente' idCliente data-toggle='modal' data-target='#modalEliminarCliente'><i class='far fa-trash-alt'></i></button></div>"
		        },
                {
                "targets": -3,
                "visible": false
                },
                {
                "targets": -2,
                "visible": false
                }],
                "language": {

        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }

    }

})




/*ACTIVAR BOTONES CON ID*/
 $('.tablaClientes tbody').on( 'click', 'button.btnEditarCliente', function () {
        // $('.btnEditarCliente').attr("idcliente", data[9]);
         if (window.matchMedia("(min-width:992px)").matches) {
            var data = table.row( $(this).parents('tr')).data();
         }else{
            var data = table.row( $(this).parents('tbody tr ul li') ).data();
         }
         console.log("xd "+data);
          $("#codigoClienteEditar").val(data[9]);
            $("#editarCliente").val(data[1]);
            $("#editarDocumentoId").val(data[2]);
            $("#editarEmail").val(data[3]);
            $("#editarTelefono").val(data[4]);
            $("#editarDireccion").val(data[5]);
             $("#editarFechaNacimiento").val(data[6]);
    } )

  $('.tablaClientes tbody').on( 'click', 'button.btnEliminarCliente', function () {
        // $('.btnEditarCliente').attr("idcliente", data[9]);
         if (window.matchMedia("(min-width:992px)").matches) {
            var data = table.row( $(this).parents('tr')).data();
         }else{
            var data = table.row( $(this).parents('tbody tr ul li') ).data();
         }
         console.log(data);
        $("#codigoCliente").val(data[9]);
        $("#razonCliente").val(data[1]+" Ruc: "+data[2]);
    } );

 $('.tablaClientes tbody').on( 'click', 'button.btnAtencionCliente', function () {
        // $('.btnEditarCliente').attr("idcliente", data[9]);
         if (window.matchMedia("(min-width:992px)").matches) {
            var data = table.row( $(this).parents('tr')).data();
         }else{
            var data = table.row( $(this).parents('tbody tr ul li') ).data();
         }
         console.log(data);
         window.location ="index.php?ruta=historial&id="+data[9];

    } );

