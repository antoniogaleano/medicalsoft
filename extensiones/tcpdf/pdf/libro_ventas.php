<?php
require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";
require_once "../../../controladores/empresas.controlador.php";
require_once "../../../modelos/empresas.modelo.php";
class imprimirCierre{
	public $fecha;
	 public function mostrarCierre(){
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

		$itemCierre = "fecha";
       	$valorCierre = $_GET["fechaInicial"];
       	$fechaCierre = date('d/m/Y',strtotime($valorCierre));
       	$traeCierre   = ControladorVentas::ctrMostrarCierre($itemCierre, $valorCierre);
       	// var_dump($traeCierre);
		//REQUERIMOS LA CLASE TCPDF
		require_once('tcpdf_include.php');
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->AddPage('P','A4');

		/*=================================
		=            CONTENIDO            =
		=================================*/
$bloque1 = <<<EOF
	<table>
		<tr>
			<td style="width:150px"><img src="../../../$logo"></td>
			<td style="background-color:white; width:140px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">

					<br>
					$denominacion
					<br>
					RUC: $ruc
					<br>
					Dirección: $dir
				</div>

			</td>
			<td style="background-color:white; width:140px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					<br>
					Teléfono: $tel
					<br>
					$mail
				</div>

			</td>
			<td style="background-color:white; width:110px; text-align:center; color:black"><br><br>CIERRE NRO<br>$fechaCierre</td>

		</tr>
	</table>
EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');
$bloque3 = <<<EOF
<table style="font-size:9px; padding:2px 2px;">
<tr>
	<td style="border: 1px solid #666; background-color:white; width:60px; text-align:center">FECHA</td>
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">FACTURA</td>
		<td style="border: 1px solid #666; background-color:white; width:60px; text-align:center">RUC</td>
		<td style="border: 1px solid #666; background-color:white; width:160px; text-align:center">CLIENTE</td>
		<td style="border: 1px solid #666; background-color:white; width:60px; text-align:center">IVA</td>
		<td style="border: 1px solid #666; background-color:white; width:60px; text-align:center">GRAVADAS</td>
		<td style="border: 1px solid #666; background-color:white; width:60px; text-align:center">TOTAL</td>
		</tr>
</table>
EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');
$htmlBody =<<<EOF
	<table style="font-size:10px;">
EOF;
$totalGral = 0;
$totalFormato = 0;
foreach ($traeCierre as $key => $value) {
$factura = $value["codigo"];
$fechaFactura = $value["f"];
$ruc = $value["ruc"];
$cliente = $value["cliente"];
$imp = number_format($value["imp"]);
$total = number_format($value["total"]);
$gravadas = number_format($value["total"]  -  $value["imp"]) ;
$totalGral+= $value["total"];
$htmlBody .=<<<EOF
		<tr>
		<td style="width:60px;">$fechaFactura</td>
		<td style="width:90px;">$factura</td>
		<td style="width:60px;">$ruc</td>
		<td style="width:160px;">$cliente</td>
		<td style="width:60px;"> $imp</td>
		<td style="width:60px;">$gravadas</td>
		<td style="width:60px;">$total</td>
		</tr>
EOF;
}
$totalFormato = number_format($totalGral);
$htmlBody .=<<<EOF
	</table>
	<hr>
EOF;
$pdf->writeHTML($htmlBody, false, false, false, false, '');
/*=====  End of CONTENIDO  ======*/
$bloque5 = <<<EOF
	<table style="font-size:10px; padding:5px 10px;">
		<tr>
		<td style="color:#333; background-color:white; width:340px; text-align:center"></td>
		<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center">
		</td>
		<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
		</td>
		</tr>
		<tr>
		<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
		Total:
		</td>
		<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
			Gs $totalFormato
		</td>
		</tr>
	</table>
EOF;
$pdf->writeHTML($bloque5, false, false, false, false, '');

ob_end_clean();
$pdf->Output('cierre.pdf');
	}
}
$reporte = new imprimirCierre();
$reporte -> fecha = $_GET["fechaInicial"];
$reporte -> mostrarCierre();
?>