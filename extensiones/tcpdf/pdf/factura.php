
<?php
require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";
require_once "../../../controladores/empresas.controlador.php";
require_once "../../../modelos/empresas.modelo.php";
class imprimirFactura{
	public $codigo;
	public function traerImpresionFactura(){
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
		/*informacion de las ventas*/
		$itemVenta = "id";
		$valorVenta = $this->codigo;
		$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);
		$factura = $respuestaVenta["codigo"];
		$fecha = substr($respuestaVenta["fecha"],0,-8);
		$productos = json_decode($respuestaVenta["productos"], true);
		$neto =  number_format($respuestaVenta["total"] - $respuestaVenta["neto"] / 11,0)  ;
		$impuesto = number_format($respuestaVenta["neto"] / 11,0);
		$total = number_format($respuestaVenta["total"],0);

		//INFORMACION DE CLIENTE
		$itemCliente = "id";
		$valorCliente = $respuestaVenta["id_cliente"];
		$respuestaCliente = ControladorClientes::crtMostrarClientes($itemCliente, $valorCliente);
		///var_dump($respuestaCliente);
		//INFORMACION DE VENDEDOR
		$itemVendedor = "id";
		$valorVendedor = $respuestaVenta["id_vendedor"];
		$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);
		//CAJA DEL VENDEDOR
		 $item = "usuario";
		 $valor = $respuestaVendedor["id"];
		 $traeCaja = ControladorVentas::ctrMostrarCaja($item, $valor);
		 // var_dump($traeCaja);
		 $sucursal = $traeCaja["sucursal"];
		 $caja = $traeCaja["caja"];
		 $nroFactura = $sucursal."-".$caja."-".str_pad($factura, 7, "0000000", STR_PAD_LEFT);
		 // echo $nroFactura;


//REQUERIMOS LA CLASE TCPDF
require_once('tcpdf_include.php');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->AddPage('P','A7');
$bloque1=<<<EOF
	<table style="font-size:9px; text-align:center">
		<tr>
		<td style="width:160px;">
			<div>
			Fecha: $fecha<br>
			$denominacion<br>
			Ruc:$ruc<br>
			Tel: $tel<br>
			Dirección: $dir
			<br><br>
			FACTURA: $nroFactura<br>
			CLIENTE: $respuestaCliente[nombre]<br>
			VENDEDOR: $respuestaVendedor[nombre]<br>
			</div>
		</td>
		</tr>

	</table>
EOF;
$pdf->writeHTML($bloque1, false, false, false, false, '');
///*INICIO CONTENIDO*/
	foreach ($productos as $key => $itemx) {
		$valorUnitario = number_format($itemx["precio"],0);
		$precioTotal =number_format($itemx["total"],0);
		$bloque2 = <<<EOF

<table style="font-size:9px;">

	<tr>

		<td style="width:160px; text-align:left">
		$itemx[descripcion]
		</td>

	</tr>

	<tr>

		<td style="width:160px; text-align:right">
		Gs $valorUnitario Und * $itemx[cantidad]  = Gs $precioTotal
		<br>
		</td>

	</tr>

</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');
	// 	 $pdf->writeHTML($bloque2, false, false, false, false, '');
	}
///*FIN CONTENIDO*/
// ---------------------------------------------------------

$bloque3 = <<<EOF

<table style="font-size:9px; text-align:right">

	<tr>

		<td style="width:80px;">
			 NETO:
		</td>

		<td style="width:80px;">
			Gs $neto
		</td>

	</tr>

	<tr>

		<td style="width:80px;">
			 IMPUESTO:
		</td>

		<td style="width:80px;">
			Gs $impuesto
		</td>

	</tr>

	<tr>

		<td style="width:160px;">
		=============================
		</td>

	</tr>

	<tr>

		<td style="width:80px;">
			 TOTAL:
		</td>

		<td style="width:80px; bold">
			Gs $total
		</td>

	</tr>

	<tr>

		<td style="width:160px;">
			<br>

			Muchas gracias por su compra
		</td>
		</tr>

</table>



EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');
///*SALIDA DEL ARCHIVO*/
ob_end_clean();
$pdf->Output('factura.pdf');
	}
}
$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();
?>
