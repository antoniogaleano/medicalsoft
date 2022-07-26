/*EDITAR CATEGORIA*/
$(".btnEditarCategoria").click(function(){
	var idCategoria = $(this).attr("idCategoria");
	var datos = new FormData();
	datos.append("idCategoria",idCategoria);
	$.ajax({
		url: "ajax/categorias.ajax.php",
		method: "POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(respuesta){
			$("#editarCategoria").val(respuesta["categoria"]);
			$("#idCategoria").val(respuesta["id"]);
			// console.log("respuesta", respuesta);
		}
	})
})

/*ELIMINAR CATEGORIA*/
$(".btnEliminarCategoria").click(function(){
	var idCategoria = $(this).attr("idCategoria");
				Swal.fire({
			  title: 'Estas seguro de eliminar el registro?',
			  text: "No podras recuperar una vez eliminado!",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Si, Eliminar!'
			}).then((result) => {
			  if (result.value) {
			  	window.location = "index.php?ruta=categorias&idCategoria="+idCategoria;

			  }
			})
})
$(".btnImprimirCategoria").click(function(){
	var idCategoria = $(this).attr("idCategoria");
	 window.open("extensiones/tcpdf/pdf/productos-detalle.php?id="+idCategoria,  "_blank");
	// window.location = "index.php?ruta=categorias&idCategoria="+idCategoria;
})