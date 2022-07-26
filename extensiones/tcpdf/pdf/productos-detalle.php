<?php
require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

require_once "../../../controladores/empresas.controlador.php";
require_once "../../../modelos/empresas.modelo.php";

require_once "../../../controladores/categorias.controlador.php";
require_once "../../../modelos/categorias.modelo.php";

class imprimirProductos{
	public $codigo;
	public $print;
	public function mostrarProductos(){
		$print = $_GET["id"];

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

           if ($print != "") {
			$itemPro = "id_categoria";
           $valorPro = $print;
           $productos = ControladorProductos::crtMostrarProductosReporte($itemPro, $valorPro);

           $itemCat = "id";
           $valorCat = $print;
           $categorias = ControladorCategorias::ctrMostrarCategoria($itemCat, $valorCat);
           $categoriaDescripcion = $categorias["categoria"];

			}else{
			$itemProa = null;
           $valorProb = null;
           $productos = ControladorProductos::crtMostrarProductosReporte($itemProa, $valorProb);
		}

	$totalGral = 0;
	$totalFormato = 0;

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
			<td style="font-size:9px; background-color:white; width:110px; text-align:center; color:black"><br><br>CATEGORIAS
			<br>$categoriaDescripcion</td>

		</tr>
	</table>
	<hr>
EOF;
$pdf->writeHTML($bloque1, false, false, false, false, '');
$bloque3 = <<<EOF
<h5>DETALLE</h5>
<table style="font-size:9px; padding:2px 2px;">
<tr>
	<td style="border: 1px solid #666; background-color:white; width:290px; text-align:center">PRODUCTOS</td>
	<td style="border: 1px solid #666; background-color:white; width:40px; text-align:center">STOCK</td>
	<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">PRECIO UN</td>
	<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">TOTAL</td>
</tr>
</table>
EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');

$htmlBody =<<<EOF
	<table style="font-size:10px;">
EOF;

foreach ($productos as $key => $value) {
$productos =$value["descripcion"];
$stock =$value["stock"];
$precio =number_format($value["precio_compra"]);
$total = number_format($value["stock"]  * $value["precio_compra"]);
$totalGral+=  $value["stock"]  * $value["precio_compra"] ;
$htmlBody .=<<<EOF
		<tr>
		<td style="width:240px;">$productos</td>
		<td style="width:80px; text-align:rigth;">$stock</td>
		<td style="width:80px; text-align:rigth;">$precio</td>
		<td style="width:80px; text-align:rigth;">$total</td>
	</tr>
EOF;
}
$totalFormato = number_format($totalGral);
$htmlBody .=<<<EOF
<tr>
<td style="width:480px; text-align:rigth;">----------------------------------</td>
</tr>
<tr>
<td style="width:480px; text-align:rigth;">TOTAL: Gs. $totalFormato</td>
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
$reporte -> codigo = $_GET["id"];
$reporte -> mostrarProductos();
?>