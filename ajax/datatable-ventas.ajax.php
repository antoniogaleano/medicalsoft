<?php
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";
class TablaProductos{
	/*=====================================
	=            MOSTRAR TABLA            =
	=====================================*/
	public function mostrarTabla(){
		$item = null;
        $valor =null;
        $productos = ControladorProductos::crtMostrarProductosStock($item, $valor);

         echo '{
			  "data": [';
			  for ($i=0; $i < count($productos)-1 ; $i++) {

			  	echo '[
			  		"'.($i+1).'",
			      "'.$productos[$i]["imagen"].'",
			      "'.$productos[$i]["codigo"].'",
			      "'.$productos[$i]["descripcion"].'",
			      "'.$productos[$i]["stock"].'",
			      "'.$productos[$i]["barcode"].'",
			      "'.$productos[$i]["id"].'"
			    ],';
			  }
				echo '[
				  "'.count($productos).'",
				  "'.$productos[count($productos)-1]["imagen"].'",
			      "'.$productos[count($productos)-1]["codigo"].'",
			      "'.$productos[count($productos)-1]["descripcion"].'",
			      "'.$productos[count($productos)-1]["stock"].'",
			      "'.$productos[count($productos)-1]["barcode"].'",
			      "'.$productos[count($productos)-1]["id"].'"
				    ]
				  ]
				}';

	}

}
/*=============================================
	ACTIVAR TABLA PRODUCTO  DE FORMA INMEDIATA
	=============================================*/
	$activar = new TablaProductos();
	$activar -> mostrarTabla();