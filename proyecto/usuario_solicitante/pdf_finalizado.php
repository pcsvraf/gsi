<?php
ob_start();
require_once('../tcpdf/config/lang/eng.php');
require_once('../tcpdf/tcpdf.php');
require_once('../core/conexion.php');

$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('Voucher Inversión Finalizada'); //Titulo del pdf
$pdf->setPrintHeader(true); //No se imprime cabecera
$pdf->setPrintFooter(false); //No se imprime pie de pagina
$pdf->SetMargins(50, 40, 50, false); //Se define margenes izquierdo, alto, derecho
$pdf->SetAutoPageBreak(true, 20); //Se define un salto de pagina con un limite de pie de pagina
$pdf->setHeaderMargin(5);
$imagen = "logo.png";
$pdf->SetHeaderData($imagen, PDF_HEADER_LOGO_WIDTH, '', '');
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->addPage();
$htm = "<h1>Documento Inversión Finalizada</h1> <br>";

// print a block of text using Write()
$pdf->writeHTML($htm, true, false, true, false, '');

//$sql = "SELECT * FROM rescate ORDER BY id ASC";
//$cosas = $mysqli->query($sql);
$html = '';
$item = 1;

//datos soli
$idSoli = $_POST['id'];
$institucion = $_POST['institucion'];
$moneda = $_POST['tipoMoneda'];
$monto = $_POST['monto'];
$tipo = $_POST['tipo'];
$cuenta = $_POST['cuenta'];
$descripcion = $_POST['descripcion'];
$numeroEgreso = $_POST['egreso'];
$numeroIngreso = $_POST['ingreso'];
//datos rescate
$montoRescate = $_POST['montoRescatado'];
$rentabilidad = $_POST['rentabilidad'];
$fecha = $_POST['fechaRescate'];
//datos abono1
$institucion1 = $_POST['institucion1'];
$cuenta1 = $_POST['cuenta1'];
$abono1 = $_POST['abono1'];
//datos abono2
$institucion2 = $_POST['institucion2'];
$cuenta2 = $_POST['cuenta2'];
$abono2 = $_POST['abono2'];
//datos abono3
$institucion3 = $_POST['institucion3'];
$cuenta3 = $_POST['cuenta3'];
$abono3 = $_POST['abono3'];

//foreach ($cosas as $row) {
//$idpeticion = $row['idPeticion'];
//$monto = $row['monto'];
//$registro = date('d/m/Y', strtotime($row['cosa_registro']));
//$fechaRescate = $row['fechaRescate'];
//$porcentajeGanancia = $row['porcentajeGanancia'];
//$descrip = $row['descripcion'];
$html .= '<h1>Datos Solicitud</h1>
    <table border="1" cellpadding="5">
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
        <td>' . $institucion . '</td>
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
    <tr>
        <td bgcolor="#E6E6E6"><b>Número Ingreso: </b></td>
        <td>' . $numeroIngreso . '</td>
    </tr>

</table><br><br><br>';

$html2 .= '<h1>Datos Rescate</h1>
    <table border="1" cellpadding="5">
    <tr>
        <td width="100" bgcolor="#E6E6E6"><b>Monto: </b></td>
        <td width="220">' . $montoRescate . '</td>
    </tr>
    <tr>
        <td bgcolor="#E6E6E6"><b>Rentabilidad: </b></td>
        <td>' . $rentabilidad . '</td>
    </tr>
    <tr>
        <td bgcolor="#E6E6E6"><b>Fecha: </b></td>
        <td>' . $fecha . '</td>
    </tr>

</table><br><br><br>';

$html3 .= '<h1>Datos Abonos</h1>
    <table border="1" cellpadding="5">
    <tr>
        <td width="100" bgcolor="#E6E6E6"><b>Institución 1: </b></td>
        <td width="220">' . $institucion1 . '</td>
    </tr>
    <tr>
        <td bgcolor="#E6E6E6"><b>N° Cuenta: </b></td>
        <td>' . $cuenta1 . '</td>
    </tr>
    <tr>
        <td bgcolor="#E6E6E6"><b>Monto Abono: </b></td>
        <td>' . $abono1 . '</td>
    </tr>
    </table>';

$html4 .= '<table border="1" cellpadding="5">
        <tr>
        <td width="100" bgcolor="#E6E6E6"><b>Institución 2: </b></td>
        <td width="220">' . $institucion2 . '</td>
    </tr>
    <tr>
        <td bgcolor="#E6E6E6"><b>N° Cuenta: </b></td>
        <td>' . $cuenta2 . '</td>
    </tr>
    <tr>
        <td bgcolor="#E6E6E6"><b>Monto Abono: </b></td>
        <td>' . $abono2 . '</td>
    </tr>
    </table>';

$html5 .= '<table border="1" cellpadding="5">
    <tr>
        <td width="100" bgcolor="#E6E6E6"><b>Institución 3: </b></td>
        <td width="220">' . $institucion3 . '</td>
    </tr>
    <tr>
        <td bgcolor="#E6E6E6"><b>N° Cuenta: </b></td>
        <td>' . $cuenta3 . '</td>
    </tr>
    <tr>
        <td bgcolor="#E6E6E6"><b>Monto Abono: </b></td>
        <td>' . $abono3 . '</td>
    </tr>
    </table>';

$item = $item + 1;
//}

ob_end_clean();
$pdf->SetFont('Helvetica', '', 10);
$pdf->writeHTML($html, true, 0, true, 0);
$pdf->writeHTML($html2, true, 0, true, 0);
$pdf->writeHTML($html3, true, 0, true, 0);
$pdf->writeHTML($html4, true, 0, true, 0);
$pdf->writeHTML($html5, true, 0, true, 0);

$pdf->lastPage();
$pdf->output('Reporte.pdf', 'I');
?>
