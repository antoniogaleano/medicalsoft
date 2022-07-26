/*===============================================
=            LOCAL STORAGE           =
===============================================*/
if (localStorage.getItem("capturarRango") != null) {
    // alert(localStorage.getItem("capturarRango"));
     $('#reportrange span').html(localStorage.getItem("capturarRango"));
}

/*===============================================
=            CARGAR PRODUCTOS VENTAS            =
===============================================*/
var tableDVenta = $('.tablaVentaDet').DataTable({
	// "ajax":"ajax/datatable-ventas-detalle.ajax.php",
	"columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='btn-group-xs'><button class='btn btn-primary btnImprimirFactura' codigoVenta><i class='fa fa-print'></i></button><button class='btn btn-warning btnEditar' idVenta><i class='fas fa-pencil-alt'></i></button><button class='btn btn-danger btnEliminarVenta' idVenta><i class='fa fa-trash'></i></button></div>"
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
$('.tablaVentaDet tbody').on( 'click', 'button.btnEditar', function () {
    if (window.matchMedia("(min-width:992px)").matches) {
            var data = tableDVenta.row( $(this).parents('tr') ).data();
         }else{
            var data = tableDVenta.row( $(this).parents('tbody tr ul li') ).data();
         }
         console.log(data);
         $(this).attr("idCompra",data[9]);
        // var codigo = $(this).attr("idVenta");
        window.location = "index.php?ruta=editar-venta&idVenta="+data[8];

});

// $(".btnEditar").click(function(){
//         var codigo = $(this).attr("idVenta");
//         window.location = "index.php?ruta=editar-venta&idVenta="+codigo;
// })

$("#btnImprimirFactura").click(function(){
var codigoventa = $(this).val();
var data = tableDVenta.row( $(this).parents('tbody tr ul li') ).data();

        // alert(data);
        // window.open("extensiones/tcpdf/pdf/factura.php?codigo="+codigo,  "_blank");

    })
/*IMPRIMIR FACTURA VERSION AJAX*/
$('.tablaVentaDet tbody').on( 'click', 'button.btnImprimirFactura', function () {
     if (window.matchMedia("(min-width:992px)").matches) {
            var data = tableDVenta.row( $(this).parents('tr') ).data();
         }else{
            var data = tableDVenta.row( $(this).parents('tbody tr ul li') ).data();
         }
          // console.log(data);
         $(this).attr("codigoVenta",data[8]);
         window.open("extensiones/tcpdf/pdf/factura.php?codigo="+data[8],  "_blank");

})



/*IMPRIMIR FACTURA VERSION AJAX*/
$('.tablaVentaDet tbody').on( 'click', 'button.btnEliminarVenta', function () {
     if (window.matchMedia("(min-width:992px)").matches) {
            var data = tableDVenta.row( $(this).parents('tr') ).data();
         }else{
            var data = tableDVenta.row( $(this).parents('tbody tr ul li') ).data();
         }
        // console.log(data);
          Swal.fire({
                  title: 'Estas seguro de eliminar la venta?',
                  text: "No podras recuperar una vez eliminado!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si, Deseo Borrar!'
                }).then((result) => {
                  if (result.value) {
                      $(this).attr("codigoVenta",data[8]);
        var codigoVenta = data[8];
        var datos = new FormData();
        datos.append("codigoVenta",codigoVenta);
          $.ajax({
        url : "ajax/eliminar.ventas.ajax.php",
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
                 title: 'Venta eliminada correctamente!'
                         }).then((result)=>{
                             if(result.value){
                                 window.location = 'ventas';
                             }
                         })

            }
        }
    })

                  }
                })


})
$(function() {
var start = moment().subtract(29, 'days');
    // var start = moment();

    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
       var capturarRango = $('#reportrange span').html();
       // console.log("rango",rango);
       var fechaInicial = start.format('YYYY-MM-DD');
       var fechaFinal = end.format('YYYY-MM-DD');
       // console.log("periodo ", fechaInicial+" "+fechaFinal);
       localStorage.setItem("capturarRango", capturarRango);
        window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Hoy': [moment(), moment()],
           'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Ultimos 7 dias': [moment().subtract(6, 'days'), moment()],
           'Ultimos 30 dias': [moment().subtract(29, 'days'), moment()],
           'Mes actual': [moment().startOf('month'), moment().endOf('month')],
           'Mes anterior': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    // cb(start, end);

});