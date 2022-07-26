<?php
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";
class AjaxEliminarVentas{
	public $id;
	  public function ajaxEliminarVenta(){
		$item = "id";
		$valor = $this->id;
		// echo "VALOR ". $valor;
		 $traerVenta = ControladorVentas::ctrMostrarVentas($item, $valor);
		 $productos = json_decode($traerVenta["productos"], true);

		  foreach ($productos as $key => $value) {
		  	// echo $value["id"]." ".$value["descripcion"]." ".$value["cantidad"]."<br>";
		  	$tablaProductos = "productos";
			$item = "id";
			$valor = $value["id"];
			$traerProducto = ModeloProductos::mldMostrarProductos($tablaProductos, $item, $valor);
			// var_dump($traerProducto);
			 $item1a = "stock";
			 $valor1a = $traerProducto["stock"] + $value["cantidad"];
			$nuevasCantidad = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);
		  }

		  $itemb = "id";
		  $valorb =  $this->id;
		  $respuesta = ControladorVentas::ctrEliminarVenta($itemb, $valorb);
		   // ControladorVentas::ctrVentas($respuesta);
		  echo json_encode($respuesta);
		}

}
/*=============================================
	AGREGAR PRODUCTOS A LA TABLA COMPRAS
	=============================================*/
	if (isset($_POST["codigoVenta"])) {

			$eliminarVenta = new AjaxEliminarVentas();
			$eliminarVenta -> id = $_POST["codigoVenta"];
			$eliminarVenta -> ajaxEliminarVenta();
	}