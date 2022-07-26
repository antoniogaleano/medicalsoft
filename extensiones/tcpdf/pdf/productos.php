<?php
require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

require_once "../../../controladores/empresas.controlador.php";
require_once "../../../modelos/empresas.modelo.php";

require_once "../../../controladores/categorias.controlador.php";
require_once "../../../modelos/categorias.modelo.php";
class imprimirProductos{
	public function mostrarProductos(){
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

           $itemPro = null;
           $valorPro = null;
           $productosCategoria = ControladorProductos::ctrMostrarResumen();
           // var_dump($productosCategoria);



		require_once('tcpdf_include.php');
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->AddPage('P','A4');
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
			<td style="background-color:white; width:110px; text-align:center; color:black"><br><br>PRODUCTOS</td>

		</tr>
	</table>
	<hr>
EOF;
$pdf->writeHTML($bloque1, false, false, false, false, '');
$bloque3 = <<<EOF
<h5>RESUMEN</h5>
<table style="font-size:9px; padding:2px 2px;">
<tr>
	<td style="border: 1px solid #666; background-color:white;; text-align:center">CATEGORIAS</td>
	<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">IMPORTE</td>
</tr>
</table>
EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');

$htmlBody =<<<EOF
	<table style="font-size:10px;">
EOF;
$totalGral = 0;
$totalFormato = 0;
foreach ($productosCategoria as $key => $value) {
$categoria =$value["categoria"];
$total =number_format($value["total"]);
$totalGral+= $value["total"];
$htmlBody .=<<<EOF
		<tr>
		<td>$categoria</td>
		<td style="width:80px; text-align:rigth;">$total</td>
	</tr>
EOF;
}
$totalFormato = number_format($totalGral);
$htmlBody .=<<<EOF
<tr>
<td style="width:350px; text-align:rigth;">----------------------------------</td>
</tr>
<tr>
<td style="width:350px; text-align:rigth;">TOTAL: $totalFormato</td>
</tr>
</table>
<hr>
EOF;
$pdf->writeHTML($htmlBody, false, false, false, false, '');

	ob_end_clean();
	$pdf->Output('cierre.pdf');
	}
}
$reporte = new imprimirProductos();
$reporte -> mostrarProductos();
?>