<?php
require_once "conexion.php";
class ModeloProductos{
static public function mldMostrarProductosResumen(){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM v_productos_total");
			$stmt -> execute();
			 return $stmt -> fetchAll();

		$stmt -> close();
		$stmt = null;
	}
	static public function mldMostrarProductosReporte($tabla, $item, $valor){
	if ($item != null) {
				  $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE   $item = :$item");
				   $stmt->bindParam(':'.$item, $valor, PDO::PARAM_STR);
				  $stmt -> execute();
				  return $stmt -> fetchAll();//para reporte
				  //return $stmt -> fetch(); //para agregar
		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM  $tabla");
			$stmt -> execute();
			 return $stmt -> fetchAll();
			}
		$stmt -> close();
		$stmt = null;
	}
	static public function mldMostrarProductos($tabla, $item, $valor){
	if ($item != null) {
				  $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE   $item = :$item");
				   $stmt->bindParam(':'.$item, $valor, PDO::PARAM_STR);
				  $stmt -> execute();
				  //return $stmt -> fetchAll();//para reporte
				  return $stmt -> fetch(); //para agregar
		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM  $tabla");
			$stmt -> execute();
			 return $stmt -> fetchAll();
			}
		$stmt -> close();
		$stmt = null;
	}
	/*=============================================
	REGISTRO DE PRODUCTO
	=============================================*/
	static public function mdlIngresarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_categoria, codigo, descripcion, barcode, imagen, stock, precio_compra, precio_venta, ventas) VALUES (:id_categoria, :codigo, :descripcion, :barcode, :imagen, :stock, :precio_compra, :precio_venta, :ventas)");

		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":barcode", $datos["barcode"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);
		$stmt->bindParam(":ventas", $datos["ventas"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}
	/*=============================================
	EDITAR DE PRODUCTO
	=============================================*/
	static public function mdlEditarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE  $tabla SET id_categoria = :id_categoria, descripcion = :descripcion, barcode = :barcode, imagen = :imagen , stock = :stock, precio_compra = :precio_compra , precio_venta = :precio_venta WHERE codigo = :codigo ");

		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":barcode", $datos["barcode"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);
		// $stmt->bindParam(":ventas", $datos["ventas"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}
	/*========================================
	=            BORRAR PRODUCTOS            =
	========================================*/
	static public function mdlEliminarProducto($tabla, $datos){
$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id ");

		$stmt->bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;
	}
	/*=====  End of BORRAR PRODUCTOS  ======*/
	/*ACTUALIZAR USAURIO*/
	static public function mdlActualizarProducto($tabla, $item1, $valor1, $valor){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla set $item1 = :$item1 WHERE id =:id");
		$stmt ->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt ->bindParam(":id", $valor, PDO::PARAM_STR);
		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}
		$stmt ->close();
		$stmt = null;
	}
}