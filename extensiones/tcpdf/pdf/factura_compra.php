<?php
require_once "../../../controladores/compras.controlador.php";
require_once "../../../modelos/compras.modelo.php";

require_once "../../../controladores/proveedores.controlador.php";
require_once "../../../modelos/proveedores.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

require_once "../../../controladores/empresas.controlador.php";
require_once "../../../modelos/empresas.modelo.php";
class imprimirFacturaCompra{
	  // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
	public $codigo;
	public function traerImpresionFacturaCompra(){

			$itemEmp = null;
          	$valorEmp = null;
          	$empresa = ControladorEmpresas::ctrMostrarEmpresa($itemEmp, $valorEmp);
          	foreach ($empresa as $key => $value) {}
              $id =$value["id_empresa"];
              $denominacion = $value["denominacion"];
              $ruc =$value["ruc"];
              $dir = $value["direccion"];
              $logo  =$value["logo"];
              $tel = $value["telefono"];
              $mail = $value["correo"];

		 	$itemCompra = "id_compra";
			$valorCompra = $this->codigo;
			$respuestaCompra= ControladorCompras::ctrMostrarCompra($itemCompra, $valorCompra);

			$factura = $respuestaCompra["factura"];
			// $fecha = substr($respuestaCompra["fecha"],0,-8);
			$fecha = $respuestaCompra["fecha"];
			$productos = json_decode($respuestaCompra["productos"], true);
			$impuesto =  number_format(($respuestaCompra["total"])/ (11)) ;
			$netoCompra = number_format(($respuestaCompra["total"]) - ($respuestaCompra["total"])/ (11),0);

		// $impuesto =
			$total = number_format($respuestaCompra["total"]);
			// var_dump($respuestaCompra);
			$itemProv = "id_proveedor";
			$valorProv = $respuestaCompra["id_proveedor"];
			$respuestaProv = ControladorProveedor::crtMostrarProveedores($itemProv,$valorProv);
			// var_dump($respuestaProv);

			//REQUERIMOS LA CLASE TCPDF
			require_once('tcpdf_include.php');
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			$pdf->startPageGroup();
			// $pdf->AddPage();
			$pdf->AddPage('P', 'A4');
			 $pdf->Cell(0, 0, 'Detalle de factura de compra', 1, 1, 'C');
// $bloque1 = <<<EOF

// EOF;
$bloque2 = <<<EOF

	<table>
		<tr>
			<td style="width:540px"><img src="images/back.jpg"></td>

		</tr>
	</table>

	<table style="font-size:8px;padding:5px 5px; ">

		<tr>

		<td style="border: 1px solid #666; background-color:white; width:290px">Proveedor: $respuestaProv[razon_social]</td>
		<td style="border: 1px solid #666; background-color:white; width:140px">Factura: $factura</td>
		<td style="border: 1px solid #666; background-color:white; width:110px; text-align:right">Fecha:
		$fecha</td>

		</tr>

		<tr>



		</tr>

		<tr>

		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');


$bloque3 = <<<EOF

	<table style="font-size:8px; padding:5px 8px;">

		<tr>

		<td style="border: 1px solid #666; background-color:white; width:290px; text-align:center">Producto</td>
		<td style="border: 1px solid #666; background-color:white; width:50px; text-align:center">Cant</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Unit.</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Total</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');
foreach ($productos as $key => $item) {
	$itemProducto = "descripcion";
	$valorProducto = $item["descripcion"];
	$orden = null;
	$respuestaProducto = ControladorProductos::crtMostrarProductos($itemProducto, $valorProducto, $orden);

	$precioUnidad = number_format($respuestaProducto["precio_compra"], 0);

	$precioTotal = number_format($item["total"]);
$bloque4 = <<<EOF
	<table style="font-size:8px; padding:5px 5px;">

		<tr>

		<td style="border: 1px solid #666; color:#333; background-color:white; width:290px; text-align:left">
		$item[descripcion]
		</td>
		<td style="border: 1px solid #666; color:#333; background-color:white; width:50px; text-align:center">
		$item[cantidad]
		</td>
		<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">Gs
		$precioUnidad
		</td>
		<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">Gs
		 $precioTotal
		</td>

		</tr>

	</table>
EOF;
$pdf->writeHTML($bloque4, false, false, false, false, '');
}
$pdf->writeHTML($bloque1, false, false, false, false, '');
$bloque5 = <<<EOF

	<table style="font-size:8px; padding:5px 10px;">

		<tr>

		<td style="color:#333; background-color:white; width:340px; text-align:center"></td>

		<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center">

		</td>
		<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">

		</td>

		</tr>

		<tr>

		<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

		<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
			Neto:
		</td>
		<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
		Gs	$netoCompra
		</td>

		</tr>

		<tr>

		<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
			Impuesto:
		</td>
		<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
			Gs $impuesto
		</td>

		</tr>

		<tr>

		<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
			Total:
		</td>
		<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
			Gs $total
		</td>

		</tr>

	</table>

EOF;


$pdf->writeHTML($bloque5, false, false, false, false, '');
ob_end_clean();
$pdf->Output('factura_compra.pdf');
}
}
$facturaCompra = new imprimirFacturaCompra();
$facturaCompra -> codigo = $_GET["codigo"];
$facturaCompra -> traerImpresionFacturaCompra();
 ?>