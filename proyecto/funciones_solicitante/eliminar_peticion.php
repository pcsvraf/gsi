<?php
include '../core/conexion.php';
$db = new Conect_MySql();
$idSoli = $_GET['id'];
$sql = "delete from peticion where id=" . $idSoli;
$solicitud = $db->execute($sql) or die("Error al eliminar Peticion". mysqli_error($db));
if ($solicitud) {
    header('Location: https://pcspucv.cl/gsi/proyecto/usuario_solicitante/editar_peticiones_vista.php');
} else {
    echo "no se actualizaron los campos";
}
?>
