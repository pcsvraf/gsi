<?php

include '../core/conexion.php';

$db = new Conect_MySql();

$idSoli = $_GET['id'];


$sql = "update peticion set estado = 3 where id=" . $idSoli;

$solicitud = $db->execute($sql);

if ($solicitud) {
    header("Location: ../usuario_autorizador/index.php");
} else {
    echo "ocurrio un error";
}


$db->close_db();
?>
