<?php
class ControladorCompras{
/*=============================================
	=           MOSTAR COMPRAS       =
	=============================================*/
	static public function ctrMostrarCompra($item, $valor){
		$tabla = "compras";
		$respuesta = ModeloCompras::mdlMostrarCompras($tabla, $item, $valor);
		return $respuesta;

	}

	/*=============================================
	=           RangoFechasVentas       =
	=============================================*/
	static public function ctrRangoFechasCompras($fechaInicial, $fechaFinal){
		$tabla = "v_compras";
		$respuesta = ModeloCompras::mdlRangoFechasCompras($tabla, $fechaInicial, $fechaFinal);
		return $respuesta;

	}

	/*=============================================
	=           CREAR COMPRA          =
	=============================================*/
	static public function ctrCrearCompra(){
		if(isset($_POST["seleccionarCliente"])){
			/*=============================================
			=           ACTUALIZAR PRODUCTOS COMPRAS   =
			=============================================*/
			$listaProductosCompras = json_decode($_POST["listaProductosCompras"], true);
			$totalProductosComprados = array();
			// var_dump($listaProductosCompras);
			foreach ($listaProductosCompras as $key => $value) {
				array_push($totalProductosComprados, $value["cantidad"]);
				$tablaProductos = "productos";
				$item = "id";
				$valor = $value["id"];
				$traerProducto = ModeloProductos::mldMostrarProductos($tablaProductos, $item, $valor);
				$total = $traerProducto["stock"] + $value["cantidad"];

				$item1b = "stock";
				$valor1b = $value["stock"];
				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

				$item1c = "precio_compra";
				$valor1c = $value["precioUnt"];
				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1c, $valor1c, $valor);

			}
			$tabla = "compras";
			$estado = "PENDIENTE";
			$impuesto = 0;
			$datos = array("id_proveedor" => $_POST["seleccionarCliente"],
							"id_usuario" => $_POST["idVendedor"],
							"fecha" => fechabd($_POST["nuevaFecha"]),
							"factura" => $_POST["nuevaFactura"],
							"tipo" => $_POST["nuevoTipo"],
							"vencimiento" => fechabd($_POST["nuevoVencimiento"]),
							"productos" => $_POST["listaProductosCompras"],
							"impuesto" => $impuesto,
							"neto" => $_POST["totalCompra"],
							"total" => $_POST["totalCompra"],
							"estado" => $estado,
							"metodo_pago" => $_POST["listaMetodoPago"] );
			 // var_dump($datos);
				$respuesta = ModeloCompras::mdlIngresarCompra($tabla, $datos);
			if ($respuesta == "ok") {
				echo "<script>
					Swal.fire({
	  				icon: 'success',
	  				title: 'Compra generada correctamente!'
							}).then((result)=>{
								if(result.value){
									window.location = 'compras';
								}
							})
				 </script>";
			}else{
				echo "No Ok";
			}

		}
	}


	/*=============================================
	=           EDITAR COMPRAS          =
	=============================================*/
	static public function ctrEditarCompra(){
		if (isset($_POST["editarCompra"])) {
			if (isset($_POST["listaProductosCompras"]) && $_POST["listaProductosCompras"] != "") {
				/*SETEAR CANTIDAD PRODUCTOS*/
				$tabla = "compras";
				$item = "id_compra";
				$valor = $_POST["editarCompra"];
				$traerComprasEditar = ModeloCompras::mdlMostrarCompras($tabla, $item, $valor);
				$productosEditar = json_decode($traerComprasEditar["productos"], true);
				$totalProductosCompradosAnulados = array();
				// var_dump($traerComprasEditar);
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
			 	/*FIN DE SETEO*/
			 	/*SUMA LA CANTIDAD EN PRODUCTOS NUEVOS O ACTUALES LISTA ENVIADA DESDE EL FORMULARIO*/
			 	$listaProductosCompras = json_decode($_POST["listaProductosCompras"], true);
				$totalProductosComprados = array();
				 // var_dump($listaProductosCompras);
				foreach ($listaProductosCompras as $key => $value) {
				array_push($totalProductosComprados, $value["cantidad"]);
				// echo "string". $value["cantidad"];
				$tablaProductosSumar = "productos";
				$itemSumar = "id";
				$valorSumar = $value["id"];
				$traerProducto = ModeloProductos::mldMostrarProductos($tablaProductosSumar, $itemSumar, $valorSumar);
				$total = $traerProducto["stock"] + $value["cantidad"];
				// var_dump($traerProducto);
				$itemC = "stock";
				$valorC = $total;
				$valorId = $value["id"];
				// echo "id ".$value["id"];
				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductosSumar, $itemC, $valorC, $valorId);

				$itemB = "precio_compra";
				$valorB = $value["precioUnt"];
				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductosSumar, $itemB, $valorB, $valorId);

			}
			/*ACTUALIZACION DE LA TABLA SEGUN ID*/

			$impuesto = 0;
			$datos = array("id_compra" => $_POST["editarCompra"],
							"id_proveedor" => $_POST["seleccionarCliente"],
							"id_usuario" => $_POST["idVendedor"],
							"fecha" => fechabd($_POST["nuevaFecha"]),
							"factura" => $_POST["nuevaFactura"],
							"tipo" => $_POST["nuevoTipo"],
							"vencimiento" => fechabd($_POST["nuevoVencimiento"]),
							"productos" => $_POST["listaProductosCompras"],
							"impuesto" => $impuesto,
							"neto" => $_POST["totalCompra"],
							"total" => $_POST["totalCompra"]);

			 $respuesta = ModeloCompras::mdlEditarCompra($tabla, $datos);
				 if ($respuesta == "ok") {
				echo "<script>
					Swal.fire({
	  				icon: 'success',
	  				title: 'Compra ha sido modificada correctamente!'
							}).then((result)=>{
								if(result.value){
									window.location = 'compras';
								}
							})
				 </script>";
			}else{
				echo "No Ok";
			}
			}else{
				$tabla = "compras";
				$impuesto = 0;
				$datos = array("id_compra" => $_POST["editarCompra"],
							"id_proveedor" => $_POST["seleccionarCliente"],
							"id_usuario" => $_POST["idVendedor"],
							"fecha" => fechabd($_POST["nuevaFecha"]),
							"factura" => $_POST["nuevaFactura"],
							"tipo" => $_POST["nuevoTipo"],
							"vencimiento" => fechabd($_POST["nuevoVencimiento"]),
							"impuesto" => $impuesto,
							"neto" => $_POST["totalCompra"],
							"total" => $_POST["totalCompra"]);
				 $respuesta = ModeloCompras::mdlEditarCompraCabecera($tabla, $datos);
				 if ($respuesta == "ok") {
						echo "<script>
							Swal.fire({
			  				icon: 'success',
			  				title: 'Compra ha sido modificada correctamente!'
									}).then((result)=>{
										if(result.value){
											window.location = 'compras';
										}
									})
						 </script>";
				}else{
					echo "No Ok";
				}
			}
		}
	}
	/*=============================================
	=           ELIMINAR COMPRAS       =
	=============================================*/
	static public function ctrEliminarCompra($item, $valor){
		$tabla = "compras";
		$respuesta = ModeloCompras::mdlEliminarCompras($tabla, $item, $valor);
		return $respuesta;
	}
}