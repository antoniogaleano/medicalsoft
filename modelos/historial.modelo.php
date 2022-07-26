<?php
require_once "conexion.php";
class ModeloHistorial{
static public function mdlInsertarHistorial($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id,fecha,motivo,esf_od,esf_oi,cilindro_od,cilindro_oi,eje_od,eje_oi,adicion_od,adicion_oi,dnp_od,dnp_oi,di,alt,monofocal,monofocal_descri,estuche,bifocal,bifocal_descri,progesivo,progresivo_descri,armazon,doctor,retiro,total,anticipo,receta,id_usuario) VALUES (:id,:fecha,:motivo,:esf_od,:esf_oi,:cilindro_od,:cilindro_oi,:eje_od,:eje_oi,:adicion_od,:adicion_oi,:dnp_od,:dnp_oi,:di,:alt,:monofocal,:monofocal_descri,:estuche,:bifocal,:bifocal_descri,:progesivo,:progresivo_descri,:armazon,:doctor,:retiro,:total,:anticipo,:receta, :id_usuario)");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":motivo", $datos["motivo"], PDO::PARAM_STR);
		$stmt->bindParam(":esf_od", $datos["esf_od"], PDO::PARAM_STR);
		$stmt->bindParam(":esf_oi", $datos["esf_oi"], PDO::PARAM_STR);
		$stmt->bindParam(":cilindro_od", $datos["cilindro_od"], PDO::PARAM_STR);
		$stmt->bindParam(":cilindro_oi", $datos["cilindro_oi"], PDO::PARAM_STR);
		$stmt->bindParam(":eje_od", $datos["eje_od"], PDO::PARAM_STR);
		$stmt->bindParam(":eje_oi", $datos["eje_oi"], PDO::PARAM_STR);
		$stmt->bindParam(":adicion_od", $datos["adicion_od"], PDO::PARAM_STR);
		$stmt->bindParam(":adicion_oi", $datos["adicion_oi"], PDO::PARAM_STR);
		$stmt->bindParam(":dnp_od", $datos["dnp_od"], PDO::PARAM_STR);
		$stmt->bindParam(":dnp_oi", $datos["dnp_oi"], PDO::PARAM_STR);
		$stmt->bindParam(":di", $datos["di"], PDO::PARAM_STR);
		$stmt->bindParam(":alt", $datos["alt"], PDO::PARAM_STR);
		$stmt->bindParam(":monofocal", $datos["monofocal"], PDO::PARAM_STR);
		$stmt->bindParam(":monofocal_descri", $datos["monofocal_descri"], PDO::PARAM_STR);
		$stmt->bindParam(":estuche", $datos["estuche"], PDO::PARAM_STR);
		$stmt->bindParam(":bifocal", $datos["bifocal"], PDO::PARAM_STR);
		$stmt->bindParam(":bifocal_descri", $datos["bifocal_descri"], PDO::PARAM_STR);
		$stmt->bindParam(":progesivo", $datos["progesivo"], PDO::PARAM_STR);
		$stmt->bindParam(":progresivo_descri", $datos["progresivo_descri"], PDO::PARAM_STR);
		$stmt->bindParam(":armazon", $datos["armazon"], PDO::PARAM_STR);
		$stmt->bindParam(":doctor", $datos["doctor"], PDO::PARAM_STR);
		$stmt->bindParam(":retiro", $datos["retiro"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":anticipo", $datos["anticipo"], PDO::PARAM_STR);
		$stmt->bindParam(":receta", $datos["receta"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_STR);
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}

static public function mldMostrarHistorial($tabla, $item, $valor){
	if ($item != null) {
				  $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE   $item = :$item");
				   $stmt->bindParam(':'.$item, $valor, PDO::PARAM_STR);
				  $stmt -> execute();
				  return $stmt -> fetchAll();//para reporte
				 // return $stmt -> fetch(); //para agregar
		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM  $tabla");
			$stmt -> execute();
			 return $stmt -> fetchAll();
			}
		$stmt -> close();
		$stmt = null;
	}
	static public function mdlTraerHistorial($tabla, $item, $valor){
	if ($item != null) {
				  $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE   $item = :$item");
				   $stmt->bindParam(':'.$item, $valor, PDO::PARAM_STR);
				  $stmt -> execute();
				  // return $stmt -> fetchAll();//para reporte
				 return $stmt -> fetch(); //para agregar
		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM  $tabla");
			$stmt -> execute();
			 return $stmt -> fetchAll();
			}
		$stmt -> close();
		$stmt = null;
	}

	// mdlEditarHistorial


static public function mdlEditarHistorial($tabla, $datos){
	 // var_dump($datos);

	 	$stmt = Conexion::conectar()->prepare("UPDATE  $tabla SET  fecha = :fecha , motivo = :motivo , esf_od = :esf_od	, esf_oi = :esf_oi , cilindro_od = :cilindro_od , cilindro_oi = :cilindro_oi , eje_od = :eje_od , eje_oi = :eje_oi , adicion_od = :adicion_od , adicion_oi = :adicion_oi , dnp_od = :dnp_od , dnp_oi = :dnp_oi , di = :di , alt = :alt , monofocal = :monofocal , monofocal_descri = :monofocal_descri , estuche = :estuche , bifocal = :bifocal , bifocal_descri = :bifocal_descri , progesivo = :progesivo , progresivo_descri = :progresivo_descri , armazon = :armazon , doctor = :doctor , retiro= :retiro , total = :total , anticipo = :anticipo , id_usuario = :id_usuario WHERE   id_historial = :id_historial AND id = :id");
		$stmt->bindParam(":id_historial", $datos["id_historial"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":motivo", $datos["motivo"], PDO::PARAM_STR);
		 $stmt->bindParam(":esf_od", $datos["esf_od"], PDO::PARAM_STR);
		$stmt->bindParam(":esf_oi", $datos["esf_oi"], PDO::PARAM_STR);
		 $stmt->bindParam(":cilindro_od", $datos["cilindro_od"], PDO::PARAM_STR);
		$stmt->bindParam(":cilindro_oi", $datos["cilindro_oi"], PDO::PARAM_STR);
		$stmt->bindParam(":eje_od", $datos["eje_od"], PDO::PARAM_STR);
		$stmt->bindParam(":eje_oi", $datos["eje_oi"], PDO::PARAM_STR);
		$stmt->bindParam(":adicion_od", $datos["adicion_od"], PDO::PARAM_STR);
		$stmt->bindParam(":adicion_oi", $datos["adicion_oi"], PDO::PARAM_STR);
		$stmt->bindParam(":dnp_od", $datos["dnp_od"], PDO::PARAM_STR);
		$stmt->bindParam(":dnp_oi", $datos["dnp_oi"], PDO::PARAM_STR);
		$stmt->bindParam(":di", $datos["di"], PDO::PARAM_STR);
		$stmt->bindParam(":alt", $datos["alt"], PDO::PARAM_STR);
		$stmt->bindParam(":monofocal", $datos["monofocal"], PDO::PARAM_STR);
		$stmt->bindParam(":monofocal_descri", $datos["monofocal_descri"], PDO::PARAM_STR);
		$stmt->bindParam(":estuche", $datos["estuche"], PDO::PARAM_STR);
		$stmt->bindParam(":bifocal", $datos["bifocal"], PDO::PARAM_STR);
		$stmt->bindParam(":bifocal_descri", $datos["bifocal_descri"], PDO::PARAM_STR);
		$stmt->bindParam(":progesivo", $datos["progesivo"], PDO::PARAM_STR);
		$stmt->bindParam(":progresivo_descri", $datos["progresivo_descri"], PDO::PARAM_STR);
		$stmt->bindParam(":armazon", $datos["armazon"], PDO::PARAM_STR);
		$stmt->bindParam(":doctor", $datos["doctor"], PDO::PARAM_STR);
		$stmt->bindParam(":retiro", $datos["retiro"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":anticipo", $datos["anticipo"], PDO::PARAM_STR);
		// $stmt->bindParam(":receta", $datos["receta"], PDO::PARAM_STR);
		 $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_STR);
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}

	static public function mdlEliminarHistorial($tabla, $item, $valor){
$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item = :$item ");

		$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;
	}
	// mdlEliminarHistorial
}
