<?php
// $dir = "index.php?ruta=";
class ControladorUsuarios{
	//Editar usuarios
	static public function ctrEditarUsuario(){

		if (isset($_POST["editarUsuario"])) {
				if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])) {
					/*Validar imagen*/
					$ruta  = $_POST["fotoActual"];
					if (isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])) {
							list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);
							$nuevoAncho = 500;
							$nuevoAlto = 500;
							/*CREAR DIRECTORIO DONDE SE VA A GUARDAR LA IMAGEN*/
							$directorio = "vistas/img/usuarios/".$_POST["editarUsuario"];
							echo "directorio ".$directorio;
							/*preguntamos si existe la foto*/
							if (!empty($_POST["fotoActual"])) {

									unlink($_POST["fotoActual"]);

							}else{
									mkdir($directorio, 0777);
							}


							if ($_FILES["editarFoto"]["type"] == "image/jpeg") {
								/*se guarda imagen*/
								$aleatorio  = mt_rand(100,999);
								$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".jpg";
								$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);
								$destino =imagecreatetruecolor($nuevoAncho, $nuevoAlto);
								imagecopyresized($destino,$origen,0,0,0,0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
								imagejpeg($destino, $ruta);
							}
							if ($_FILES["editarFoto"]["type"] == "image/png") {
								/*se guarda imagen*/
								$aleatorio  = mt_rand(100,999);
								$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".png";
								$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);
								$destino =imagecreatetruecolor($nuevoAncho, $nuevoAlto);
								imagecopyresized($destino,$origen,0,0,0,0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
								imagepng($destino, $ruta);
							}
				}
					$tabla = "usuarios";
					if ($_POST["editarPassword"] != "") {
						if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])) {
								$encriptar = crypt($_POST["editarPassword"], '$2a$07$usesomesillystringforsalt$');
						}else{
								echo '<script>
											Swal.fire({

													 icon: "error",
													  title: "Verificar!...",
													  text: "No se permiten caracteres especiales!",
													  confirmButtonText : "Cerrar",
											}).then((result)=>{
												if(result.value){
													 window.location = "usuario";
												}
												});
									</script>';

						}
					}else{
						$encriptar = $_POST["passwordActual"];
					// $encriptar = $passwordActual;


					}
					$datos =   array("nombre" => $_POST["editarNombre"],
								"usuario" => $_POST["editarUsuario"],
								"password" =>  $encriptar,
								"perfil" => $_POST["editarPerfil"] ,
								"foto" => $ruta);
					$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);
					if ($respuesta == "ok") {
						echo '<script>
											Swal.fire({

													 icon: "success",
													  title: "Ok",
													  text: "Usuario modificado exitosamente",
													  confirmButtonText : "Cerrar",
											}).then((result)=>{
												if(result.value){
													 window.location = "usuario";
												}
												});
									</script>';
				// 			echo '<script>
				// 		Swal.fire({
				// 			position: "top-end",
				// 				  icon: "success",
				// 				  title: "Modificado exitosamente",
				// 				  showConfirmButton: false,
				// 				  timer: 2000

				// 		}).then((result)=>{
				// 			if(result.value){
				// 				window.location = "usuario";
				// 			}
				// 			});
				// </script>';


			}
				}else{
				echo '<script>
						Swal.fire({
							position: "top-end",
								  icon: "error",
								  title: "El usuario no puede llevar caracteres especiales",
								  showConfirmButton: false,
								  timer: 3000

						}).then((result)=>{
							if(result.value){
								window.location = "usuario";
							}
							});
						</script>';
				}
		}
	}

	/*========================================
	=            MOSTRAR USUARIOS            =
	========================================*/
		static public function ctrMostrarUsuarios($item, $valor){
			$tabla = "usuarios";

			$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);
			return $respuesta;
		}


	/*=====  End of MOSTRAR USUARIOS  ======*/





	/**
	 *
	 * Ingresar al sistema
	 *
	 */

	static public function ctrIngresoUsuario(){
		if(isset($_POST['ingUsuario'])){
			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"])
				&&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){
				$encriptar = crypt($_POST["ingPassword"], '$2a$07$usesomesillystringforsalt$');
				$tabla = "usuarios";
				$item = "usuario";
				$valor = $_POST["ingUsuario"];
				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);
				// var_dump($respuesta["usuario"]);
				// var_dump($respuesta);

				if ($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar) {
					/*VALIDAR INGRESO POR ESTADO*/
					if ($respuesta["estado"]==1) {
							echo '<br>';
							echo '<div class="alert alert-success">Bienvenido al sistema :)</div>';
							$_SESSION["iniciarSesion"] = "ok";
							$_SESSION["id"] = $respuesta["id"];
							$_SESSION["nombre"] = $respuesta["nombre"];
							$_SESSION["usuario"] = $respuesta["usuario"];
							$_SESSION["foto"] = $respuesta["foto"];
							$_SESSION["perfil"] = $respuesta["perfil"];
							$_SESSION["ultimo_login"] = $respuesta["ultimo_login"];

							date_default_timezone_set('America/Asuncion');
							$fechaActual = date('Y-m-d');
							$horaActual = date('H:i:s');
							$fechaActual = $fechaActual.' '.$horaActual;

							$item1 = "ultimo_login";
							$valor1 = $fechaActual;

							$item2 = "id";
							$valor2 = $respuesta["id"];

							$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
							if ($ultimoLogin == "ok") {

								 echo '<script> window.location = "inicio";</script>';
							}

					}else{
						echo '<br>';
						echo '<div class="alert alert-danger">El usuario aun no esta activado!</div>';
					}
					/*FIN VALIDAR*/


				}else{
					echo '<br>';
					echo '<div class="alert alert-danger">El usuario ingresado no existe!</div>';
				}
			}
		}
	}
	/**
	 *
	 * AGREGAR USUARIO
	 *
	 */
	static public function ctrCrearUsuario(){

		if (isset($_POST["nuevoNombre"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])) {
				$ruta = "";
				/*======================================
				=            VALIDAR IMAGEN            =
				======================================*/
				if (isset($_FILES["nuevaFoto"]["tmp_name"])) {
					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;
					/*CREAR DIRECTORIO DONDE SE VA A GUARDAR LA IMAGEN*/

					$directorio = "vistas/img/usuarios/".$_POST["nuevoUsuario"];
					/*MODIFICACIONES PARA IMAGEN*/
					$root = $_SERVER["DOCUMENT_ROOT"];
					echo "ROOT DOC ".$root;
					// $dir = $root .$directorio;
					// if( !file_exists($dir) ) {
					    // mkdir($dir, 0755, true);
					// }
					/*MODIFICACIONES PARA IMAGEN FIN*/
					mkdir($directorio, 0755);

					if ($_FILES["nuevaFoto"]["type"] == "image/jpeg") {
						/*se guarda imagen*/
						$aleatorio  = mt_rand(100,999);
						$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";
						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);
						$destino =imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino,$origen,0,0,0,0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);
					}
					if ($_FILES["nuevaFoto"]["type"] == "image/png") {
						/*se guarda imagen*/
						$aleatorio  = mt_rand(100,999);
						$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";
						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);
						$destino =imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino,$origen,0,0,0,0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagepng($destino, $ruta);
					}
				}


				/*=====  End of VALIDAR IMAGEN  ======*/

				$tabla = "usuarios";
				$estado = 0;
				$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$usesomesillystringforsalt$');
				$datos =   array("nombre" => $_POST["nuevoNombre"],
								"usuario" => $_POST["nuevoUsuario"],
								"password" =>  $encriptar,
								"perfil" => $_POST["nuevoPerfil"] ,
								"foto" => $ruta,
								"estado" => $estado);
				$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);
				var_dump("Respuesta ".$respuesta);
				if ($respuesta == "ok") {
						echo '<script>
						Swal.fire({
							icon: "success",
						  title: "Ok",
						  text: "Registro exitoso!",
						  confirmButtonText : "Cerrar",
						}).then((result)=>{
							if(result.value){
								 window.location = "usuario";
							}
							});
				</script>';
				// 			echo '<script>
				// 		Swal.fire({
				// 			position: "top-end",
				// 				  icon: "success",
				// 				  title: "Registro guardado exitosamente",
				// 				  showConfirmButton: false,
				// 				  timer: 2000
				// 				  window.location = "usuario";

				// 		}).then((result)=>{
				// 			if(result.value){
				// 				window.location = "usuario";
				// 			}
				// 			});
				// </script>';


			}else{
				echo '<script>
						Swal.fire({
							icon: "error",
						  title: "Oops!...",
						  text: "Error al cargar datos!",
						  confirmButtonText : "Cerrar",
						}).then((result)=>{
							if(result.value){
								 window.location = "usuario";
							}
							});
				</script>';
			}
		}else{
				echo '<script>
						Swal.fire({

								 icon: "error",
								  title: "Verificar!...",
								  text: "No se permiten caracteres especiales!",
								  confirmButtonText : "Cerrar",
						}).then((result)=>{
							if(result.value){
								 window.location = "usuario";
							}
							});
				</script>';
		}
	}
}
/*BORRAR USUARIO*/
	static public function ctrBorrarUsuario(){
		if (isset($_GET["idUsuario"])) {
			 $tabla = "usuarios";
			 $datos = $_GET["idUsuario"];
			 if ($_GET["fotoUsuario"] != "") {
			 	unlink($_GET["fotoUsuario"]);
			 	rmdir('vistas/img/usuarios/'.$_GET["nombreUsuario"]);
			 }
			 $respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);
			 if ($respuesta = "ok") {
			 	echo '<script>
						Swal.fire({
								type: "success",
								title: "El usuario se ha eliminado correctamente!",
								showConfirmButton:true,
								confirmButtonText : "Cerrar",
								closeOnConfirm:false
						}).then((result)=>{
							if(result.value){
								 window.location = "usuario";
							}
							});
				</script>';
			 }else{
			 	return "error";
			 }
		}
	}
}