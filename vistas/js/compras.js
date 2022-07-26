/*===============================================
=            CARGAR PRODUCTOS COMPRAS            =
===============================================*/
var tableCompra = $('.tablaCompras').DataTable({
	"ajax":"ajax/datatable-compras.ajax.php",
	"columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='btn-group-xs'><button class='btn btn-success agregarProductoCompra recuperarProductoCompra recuperarBotonCompra' idProductoCompra><i class='fas fa-shopping-basket'></i></button></div>"
		        },
		        {
            "targets": -3,
            "data": null,
            "defaultContent": "<div class='btn-group-xs'><button class='btn btn-success limiteStock'></button></div>"
		        },
		        {
            "targets": -6,
            "data": null,
            "defaultContent": '<img class="img-thumbnail imgTablaCompra" width="40px">'
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
/*=============================================
=            ACTIVAR BOTON DE LA TABLA COMPRAS        =
=============================================*/

$('.tablaCompras tbody').on( 'click', 'button.agregarProductoCompra', function () {
        var data = tableCompra.row( $(this).parents('tr')).data();
      $(this).attr("idProductoCompra",data[6]);
        // $('.agregarProductoCompra').attr("idProductoCompra", data[6]);
       // console.log("dd ",data);
})
/*=============================================
=            CARGAR IMAGENES PRODUCTO        =
=============================================*/
function cargarImagenesProductosCompra(){

    var imgTabla = $(".imgTablaCompra");
    var limiteStock = $(".limiteStock");
    for (var i = 0; i <imgTabla.length; i++) {
       var data = tableCompra.row($(imgTabla[i]).parents("tr")).data();
       $(imgTabla[i]).attr("src", data[1]);
       // console.log("data ",data[4]);
       if (data[4] <= 10) {
        $(limiteStock[i]).addClass("btn-danger");
        $(limiteStock[i]).html(data[4]);
       }else if(data[4] > 11 && data[4] <= 15){
        $(limiteStock[i]).addClass("btn-warning");
        $(limiteStock[i]).html(data[4]);
       }else{
        $(limiteStock[i]).addClass("btn-success");
        $(limiteStock[i]).html(data[4]);
       }
    }
}
setTimeout(function(){
    cargarImagenesProductosCompra();
},2000)

$(".dataTables_paginate").click(function(){
    cargarImagenesProductosCompra();
})
$("input[aria-controls='DataTables_Table_0']").focus(function(){
    $(document).keyup(function(event){
        event.preventDefault();
        cargarImagenesProductosCompra();
    })
})
$("select[name='DataTables_Table_0_length']").change(function(){
cargarImagenesProductosCompra();
})

$(".sorting").click(function(){
    cargarImagenesProductosCompra();
})

/*=========================================================
=            AGREGAR PRODUCTO A LA TABLA COMPRA            =
=========================================================*/
$('.tablaCompras tbody').on( 'click', 'button.agregarProductoCompra', function () {
    var idProductoCompra = $(this).attr("idProductoCompra");
    // console.log("??????",$(this));
    $(this).removeClass("btn-success agregarProductoCompra");
    $(this).addClass("btn-default");
    var datos = new FormData();
    datos.append("idProductoCompra", idProductoCompra);
    $.ajax({
            url : "ajax/productos.compras.ajax.php",
            method : "POST",
            data : datos,
            cache :false,
            contentType :false,
            processData: false,
            dataType: "json",
            success:function(respuesta){
                // console.log("respuesta ", respuesta);
                var descripcion = respuesta["descripcion"];
                var stock = respuesta["stock"];
                var precio = respuesta["precio_compra"];
                var impuesto = 10;
                var cant = 1;
                // console.log(Number(stock)+1);
                $(".nuevoProductoCompra").append(
          '<!--PANTALLA COMPLETA-->'+
          '<div class="row">'+
                          '<div class="col-5">'+
                              '<div class="input-group mb-3">'+
                                '<div class="input-group-prepend">'+
                                  '<span class="input-group-text"><button class="btn  btn-sm btn-danger quitarProductoCompra " idProductoCompra="'+idProductoCompra+'"><i class="far fa-trash-alt"></i></button></span>'+
                                '</div>'+
                                '<input type="text" class="form-control  nuevaDescripcionProducto" idProductoCompra="'+idProductoCompra+'" name="agregarProductoCompra" value="'+descripcion+'" readonly>'+
                              '</div>'+
                          '</div>'+
                          '<div class="col">'+
                            '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+(Number(stock)+1)+'" required>'+
                          '</div>'+
                          '<div class="col ingresoImpuesto">'+
                            '<input type="number" class="form-control nuevoIva"  name="nuevoIva" value="'+impuesto+'" required>'+
                          '</div>'+
                          '<div class="col-3 ingresoPrecio">'+
                            '<input type="number" class="form-control nuevoPrecioProducto"  name="nuevoPrecioProducto" value="'+precio+'"  precioReal="'+precio+'"  required>'+
                          '</div>'+
                        '</div>'
                        );

                      sumarTotalPrecios()
                      listarProductosCompras()
                      $(".nuevoPrecioProducto").number(true, 2);


            }
        })

})

/*=========================================================
=           QUITAR PRODUCTO Y HABILITAR BOTON            =
=========================================================*/
$('.formularioCompra').on( 'click', 'button.quitarProductoCompra', function(){
    $(this).parent().parent().parent().parent().parent().remove();
    var idProductoCompra = $(this).attr("idProductoCompra");
     // console.log("fadfasdfas", idProductoCompra)

    $("button.recuperarBotonCompra[idProductoCompra='"+idProductoCompra+"']").removeClass('btn-default');
    $("button.recuperarBotonCompra[idProductoCompra='"+idProductoCompra+"']").addClass('btn-primary agregarProductoCompra');

    if ($(".nuevoProductoCompra").children().length == 0) {
        console.log("test ",idProductoCompra);
        $("#nuevoTotalCompra").val(0);

    }  else{

      listarProductosCompras()
      sumarTotalPrecios()
    }
    // sumarTotalPrecios()
})



// formularioEditarCompra




/*=============================================
=            MODIFICAR LA CANTIDAD         =
=============================================*/
$('.formularioCompra').on( 'change', 'input.nuevaCantidadProducto', function(){
   var precioUnitario = $(".nuevoPrecioProducto").val();
  $(".nuevoPrecioProducto").attr("preciounitario", precioUnitario);
  var nuevoStock = Number($(this).attr("stock")) + Number($(this).val());
  $(this).attr("nuevoStock", nuevoStock);
  listarProductosCompras()
  sumarTotalPrecios()
})

/*=============================================
=            INGRESANDO IMPORTE           =
=============================================*/
$('.formularioCompra').on( 'change', 'input.nuevoPrecioProducto', function(){
  var precioUnitario = $(".nuevoPrecioProducto").val();
  $(".nuevoPrecioProducto").attr("preciounitario", precioUnitario);
  listarProductosCompras()
  sumarTotalPrecios()
})


/*LISTAR O AGRUPAR PRODUCTOS*/
function listarProductosCompras(){

  var listaProductosCompras = [];

  var descripcion = $(".nuevaDescripcionProducto");
  var cantidad = $(".nuevaCantidadProducto");
  var impuesto = $(".nuevoIva");
  var precio = $(".nuevoPrecioProducto");
  var precioUnt = $(".nuevaCantidadProducto");
  for(var i = 0; i < descripcion.length; i++){
    listaProductosCompras.push({ "id" : $(descripcion[i]).attr("idProductoCompra"),
                "descripcion" : $(descripcion[i]).val(),
                "impuesto" : $(impuesto[i]).val(),
                "precioUnt" : Math.round($(precio[i]).val() / $(precioUnt[i]).val()) ,
                "cantidad" : $(cantidad[i]).val(),
                "stock" : $(cantidad[i]).attr("nuevoStock"),
                "precio" : $(precio[i]).attr("precioReal"),
                "total" : $(precio[i]).val()})
  }
  $("#listaProductosCompras").val(JSON.stringify(listaProductosCompras));
 console.log("listar prodcutos", JSON.stringify(listaProductosCompras));
  sumarTotalPrecios()
}

  function sumarTotalPrecios(){
      var precioItem = $(".nuevoPrecioProducto");
      var arraySumarPrecio = [];
      for (var i = 0; i < precioItem.length; i++ ) {
          arraySumarPrecio.push(Number($(precioItem[i]).val()));

      }
      // console.log("array ",arraySumarPrecio );
        function sumaArrayPreciosCompra(total, numero){
            return   total + numero;
        }
        var sumaTotalPrecio = arraySumarPrecio.reduce(sumaArrayPreciosCompra);
        $("#nuevoTotalCompra").val(sumaTotalPrecio);
        $("#totalCompra").val(sumaTotalPrecio);
        $("#nuevoTotalCompra").attr("total",sumaTotalPrecio);
        // console.log("sumaTotalPrecio", sumaTotalPrecio);
  }

var date = new Date();
var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
console.log(today);
// $( '#datePicker' ).datepicker( optComponent );
// $( '#nuevaFecha, #datepicker2, #simple, #datePicker' ).datepicker( 'setDate', today );
var optSimple = {
  format: 'dd/mm/yyyy'
};
console.log(today, optSimple);
$('#nuevaFecha').html(optSimple);
// var optComponent = {
//   format: 'mm-dd-yyyy',
//   container: '#datePicker',
//   orientation: 'auto top',
//   todayHighlight: true,
//   autoclose: true
// };

// SIMPLE

/*=====================================
=            EDITAR COMPRA            =
=====================================*/
/*=========================================================
=           QUITAR PRODUCTO Y HABILITAR BOTON            =
=========================================================*/
$('.formularioEditarCompra').on( 'click', 'button.quitarProductoCompra', function(){
    $(this).parent().parent().parent().parent().parent().remove();
    var idProductoCompra = $(this).attr("idProductoCompra");
     // console.log("fadfasdfas", idProductoCompra)

    $("button.recuperarBotonCompra[idProductoCompra='"+idProductoCompra+"']").removeClass('btn-default');
    $("button.recuperarBotonCompra[idProductoCompra='"+idProductoCompra+"']").addClass('btn-primary agregarProductoCompra');

    if ($(".nuevoProductoCompra").children().length == 0) {
        console.log("test ",idProductoCompra);
        $("#nuevoTotalCompra").val(0);

    }  else{

      listarProductosCompras()
      sumarTotalPrecios()
    }
    // sumarTotalPrecios()
})

/*=============================================
=            MODIFICAR LA CANTIDAD   formularioEditarCompra         =
=============================================*/
$('.formularioEditarCompra').on( 'change', 'input.nuevaCantidadProducto', function(){
   var precioUnitario = $(".nuevoPrecioProducto").val();
  $(".nuevoPrecioProducto").attr("preciounitario", precioUnitario);
  var nuevoStock = Number($(this).attr("stock")) + Number($(this).val());
  $(this).attr("nuevoStock", nuevoStock);
  listarProductosCompras()
  sumarTotalPrecios()
})
/*=====  End of EDITAR COMPRA  ======*/
/*=========================================================
=           QUITAR PRODUCTO Y HABILITAR BOTON            =
=========================================================*/



