
var tableProveedor = $('.tablaProveedor').DataTable({
	"ajax":"ajax/datatable-proveedores.ajax.php",
	"columnDefs": [{
            "className": 'details-control',
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='btn-group-xs'><button class='btn btn-warning btnEditarProveedor' data-toggle='modal' data-target='#modalEditarProveedor' idProveedor><i class='far fa-edit'></i></button><button class='btn btn-danger btnEliminarProveedor' idProveedor data-toggle='modal' data-target='#modalEliminarProveedor'><i class='far fa-trash-alt'></i></button></div>"
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
 $('.tablaProveedor tbody').on( 'click', 'button.btnEditarProveedor', function () {
         if (window.matchMedia("(min-width:992px)").matches) {
            var data = tableProveedor.row( $(this).parents('tr')).data();
         }else{
            var data = tableProveedor.row( $(this).parents('tbody tr ul li') ).data();
         }
    console.log(data);
    $('.btnEditarProveedor').attr("idProveedor", data[8]);
    $('.btnEliminarProveedor').attr("idProveedor", data[8]);

          $("#codigoProveedorEditar").val(data[8]);
            $("#editarProveedor").val(data[1]);
            $("#editarDocumentoId").val(data[2]);
            $("#editarEmail").val(data[5]);
            $("#editarTelefono").val(data[3]);
            $("#editarDireccion").val(data[4]);

    })



 $('.tablaProveedor tbody').on( 'click', 'button.btnEliminarProveedor', function () {
    if (window.matchMedia("(min-width:992px)").matches) {
            var data = tableProveedor.row( $(this).parents('tr')).data();
         }else{
            var data = tableProveedor.row( $(this).parents('tbody tr ul li') ).data();
         }
        $("#codigoProveedorEliminar").val(data[8]);
        $("#eliminarProveedor").val(data[1]+" Ruc: "+data[2]);
})
