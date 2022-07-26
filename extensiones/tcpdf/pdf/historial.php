
<?php
require_once "../../../controladores/historial.controlador.php";
require_once "../../../modelos/historial.modelo.php";
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

			$item_h = "id_historial";
			$valor_h = $this->codigo;
			$historial = ControladorHistorial::ctrTraerHistorial($item_h, $valor_h);
			$cli = $historial["id"];
			$motivo = $historial["motivo"];
			$date = date_create($historial["fecha"]);
			$fecha = date_format($date, 'd/m/Y');
			// $retiro $hora
			$retirar = date_create($historial["retiro"]);
			$retiro = date_format($retirar, 'd/m/Y');
			$hora = date_format($retirar, 'H:i:s');
			$esfod = $historial["esf_od"];
			$esfoi = $historial["esf_oi"];

			$cilod =  $historial["cilindro_od"];
			$ciloi =  $historial["cilindro_oi"];

			$ejeod =  $historial["eje_od"];
			$ejeoi =  $historial["eje_oi"];

			$adod =  $historial["adicion_od"];
			$adoi =  $historial["adicion_oi"];
			$_dnpod =  $historial["dnp_od"];
			$_dnpoi =  $historial["dnp_oi"];

			$_di =  $historial["di"];
			$_alt =  $historial["alt"];
			$_mono_descri =  $historial["monofocal_descri"];
			$_estuche =  $historial["estuche"];
			$_bifocal_descri  =  $historial["bifocal_descri"];
			$_progresivo_descri =  $historial["progresivo_descri"];

			$_armazon = $historial["armazon"];
			$_doctor =  $historial["doctor"];
			$totalx = $historial["total"];
			$anticipo=  $historial["anticipo"];
			 $saldox =$totalx - $anticipo;
			 $saldo = number_format($saldox);
			 $total = number_format($totalx);

		//INFORMACION DE CLIENTE
		$itemCliente = "id";
		$valorCliente = $cli;
		$respuestaCliente = ControladorClientes::crtMostrarClientes($itemCliente, $valorCliente);
		$cliente =$respuestaCliente["nombre"];
		///var_dump($respuestaCliente);
		//INFORMACION DE VENDEDOR
		$itemVendedor = "id";
		$valorVendedor = $historial["id_usuario"];
		$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);



//REQUERIMOS LA CLASE TCPDF
require_once('tcpdf_include.php');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->startPageGroup();
$pdf->AddPage();
// ---------------------------------------------------------
$bloque1 = <<<EOF
	<table>
		<tr>
			<td style="width:150px"><img src="../../../$logo"></td>
			<td style="background-color:white; width:140px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">

					$denominacion
					<br>
					RUC: $ruc
					<br>
					Dirección: $dir
				</div>

			</td>
			<td style="background-color:white; width:140px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">

					Teléfono: $tel
					<br>
					$mail
				</div>

			</td>


		</tr>
	</table>
EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');
// ---------------------------------------------------------

$bloque2 = <<<EOF
	<table>
		<tr>
			<td style="width:540px"><img src="images/back.jpg"></td>
		</tr>
	</table>

	<table style="font-size:8px; padding:5px 10px;">
		<tr>
		<td style="border: 1px solid #666; background-color:white; width:390px">Cliente: $respuestaCliente[nombre]</td>
		<td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">Fecha:
		$fecha</td>
		</tr>
		<tr>
		<td style="border: 1px solid #666; background-color:white; width:240px">Vendedor: $respuestaVendedor[nombre]</td>
		<td style="border: 1px solid #666; background-color:white; width:300px">Motivo: $motivo</td>
		</tr>
		<tr>
		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>
		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

$bloque3 = <<<EOF
	<table style="font-size:8px; padding:5px 5px;">
		<tr>
		<td style="border: 1px solid #666; background-color:white; width:135px; text-align:center">Esferico</td>
		<td style="border: 1px solid #666; background-color:white; width:135px; text-align:center">Cilindro</td>
		<td style="border: 1px solid #666; background-color:white; width:135px; text-align:center">Eje</td>
		<td style="border: 1px solid #666; background-color:white; width:135px; text-align:center">Adición</td>
		</tr>
	</table>
EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');
$html = <<<EOF
	<table style="font-size:8px; padding:2px 5px;">
		<tr>
		<td style="border: 1px solid #666; background-color:white; width:135px; text-align:center">$esfod</td>
		<td style="border: 1px solid #666; background-color:white; width:135px; text-align:center">$cilod</td>
		<td style="border: 1px solid #666; background-color:white; width:135px; text-align:center">$ejeod</td>
		<td style="border: 1px solid #666; background-color:white; width:135px; text-align:center">$adod</td>

		</tr>
		<tr>

		<td style="border: 1px solid #666; background-color:white; width:135px; text-align:center">$esfoi</td>
		<td style="border: 1px solid #666; background-color:white; width:135px; text-align:center">$ciloi</td>
		<td style="border: 1px solid #666; background-color:white; width:135px; text-align:center">$ejeoi</td>
		<td style="border: 1px solid #666; background-color:white; width:135px; text-align:center">$adoi</td>

		</tr>

	</table>
<br>
<br>
EOF;

$pdf->writeHTML($html, false, false, false, false, '');
$html1 = <<<EOF
	<table style="font-size:8px; padding:5px 10px;">
		<tr>
		<td style="border: 1px solid #666; background-color:white; width:135px; text-align:center">DNP OD</td>
		<td style="border: 1px solid #666; background-color:white; width:135px; text-align:center">DNP OI</td>
		<td style="border: 1px solid #666; background-color:white; width:135px; text-align:center">DI</td>
		<td style="border: 1px solid #666; background-color:white; width:135px; text-align:center">ALT</td>
		</tr>

	</table>

EOF;
$pdf->writeHTML($html1, false, false, false, false, '');
$html2 = <<<EOF
	<table style="font-size:8px; padding:5px 10px;">
		<tr>
		<td style="border: 1px solid #666; background-color:white; width:135px; text-align:center">$_dnpod</td>
		<td style="border: 1px solid #666; background-color:white; width:135px; text-align:center">$_dnpoi</td>
		<td style="border: 1px solid #666; background-color:white; width:135px; text-align:center">$_di</td>
		<td style="border: 1px solid #666; background-color:white; width:135px; text-align:center">$_alt</td>
		</tr>
	</table>
EOF;
$pdf->writeHTML($html2, false, false, false, false, '');

$_monofocal = $historial["monofocal"];
if ($_monofocal) {
$html3 = <<<EOF
<br><br>
	<table style="font-size:8px; padding:5px 10px;">
		<tr>
		<td style="border: 1px solid #666; background-color:white; width:75px; text-align:center">MONOFOCAL</td>
		<td style="border: 1px solid #666; background-color:white; width:285px; text-align:left">$_mono_descri</td>
		<td style="border: 1px solid #666; background-color:white; width:180px; text-align:left">$_estuche</td>

		</tr>
	</table>
EOF;
$pdf->writeHTML($html3, false, false, false, false, '');
}

$_bifocal = $historial["bifocal"];
if ($_bifocal) {
$html3 = <<<EOF
<table style="font-size:8px; padding:5px 10px;">
		<tr>
		<td style="border: 1px solid #666; background-color:white; width:75px; text-align:center">BIFOCAL</td>
		<td style="border: 1px solid #666; background-color:white; width:465px; text-align:left">$_bifocal_descri</td>


		</tr>
	</table>
EOF;
$pdf->writeHTML($html3, false, false, false, false, '');
}
$_progresivo = $historial["progesivo"];
if ($_progresivo) {
$html4 = <<<EOF
<table style="font-size:8px; padding:5px 10px;">
		<tr>
		<td style="border: 1px solid #666; background-color:white; width:75px; text-align:center">PROGRESIVO</td>
		<td style="border: 1px solid #666; background-color:white; width:465px; text-align:left">$_progresivo_descri</td>
		</tr>
	</table>
EOF;
$pdf->writeHTML($html4, false, false, false, false, '');
}
// ---------------------------------------------------------

if ($_armazon != ''  &&  $_doctor != '') {
	 $html5 = <<<EOF
<br><br>
<table style="font-size:8px; padding:5px 10px;">
		<tr>
		<td style="border: 1px solid #666; background-color:white; width:270px; text-align:left">ARMAZON</td>
		<td style="border: 1px solid #666; background-color:white; width:270px; text-align:left">MEDICO</td>
		</tr>
	</table>
EOF;
$pdf->writeHTML($html5, false, false, false, false, '');
 $html6 = <<<EOF
<table style="font-size:8px; padding:5px 10px;">
		<tr>
		<td style="border: 1px solid #666; background-color:white; width:270px; text-align:left">$_armazon</td>
		<td style="border: 1px solid #666; background-color:white; width:270px; text-align:left">$_doctor</td>
		</tr>
	</table>
EOF;
$pdf->writeHTML($html6, false, false, false, false, '');
}else if($_armazon != ''  &&  $_doctor == ''){
	 $html5 = <<<EOF
<br><br>
<table style="font-size:8px; padding:5px 10px;">
		<tr>
		<td style="border: 1px solid #666; background-color:white; width:270px; text-align:left">ARMAZON</td>

		</tr>
	</table>
EOF;
$pdf->writeHTML($html5, false, false, false, false, '');
 $html6 = <<<EOF
<table style="font-size:8px; padding:5px 10px;">
		<tr>
		<td style="border: 1px solid #666; background-color:white; width:270px; text-align:left">$_armazon</td>

		</tr>
	</table>
EOF;
$pdf->writeHTML($html6, false, false, false, false, '');
}else if($_armazon == ''  &&  $_doctor != ''){
	 $html5 = <<<EOF
<br><br>
<table style="font-size:8px; padding:5px 10px;">
		<tr>
		<td style="border: 1px solid #666; background-color:white; width:270px; text-align:left">MEDICO</td>

		</tr>
	</table>
EOF;
$pdf->writeHTML($html5, false, false, false, false, '');
 $html6 = <<<EOF
<table style="font-size:8px; padding:5px 10px;">
		<tr>
		<td style="border: 1px solid #666; background-color:white; width:270px; text-align:left">$_doctor</td>

		</tr>
	</table>
EOF;
$pdf->writeHTML($html6, false, false, false, false, '');
}
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
		<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
			Retira:
		</td>
		<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
			$retiro $hora Hs
		</td>

		</tr>

		<tr>

		<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
			Saldo:
		</td>
		<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
			$saldo Gs.
		</td>

		</tr>

		<tr>

		<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
			Total:
		</td>
		<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
			$total Gs.
		</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');


ob_end_clean();
$pdf->Output($cliente.$fecha.'.pdf');
	}
}
$factura = new imprimirFactura();
$factura -> codigo = $_GET["id"];
$factura -> traerImpresionFactura();
?>
