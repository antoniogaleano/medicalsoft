<?php
require_once "conexion.php";
	class ModeloEmpresas{
			static public function mdlMostrarEmpresas($tabla, $item, $valor){
		//echo "item ".$item;
		if ($item != null) {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
			 // echo "tabla ".$tabla." item ".$item." valor ".$valor;
			$stmt = Conexion::conectar()->prepare("SELECT * FROM  $tabla");
			$stmt -> execute();
			 return $stmt -> fetchAll();
			//var_dump($stmt -> fetchAll());
		}
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlIngresarEmpresa($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(denominacion  , ruc ,telefono , direccion ,correo ,logo ) VALUES (:denominacion  , :ruc ,:telefono , :direccion ,:correo ,:logo )");
		$stmt ->bindParam(":denominacion", $datos["denominacion"], PDO::PARAM_STR);
		$stmt ->bindParam(":ruc", $datos["ruc"], PDO::PARAM_STR);
		$stmt ->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt ->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt ->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$stmt ->bindParam(":logo", $datos["logo"], PDO::PARAM_STR);
		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}
		$stmt ->close();
		$stmt = null;
	}
	static public function mdlEditarEmpresa($tabla, $datos){
		var_dump($datos);
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET denominacion =:denominacion, ruc = :ruc, telefono = :telefono, direccion = :direccion, correo = :correo, logo = :logo WHERE id_empresa = :id_empresa");
		$stmt ->bindParam(":denominacion", $datos["denominacion"], PDO::PARAM_STR);
		$stmt ->bindParam(":ruc", $datos["ruc"], PDO::PARAM_STR);
		$stmt ->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt ->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt ->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$stmt ->bindParam(":logo", $datos["logo"], PDO::PARAM_STR);
		$stmt ->bindParam(":id_empresa", $datos["id_empresa"], PDO::PARAM_STR);
		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}
		$stmt ->close();
		$stmt = null;
	}
	}