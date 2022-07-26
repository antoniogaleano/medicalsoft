<?php
require_once "conexion.php";
class ModeloVentas{
/*=============================================
		 RangoFechasVentas
	=============================================*/
	static public function mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal){
	if ($fechaInicial == null) {
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY fecha DESC");
		$stmt -> execute();
		return $stmt -> fetchAll();
		}else if($fechaInicial == $fechaFinal){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE   fecha like '%$fechaFinal%'");
			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetchAll();

		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE   fecha BETWEEN '$fechaInicial' and '$fechaFinal'");

			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		$stmt -> close();
		$stmt = null;
	}
/*=============================================
							MOSTRAR VENTAS DIARIAS
	=============================================*/
	static public function mdlMostrarVentasDiarias($tabla, $item, $valor){
		// echo "iTEM ".$item;
		 // echo "Valor ".$valor;
	if ($item != null) {
	$stmt = Conexion::conectar()->prepare("SELECT sum(neto) as neto FROM $tabla WHERE   $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");
		$stmt -> execute();
		return $stmt -> fetchAll();
		}
		$stmt -> close();
		$stmt = null;
	}
	/*=============================================
							MOSTRAR DETALLE VENTAS
	=============================================*/
	static public function mdlMostrarDetalleVentas($tabla, $item, $valor){
	if ($item != null) {
	$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");
		$stmt -> execute();
		return $stmt -> fetchAll();
		}
		$stmt -> close();
		$stmt = null;
	}
	/*=============================================
							MOSTRAR VENTA
	=============================================*/
	static public function mdlMostrarVentas($tabla, $item, $valor){
	if ($item != null) {
	$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");
		$stmt -> execute();
		return $stmt -> fetchAll();
		}
		$stmt -> close();
		$stmt = null;
	}
	/*=============================================
							MOSTRAR CIERRE
	=============================================*/
	static public function mdlMostrarCierre($tabla, $item, $valor){
	if ($item != null) {
  		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE   fecha = :fecha");
		$stmt->bindParam(':fecha', $valor, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetchAll();
		}
		$stmt -> close();
		$stmt = null;
	}
			/*=============================================
							INSERTAR VENTA
			=============================================*/
			static public function mdlIngresarVenta($tabla, $datos){
				$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, id_cliente, id_vendedor, productos, impuesto, neto, total, metodo_pago) VALUES (:codigo, :id_cliente, :id_vendedor, :productos, :impuesto, :neto, :total, :metodo_pago)");

					$stmt -> bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
					$stmt -> bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_STR);
					$stmt -> bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_STR);
					$stmt -> bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
					$stmt -> bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
					$stmt -> bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
					$stmt -> bindParam(":total", $datos["total"], PDO::PARAM_STR);
					$stmt -> bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);

					if($stmt -> execute()){
						return "ok";
					}else{
						return "error";
					}
					$stmt -> close();
					$stmt = null;
			}
/*====	EDITAR VENTA ====*/
			static public function mdlEditarVenta($tabla, $datos){
				$stmt = Conexion::conectar()->prepare("UPDATE  $tabla set id_cliente = :id_cliente, id_vendedor = :id_vendedor, productos = :productos, impuesto = :impuesto, neto = :neto, total = :total, metodo_pago = :metodo_pago WHERE codigo = :codigo");

					$stmt -> bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
					$stmt -> bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_STR);
					$stmt -> bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_STR);
					$stmt -> bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
					$stmt -> bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
					$stmt -> bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
					$stmt -> bindParam(":total", $datos["total"], PDO::PARAM_STR);
					$stmt -> bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);

					if($stmt -> execute()){
						return "ok";
					}else{
						return "error";
					}
					$stmt -> close();
					$stmt = null;
			}
			/*ELIMINAR VENTAS*/
			static public function mdlEliminarVenta($tabla, $itemb, $valorb){
				$stmt = Conexion::conectar()->prepare("DELETE FROM  $tabla  WHERE  $itemb = :$itemb");
					$stmt -> bindParam(":".$itemb, $valorb, PDO::PARAM_STR);

					if($stmt -> execute()){
						return "ok";
					}else{
						return "error";
					}
					$stmt -> close();
					$stmt = null;
			}

	/*=============================================
							MOSTRAR CAJA
	=============================================*/
	static public function mdlMostrarCaja($tabla, $item, $valor){
	if ($item != null) {
	$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item and estado = 'ACTIVO'");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");
		$stmt -> execute();
		return $stmt -> fetchAll();
		}
		$stmt -> close();
		$stmt = null;
	}
	/*=============================================
							ACTUALIZAR FACTURA CAJA
	=============================================*/
	static public function mdlActualizarCaja($tabla, $item, $valor,$itemB, $valorB){
		// $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item =:$item  WHERE $itemB = :$itemB");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":".$itemB, $valorB, PDO::PARAM_STR);
		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";
		}
		$stmt -> close();
		$stmt = null;

}
}