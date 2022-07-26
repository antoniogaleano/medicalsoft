<?php
require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";

class TablaProveedor{
	static public function mostrarTablaProveedores(){
		$item = null;
        $valor = null;
        $proveedores = ControladorProveedor::crtMostrarProveedores($item, $valor);
		//echo json_encode($clientes);
		echo '{
			  "data": [';
			  for ($i=0; $i < count($proveedores)-1 ; $i++) {
			  	echo '[
			  		"'.($i+1).'",
			      "'.$proveedores[$i]["razon_social"].'",
			      "'.$proveedores[$i]["ruc"].'",
			      "'.$proveedores[$i]["telefono"].'",
			      "'.$proveedores[$i]["direccion"].'",
			      "'.$proveedores[$i]["correo"].'",
			      "'.$proveedores[$i]["estado"].'",
			      "'.$proveedores[$i]["totalcompra"].'",
			      "'.$proveedores[$i]["id_proveedor"].'"
			    ],';
			  }
				echo '[
				      "'.count($proveedores).'",
				      "'.$proveedores[count($proveedores)-1]["razon_social"].'",
			      "'.$proveedores[count($proveedores)-1]["ruc"].'",
			      "'.$proveedores[count($proveedores)-1]["telefono"].'",
			      "'.$proveedores[count($proveedores)-1]["direccion"].'",
			      "'.$proveedores[count($proveedores)-1]["correo"].'",
			      "'.$proveedores[count($proveedores)-1]["estado"].'",
			      "'.$proveedores[count($proveedores)-1]["totalcompra"].'",
			      "'.$proveedores[count($proveedores)-1]["id_proveedor"].'"
				    ]
				  ]
				}';

	}
}

/*=============================================
	ACTIVAR TABLA PRODUCTO  DE FORMA INMEDIATA
	=============================================*/
	$activar = new TablaProveedor();
	$activar -> mostrarTablaProveedores();