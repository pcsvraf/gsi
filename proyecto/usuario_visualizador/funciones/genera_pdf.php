<?php
require_once('../../tcpdf/config/lang/eng.php');
require_once('../../tcpdf/tcpdf.php');
require_once('../../core/conexion.php');

$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('Voucher Egreso Procesado'); //Titlo del pdf
$pdf->setPrintHeader(true); //No se imprime cabecera
$pdf->setPrintFooter(false); //No se imprime pie de pagina
$pdf->SetMargins(50, 40, 50, false); //Se define margenes izquierdo, alto, derecho
$pdf->SetAutoPageBreak(true, 20); //Se define un salto de pagina con un limite de pie de pagina
$pdf->setHeaderMargin(5);
$imagen = "logo.png";
$pdf->SetHeaderData($imagen, PDF_HEADER_LOGO_WIDTH, '', '');
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->addPage();
$htm = "<h1>Documento Egreso Procesado</h1> <br>";

// print a block of text using Write()
$pdf->writeHTML($htm, true, false, true, false, '');

//$sql = "SELECT * FROM rescate ORDER BY id ASC";
//$cosas = $mysqli->query($sql);
$html = '';
$item = 1;

    $idSoli = $_GET['id'];
    $insitucion = $_GET['insti'];
    $numeroEgreso = $_GET['numero'];
    $moneda = $_GET['moneda'];
    $monto = $_GET['monto'];
    $tipo = $_GET['tipo'];
    $cuenta = $_GET['cuenta'];
    $descripcion = $_GET['desc'];

//foreach ($cosas as $row) {
      
    //$idpeticion = $row['idPeticion'];
    //$monto = $row['monto'];
    //$registro = date('d/m/Y', strtotime($row['cosa_registro']));
    //$fechaRescate = $row['fechaRescate'];
    //$porcentajeGanancia = $row['porcentajeGanancia'];
    //$descrip = $row['descripcion'];
    $html .= '<table border="1" cellpadding="5">
    <tr>
        <td width="100" bgcolor="#E6E6E6"><b>ID solicitud: </b></td>
        <td width="220">' . $idSoli . '</td>
    </tr>
    <tr>
        <td bgcolor="#E6E6E6"><b>Número Egreso: </b></td>
        <td>' . $numeroEgreso . '</td>
    </tr>
    <tr>
        <td bgcolor="#E6E6E6"><b>Institución: </b></td>
        <td>' . $insitucion . '</td>
    </tr>
    <tr>
        <td bgcolor="#E6E6E6"><b>Tipo Moneda: </b></td>
        <td>' . $moneda . '</td>
    </tr>
    <tr>
        <td bgcolor="#E6E6E6"><b>Monto Inversión: </b></td>
        <td>' . $monto . '</td>
    </tr>
    <tr>
        <td bgcolor="#E6E6E6"><b>Tipo: </b></td>
        <td>' . $tipo . '</td>
    </tr>
     <tr>
        <td bgcolor="#E6E6E6"><b>N° Cuenta: </b></td>
        <td>' . $cuenta . '</td>
    </tr>
     <tr>
        <td bgcolor="#E6E6E6"><b>Descripción: </b></td>
        <td>' . $descripcion . '</td>
    </tr>

</table><br><br><br>';

    $item = $item + 1;
//}


$pdf->SetFont('Helvetica', '', 10);
$pdf->writeHTML($html, true, 0, true, 0);

$pdf->lastPage();
$pdf->output('Reporte.pdf', 'I');

?>
