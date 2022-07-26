<?php
require_once "../controladores/historial.controlador.php";
require_once "../modelos/historial.modelo.php";

class AjaxEliminarHistorial{
public $idHistorial;
	  public function ajaxEliminarHitorial(){
	  			$item = "id_historial";
				$valor =$this->idHistorial;
			 	$respuesta = ControladorHistorial::ctrEliminarHistorial($item, $valor);
			 	echo json_encode($respuesta);

		}
}
/*=============================================
	ELIMINAR COMPRA
	=============================================*/
	if (isset($_POST["idHistorial"])) {
			// echo "Id compra ".$_POST["codigoCompra"];
			$eliminarHistorial = new AjaxEliminarHistorial();
			$eliminarHistorial -> idHistorial = $_POST["idHistorial"];
			$eliminarHistorial -> ajaxEliminarHitorial();
	}