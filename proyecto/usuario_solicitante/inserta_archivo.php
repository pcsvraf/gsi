<?php

include '../core/conexion.php';

$db = new Conect_MySql();
$idSoli = $_POST['id'];


if (isset($_POST['archivo'])) {
    $nombre = $_FILES['archivo']['name'];
    $tipo = $_FILES['archivo']['type'];
    $tamanio = $_FILES['archivo']['size'];
    $prefix = "doc_";
    $ext = explode(".", $nombre)[1];
    $ruta = $_FILES['archivo']['tmp_name'];
    $destino = "..//usuario_solicitante/archivos/" . $nombre;
    $realName = uniqid($prefix, TRUE) . '.' . $ext;
    if ($nombre != "") {
        if (move_uploaded_file($ruta, $destino)) {
            $sql = "INSERT INTO archivo(tamanio,tipo,nombre_archivo,nombre_random,id_soli) VALUES('$tamanio','$tipo','$nombre','$realName','$idSoli')";
            $isInsert = $db->execute($sql);

            if ($isInsert) {
                $text = 'true';
            }
            echo "<script>"
            . "mostrarAlerta($text);"
            . "</script>";
        } else {
            echo "Error";
        }
    }
}else
{
    echo 'no se inserto su archivo';
}
?>