/*===============================================
=            CARGAR PRODUCTOS VENTAS            =
===============================================*/
var table2 = $('.tablaVentas').DataTable({
	"ajax":"ajax/datatable-ventas.ajax.php",
	"columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='btn-group-xs'><button class='btn btn-primary agregarProducto recuperarProducto recuperarBoton' idProducto><i class='fas fa-cart-plus'></i></button></div>"
		        },
		        {
            "targets": -3,
            "data": null,
            "defaultContent": "<div class='btn-group-xs'><button class='btn btn-success limiteStock'></button></div>"
		        },
		        {
            "targets": -6,
            "data": null,
            "defaultContent": '<img class="img-thumbnail imgTablaVenta" width="40px">'
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
=            ACTIVAR BOTON DE LA TABLA        =
=============================================*/

$('.tablaVentas tbody').on( 'click', 'button.agregarProducto', function () {
        var data = table2.row( $(this).parents('tr') ).data();
        // $(this).attr("idProducto",data[5]);
        $('.agregarProducto').attr("idProducto", data[6]);
})
/*=============================================
=            CARGAR IMAGENES PRODUCTO        =
=============================================*/
function cargarImagenesProductos(){

    var imgTabla = $(".imgTablaVenta");
    var limiteStock = $(".limiteStock");
    for (var i = 0; i <imgTabla.length; i++) {
       var data = table2.row($(imgTabla[i]).parents("tr")).data();
       $(imgTabla[i]).attr("src", data[1]);
       console.log("data ",data[4]);
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
	cargarImagenesProductos();
},2000)

$(".dataTables_paginate").click(function(){
    cargarImagenesProductos();
})
// $(".dataTables_paginate").click(function(){
//     cargarImagenesProductos();
// })
$("input[aria-controls='DataTables_Table_0']").focus(function(){
    $(document).keyup(function(event){
        event.preventDefault();
        cargarImagenesProductos();
    })
})


$("select[name='DataTables_Table_0_length']").change(function(){
cargarImagenesProductos();
})

$(".sorting").click(function(){
    cargarImagenes();
})
/*=========================================================
=            AGREGAR PRODUCTO A LA TABLA VENTA            =
=========================================================*/
$('.tablaVentas tbody').on( 'click', 'button.agregarProducto', function () {
	var idProducto = $(this).attr("idProducto");
	// console.log("this is",idProducto);
	$(this).removeClass("btn-primary agregarProducto");
	$(this).addClass("btn-default");
	var datos = new FormData();
	datos.append("idProducto", idProducto);
	$.ajax({
	        url : "ajax/productos.ajax.php",
	        method : "POST",
	        data : datos,
	        cache :false,
	        contentType :false,
	        processData: false,
	        dataType: "json",
	        success:function(respuesta){

	        	var descripcion = respuesta["descripcion"];
	        	var stock = respuesta["stock"];
	        	var precio = respuesta["precio_venta"];

	 			$(".nuevoProducto").append(
          '<!--PANTALLA COMPLETA-->'+
          '<div class="row">'+
                          '<div class="col-6">'+
                              '<div class="input-group mb-3">'+
                                '<div class="input-group-prepend">'+
                                  '<span class="input-group-text"><button class="btn  btn-sm btn-danger quitarProducto " idProducto="'+idProducto+'"><i class="far fa-trash-alt"></i></button></span>'+
                                '</div>'+
                                '<input type="text" class="form-control  nuevaDescripcionProducto" idProducto="'+idProducto+'" name="agregarProducto" value="'+descripcion+'" readonly>'+
                              '</div>'+
                          '</div>'+
                          '<div class="col-3">'+
                            '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+
                          '</div>'+
                          '<div class="col-3 ingresoPrecio">'+
                            '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio+'"   name="nuevoPrecioProducto" value="'+precio+'" required readonly>'+
                          '</div>'+
                        '</div>'
                        );
                      /*SUMAR TOTAL PRECIOS*/
                      sumarTotalPreciosVenta()
                      agregarImpuesto()
                      listarProductos()
                      //FORMATO PRECIO
                      $(".nuevoPrecioProducto").number(true, 2);


	        }
	    })

        // var data = table2.row( $(this).parents('tr') ).data();
        // $('.agregarProducto').attr("idcliente", data[5]);
})
/*=====  End of AGREGAR PRODUCTO A LA TABLA VENTA  ======*/
/*=========================================================
=           QUITAR PRODUCTO Y HABILITAR BOTON            =
=========================================================*/
$('.formularioVenta').on( 'click', 'button.quitarProducto', function(){
  console.log(";)");
	$(this).parent().parent().parent().parent().parent().remove();
	var idProducto = $(this).attr("idProducto");
	$("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');
	$("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');
    if ($(".nuevoProducto").children().length == 0) {
          $("#nuevoImpuestoVenta").val(0);
        $("#nuevoTotalVenta").val(0);
        $("#totalVenta").val(0);
        $("#nuevoTotalVenta").attr("total", 0);
    }else{
      sumarTotalPreciosVenta()
      agregarImpuesto()
      listarProductos()
    }
    // sumarTotalPreciosVenta()
})
/*====================================================
=            AGREGAR PRODUCTO DESDE MOVIL            =
====================================================*/
$('.btnAgregarProducto').click(function(){
	var datos = new FormData();
	datos.append("traerProductos", "ok");
	  $.ajax({
        url : "ajax/productos.ajax.php",
        method : "POST",
        data : datos,
        cache :false,
        contentType :false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
          	$(".nuevoProducto").append(
              '<!--PANTALLA MOVIL-->'+
              '<div class="row">'+
                          '<div class="col-6">'+
                              '<div class="input-group mb-3">'+
                                '<div class="input-group-prepend">'+
                                  '<span class="input-group-text"><button class="btn  btn-sm btn-danger quitarProducto " idProducto><i class="far fa-trash-alt"></i></button></span>'+
                                '</div>'+
                                '<select class="form-control nuevaDescripcionProducto" idProducto name="nuevaDescripcionProducto" required>'+
                                '<option>Seleccion un Producto</option>'+
                                '</select>'+
                              '</div>'+
                          '</div>'+
                          '<div class="col-3 ingresoCantidad">'+
                            '<input type="number" class="form-control nuevaCantidadProducto"    name="nuevaCantidadProducto" value="1" min="1" stock  nuevoStock required>'+
                          '</div>'+
                          '<div class="col-3 ingresoPrecio">'+
                            '<input type="text" class="form-control nuevoPrecioProducto"  precioReal=""  min="1"  name="nuevoPrecioProducto" value="" required readonly>'+
                          '</div>'+
                        '</div>');
          		/*===================================================
          		=            AGREGAR PRODUCTOS AL SELECT            =
          		===================================================*/
          			respuesta.forEach(functionForEach);
          			function functionForEach(item, index){
          					$(".nuevaDescripcionProducto").append('<option idProducto="'+item.id+'" value"'+item.descripcion+'">'+item.descripcion+'</option>')
          			}
                /*SUMAR TOTAL PRECIOS MOVIL*/
                sumarTotalPreciosVenta()
                agregarImpuesto()

                $(".nuevoPrecioProducto").number(true, 2);
          		/*=====  End of AGREGAR PRODUCTOS AL SELECT  ======*/
        }

    })

})
/*=====  End of AGREGAR PRODUCTO DESDE MOVIL  ======*/
/*=============================================
=            SELECCCIONAR PRODUCTO            =
=============================================*/
$('.formularioVenta').on( 'change', 'select.nuevaDescripcionProducto', function(){
	var nombreProducto = $(this).val();
	var nuevoPrecioProducto = $(this).parents().parents().parents().children(".ingresoPrecio").children(".nuevoPrecioProducto");

	var nuevaCantidadProducto = $(this).parents().parents().parents().children(".ingresoCantidad").children(".nuevaCantidadProducto");

	// console.log("x ",nuevoPrecioProducto);
	var datos = new FormData();
	datos.append("nombreProducto", nombreProducto);
	$.ajax({
        url : "ajax/productos.ajax.php",
        method : "POST",
        data : datos,
        cache :false,
        contentType :false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
        	$(nuevaCantidadProducto).attr("stock", respuesta["stock"]);
          $(nuevaCantidadProducto).attr("nuevoStock", Number(respuesta["stock"])-1);
        	$(nuevoPrecioProducto).val(respuesta["precio_venta"]);
        	$(nuevoPrecioProducto).attr("precioReal",respuesta["precio_venta"]);
        	// console.log("respuesta", respuesta);
           listarProductos()
        }
    })

})
/*=====  End of SELECCCIONAR PRODUCTO  ======*/
/*=============================================
=            MODIFICAR LA CANTIDAD            =
=============================================*/
$('.formularioVenta').on( 'change', 'input.nuevaCantidadProducto', function(){
	var precio =$(this).parents().parents().children(".ingresoPrecio").children(".nuevoPrecioProducto");
	var precioFinal = $(this).val() * precio.attr("precioReal");
	precio.val(precioFinal);

  var nuevoStock = Number($(this).attr("stock")) - $(this).val();
  $(this).attr("nuevoStock", nuevoStock);

  sumarTotalPreciosVenta()
  agregarImpuesto()
  listarProductos()
  if (Number($(this).val()) > Number($(this).attr("stock"))) {
      $(this).val(1);
            var precio =$(this).parents().parents().children(".ingresoPrecio").children(".nuevoPrecioProducto");
              var precioFinal = $(this).val() * precio.attr("precioReal");
              precio.val(precioFinal);
          Swal.fire({
            icon: 'error',
            title: 'La cantidad supera el stock!',
            text: 'Solo hay '+$(this).attr("stock")+' unidades!',
            confirmButtonText: "Cerrar"
            // footer: '<a href>Why do I have this issue?</a>'
          })
          /*SUMAR TOTAL PRECIOS MOVIL*/
          sumarTotalPreciosVenta()
          agregarImpuesto()
          listarProductos()
  }

})
// $('.nuevaCantidadProducto').
/*=====  End of MODIFICAR LA CANTIDAD  ======*/
  function sumarTotalPreciosVenta(){
      var precioItem = $(".nuevoPrecioProducto");
      var arraySumarPrecio = [];
      for (var i = 0; i < precioItem.length; i++ ) {
          arraySumarPrecio.push(Number($(precioItem[i]).val()));

      }
        console.log("array ",arraySumarPrecio );
        function sumaArrayPrecios(total, numero){
            return   total + numero;
        }
        var sumaTotalPrecio = arraySumarPrecio.reduce(sumaArrayPrecios);
        $("#nuevoTotalVenta").val(sumaTotalPrecio);
        $("#totalVenta").val(sumaTotalPrecio);
        $("#nuevoTotalVenta").attr("total",sumaTotalPrecio);
        // console.log("sumaTotalPrecio", sumaTotalPrecio);
  }
  /*===================================
  =            AGREGAR IVA            =
  ===================================*/
    function agregarImpuesto(){
     var impuesto =  $("#nuevoImpuestoVenta").val();
     var precioTotal = $("#nuevoTotalVenta").attr("total");
     var precioImpuesto = Number(precioTotal * impuesto /100);
     var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);
      $("#nuevoTotalVenta").val(totalConImpuesto);
      $("#totalVenta").val(totalConImpuesto);
      $("#nuevoPrecioImpuesto").val(precioImpuesto);
      $("#nuevoPrecioNeto").val(precioTotal);
    }
  /*=====  End of AGREGAR IVA  ======*/
$("#nuevoImpuestoVenta").change(function(){
    agregarImpuesto();
})
// FORMATO NUMERO
$("#nuevoTotalVenta").number(true, 2);



// SELECCIONAR METODO DE PAGO
$("#nuevoMetodoPago").change(function(){
console.log("test pago");
  var metodo = $(this).val();

  if(metodo == "Efectivo"){
    $(this).parent().parent().removeClass("col");
    $(this).parent().parent().addClass("col-sm-6");

      $(this).parent().parent().parent().children(".cajasMetodoPago").html(
      '<div class="col">'+
        // '<div class="input-group">'+
          // '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
         '<input type="text" class="form-control" id="nuevoValorEfectivo" placeholder="000000" required style="margin-top: 5px;">'+

        // '</div>'+
       '</div>'+
       '<div class="col" id="capturarCambioEfectivo">'+
        // '<div class="input-group">'+
          // '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
         '<input type="text" class="form-control nuevoCambioEfectivo" id="nuevoCambioEfectivo" placeholder="0" readonly required>'+
        // '</div>'+
       '</div>'
     )

    // Agregar formato al precio

    $('#nuevoValorEfectivo').number( true, 0);
    $('#nuevoCambioEfectivo').number( true, 0);
    /*lista metodo pago en la entrada*/
    listarMetodos()

 // Listar método en la entrada
    // listarMetodos()

  }else{

    // $(this).parent().parent().removeClass('col-sm-4');
    // $(this).parent().parent().addClass('col-sm-6');
    $(this).parent().parent().parent().children('.cajasMetodoPago').html(
      '<div class="col">'+
                '<div class="input-group">'+
                  '<input type="number" min="0" class="form-control" id="nuevoCodigoTransaccion" placeholder="Código transacción"  required>'+
                  // '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
                '</div>'+

              '</div>')

  }



})

/*CAMBIO EFECTIVO*/
$('.formularioVenta').on('change', 'input#nuevoValorEfectivo', function(){
    var efectivo = $("#nuevoValorEfectivo").val();

    var cambio = Number(efectivo) - Number($('#nuevoTotalVenta').val());

    var nuevoCambioEfectivo =  $(this).parent().parent().children('#capturarCambioEfectivo').children('#nuevoCambioEfectivo');

    // var nuevoCambioEfectivo =  $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');
     console.log("nuevoCambioEfectivo", nuevoCambioEfectivo);

  nuevoCambioEfectivo.val(cambio);

})
/*CAMBIO TRANSACION*/
$('.formularioVenta').on('change', 'input#nuevoCodigoTransaccion', function(){
listarMetodos()
})

/*LISTAR O AGRUPAR PRODUCTOS*/
function listarProductos(){
  var listaProductos = [];
  var descripcion = $(".nuevaDescripcionProducto");
  var cantidad = $(".nuevaCantidadProducto");
  var precio = $(".nuevoPrecioProducto");
  for(var i = 0; i < descripcion.length; i++){
    listaProductos.push({ "id" : $(descripcion[i]).attr("idProducto"),
                "descripcion" : $(descripcion[i]).val(),
                "cantidad" : $(cantidad[i]).val(),
                "stock" : $(cantidad[i]).attr("nuevoStock"),
                "precio" : $(precio[i]).attr("precioReal"),
                "total" : $(precio[i]).val()})
  }
  $("#listaProductos").val(JSON.stringify(listaProductos));
  console.log("listar", JSON.stringify(listaProductos));
}



function listarMetodos(){
  var listaMetodos = "";
  if($("#nuevoMetodoPago").val() == "Efectivo"){
    $("#listaMetodoPago").val("Efectivo");
  }else{
    $("#listaMetodoPago").val($("#nuevoMetodoPago").val()+"-"+$("#nuevoCodigoTransaccion").val());
  }
  listarProductos()
}

$("#seleccionarCliente").change(function(){
console.log($("#seleccionarCliente").val());
if ($("#seleccionarCliente").val() != 'Seleccionar cliente') {
document.getElementById('btnGrabarVenta').style.visibility='visible';
}else{
  document.getElementById('btnGrabarVenta').style.visibility='hidden';
}
})

$( document ).ready(function() {
  console.log("test");
  if (document.getElementById('btnGrabarVenta') !=null) {
  document.getElementById('btnGrabarVenta').style.visibility='hidden';
  }


});