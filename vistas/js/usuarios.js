/*=======================================
=            FOTO DE USUARIO            =
=======================================*/
$(".nuevaFoto").change(function(){
	var imagen = this.files[0];
	 console.log("imagen ", imagen);
	if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
		$(".nuevaFoto").val("");
		Swal.fire({
		  icon: "error",
		  title: "Oops...",
		  text: "!La imagen debe estar en formato JPG o PNG¡",
		  confirmButtonText : "Cerrar"

		})
	}else if(imagen["size"] > 2000000){
		$(".nuevaFoto").val("");
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
});


/*=====  End of FOTO DE USUARIO  ======*/
$("#btnEditarUsuario").click(function(){

	// var idUsuario = $(this).attr("idUsuario");
	// var datos = new FormData();
	// datos.append("idUsuario", idUsuario);
	// $.ajax({
	// 	url:"ajax/usuarios.ajax.php",
	// 	method:"POST",
	// 	data:datos,
	// 	cache:false,
	// 	contentType:false,
	// 	processData:false,
	// 	dataType:"json",
	// 	success: function(respuesta){
	// 		// console.log("respuesta", respuesta);
	// 		$("#editarNombre").val(respuesta["nombre"]);
	// 		$("#editarUsuario").val(respuesta["usuario"]);
	// 		$("#editarPerfil").html(respuesta["perfil"]);
	// 		$("#editarPerfil").val(respuesta["perfil"]);
	// 		$("#passwordActual").val(respuesta["password"]);

	// 		$("#fotoActual").val(respuesta["foto"]);

	// 		if (respuesta["foto"] != "") {
	// 			$(".previsualizar").attr("src", respuesta["foto"]);

	// 		}else{
	// 			$(".previsualizar").attr("src", "vistas/img/usuarios/default/anonymous.png");
	// 		}
	// 	}
	// });
});

$('.tbuser tbody').on( 'click', 'button.btnEditarUsuario', function () {
var idUsuario = $(this).attr("idUsuario");
	var datos = new FormData();
	datos.append("idUsuario", idUsuario);
	$.ajax({
		url:"ajax/usuarios.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success: function(respuesta){
			console.log("respuesta usuarios", respuesta);
			$("#editarNombre").val(respuesta["nombre"]);
			$("#editarUsuario").val(respuesta["usuario"]);
			$("#editarPerfil").html(respuesta["perfil"]);
			$("#editarPerfil").val(respuesta["perfil"]);
			$("#passwordActual").val(respuesta["password"]);

			$("#fotoActual").val(respuesta["foto"]);

			if (respuesta["foto"] != "") {
				$(".previsualizar").attr("src", respuesta["foto"]);

			}else{
				$(".previsualizar").attr("src", "vistas/img/usuarios/default/anonymous.png");
			}
		}
	});
})
/*=======================================
=            ACTIVAR USUARIO            =
=======================================*/
$(".btnActivar").click(function(){
				var idUsuario = $(this).attr("idUsuario");
				var estadoUsuario = $(this).attr("estadoUsuario");
				var datos = new FormData();
				datos.append("activarId", idUsuario);
				datos.append("activarUsuario", estadoUsuario);

				$.ajax({
					url:"ajax/usuarios.ajax.php",
					method:"POST",
					data:datos,
					cache:false,
					contentType:false,
					processData:false,
					dataType:"json",
					success: function(respuesta){
						console.log("ok");
					}
				})
				/**cierre ajax*/
				if (estadoUsuario == 0) {
					$(this).removeClass('btn-success');
					$(this).addClass('btn-danger');
					$(this).html('Desactivado');
					$(this).attr('estadoUsuario',1);
				}else{
					$(this).addClass('btn-success');
					$(this).removeClass('btn-danger');
					$(this).html('Activado');
					$(this).attr('estadoUsuario',0);
				}

});
/*=====  End of ACTIVAR USUARIO  ======*/
/*EVITAR DUPLICAR NICK*/
$("#nuevoUsuario").change(function(){
	$(".alert").remove();
	var usuario = $(this).val();
	var datos = new FormData();
	datos.append("validarUsuario", usuario);
	$.ajax({
		url:"ajax/usuarios.ajax.php",
					method:"POST",
					data:datos,
					cache:false,
					contentType:false,
					processData:false,
					dataType:"json",
					success: function(respuesta){
					 if (respuesta) {
					 	$("#nuevoUsuario").parent().after('<div class="alert alert-warning">Este usuario ya existe</div>');
					 	$("#nuevoUsuario").val("");
					 }
					}
	})
})

/*ELIMINAR USUARIO*/
$(".btnEliminarUsuario").click(function(){
	 var idUsuario = $(this).attr("idUsuario");
	 var fotoUsuario = $(this).attr("fotoUsuario");
	 var nombreUsuario = $(this).attr("nombreUsuario");
	 //console.log("USuario "+fotoUsuario);
				Swal.fire({
				  title: 'Estas seguro de eliminar el registro?',
				  text: "No podras recuperar una vez eliminado!",
				  icon: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Si, Deseo Borrar!'
				}).then((result) => {
				  if (result.value) {
				  	// window.location = "index.php?ruta=usuarios &idUsuario="+idUsuario+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario;
				     window.location = "index.php?ruta=usuario&idUsuario="+idUsuario+"&nombreUsuario="+nombreUsuario+"&fotoUsuario="+fotoUsuario;
				    Swal.fire(
				      'Eliminado!',
				      'El registro a sido eliminado',
				      'success'
				    )
				  }
				})

})