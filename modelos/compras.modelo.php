<?php
require_once "conexion.php";
class ModeloCompras{
/*=============================================
		 MOSTRAR COMPRAS
	=============================================*/
	static public function mdlMostrarCompras($tabla, $item, $valor){
	if ($item != null) {

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE  $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();

		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		$stmt -> close();
		$stmt = null;
	}



/*=============================================
		 RangoFechasVentas
	=============================================*/
	static public function mdlRangoFechasCompras($tabla, $fechaInicial, $fechaFinal){
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
							INSERTAR COMPRA
			=============================================*/
			static public function mdlIngresarCompra($tabla, $datos){
				// var_dump($datos);
				$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_proveedor, id_usuario, fecha, factura, tipo, vencimiento, productos, impuesto, neto, total, estado, metodopago) VALUES (:id_proveedor, :id_usuario, :fecha, :factura, :tipo, :vencimiento, :productos, :impuesto, :neto, :total, :estado, :metodopago)");

					$stmt -> bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_STR);
					$stmt -> bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_STR);
					$stmt -> bindParam(":fecha",  $datos["fecha"], PDO::PARAM_STR);
					$stmt -> bindParam(":factura", $datos["factura"], PDO::PARAM_STR);
					$stmt -> bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
					$stmt -> bindParam(":vencimiento", $datos["vencimiento"], PDO::PARAM_STR);
					$stmt -> bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
					$stmt -> bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
					$stmt -> bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
					$stmt -> bindParam(":total", $datos["total"], PDO::PARAM_STR);
					$stmt -> bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
					$stmt -> bindParam(":metodopago", $datos["metodopago"], PDO::PARAM_STR);

					if($stmt -> execute()){
						return "ok";
					}else{
						return "error";
					}
					$stmt -> close();
					$stmt = null;
			}

/*=============================================
	EDITAR DE PRODUCTO
	=============================================*/
	static public function mdlEditarCompra($tabla, $datos){
		var_dump($datos);
		$stmt = Conexion::conectar()->prepare("UPDATE  $tabla SET  id_proveedor =:id_proveedor, id_usuario =:id_usuario, fecha =:fecha, factura =:factura, tipo = :tipo, vencimiento =:vencimiento, productos = :productos, impuesto =:impuesto , neto = :neto,  total =:total    WHERE id_compra = :id_compra ");

		$stmt->bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":factura", $datos["factura"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":vencimiento", $datos["vencimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":id_compra", $datos["id_compra"], PDO::PARAM_STR);
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}
	/*=============================================
	EDITAR DE PRODUCTO  CABECERA
	=============================================*/
	static public function mdlEditarCompraCabecera($tabla, $datos){
		var_dump($datos);
		$stmt = Conexion::conectar()->prepare("UPDATE  $tabla SET  id_proveedor =:id_proveedor, id_usuario =:id_usuario, fecha =:fecha, factura =:factura, tipo = :tipo, vencimiento =:vencimiento, impuesto =:impuesto , neto = :neto,  total =:total    WHERE id_compra = :id_compra ");

		$stmt->bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":factura", $datos["factura"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":vencimiento", $datos["vencimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":id_compra", $datos["id_compra"], PDO::PARAM_STR);
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}
	/*=============================================
		 ELIMINAR COMPRAS
	=============================================*/
	static public function mdlEliminarCompras($tabla, $item, $valor){
	$stmt = Conexion::conectar()->prepare("DELETE  FROM $tabla WHERE  $item = :$item");
				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				if($stmt->execute()){
					return "ok";
				}else{
					return "error";
				}
			$stmt -> close();
			$stmt = null;

	}
}
