<?php

include '../core/conexion.php';
$db = new Conect_MySql();
$idsoli = $_POST['id'];
$moneda = $_POST["moneda"];

$institucion = $_POST['institucion'];
$otro = $_POST['otrainsti'];
for ($i = 0; $i < count($institucion); $i++) {
    $insti = $institucion[$i];
}
if ($institucion[$i] == 'otro1') {
    $dato = $otro;
} else {
    $dato = $insti;
}

for ($i = 0; $i < count($moneda); $i++) {
    $moneda[$i];
    $monedasi = $moneda[$i];
}
$tipo = $_POST["tipo"];
for ($i = 0; $i < count($tipo); $i++) {
    $tipo[$i];
    $tiposi = $tipo[$i];
}
$cuentaCheque = $_POST['cuentaCargo'];
$radio = $_POST['radios'];
$cuenta = $_POST['cuenta'];

if ($radio == 1) {
    $cuenta = "   (cuenta)";
}
$sql = "update peticion set ";
$sql .= "institucion='" . $dato . "', ";
$sql .= "tipoMoneda='" . $monedasi . "', ";
$sql .= "monto='$_POST[monto]', ";
$sql .= "tipoSolicitud='" . $tiposi . "', ";
$sql .= "cuentaCheque='" . $cuentaCheque . "',";
$sql .= "descripcion='" . $_POST["descripcion"] . "',";
$sql .= "tasaMensual='" . $_POST["tasa"] . "',";
$sql .= "cuentaOcheque='" . $cuenta . "'";
$sql .= "where id = " . $_POST["id"];
$ejecutar = $db->execute($sql);
if ($ejecutar) {
    header('Location: https://pcspucv.cl/gsi/proyecto/usuario_solicitante/editar_peticiones_vista.php');
} else {
    echo "no se actualizaron los campos";
}
$db->close_db();
?>
