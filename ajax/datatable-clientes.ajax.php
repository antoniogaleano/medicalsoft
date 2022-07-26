<?php
require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class TablaCliente{
	static public function mostrarTablaCliente(){
		$item = null;
        $valor = null;
        $clientes = ControladorClientes::crtMostrarClientes($item, $valor);
		//echo json_encode($clientes);
		echo '{
			  "data": [';
			  for ($i=0; $i < count($clientes)-1 ; $i++) {
			  	echo '[
			  		"'.($i+1).'",
			      "'.$clientes[$i]["nombre"].'",
			      "'.$clientes[$i]["documento"].'",
			      "'.$clientes[$i]["email"].'",
			      "'.$clientes[$i]["telefono"].'",
			      "'.$clientes[$i]["direccion"].'",
			      "'.$clientes[$i]["fecha_nacimiento"].'",
			      "'.$clientes[$i]["compras"].'",
			      "'.$clientes[$i]["fecha"].'",
			      "'.$clientes[$i]["id"].'"
			    ],';
			  }
				echo '[
				      "'.count($clientes).'",
				      "'.$clientes[count($clientes)-1]["nombre"].'",
			      "'.$clientes[count($clientes)-1]["documento"].'",
			      "'.$clientes[count($clientes)-1]["email"].'",
			      "'.$clientes[count($clientes)-1]["telefono"].'",
			      "'.$clientes[count($clientes)-1]["direccion"].'",
			      "'.$clientes[count($clientes)-1]["fecha_nacimiento"].'",
			      "'.$clientes[count($clientes)-1]["compras"].'",
			      "'.$clientes[count($clientes)-1]["fecha"].'",
			      "'.$clientes[count($clientes)-1]["id"].'"
				    ]
				  ]
				}';

	}
}
/*=============================================
	ACTIVAR TABLA PRODUCTO  DE FORMA INMEDIATA
	=============================================*/
	$activar = new TablaCliente();
	$activar -> mostrarTablaCliente();