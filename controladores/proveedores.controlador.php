<?php
class ControladorProveedor{

	/*========================================
	=            MOSTRAR PROVEEDOR            =
	========================================*/
	static public function crtMostrarProveedores($item, $valor){
		$tabla = "proveedores";
		$respuesta = ModeloProveedor::mldMostrarProveedores($tabla, $item, $valor);
		return $respuesta;
	}
	static public function ctrEliminarProveedor(){
		if(isset($_POST["codigoProveedorEliminar"])){
				$tabla = "proveedores";
				$item = "id_proveedor";
				$valor = $_POST["codigoProveedorEliminar"];
				$respuesta = ModeloProveedor::mdlEliminarProveedor($tabla, $item, $valor);
			   	//var_dump($respuesta);
			   	if($respuesta == "ok"){
					echo'<script>
					swal.fire({
						  type: "success",
						  title: "El cliente ha sido eliminado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
									if (result.value) {

									window.location = "proveedores";

									}
								})
					</script>';

				}else{
					echo'<script>
					swal.fire({
						  type: "error",
						  title: "Ha ocurrido un error al eliminar, vuelva a intentar",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
									if (result.value) {

									window.location = "proveedores";

									}
								})
					</script>';
				}

		}
	}
	/*========================================
	=            CREAR PROVEEDOR            =
	========================================*/
	static public function ctrCrearProveedor(){
		if(isset($_POST["nuevoProveedor"])){
				$tabla = "proveedores";
				$estado = "ACTIVO";
				$compras = 0;
				$datos = array("ruc"=>$_POST["nuevoDocumentoId"],
								"razon_social"=>$_POST["nuevoProveedor"],
					           "telefono"=>$_POST["nuevoTelefono"],
					           "direccion"=>$_POST["nuevaDireccion"],
					           "correo"=>$_POST["nuevoEmail"],
					           "estado"=>$estado,
					       		"totalcompra"=>$compras);
			   	$respuesta = ModeloProveedor::mdlIngresarProveedor($tabla, $datos);
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

									window.location = "proveedores";

									}
								})

					</script>';

				}

		}
	}
/*=====  End of MOSTRAR CLIENTES  ======*/

static public function ctrEditarProveedor(){
	if(isset($_POST["codigoProveedorEditar"])){

				$tabla = "proveedores";

			   	$datos = array("ruc"=>$_POST["editarDocumentoId"],
			   				   "razon_social"=>$_POST["editarProveedor"],
					           "telefono"=>$_POST["editarTelefono"],
					           "direccion"=>$_POST["editarDireccion"],
					           "correo"=>$_POST["editarEmail"],
					       		"id_proveedor"=>$_POST["codigoProveedorEditar"]);

			   	$respuesta = ModeloProveedor::mdlEditarProveedor($tabla, $datos);
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

									window.location = "proveedores";

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
								 window.location = 'proveedores';
								}
							})
						</script>";
				}
	}
	}

}
// function fechabd($fecha){
//                  $db = "";
//                   $var = $fecha;
//                   $dia = substr($var,0,2);
//                   $mes = substr($var,3,2);
//                   $anio = substr($var,6,4);
//                   return $db = $anio."-".$mes."-".$dia;
//                }