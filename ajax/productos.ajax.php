<?php
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once   "../controladores/categorias.controlador.php";
require_once   "../modelos/categorias.modelo.php";
class AjaxProductos{

	/*Generar codigo*/
	 public $idCategoria;
	  public function ajaxCrearCodigoProducto(){
		$item = "id_categoria";
		$valor = $this->idCategoria;
		$respuesta = ControladorProductos::crtMostrarProductos($item, $valor);
		echo json_encode($respuesta);
	}


	/*====EDITAR PRODUCTO===*/
		public $idProducto;
		public $traerProductos;
		public $nombreProducto;
		public function ajaxEditarProducto(){
			if ($this->traerProductos == "ok") {
					 $item = null;
					$valor = null;
					$respuesta = ControladorProductos::crtMostrarProductos($item, $valor);
					echo json_encode($respuesta);
				}else if($this->nombreProducto != ""){
					$item = "descripcion";
					$valor = $this->nombreProducto;
					$respuesta = ControladorProductos::crtMostrarProductos($item, $valor);
					echo json_encode($respuesta);

				}else{
					$item = "id";
					$valor = $this->idProducto;
					$respuesta = ControladorProductos::crtMostrarProductos($item, $valor);
					//header('Content-Type: text/html; charset=iso-8859-1');
					//header("application/json");
					// echo $respuesta;
					 echo json_encode($respuesta);
				}

		}
}




	/*=============================================
	GENERAR CODIGO
	=============================================*/
	if (isset($_POST["idCategoria"])) {
		//echo "cod ".$_POST["idCategoria"];
			$codigoProducto = new AjaxProductos();
	$codigoProducto -> idCategoria = $_POST["idCategoria"];
	$codigoProducto -> ajaxCrearCodigoProducto();
	}
	/*=============================================
	EDITAR PRODUCTOS
	=============================================*/
	if (isset($_POST["idProducto"])) {
		//echo "cod ".$_POST["idCategoria"];
			$editarProducto = new AjaxProductos();
			$editarProducto -> idProducto = $_POST["idProducto"];
			$editarProducto -> ajaxEditarProducto();
	}

/*=============================================
	TRAER PRODUCTOS
	=============================================*/
	if (isset($_POST["traerProductos"])) {
		//echo "cod ".$_POST["idCategoria"];
			$traerProductos = new AjaxProductos();
			$traerProductos -> traerProductos = $_POST["traerProductos"];
			$traerProductos -> ajaxEditarProducto();
	}

	/*=============================================
	TRAER PRODUCTOS
	=============================================*/
	if (isset($_POST["nombreProducto"])) {
		//echo "cod ".$_POST["idCategoria"];
			$traerProductos = new AjaxProductos();
			$traerProductos -> nombreProducto = $_POST["nombreProducto"];
			$traerProductos -> ajaxEditarProducto();
	}