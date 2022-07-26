<?php
require_once   "../controladores/categorias.controlador.php";
require_once   "../modelos/categorias.modelo.php";

class AjaxCategorias{
		/*EDITAR CATEGORIA*/
		/* var */
		public $idCategoria;
		public function ajaxEditarCategoria(){
			/*campo de la tabla*/
			$item = "id";
			/*valor de la variable var*/
			$valor = $this->idCategoria;
			/*se solicita una respuesta al controlador clase::metodo()*/
			$respuesta = ControladorCategorias::ctrMostrarCategoria($item, $valor);
			echo json_encode($respuesta);
		}


}
/*FUERA DE LA CLASE*/
/*OBJETO QUE VA A RECIBIR EL POST*/
/*$_POST["idCategoria"] viene por post del ajax ejecutado en el  archivo categoria js*/
if (isset($_POST["idCategoria"])) {
	/*si la variable post tiene algun valor entra en esta seccion
	y se crea una nueva instancia de la clase ajax AjaxCategorias
	*/
	$categoria = new AjaxCategorias();
	/*Se ingresa al valor por medio del post a la variable publica mas arriba comentado como var*/
	$categoria -> idCategoria = $_POST["idCategoria"];
	/*Aqui se ejecuta el metodo editar*/
	$categoria ->ajaxEditarCategoria();
}