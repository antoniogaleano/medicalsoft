<?php
class ControladorHistorial{
// ctrEliminarHistorial
static public function ctrEliminarHistorial($item, $valor){
	$tabla = "historial";
	$respuesta = ModeloHistorial::mdlEliminarHistorial($tabla, $item, $valor);
	return $respuesta;

}


	static public function ctrCrearHistorial(){
		if (isset($_POST["id_cli"])) {
			echo "string".$_POST["id_cli"];
			$fecha = fechabd($_POST["nuevoRegistro"]);
			$fechaActual = date('Y-m-d');
			$horaActual = date('H:i:s');
			$fechaActual = $fechaActual.' '.$horaActual;
			$retiro = $fechaActual;
			 $hora = $_POST["nuevaHora"];
			 $retiro = fechabd($_POST["nuevoRetiro"])." ".$hora;

			 $datos = array(
			 	'id' => $_POST["id_cli"],
			 	'fecha' => $fecha,
			 	'motivo' => $_POST["nuevoMotivo"],
			 	'esf_od' => $_POST["nuevoEsfOd"],
			 	'esf_oi' => $_POST["nuevoEsfOi"],
			 	'cilindro_od' => $_POST["nuevoCilOd"],
			 	'cilindro_oi' => $_POST["nuevoCilOi"],
			 	'eje_od' => $_POST["nuevoEjeOd"],
			 	'eje_oi' => $_POST["nuevoEjeOi"],
			 	'adicion_od' => $_POST["nuevoAdicionOd"],
			 	'adicion_oi' => $_POST["nuevoAdicionOi"],
			 	'dnp_od' => $_POST["nuevoDnpOd"],
			 	'dnp_oi' => $_POST["nuevoDnpOi"],
			 	'di' => $_POST["nuevoDi"],
			 	'alt' => $_POST["nuevoAlt"],
			 	'monofocal' => $_POST["monofocal"],
			 	'monofocal_descri' => $_POST["mono_descri"],
			 	'estuche' => $_POST["nuevo_estuche"],
			 	'bifocal' => $_POST["bifocal"],
			 	'bifocal_descri' => $_POST["bifocal_descri"],
			 	'progesivo' => $_POST["progresivo"],
			 	'progresivo_descri' => $_POST["progresivo_descri"],
			 	'armazon' => $_POST["nuevoArmazon"],
			 	'doctor' => $_POST["nuevoDoctor"],
			 	'retiro' => $retiro,
			 	'total' => $_POST["nuevoTotal"],
			 	'anticipo' => $_POST["nuevaEntrega"],
			 	'receta' => $_POST["nuevaFoto"],
			 	'id_usuario' => $_SESSION["id"]
			 );
			   // var_dump($datos);
		$tabla = "historial";
		$respuesta = ModeloHistorial::mdlInsertarHistorial($tabla, $datos);
		if ($respuesta = "ok") {
			echo "No Grabo";
				echo '<script>
						Swal.fire({
							icon: "success",
							title: "Ok",
							text: "Registro exitoso!",
							confirmButtonText : "Cerrar",
							}).then((result)=>{
							if(result.value){
							window.location = "consultas";
							}
							});
						</script>';
		}else{
			echo "No Grabo";
		}
		}

	}

	static public function  ctrMostrarHistorial($item, $valor){
		$tabla = "historial";
		$respuesta = ModeloHistorial::mldMostrarHistorial($tabla, $item, $valor);
		return $respuesta;
	}
	static public function  ctrTraerHistorial($item, $valor){
		$tabla = "historial";
		$respuesta = ModeloHistorial::mdlTraerHistorial($tabla, $item, $valor);
		return $respuesta;
	}

	static public function ctrEditarHistorial(){
		if (isset($_POST["id_cli"])) {
			// echo "string".$_POST["id_cli"];
			// 	echo "string".$_POST["id_cli"];
			$fecha = fechabd($_POST["editarRegistro"]);
			$fechaActual = date('Y-m-d');
			$horaActual = date('H:i:s');
			$fechaActual = $fechaActual.' '.$horaActual;
			$retiro = $fechaActual;
			  $retirar = fechabd($_POST["editarRetiro"]);
			 $hora = $_POST["editarHora"];
			$retiro = $retirar.' '.$hora;
			 $datos = array(
			 	'id_historial' => $_POST["id_historial"],
			 	'id' => $_POST["id_cli"],
			 	'fecha' => $fecha,
			 	'motivo' => $_POST["editarMotivo"],
			 	'esf_od' => $_POST["editarEsfOd"],
			 	'esf_oi' => $_POST["editarEsfOi"],
			 	'cilindro_od' => $_POST["editarCilOd"],
			 	'cilindro_oi' => $_POST["editarCilOi"],
			 	'eje_od' => $_POST["editarEjeOd"],
			 	'eje_oi' => $_POST["editarEjeOi"],
			 	'adicion_od' => $_POST["editarAdicionOd"],
			 	'adicion_oi' => $_POST["editarAdicionOi"],
			 	'dnp_od' => $_POST["editarDnpOd"],
			 	'dnp_oi' => $_POST["editarDnpOi"],
			 	'di' => $_POST["editarDi"],
			 	'alt' => $_POST["editarAlt"],
			 	'monofocal' => $_POST["monofocal"],
			 	'monofocal_descri' => $_POST["editar_mono_descri"],
			 	'estuche' => $_POST["editar_estuche"],
			 	'bifocal' => $_POST["bifocal"],
			 	'bifocal_descri' => $_POST["editar_bifocal_descri"],
			 	'progesivo' => $_POST["progresivo"],
			 	'progresivo_descri' => $_POST["editar_progresivo_descri"],
			 	'armazon' => $_POST["editarArmazon"],
			 	'doctor' => $_POST["editarDoctor"],
			 	'retiro' => $retiro,
			 	'total' => $_POST["editarTotal"],
			 	'anticipo' => $_POST["editarEntrega"],
			 	'receta' => $_POST["nuevaFoto"],
			 	'id_usuario' => $_SESSION["id"]
			 );
		 // var_dump($datos);
		$tabla = "historial";
		$respuesta = ModeloHistorial::mdlEditarHistorial($tabla, $datos);
		// var_dump($respuesta);
		if ($respuesta = "ok") {
			echo "No Grabo";
				echo '<script>
						Swal.fire({
							icon: "success",
							title: "Ok",
							text: "Modificación exitoso!",
							confirmButtonText : "Cerrar",
							}).then((result)=>{
							if(result.value){
							window.location = "consultas";
							}
							});
						</script>';
		}else{
			echo "No Grabo";
		}
		}
	}
}
