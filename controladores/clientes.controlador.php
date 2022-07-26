<?php
class ControladorClientes{
	/*======================================
	=            ELIMINAR CLIENTES            =
	======================================*/
static public function ctrEliminarCliente(){
	if(isset($_POST["codigoCliente"])){
		$tabla = "clientes";
				$item = "id";
				$valor = $_POST["codigoCliente"];
				$respuesta = ModeloClientes::mdlEliminarCliente($tabla, $item, $valor);
					if ($respuesta = "ok") {
						echo "<script>
						Swal.fire({
					  	icon: 'success',
					  	title: 'Ok',
					  	text: 'Operación Exitosa'
						}).then((result) => {
						  if (result.value) {
						    window.location = 'clientes';
						  }
						})
						</script>";
				}else{
						echo "<script>
						Swal.fire({
					  icon: 'error',
					  title: 'Oops...',
					  text: 'Ha ocurrido un error al eliminar!'
					}).then((result) => {
						  if (result.value) {
						    window.location = 'clientes';
						  }
						})</script>";
				}
	}
}
	/*======================================
	=            CREAR CLIENTES            =
	======================================*/
	static public function ctrCrearCliente(){
	if(isset($_POST["nuevoCliente"])){

		// if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCliente"]) &&
		// 	   preg_match('/^[0-9][-]+$/', $_POST["nuevoDocumentoId"]) &&
		// 	   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoEmail"]) &&
		// 	   preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"]) &&
		// 	   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaDireccion"])){

			  // echo "CLI ".$_POST["nuevoDocumentoId"];

				$tabla = "clientes";
				$fechaNacimiento= fechabd($_POST["nuevaFechaNacimiento"]);
			   	$datos = array("nombre"=>$_POST["nuevoCliente"],
					           "documento"=>$_POST["nuevoDocumentoId"],
					           "email"=>$_POST["nuevoEmail"],
					           "telefono"=>$_POST["nuevoTelefono"],
					           "direccion"=>$_POST["nuevaDireccion"],
					           "fecha_nacimiento"=>$fechaNacimiento);

			   	$respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);
			   	//var_dump($respuesta);
			   	if($respuesta == "ok"){

					echo'<script>

					swal.fire({
						  type: "success",
						  title: "El cliente ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
									if (result.value) {

									window.location = "clientes";

									}
								})

					</script>';

				}


			// }else{
			// 		echo "<script>
			// 				Swal.fire({
			// 				icon: 'error',
			// 				title: 'Oops...',
			// 				text: 'El formulario contiene campos vacios y caracteres especiales!'
			// 				}).then((result) => {
			// 					if (result.value) {
			// 					 window.location = 'clientes';
			// 					}
			// 				})
			// 			</script>";

			// }
	}

	}
	/*=====  End of CREAR CLIENTES  ======*/
	/*========================================
	=            MOSTRAR CLIENTES            =
	========================================*/
	static public function crtMostrarClientes($item, $valor){
		$tabla = "clientes";
		$respuesta = ModeloClientes::mldMostrarClientes($tabla, $item, $valor);
		return $respuesta;

	}
/*=====  End of MOSTRAR CLIENTES  ======*/

static public function ctrEditarCliente(){
	if(isset($_POST["codigoClienteEditar"])){

				$tabla = "clientes";
				$fechaNacimiento= fechabd($_POST["editarFechaNacimiento"]);
			   	$datos = array("nombre"=>$_POST["editarCliente"],
					           "documento"=>$_POST["editarDocumentoId"],
					           "email"=>$_POST["editarEmail"],
					           "telefono"=>$_POST["editarTelefono"],
					           "direccion"=>$_POST["editarDireccion"],
					           "fecha_nacimiento"=>$fechaNacimiento,
					       		"id"=>$_POST["codigoClienteEditar"]);

			   	$respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);
			   	//var_dump($respuesta);
			   	if($respuesta == "ok"){

					echo'<script>

					swal.fire({
						  type: "success",
						  title: "El cliente ha sido modicado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
									if (result.value) {

									window.location = "clientes";

									}
								})

					</script>';

				}else{
									echo "<script>
							Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: 'Ha ocurrido un error al editar los datos, vuelva a intentar'
							}).then((result) => {
								if (result.value) {
								 window.location = 'clientes';
								}
							})
						</script>";
				}


			// }else{
			// 		echo "<script>
			// 				Swal.fire({
			// 				icon: 'error',
			// 				title: 'Oops...',
			// 				text: 'El formulario contiene campos vacios y caracteres especiales!'
			// 				}).then((result) => {
			// 					if (result.value) {
			// 					 window.location = 'clientes';
			// 					}
			// 				})
			// 			</script>";

			// }
	}

	}
}
function fechabd($fecha){
                 $db = "";
                  $var = $fecha;
                  $dia = substr($var,0,2);
                  $mes = substr($var,3,2);
                  $anio = substr($var,6,4);
                  return $db = $anio."-".$mes."-".$dia;
}