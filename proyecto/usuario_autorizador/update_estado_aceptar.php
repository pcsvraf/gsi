<?php

include '../core/conexion.php';

$db = new Conect_MySql();

$idSoli = $_GET['id'];

$fecha = getdate();
$dia = $fecha['mday'];
$mes = $fecha['mon'];
$anio = $fecha['year'];

$sql = "update peticion set estado = 2, `fechaAutorizacion` = '$dia-$mes-$anio' where id=" . $idSoli;

$solicitud = $db->execute($sql);

if ($solicitud) {
    header("Location: ../usuario_autorizador/index.php");
} else {
    echo "ocurrio un error";
}


$db->close_db();
?>
