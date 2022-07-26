<?php
class ControladorEmpresas{
	public static function ctrMostrarEmpresa($item, $valor){
		$tabla = "empresas";
		$respuesta = ModeloEmpresas::mdlMostrarEmpresas($tabla, $item, $valor);
		return $respuesta;
	}
	public static function ctrAbmEmpresa(){

		if (isset($_POST["ope"]) == "AGREGAR") {
			if (isset($_POST["nuevaRazon"])) {

				$ruta = "";
				/*======================================
				=            VALIDAR IMAGEN            =
				======================================*/
				var_dump(isset($_FILES["nuevaFoto"]["tmp_name"]) );
				if (isset($_FILES["nuevaFoto"]["tmp_name"]) && isset($_FILES["nuevaFoto"]["tmp_name"]) != "") {
					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 183;
					/*CREAR DIRECTORIO DONDE SE VA A GUARDAR LA IMAGEN*/
					$directorio = "vistas/img/plantilla/".$_POST["nuevaRazon"];
					mkdir($directorio, 0755);

					if ($_FILES["nuevaFoto"]["type"] == "image/jpeg") {
						/*se guarda imagen*/
						$aleatorio  = mt_rand(100,999);
						$ruta = "vistas/img/plantilla/".$_POST["nuevaRazon"]."/".$aleatorio.".jpg";
						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);
						$destino =imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino,$origen,0,0,0,0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);
					}
					if ($_FILES["nuevaFoto"]["type"] == "image/png") {
						/*se guarda imagen*/
						$aleatorio  = mt_rand(100,999);
						$ruta = "vistas/img/plantilla/".$_POST["nuevaRazon"]."/".$aleatorio.".png";
						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);
						$destino =imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino,$origen,0,0,0,0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagepng($destino, $ruta);
					}
				}
				////**FIN DE VALIDAR IMAGEN**/////
				$tabla = "empresas";
				$datos =   array("denominacion" => $_POST["nuevaRazon"],
								"ruc" => $_POST["nuevoRuc"],
								"telefono" =>  $_POST["nuevoTelefono"],
								"direccion" => $_POST["nuevaDirección"] ,
								"correo" => $_POST["nuevoCorreo"] ,
								"logo" => $ruta);
			$respuesta = ModeloEmpresas::mdlIngresarEmpresa($tabla, $datos);
				if ($respuesta == "ok") {
						echo '<script>
						Swal.fire({
							icon: "success",
						  title: "Ok",
						  text: "Registro exitoso!",
						  confirmButtonText : "Cerrar",
						}).then((result)=>{
							if(result.value){
								window.location = "empresa";
							}
							});
				</script>';
			}else{
				echo '<script>
						Swal.fire({
							icon: "error",
						  title: "Oops!...",
						  text: "Error al cargar datos!",
						  confirmButtonText : "Cerrar",
						}).then((result)=>{
							if(result.value){
								window.location = "empresa";
							}
							});
				</script>';
			}
			}

		}
		if (isset($_POST["ope"]) == "EDITAR"){
			if (isset($_POST["codigoEmpresa"]) && isset($_POST["codigoEmpresa"]) != 0) {
			$ruta  = $_POST["fotoActual"];
			echo "ruta ".$ruta;
					if (isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])) {
							list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);
							$nuevoAncho = 500;
							$nuevoAlto = 183;
							/*CREAR DIRECTORIO DONDE SE VA A GUARDAR LA IMAGEN*/
							$directorio = "vistas/img/plantilla/".$_POST["editarRazon"];
							/*preguntamos si existe la foto*/
							if (!empty($_POST["fotoActual"])) {

									unlink($_POST["fotoActual"]);

							}else{
									mkdir($directorio, 0777);
							}


							if ($_FILES["editarFoto"]["type"] == "image/jpeg") {
								/*se guarda imagen*/
								$aleatorio  = mt_rand(100,999);
								$ruta = "vistas/img/plantilla/".$_POST["editarRazon"]."/".$aleatorio.".jpg";
								$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);
								$destino =imagecreatetruecolor($nuevoAncho, $nuevoAlto);
								imagecopyresized($destino,$origen,0,0,0,0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
								imagejpeg($destino, $ruta);
							}
							if ($_FILES["editarFoto"]["type"] == "image/png") {
								/*se guarda imagen*/
								$aleatorio  = mt_rand(100,999);
								$ruta = "vistas/img/plantilla/".$_POST["editarRazon"]."/".$aleatorio.".png";
								$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);
								$destino =imagecreatetruecolor($nuevoAncho, $nuevoAlto);
								imagecopyresized($destino,$origen,0,0,0,0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
								imagepng($destino, $ruta);
							}
				}
				////**FIN DE VALIDAR IMAGEN**/////
				$tabla = "empresas";
				$datos =   array("denominacion" => $_POST["editarRazon"],
								"ruc" => $_POST["editarRuc"],
								"telefono" =>  $_POST["editarTelefono"],
								"direccion" => $_POST["editarDirección"] ,
								"correo" => $_POST["editarCorreo"] ,
								"logo" => $ruta,
								"id_empresa" => $_POST["codigoEmpresa"]);
				$respuesta = ModeloEmpresas::mdlEditarEmpresa($tabla, $datos);
				if ($respuesta == "ok") {
						echo '<script>
						Swal.fire({
							icon: "success",
						  title: "Ok",
						  text: "Modificación exitosa!",
						  confirmButtonText : "Cerrar",
						}).then((result)=>{
							if(result.value){
								 window.location = "empresa";
							}
							});
				</script>';
			}else{
				echo '<script>
						Swal.fire({
							icon: "error",
						  title: "Oops!...",
						  text: "Error al modificar datos!",
						  confirmButtonText : "Cerrar",
						}).then((result)=>{
							if(result.value){
								 window.location = "empresa";
							}
							});
				</script>';
			}


		}
		}
}

}