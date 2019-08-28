<?php

require '../../core/conexion.php';

$db = new Conect_MySql();

$idSoli = $_POST['id'];

$numeroEgreso = $_POST['numeroEgreso'];

//$query1 = "select numeroEgreso from egreso_procesado where numeroEgreso='$numeroEgreso'";

//$ejecuta = $db->execute($query1);

//$datos = $db->fetch_row($ejecuta1);

//if (mysqli_num_rows($ejecuta) != 0) {
//   echo '<script> alert("El número de egreso no se puede repetir"); history.back(); </script>';
//}else {
    $query = "insert into egreso_procesado (id, idPeticion, numeroEgreso)"
            . "values"
            . "(null,"
            . "'{$idSoli}',"
            . "'{$numeroEgreso}')";

    $consulta1 = $db->execute($query);

    $query2 = "update peticion set estado = 6 where id=" . $idSoli;

    $consulta2 = $db->execute($query2);

    if ($consulta1 && $consulta2) {
        echo '<script type="text/javascript"> alert("Se realizó correctamente el Egreso");window.location.href="../historial_egresos.php";</script>;';
    } else {
        echo '<script type="text/javascript"> alert("Lo sentimos, ocurrió un problema :(") </script>;';
    }
//}
?>