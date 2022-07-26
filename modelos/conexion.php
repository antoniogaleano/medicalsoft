<?php
class Conexion{

	static public  function conectar(){
		/*CONEXION REMOTA*/
		// $link = new PDO(
		// 	"mysql:host=localhost; dbname=bancodeo_medical_db",
		// 	"bancodeo_antonio",
		// 	"bf[m%HmAzh]A");
		/*FIN CONEXION REMOTA*/
		/*LOCAL*/
		$link = new PDO(
			"mysql:host=localhost; dbname=optivision",
			"root",
			"");
		/*FIN LOCAL*/
		$link->exec("set names utf8");
		return $link;
	}
}