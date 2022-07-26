<?php
require_once "conexion.php";
class ModeloProveedor{
		static public function mdlEliminarProveedor($tabla, $item, $valor){

			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			if ($stmt->execute()) {
					//echo "ejecuto";
					return "ok";
				}else{
					//echo "no ejecuto";
					return "error";
				}

		$stmt -> close();
		$stmt = null;

	}
	/*MOSTRAR PROVEEDORES*/
	static public function mldMostrarProveedores($tabla, $item, $valor){
		if ($item != null) {
			// echo("TEST ".$valor);
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
			///echo "tabla ".$tabla;
			$stmt = Conexion::conectar()->prepare("SELECT * FROM  $tabla");
			$stmt -> execute();
			 return $stmt -> fetchAll();
			//var_dump($stmt -> fetchAll());
		}
		$stmt -> close();
		$stmt = null;

	}
	/*CREAR PROVEEDOR*/
	static public function mdlIngresarProveedor($tabla, $datos){
	$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(ruc, razon_social,telefono, direccion, correo, estado, totalcompra) VALUES (:ruc, :razon_social, :telefono, :direccion, :correo, :estado, :totalcompra)");

		$stmt->bindParam(":ruc", $datos["ruc"], PDO::PARAM_STR);
		$stmt->bindParam(":razon_social", $datos["razon_social"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":totalcompra", $datos["totalcompra"], PDO::PARAM_STR);

		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";
		}
		$stmt -> close();
		$stmt = null;

	}
	/*ACTUALIZAR Cliente*/
	static public function mdlEditarProveedor($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("UPDATE  $tabla set ruc =:ruc, razon_social =:razon_social, telefono =:telefono, direccion =:direccion, correo =:correo WHERE id_proveedor = :id_proveedor");

			$stmt -> bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_STR);
			$stmt -> bindParam(":ruc", $datos["ruc"], PDO::PARAM_STR);
			$stmt -> bindParam(":razon_social", $datos["razon_social"], PDO::PARAM_STR);
			$stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
			$stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
			$stmt -> bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
			if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}
		$stmt ->close();
		$stmt = null;
	}
}