<?php
require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";
class TablaDetalleVenta{
	// echo "Hola";
		/*=============================================
		=            MOSTRAR VENTAS REALIZADAS        =
		=============================================*/
		static public function mostrarDetalleVentas(){

		$item = null;
        $valor = null;
        $ventas = ControladorVentas::ctrMostrarDetalleVentas($item, $valor);
        // var_dump($ventas);
        echo '{
			  "data": [';
			  for ($i=0; $i < count($ventas)-1 ; $i++) {
					echo '[
			  		"'.($i+1).'",
			      "'.$ventas[$i]["codigo"].'",
			      "'.$ventas[$i]["cliente"].'",
			      "'.$ventas[$i]["vendedor"].'",
			      "'.$ventas[$i]["metodo_pago"].'",
			      "'.number_format($ventas[$i]["neto"],0).'",
			      "'.number_format($ventas[$i]["total"],0).'",
			      "'.$ventas[$i]["fecha"].'",
			      "'.$ventas[$i]["id"].'"
			    ],';
			  }
			   echo '[
				      "'.count($ventas).'",
				      "'.$ventas[count($ventas)-1]["codigo"].'",
			      "'.$ventas[count($ventas)-1]["cliente"].'",
			      "'.$ventas[count($ventas)-1]["vendedor"].'",
			      "'.$ventas[count($ventas)-1]["metodo_pago"].'",
			      "'.number_format($ventas[count($ventas)-1]["neto"],0).'",
			      "'.number_format($ventas[count($ventas)-1]["total"],0).'",
			      "'.$ventas[count($ventas)-1]["fecha"].'",
			      "'.$ventas[count($ventas)-1]["id"].'"
				    ]
				  ]
				}';

		}


}

	$activar = new TablaDetalleVenta();
	$activar -> mostrarDetalleVentas();
