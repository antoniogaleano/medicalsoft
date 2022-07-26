<?php
require_once "conexion.php";
class ModeloUsuarios{
	/*Editar Usuarios*/
	static public  function mdlEditarUsuario($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, password = :password, perfil = :perfil, foto = :foto WHERE usuario = :usuario");

		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt -> bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";
		}
		$stmt -> close();
		$stmt = null;
	}
	//Mostrar usuarios
	static public  function MdlMostrarUsuarios($tabla, $item, $valor){
		if ($item != null) {
			$stmt = Conexion::conectar()->prepare("select * from $tabla where $item = :$item");
			$stmt ->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			/*Devuelve una sola fila*/
			return $stmt ->fetch();
		}else{
			$stmt = Conexion::conectar()->prepare("select * from $tabla");
			$stmt -> execute();
			/*Devuelve una sola fila*/
			return $stmt ->fetchAll();
		}


		$stmt -> close();
		$stmt = null;
	}

	static public function mdlIngresarUsuario($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, usuario, password, perfil,foto,estado) VALUES (:nombre, :usuario, :password, :perfil,:foto, :estado)");
		$stmt ->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt ->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt ->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt ->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt ->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt ->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		// var_dump($stmt->execute());
		if ($stmt->execute()) {
			//echo "ejecuto";
			return "ok";
		}else{
			echo "no ejecuto";
			return "error";
		}
		$stmt ->close();
		$stmt = null;
	}
	/*ACTUALIZAR USAURIO*/
	static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla set $item1 = :$item1 WHERE $item2 =:$item2");
		$stmt ->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt ->bindParam(":".$item2, $valor2, PDO::PARAM_STR);
		if ($stmt->execute()) {
			//echo "ejecuto";
			return "ok";
		}else{
			echo "no ejecuto";
			return "error";
		}
		$stmt ->close();
		$stmt = null;
	}
	static public function mdlBorrarUsuario($tabla, $datos){
				$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
				$stmt ->bindParam(":id", $datos, PDO::PARAM_STR);
				if ($stmt->execute()) {
					//echo "ejecuto";
					return "ok";
				}else{
					//echo "no ejecuto";
					return "error";
				}
				$stmt ->close();
				$stmt = null;
	}

}
