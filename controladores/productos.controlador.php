<?php
class ControladorProductos{

	/*MOSTRAR RESUMEN DE PRODUCTOS POR CATEGORIASS*/
	static public function ctrMostrarResumen(){
		// $tabla = "productos";
		$respuesta = ModeloProductos::mldMostrarProductosResumen();
		return $respuesta;
	}
	/*MOSTRAR PRODUCTOS PARA CARGAR COMPRAS*/
	static public function crtMostrarProductosCompras($item, $valor){
		$tabla = "productos";
		$respuesta = ModeloProductos::mldMostrarProductos($tabla, $item, $valor);
		return $respuesta;
	}
	/*MOSTRAR VISTA PRODUCTOS CON STOCK*/
	static public function crtMostrarProductosStock($item, $valor){
		$tabla = "produtos_stock";
		$respuesta = ModeloProductos::mldMostrarProductos($tabla, $item, $valor);
		return $respuesta;
	}
	/*MOSTRAR TABLA PRODCUTOS*/
	static public function crtMostrarProductosReporte($item, $valor){
		$tabla = "productos";
		$respuesta = ModeloProductos::mldMostrarProductosReporte($tabla, $item, $valor);
		return $respuesta;
	}
	static public function crtMostrarProductos($item, $valor){
		$tabla = "productos";
		$respuesta = ModeloProductos::mldMostrarProductos($tabla, $item, $valor);
		return $respuesta;
	}
	static public  function ctrCrearProducto(){
		if (isset($_POST["nuevaDescripcion"])) {
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcion"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoStock"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoPrecioCompra"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoPrecioVenta"])){

				$ruta = "vistas/img/productos/default/anonymous.png";
				/*======================================
				=            VALIDAR IMAGEN            =
				======================================*/
				if (isset($_FILES["nuevaImagen"]["tmp_name"])) {
					list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;
					/*CREAR DIRECTORIO DONDE SE VA A GUARDAR LA IMAGEN*/
					$directorio = "vistas/img/productos/".$_POST["nuevoCodigo"];
					mkdir($directorio, 0755);

					if ($_FILES["nuevaImagen"]["type"] == "image/jpeg") {
						/*se guarda imagen*/
						$aleatorio  = mt_rand(100,999);
						$ruta = "vistas/img/productos/".$_POST["nuevoCodigo"]."/".$aleatorio.".jpg";
						$origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);
						$destino =imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino,$origen,0,0,0,0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);
					}
					if ($_FILES["nuevaImagen"]["type"] == "image/png") {
						/*se guarda imagen*/
						$aleatorio  = mt_rand(100,999);
						$ruta = "vistas/img/productos/".$_POST["nuevoCodigo"]."/".$aleatorio.".png";
						$origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);
						$destino =imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino,$origen,0,0,0,0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagepng($destino, $ruta);
					}
				}



					$tabla = "productos";
					$venta = 0;

	 				$datos = array("id_categoria" => $_POST["nuevaCategoria"],
							   "codigo" => $_POST["nuevoCodigo"],
							   "descripcion" => $_POST["nuevaDescripcion"],
							   "barcode" => $_POST["nuevoCodigoBarra"],
							   "stock" => $_POST["nuevoStock"],
							   "precio_compra" => $_POST["nuevoPrecioCompra"],
							   "precio_venta" => $_POST["nuevoPrecioVenta"],
							   "imagen" => $ruta,
							   "ventas" => $venta);
			// var_dump($datos);
				$respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);
				var_dump($respuesta);
			if ($respuesta == "ok") {
			 echo'<script>

						Swal.fire({
							  type: "succes",
							  title: "Registro exitoso",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then((result) => {
								if (result.value) {

								window.location = "productos";

								}
							})

				  	</script>';
			}

			}else{
					echo'<script>

						Swal.fire({
							  type: "error",
							  title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then((result) => {
								if (result.value) {

								window.location = "productos";

								}
							})

				  	</script>';
			}
		}
	}
/*=============================================
=           EDITAR PRODUCTO      =
=============================================*/


	static public  function ctrEditarProducto(){
		if (isset($_POST["editarDescripcion"])) {
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarStock"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarPrecioCompra"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarPrecioVenta"])){

				$ruta = $_POST["imagenActual"];
				/*======================================
				=            VALIDAR IMAGEN            =
				======================================*/
				if (isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"])) {
					list($ancho, $alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;
					/*CREAR DIRECTORIO DONDE SE VA A GUARDAR LA IMAGEN*/
					$directorio = "vistas/img/productos/".$_POST["editarCodigo"];
					/*VALIDAMOS DIRECTORIO DE LA IMAGEN*/
					if (!empty($_POST["imagenActual"]) && $_POST["imagenActual"] != "vistas/img/productos/default/anonymous.png") {
						unlink($_POST["imagenActual"]);
					}else{
						mkdir($directorio, 0755);

					}

					if ($_FILES["editarImagen"]["type"] == "image/jpeg") {
						/*se guarda imagen*/
						$aleatorio  = mt_rand(100,999);
						$ruta = "vistas/img/productos/".$_POST["editarCodigo"]."/".$aleatorio.".jpg";
						$origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);
						$destino =imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino,$origen,0,0,0,0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);
					}
					if ($_FILES["editarImagen"]["type"] == "image/png") {
						/*se guarda imagen*/
						$aleatorio  = mt_rand(100,999);
						$ruta = "vistas/img/productos/".$_POST["editarCodigo"]."/".$aleatorio.".png";
						$origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);
						$destino =imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino,$origen,0,0,0,0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagepng($destino, $ruta);
					}
				}



					$tabla = "productos";
					$venta = 0;

	 				$datos = array("id_categoria" => $_POST["editarCategoria"],
							   "codigo" => $_POST["editarCodigo"],
							   "descripcion" => $_POST["editarDescripcion"],
							   "barcode" => $_POST["editarCodigoBarra"],
							   "stock" => $_POST["editarStock"],
							   "precio_compra" => $_POST["editarPrecioCompra"],
							   "precio_venta" => $_POST["editarPrecioVenta"],
							   "imagen" => $ruta);
				 // var_dump($datos);
				$respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);
				 //var_dump($respuesta);
			if ($respuesta == "ok") {
			 echo'<script>

						Swal.fire({
							  type: "succes",
							  title: "El producto ha sido editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then((result) => {
								if (result.value) {

								window.location = "productos";

								}
							})

				  	</script>';
			}

			}else{
					echo'<script>

						Swal.fire({
							  type: "error",
							  title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then((result) => {
								if (result.value) {

								window.location = "productos";

								}
							})

				  	</script>';
			}
		}
	}
	/*=======================================
	=            BORRAR PRODUCTO            =
	=======================================*/
		static public function ctrEliminarProducto(){
			if (isset($_GET["idProducto"])) {
				$tabla = "productos";
				$datos = $_GET["idProducto"];
				if ($_GET["imagen"] != "" && $_GET["imagen"] != "vistas/img/productos/default/anonymous.png") {
					unlink($_GET["imagen"]);
					rmdir('vistas/img/productos/'.$_GET["codigo"]);
				}
				$respuesta = ModeloProductos::mdlEliminarProducto($tabla, $datos);
				if ($respuesta == "ok") {
						 echo'<script>

									Swal.fire({
										  type: "succes",
										  title: "El producto ha sido eliminado correctamente",
										  showConfirmButton: true,
										  confirmButtonText: "Cerrar"
										  }).then((result) => {
											if (result.value) {

											window.location = "productos";

											}
										})

							  	</script>';
			}
			}
		}

	/*=====  End of BORRAR PRODUCTO  ======*/

}