<?php
class ControladorVentas{
	/*=============================================
	=           RangoFechasVentas       =
	=============================================*/
	static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal){
		$tabla = "v_detalle_ventas";
		$respuesta = ModeloVentas::mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal);
		return $respuesta;

	}
	/*=============================================
	=           SUMAR VENTA DIARIA         =
	=============================================*/
	static public function ctrMostrarVentasDiarias($item, $valor){
		$tabla = "ventas_cabecera";
		$respuesta = ModeloVentas::mdlMostrarVentasDiarias($tabla, $item, $valor);
		return $respuesta;

	}


	/*=============================================
	=           MOSTRAR DETALLE VENTAS          =
	=============================================*/
	static public function ctrMostrarDetalleVentas($item, $valor){
		$tabla = "v_detalle_ventas";
		$respuesta = ModeloVentas::mdlMostrarDetalleVentas($tabla, $item, $valor);
		return $respuesta;

	}
	/*=============================================
	=           MOSTRAR VENTAS          =
	=============================================*/
	static public function ctrMostrarVentas($item, $valor){
		$tabla = "ventas";
		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);
		return $respuesta;
		echo "fdfafd";

	}


	/*=============================================
	=           CREAR VENTAS          =
	=============================================*/
	static public function ctrCrearVenta(){
		if(isset($_POST["nuevaVenta"])){
			/*=============================================
			=           ACTUALIZAR PRODUCTOS   =
			=============================================*/
			$listaProductos = json_decode($_POST["listaProductos"], true);
			$totalProductosComprados = array();
			// var_dump($listaProductos);
			foreach ($listaProductos as $key => $value) {
				array_push($totalProductosComprados, $value["cantidad"]);
				$tablaProductos = "productos";
				$item = "id";
				$valor = $value["id"];
				$traerProducto = ModeloProductos::mldMostrarProductos($tablaProductos, $item, $valor);
				// var_dump($traerProducto["ventas"]);
				$item1a = "ventas";
				$valor1a = $value["cantidad"] + $traerProducto["ventas"];

				$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

				$item1b = "stock";
				$valor1b = $value["stock"];

				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);
			}
			/*=============================================
			=           ACTUALIZAR COMPRAS DEL CLIENTE   =
			=============================================*/
			$tablaClientes = "clientes";
			$item = "id";
			$valor = $_POST["seleccionarCliente"];
			$traerCliente = ModeloClientes::mldMostrarClientes($tablaClientes, $item, $valor);

			$item1a = "compras";
			$valor1a = array_sum($totalProductosComprados)  + $traerCliente["compras"];
			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);


			date_default_timezone_set('America/Asuncion');
			$fechaActual = date('Y-m-d');
			$horaActual = date('H:i:s');
			$fechaActual = $fechaActual.' '.$horaActual;
			$item1b = "ultima_compra";
			$valor1b = $fechaActual;
			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

			/*=============================================
			=   GUARDAR VENTA   =
			=============================================*/
			$tabla = "ventas";
			$datos = array("id_vendedor" => $_POST["idVendedor"],
							"id_cliente" => $_POST["seleccionarCliente"],
							"codigo" => $_POST["nuevaVenta"],
							"productos" => $_POST["listaProductos"],
							"impuesto" => $_POST["nuevoPrecioImpuesto"],
							"neto" => $_POST["nuevoPrecioNeto"],
							"total" => $_POST["totalVenta"],
							"metodo_pago" => $_POST["listaMetodoPago"] );
			// var_dump($datos);
			$respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);
			if ($respuesta == "ok") {
				echo "<script>
					Swal.fire({
	  				icon: 'success',
	  				title: 'Venta generada correctamente!'
							}).then((result)=>{
								if(result.value){
									window.location = 'ventas';
								}
							})
				 </script>";
			}else{
				echo "No Ok";
			}
		}

	}
	/*=============================================
	=           EDITAR VENTAS          =
	=============================================*/
	static public function ctrEditarVenta(){
		if(isset($_POST["editarVenta"])){
			/*=============================================
			=  FORMATEAR TABLA PRODUCTOS Y CLIENTES  =
			=============================================*/
			$tabla = "ventas";
			$item = "codigo";
			$valor = $_POST["editarVenta"];
			// echo "valor ".$valor;
			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);
			// var_dump($traerVenta["productos"]);

			 $productos = json_decode($traerVenta["productos"], true);
			// var_dump($productos);
			$totalProductosComprados = array();
			/*recorre los productos de la tabla ventas que esta en el json*/
			foreach ($productos as $key => $value) {
			// echo "cantidad ".$value["cantidad"];
			// array para actualizar compras acumula la cantidad de los productos detalle de venta
			array_push($totalProductosComprados, $value["cantidad"]);

			$tablaProductos = "productos";
			$item = "id";
			$valor = $value["id"];
			$traerProducto = ModeloProductos::mldMostrarProductos($tablaProductos, $item, $valor);
			// var_dump($traerProducto);
			// echo "traerProducto ".$traerProducto["ventas"];
			// 		echo "value ".$value["cantidad"];
					$item1a = "ventas";
					$valor1a = $traerProducto["ventas"] - $value["cantidad"];
					$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);
				// echo "PONE PRODUCTO EN CERO <br>";
				$item1b = "stock";
				// echo "cantidad de ventas ". $value["cantidad"];
				// echo "cantidad de stock producto ". $traerProducto["stock"];
				$valor1b = $value["cantidad"] + $traerProducto["stock"];
				// echo "suma ".$valor1b;
				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);
				}
				// var_dump($totalProductosComprados);

	// $tablaClientes = "clientes";
	// $itemCliente = "id";
	// $valorCliente = $_POST["seleccionarCliente"];
	// $traerCliente = ModeloClientes::mldMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

	// 	$item1a = "compras";
	// 	$valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados) ;
	// 	$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);
	/*===FIN FORMATEAR TABLA PRODUCTOS Y CLIENTES  ==*/

			/*=============================================
			=           ACTUALIZAR PRODUCTOS   =
			=============================================*/
			$listaProductos_2 = json_decode($_POST["listaProductos"], true);
			// var_dump($listaProductos_2);
			/*ARRAY QUE ALMACENA LA CANTIDAD ENVIADA DESDE EL FORMUALARIO*/
			  $totalProductosComprados_2 = array();

			foreach ($listaProductos_2 as $key => $value) {
			array_push($totalProductosComprados_2, $value["cantidad"]);
				$tablaProductos_2 = "productos";
				$item_2 = "id";
				$valor_2 = $value["id"];
				$traerProducto_2 = ModeloProductos::mldMostrarProductos($tablaProductos_2, $item_2, $valor_2);
				// var_dump($traerProducto_2);

				$item1a_2 = "ventas";
				$valor1a_2 = $value["cantidad"] + $traerProducto_2["ventas"];
				// echo "Cantidad ".$value["cantidad"];
				// echo "ventas de la tabla prod ".$traerProducto_2["ventas"];
				$nuevasVentas_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1a_2, $valor1a_2, $valor_2);
				 // var_dump($nuevasVentas_2);

				$item1b_2 = "stock";
				$valor1b_2 = $value["stock"];
				$nuevoStock_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1b_2, $valor1b_2, $valor_2);
			}
			// var_dump($totalProductosComprados_2);
			/*=============================================
			=           ACTUALIZAR COMPRAS DEL CLIENTE   =
			=============================================*/
			// $tablaClientes_2 = "clientes";
			// $item_2 = "id";
			// $valor_2 = $_POST["seleccionarCliente"];
			// $traerCliente_2 = ModeloClientes::mldMostrarClientes($tablaClientes, $item, $valor);

			// $item1a_2 = "compras";
			// $valor1a_2 = array_sum($totalProductosComprados)  + $traerCliente["compras"];
			// $comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);
			// date_default_timezone_set('America/Asuncion');
			// $fechaActual_2 = date('Y-m-d');
			// $horaActual_2 = date('H:i:s');
			// $fechaActualb_2 = $fechaActual_2.' '.$horaActual_2;
			// $item1b_2 = "ultima_compra";
			// $valor1b_2 = $fechaActualb_2;
			// $comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

			/*==GUARDAR CAMBIOS DE LA COMPRA==*/
			if ($_POST["listaProductos"] != "") {
				$datos = array("id_vendedor" => $_POST["idVendedor"],
							"id_cliente" => $_POST["seleccionarCliente"],
							"codigo" => $_POST["editarVenta"],
							"productos" => $_POST["listaProductos"],
							"impuesto" => $_POST["nuevoPrecioImpuesto"],
							"neto" => $_POST["nuevoPrecioNeto"],
							"total" => $_POST["totalVenta"],
							"metodo_pago" => $_POST["listaMetodoPago"] );
		  // var_dump($datos);
			$respuesta = ModeloVentas::mdlEditarVenta($tabla, $datos);
			if ($respuesta == "ok") {
				echo "<script>
					Swal.fire({
	  				icon: 'success',
	  				title: 'Venta ha sido editada correctamente!'
							}).then((result)=>{
								if(result.value){
									window.location = 'ventas';
								}
							})
				 </script>";
					}else{
						echo "No Ok";
					}
			}else{
				echo "<script>
					Swal.fire({
	  				icon: 'error',
	  				title: 'Error en la lista de productos!',
					footer: '<a href>Contacte con el administador</a>'
							}).then((result)=>{
								if(result.value){
									window.location = 'ventas';
								}
							})
				 </script>";
			}

		}

	}
}