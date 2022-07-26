<?php
class ControladorConfiguracion{
	/*========================================
	=            MOSTRAR TIKET            =
	========================================*/
	static public function crtMostrarTicket($item, $valor){
		$tabla = "configuracion";
		$respuesta = ModeloConfiguracion::mdlMostrarTicket($tabla, $item, $valor);
		return $respuesta;

	}
}