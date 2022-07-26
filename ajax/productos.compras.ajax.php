<?php
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once   "../controladores/categorias.controlador.php";
require_once   "../modelos/categorias.modelo.php";
class AjaxProductosCompras{
	public $idProductoCompra;
	public function ajaxMostarProductoCompra(){
		$item = "id";
		$valor = $this->idProductoCompra;
		$respuesta = ControladorProductos::crtMostrarProductos($item, $valor);
		// header('Content-Type: text/html; charset=iso-8859-1');
		// header("application/json");
		// echo $respuesta;
		echo json_encode($respuesta);

	}
}
	/*=============================================
	AGREGAR PRODUCTOS A LA TABLA COMPRAS
	=============================================*/
	if (isset($_POST["idProductoCompra"])) {
		//echo "cod ".$_POST["idCategoria"];
			$agregarProductoCompra = new AjaxProductosCompras();
			$agregarProductoCompra -> idProductoCompra = $_POST["idProductoCompra"];
			$agregarProductoCompra -> ajaxMostarProductoCompra();
	}