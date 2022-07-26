<?php
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once   "../controladores/categorias.controlador.php";
require_once   "../modelos/categorias.modelo.php";
class TablaProducto{
	/*=============================================
	=            MOSTRAR LA TABLA DE PRODUCTO          =
	=============================================*/
	static public function mostrarTabla(){
		// function datos(){
		$item = null;
        $valor = null;
        $productos = ControladorProductos::crtMostrarProductos($item, $valor);
        //$var_dump($productos);
        //  for ($i=0; $i < count($productos)-1; $i++) {
        // 	echo $productos[$i]["descripcion"];
        // }
        echo '{
			  "data": [';
			  for ($i=0; $i < count($productos)-1 ; $i++) {
			  	$item = "id";
        		$valor = $productos[$i]["id_categoria"];
			  	$categorias = ControladorCategorias::ctrMostrarCategoria($item, $valor);
			  	echo '[
			  		"'.($i+1).'",
			      "'.$productos[$i]["imagen"].'",
			      "'.$productos[$i]["codigo"].'",
			      "'.$productos[$i]["descripcion"].'",
			      "'.$categorias["categoria"].'",
			      "'.$productos[$i]["stock"].'",
			      "'.number_format($productos[$i]["precio_compra"],2).'",
			      "'.number_format($productos[$i]["precio_venta"],2).'",
			      "'.$productos[$i]["fecha"].'",
			      "'.$productos[$i]["barcode"].'",
			      "'.$productos[$i]["id"].'"
			    ],';
			  }
			   	$item = "id";
        		$valor = $productos[count($productos)-1]["id_categoria"];
			  	$categorias = ControladorCategorias::ctrMostrarCategoria($item, $valor);

				echo '[
				      "'.count($productos).'",
				      "'.$productos[count($productos)-1]["imagen"].'",
			      "'.$productos[count($productos)-1]["codigo"].'",
			      "'.$productos[count($productos)-1]["descripcion"].'",
			      "'.$categorias["categoria"].'",
			      "'.$productos[count($productos)-1]["stock"].'",
			      "'.number_format($productos[count($productos)-1]["precio_compra"],2).'",
			      "'.number_format($productos[count($productos)-1]["precio_venta"],2).'",
			      "'.$productos[count($productos)-1]["fecha"].'",
			      "'.$productos[count($productos)-1]["barcode"].'",
			      "'.$productos[count($productos)-1]["id"].'"
				    ]
				  ]
				}';
// }
// return datos();
	}

	/*Generar codigo*/
	public $idCategoria;
	static public function ajaxCrearCodigoProducto(){
		$item = "id_categoria";
		$valor = $this -> $idCategoria;
		$respuesta = ControladorProductos::crtMostrarProductos($item, $valor);
		echo json_encode($respuesta);
	}
}
/*=============================================
	ACTIVAR TABLA PRODUCTO  DE FORMA INMEDIATA
	=============================================*/
	$activar = new TablaProducto();
	$activar -> mostrarTabla();

