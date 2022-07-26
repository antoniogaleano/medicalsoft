<?php
class ControladorCategorias{
	/*CREAR CATEGORIAS */
	static public function ctrCrearCategoria(){
		if (isset($_POST["nuevaCategoria"])) {
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaCategoria"])) {
				$tabla = "categorias";
				$datos = $_POST["nuevaCategoria"];
				$respuesta = ModeloCategorias::mdlIngresarCategoria($tabla, $datos);
				if ($respuesta = "ok") {
						echo "<script>
						Swal.fire({
					  	icon: 'success',
					  	title: 'Ok',
					  	text: 'Registro Exitoso'
						}).then((result) => {
						  if (result.value) {
						    window.location = 'categorias';
						  }
						})
						</script>";
				}else{
						echo "<script>
						Swal.fire({
					  icon: 'error',
					  title: 'Oops...',
					  text: 'Ha ocurrido un error al guardar!'
					}).then((result) => {
						  if (result.value) {
						    window.location = 'categorias';
						  }
						})</script>";
				}

			}else{
				echo "<script>
				Swal.fire({
					  icon: 'error',
					  title: 'Oops...',
					  text: 'No se admiten caracteres especiales!'
					}).then((result) => {
						  if (result.value) {
						    window.location = 'categorias';
						  }
						})</script>";
			}
		}

	}
	/*MOSTRAR CATEGORIAS*/
	static public  function ctrMostrarCategoria($item, $valor){
		$tabla = "categorias";
		$respuesta = ModeloCategorias::mdlMostrarCategoria($tabla, $item, $valor);
		return $respuesta;
	}
		/*EDITAR CATEGORIAS */
	static public function ctrEditarCategoria(){
		if (isset($_POST["editarCategoria"])) {
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCategoria"])) {
				$tabla = "categorias";
				$datos =  array("categoria" => $_POST["editarCategoria"] ,
								"id" => $_POST["idCategoria"] );
				$respuesta = ModeloCategorias::mdlEditarCategoria($tabla, $datos);
				if ($respuesta = "ok") {
						echo "<script>
						Swal.fire({
					  	icon: 'success',
					  	title: 'Ok',
					  	text: 'Modificacion Exitoso'
						}).then((result) => {
						  if (result.value) {
						    window.location = 'categorias';
						  }
						})
						</script>";
				}else{
						echo "<script>
						Swal.fire({
					  icon: 'error',
					  title: 'Oops...',
					  text: 'Ha ocurrido un error al guardar!'
					}).then((result) => {
						  if (result.value) {
						    window.location = 'categorias';
						  }
						})</script>";
				}

			}else{
				echo "<script>
				Swal.fire({
					  icon: 'error',
					  title: 'Oops...',
					  text: 'No se admiten caracteres especiales!'
					}).then((result) => {
						  if (result.value) {
						    window.location = 'categorias';
						  }
						})</script>";
			}
		}
}

	/*BORRAR CATEGORIA*/
	static public function ctrBorrarCategoria(){
	if (isset($_GET["idCategoria"])) {
		$tabla = "categorias";
		$datos = $_GET["idCategoria"];

		$respuesta = ModeloCategorias::mdlBorrarCategoria($tabla, $datos);

		if ($respuesta == "ok") {
		echo'<script>

					swal.fire({
						  type: "success",
						  title: "La categoría ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
									if (result.value) {

									window.location = "categorias";

									}
								})

					</script>';
		}
	}
}
}