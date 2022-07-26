var tablePro = $('.tablaProductos').DataTable({
	"ajax":"ajax/datatable-productos.ajax.php",
	"columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='btn-group-xs'><button class='btn btn-warning btnEditarProducto' data-toggle='modal' data-target='#modalEditarProducto' idProducto><i class='far fa-edit'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto codigo imagen><i class='far fa-trash-alt'></i></button></div>"
		        } ,
		        {
            "targets": -10,
            "data": null,
            "defaultContent": '<img class="img-thumbnail imgTabla" width="40px">'
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
 // $('.tablaProductos tbody').on( 'click', 'button.btnEditarProducto', function () {
 $('.tablaProductos tbody').on( 'click', 'button.btnEditarProducto, button.btnEliminarProducto', function () {

         if (window.matchMedia("(min-width:992px)").matches) {
            var data = tablePro.row( $(this).parents('tr') ).data();
         }else{
            var data = tablePro.row( $(this).parents('tbody tr ul li') ).data();
         }
         console.log("datos x", data);
        $(this).attr("idProducto",data[10]);
        $(this).attr("codigo",data[2]);
        $(this).attr("imagen",data[1]);
    } );
/*COMPORTAMIENTO DE TABLA*/
/*funcion para imagen*/
function cargarImagenes(){
    var imgTabla = $(".imgTabla");
    // console.log("img", imgTabla);
    for (var i = 0; i <imgTabla.length; i++) {

     var data = tablePro.row($(imgTabla[i]).parents("tr")).data();
      // console.log("data", data);
     $(imgTabla[i]).attr("src",data[1]);
    //     //console.log("data", data);
        }
}
setTimeout(function(){
	cargarImagenes();
},2000)

$(".dataTables_paginate").click(function(){
    cargarImagenes();
})
$(".dataTables_paginate").click(function(){
    cargarImagenes();
})
$("input[aria-controls='DataTables_Table_0']").focus(function(){
    $(document).keyup(function(event){
        event.preventDefault();
        cargarImagenes();
    })
})


$("select[name='DataTables_Table_0_length']").change(function(){
cargarImagenes();
})

$(".sorting").click(function(){
    cargarImagenes();
})

/*FIN DE COMPORTAMIENTO DE TABLA*/
$("#nuevaCategoria").change(function(){
    var idCategoria = $(this).val();
    var datos = new FormData();
    datos.append("idCategoria",idCategoria);
    $.ajax({
        url : "ajax/productos.ajax.php",
        method : "POST",
        data : datos,
        cache :false,
        contentType :false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            console.log("respuesta dad ",respuesta);
            if (!respuesta) {
                var nuevoCodigo = idCategoria+"01";
                $("#nuevoCodigo").val(nuevoCodigo);
                 console.log("nuevoCodigo", nuevoCodigo);
            }else{
             var nuevoCodigo = Number(respuesta["codigo"])+1;
             $("#nuevoCodigo").val(nuevoCodigo);
             console.log("nuevoCodigo", nuevoCodigo);
            }

        }
    })
})
/**
AGREGAR NUEVO PRECIO COMPRA
 */
$('#nuevoPrecioCompra, #editarPrecioCompra').change(function(){
    if ($('.porcentaje').prop("checked")) {
        var valorPorcentaje = $('.nuevoPorcentaje').val();
        var porcentaje = Number(($('#nuevoPrecioCompra').val() * valorPorcentaje /100)) + Number($('#nuevoPrecioCompra').val());

        var editarPorcentaje = Number(($('#editarPrecioCompra').val() * valorPorcentaje /100)) + Number($('#editarPrecioCompra').val());
        //console.log("porcentaje",porcentaje);
        $('#nuevoPrecioVenta').val(porcentaje);
        $('#nuevoPrecioVenta').prop("readonly",true);

        $('#editarPrecioVenta').val(editarPorcentaje);
        $('#editarPrecioVenta').prop("readonly",true);
    }


})
/*============================================
=            CAMBIO DE PORCENTAJE            =
============================================*/
$('.nuevoPorcentaje').change(function(){
    if ($('.porcentaje').prop("checked")) {
        var valorPorcentaje = $(this).val();
        var porcentaje = Number(($('#nuevoPrecioCompra').val() * valorPorcentaje /100)) + Number($('#nuevoPrecioCompra').val());

         var editarPorcentaje = Number(($('#editarPrecioCompra').val() * valorPorcentaje /100)) + Number($('#editarPrecioCompra').val());
       // console.log("porcentaje",porcentaje);
        $('#nuevoPrecioVenta').val(porcentaje);
        $('#nuevoPrecioVenta').prop("readonly",true);

        $('#editarPrecioVenta').val(editarPorcentaje);
        $('#editarPrecioVenta').prop("readonly",true);
    }
    // else{
    //     $('#nuevoPrecioVenta').prop("readonly",false);
    // }

})
$(".porcentaje").on("ifUnchecked", function(){
   // console.log("asadf");
    $('#nuevoPrecioVenta').prop("readonly",false);
    $('#editarPrecioVenta').prop("readonly",false);
})

 $(".porcentaje").on("ifChecked", function(){
    $('#nuevoPrecioVenta').prop("readonly",true);
     $('#editarPrecioVenta').prop("readonly",true);
})
/*=====  End of CAMBIO DE PORCENTAJE  ======*/
/*=======================================
=            FOTO DE PRODUCTOS            =
=======================================*/
$(".nuevaImagen").change(function(){
    var imagen = this.files[0];
    //console.log("imagen ", imagen);
    if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
        $(".nuevaImagen").val("");
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "!La imagen debe estar en formato JPG o PNG¡",
          confirmButtonText : "Cerrar"

        })
    }else if(imagen["size"] > 2000000){
        $(".nuevaImagen").val("");
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "!La imagen debe pesar como maximo 2MB¡",
          confirmButtonText : "Cerrar"

        })
    }else{
        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);
        $(datosImagen).on("load", function(event){
            var rutaImagen = event.target.result;
            $(".previsualizar").attr("src",rutaImagen);
        })
    }
})
/*========================================
=            EDITAR PRIDUCTOS            =
========================================*/
$(".tablaProductos tbody").on("click", "button.btnEditarProducto", function(){
    var idProducto = $(this).attr("idProducto");
    var datos = new FormData();
    datos.append("idProducto",idProducto);
    $.ajax({
        url : "ajax/productos.ajax.php",
        method : "POST",
        data : datos,
        cache :false,
        contentType :false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            var datosCategoria = new FormData();
            datosCategoria.append("idCategoria",respuesta["id_categoria"]);

                $.ajax({
                        url : "ajax/categorias.ajax.php",
                        method : "POST",
                        data : datosCategoria,
                        cache :false,
                        contentType :false,
                        processData: false,
                        dataType: "json",
                        success:function(respuesta){
                            $("#editarCategoria").val(respuesta["id"]);
                            $("#editarCategoria").html(respuesta["categoria"]);

                        }
                    })
                    $("#editarCodigo").val(respuesta["codigo"]);
                    $("#editarDescripcion").val(respuesta["descripcion"]);
                    $("#editarCodigoBarra").val(respuesta["barcode"]);

                    $("#editarStock").val(respuesta["stock"]);
                    $("#editarPrecioCompra").val(respuesta["precio_compra"]);
                    $("#editarPrecioVenta").val(respuesta["precio_venta"]);
                    if (respuesta["imagen"] != "") {
                        $("#imagenActual").val(respuesta["imagen"]);
                        $(".previsualizar").attr("src", respuesta["imagen"]);
                    }


        }
    })

    // console.log("idProducto", idProducto);
})
/*=====  End of EDITAR PRIDUCTOS  ======*/
/*==========================================
=            ELIMINAR PRODUCTOS            =
==========================================*/
$(".tablaProductos tbody").on("click", "button.btnEliminarProducto", function(){
    var idProducto = $(this).attr("idProducto");
    var codigo = $(this).attr("codigo");
    var imagen = $(this).attr("imagen");
    Swal.fire({
                  title: 'Estas seguro de eliminar el producto?',
                  text: "No podras recuperar una vez eliminado!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si, Deseo Borrar!'
                }).then((result) => {
                  if (result.value) {
                    // window.location = "index.php?ruta=usuarios &idUsuario="+idUsuario+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario;
                     window.location = "index.php?ruta=productos&idProducto="+idProducto+"&imagen="+imagen+"&codigo="+codigo;
                    Swal.fire(
                      'Eliminado!',
                      'El registro a sido eliminado',
                      'success'
                    )
                  }
                })

})
/*=====  End of ELIMINAR PRODUCTOS  ======*/

$('.btnResumen').click(function(){
 window.open("extensiones/tcpdf/pdf/productos.php",  "_blank");
})
$('.btnDetalle').click(function(){
 window.open("extensiones/tcpdf/pdf/productos-detalle.php",  "_blank");
})