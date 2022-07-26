<?php
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/compras.controlador.php";
require_once "../modelos/compras.modelo.php";
class AjaxEliminarCompras{
	public $codigoCompra;
	  public function ajaxEliminarCompra(){
	  			$tabla = "compras";
				$item = "id_compra";
				$valor =$this->codigoCompra;
				// echo "VALOR ".$valor;
				$traerComprasEditar = ModeloCompras::mdlMostrarCompras($tabla, $item, $valor);
				$productosEditar = json_decode($traerComprasEditar["productos"], true);
				$totalProductosCompradosAnulados = array();
				foreach ($productosEditar as $key => $value) {
					array_push($totalProductosCompradosAnulados, $value["cantidad"]);
					$tablaProductos = "productos";
					$item = "id";
					$valor = $value["id"];
					$traerProducto = ModeloProductos::mldMostrarProductos($tablaProductos, $item, $valor);
					$stockCantActual = $traerProducto["stock"] - $value["cantidad"];
					$item1b = "stock";
					$valor1b = $stockCantActual;
					$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);
			 	}
			 	$itemb = "id_compra";
			 	$valorb   =$this->codigoCompra;
			 	$respuesta = ControladorCompras::ctrEliminarCompra($itemb, $valorb);
			 	echo json_encode($respuesta);

		}

}
/*=============================================
	ELIMINAR COMPRA
	=============================================*/
	if (isset($_POST["codigoCompra"])) {
			// echo "Id compra ".$_POST["codigoCompra"];
			$eliminarCompras = new AjaxEliminarCompras();
			$eliminarCompras -> codigoCompra = $_POST["codigoCompra"];
			$eliminarCompras -> ajaxEliminarCompra();
	}