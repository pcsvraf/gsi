<?php

require '../../core/conexion.php';

$db = new Conect_MySql();

$idSoli = $_POST['id'];
$numeroIngreso = $_POST['numeroIngreso'];
//$query1 = "select numeroIngreso from ingreso_procesado where numeroIngreso='$numeroIngreso'";

//$ejecuta1 = $db->execute($query1);

//$datos = $db->fetch_row($ejecuta1);

$query3 = "select numeroEgreso from egreso_procesado where idPeticion='$idSoli'";
$execute = $db->execute($query3);

//if (mysqli_num_rows($ejecuta1) != 0) {
//    echo '<script> alert("El número de Ingreso no se puede repetir"); history.back(); </script>';
//}else{
    $query = "insert into ingreso_procesado (id, idPeticion, numeroIngreso, numeroEgreso)"
        . "values"
        . "(null,"
        . "'{$idSoli}',"
        . "'{$numeroIngreso}',"
        . "'{$dato['numeroEgreso']}')";
$ejecuta = $db->execute($query);

$query2 = "update peticion set estado = 7 where id=". $idSoli;

$consulta2 = $db->execute($query2);

if ($ejecuta && $consulta2) {
    echo '<script type="text/javascript"> alert("Se realizó correctamente el Ingreso"); window.location.href="../historial_ingresos.php";</script>;';
} else {
    echo '<script type="text/javascript"> alert("Lo sentimos, ocurrió un problema :(") </script>;';
}

//}
?>

