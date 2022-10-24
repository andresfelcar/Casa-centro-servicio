<?php
@session_start();
require_once "controller/Controller.php";

$result = $_SESSION['user'];
if ($result == null) {
    header("Location:login.php");
}

$invoice =  new Controller();

$invoiceValues = $invoice->Invoices(0,array(3,$_GET['invoice_id']));	
	$itemsF_C=$invoiceValues[0]->fetch_row();

if(!empty($_GET['invoice_id']) && $_GET['invoice_id']) {
	$invoiceValues = $invoice->Invoices(0,array(3,$_GET['invoice_id']));	
	$itemsF_C=$invoiceValues[0]->fetch_row();
}


$output = '<table width="100%" height="200px" border="1" cellpadding="5" cellspacing="0">
	<tr>
	<td colspan="2">
	<table width="100%" cellpadding="5">
	<tr>
	<td width="65%">
	<h3>CASA CENTRO DE SERVICIO TECNICO</h3><br />
	<b>CLIENTE</b><br />
	Nombres : '.$itemsF_C[5].'<br />
	Telefono: '.$itemsF_C[6].'<br />
	Vendedor : '.$result[1].'<br />
	<b>Ventas por mostrador</b><br />
	</td>
	<td width="35%">         
	Orden de pedido No. : '.$itemsF_C[0].'<br />
	Fecha: '.$itemsF_C[1].'<br />
	Carlos E Rodriguez<br/>
	Cel: 3113510728<br/>
	Nit: 98620440-4<br/>        
	Direccion: Carre 53#58-78<br/>
	Medellin Antioquia<br/>   
	Casatecnico@Outlook.com</td>
	</tr>
	</td>
	</tr>
	</table>
	
	<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr>
	<th align="left">Item No.</th>
	<th align="left">Codigo</th>
	<th align="left">Nombre Producto</th>
	<th align="left">Cantidad</th>
	<th align="left">Precio</th>
	<th align="left">Total.</th> 
	</tr>';
$count = 0;
while($itemsD_P=$invoiceValues[1]->fetch_row()){   

	$count++;
	$output .= '
	<tr>
	<td align="left">'.$count.'</td>
	<td align="left">'.$itemsD_P[0].'</td>
	<td align="left">'.$itemsD_P[1].'</td>
	<td align="left">'.$itemsD_P[2].'</td>
	<td align="left">'.number_format($itemsD_P[3]).'</td>
	<td align="left">'.number_format($itemsD_P[2]*$itemsD_P[3]).'</td>   
	</tr>';
}
$output .= '
     <tr>
	<td align="left" colspan="5"><b>'.$itemsF_C[7].'</b></td>
	<td align="left"><b></b></td>
	</tr>
	<tr>
	<td align="right" colspan="5"><b>Sub-Total</b></td>
	<td align="left"><b>'.number_format($itemsF_C[2]).'</b></td>
	</tr>
	<tr>
	<td align="right" colspan="5">Cancelado Con:</td>
	<td align="left">'.number_format($itemsF_C[3]).'</td>
	</tr>
	<tr>
	<td align="right" colspan="5"><b>Vueltas:</b></td>
	<td align="left">'.number_format($itemsF_C[4]).'</td>
	</tr>';
$output .= '
	</table>
	</td>
	</tr>
	</table>';
// create pdf of invoice	
$invoiceFileName = 'Invoice-'.$itemsF_C[0].'.pdf';

require_once 'dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
// $dompdf->setPaper(array(0,0,454.33,478.90));
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));
?>
   