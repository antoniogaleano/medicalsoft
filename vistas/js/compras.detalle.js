/*===============================================
=            CARGAR PRODUCTOS VENTAS            =
===============================================*/
var tableCompraDetalle = $('.tablaCompraDet').DataTable({
	// "ajax":"ajax/datatable-ventas-detalle.ajax.php",
	"columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='btn-group-xs'><button class='btn btn-dark btnImprimirFacturaCompra' codigoCompra><i class='fa fa-print'></i></button><button class='btn btn-success btnEditarCompra' idCompra><i class='fas fa-pencil-alt'></i></button><button class='btn btn-warning btnEliminarCompra' idCompra><i class='fa fa-trash'></i></button></div>"
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
$('.tablaCompraDet tbody').on( 'click', 'button.btnEditarCompra', function () {
    if (window.matchMedia("(min-width:992px)").matches) {
            var data = tableCompraDetalle.row( $(this).parents('tr') ).data();
         }else{
            var data = tableCompraDetalle.row( $(this).parents('tbody tr ul li') ).data();
         }
         console.log(data);
         $(this).attr("idCompra",data[9]);
        // var codigo = $(this).attr("idVenta");
        window.location = "index.php?ruta=editar-compra&idCompra="+data[9];

});


/*=============================================
=            MODIFICAR LA CANTIDAD  EDITAR          =
=============================================*/
$('.formularioEditarCompra').on( 'change', 'input.nuevoPrecioProducto', function(){
   var precioUnitario = $(".nuevoPrecioProducto").val();
  $(".nuevoPrecioProducto").attr("preciounitario", precioUnitario);
  var nuevoStock = Number($(this).attr("stock")) + Number($(this).val());
  $(this).attr("nuevoStock", nuevoStock);
  listarProductosCompras()
  sumarTotalPrecios()
})

$('.tablaCompraDet tbody').on( 'click', 'button.btnEliminarCompra', function () {
    if (window.matchMedia("(min-width:992px)").matches) {
            var data = tableCompraDetalle.row( $(this).parents('tr') ).data();
         }else{
            var data = tableCompraDetalle.row( $(this).parents('tbody tr ul li') ).data();
         }
         // console.log(data);

        // var codigo = $(this).attr("idVenta");
        // window.location = "index.php?ruta=editar-compra&idCompra="+data[9];
           Swal.fire({
                  title: 'Estas seguro de eliminar la compra?',
                  text: "No podras recuperar una vez eliminado!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si, Deseo Borrar!'
                }).then((result) => {
                  if (result.value) {
                    $(this).attr("idCompra",data[9]);
                    var codigoCompra = data[9];
                    // console.log("codigoCompra", codigoCompra);
                    var datos = new FormData();
                    datos.append("codigoCompra",codigoCompra);
                    $.ajax({
                          url : "ajax/eliminar.compras.ajax.php",
                          method : "POST",
                          data : datos,
                          cache :false,
                          contentType :false,
                          processData: false,
                          dataType: "json",
                          success:function(respuesta){
                              if (respuesta=="ok") {
                                   Swal.fire({
                                   icon: 'success',
                                   title: 'Compra eliminada correctamente!'
                                           }).then((result)=>{
                                               if(result.value){
                                                   window.location = 'compras';
                                               }
                                           })

                              }
                          }
                      })

                  }
                })

});
  $('.tablaCompraDet tbody').on( 'click', 'button.btnImprimirFacturaCompra', function () {
 if (window.matchMedia("(min-width:992px)").matches) {
            var data = tableCompraDetalle.row( $(this).parents('tr') ).data();
         }else{
            var data = tableCompraDetalle.row( $(this).parents('tbody tr ul li') ).data();
         }
          console.log(data);
         $(this).attr("codigoCompra",data[9]);
         window.open("extensiones/tcpdf/pdf/factura_compra.php?codigo="+data[9],  "_blank");


})