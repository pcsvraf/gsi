<?php

include '../core/conexion.php';

$db = new Conect_MySql();

date_default_timezone_set("America/Santiago");
$idSoli = $_POST['id'];
$monto = $_POST['montoRescatado'];
$insitucion = $_POST['institucion'];
$i = '%';
$o = '-';
$fechaRescate = $_POST['fechaRescate'];
$tipoMoneda = $_POST['tipoMoneda'];
$tipoSoli = $_POST['tipo'];
$descripcion = $_POST['descripcion'];


$abono1 = $_POST['abono1'];
$cuenta1 = $_POST['cuenta1'];
$institucion1 = $_POST['institucion'];
$otraInsti1 = $_POST['otrainsti1'];
for ($i = 0; $i < count($institucion1); $i++) {
    $insti = $institucion1[$i];
}
if ($insti == 'otro1') {
    $insti1 = $otraInsti1;
} else {
    $insti1 = $insti;
}
$abono2 = $_POST['abono2'];
$abono3 = $_POST['abono3'];
$consulta = "select monto, fechaAutorizacion from peticion where id=". $idSoli;
$ejec = $db->execute($consulta);
$dat = $db->fetch_row($ejec);
$fechaAcep = $dat['fechaAutorizacion'];

function dias_transcurridos($fechaAcep, $fechaRescate) {
        $dias = (strtotime($fechaAcep) - strtotime($fechaRescate)) / 86400;
        $dias = abs($dias);
        $dias = floor($dias);
        return $dias;
    }
$diasTranscurridos = dias_transcurridos($fechaAcep, $fechaRescate);
    
$montoI = $dat['monto']; 
$interes = ($monto - $montoI);
$tasa = (($interes/$montoI)*30/$diasTranscurridos);
$tasaInteres = round($tasa * 100, 2);

if (empty($abono2) && empty($abono3)) {
    if ($monto > $abono1 || $monto < $abono1) {
        echo '<script language="javascript">alert("El monto abonado debe ser igual al monto rescatado!"); history.back(); </script>;';
    } else if ($abono1 == $monto) {
        if ($montoI < $monto) {
            $resultado = ($monto - $montoI);
            $seleccion = $resultado;
        } elseif ($montoI > $monto) {
            $resultado = ($montoI - $monto);
            $seleccion = $o . $resultado;
        } elseif ($montoI == $monto) {
            $seleccion = 0;
        }
        $nombre = $_FILES['archivo1']['name'];
        $prefix = "doc_";
        $ext = explode(".", $nombre)[1];
        $realName = uniqid($prefix, TRUE) . '.' . $ext;
        $ruta = $_FILES['archivo1']['tmp_name'];
        $destino = "..//usuario_solicitante/archivos_abono/" . $nombre;
        $sql = "insert into abonos (id, idPeticion, institucion, numeroCuenta, montoAbono, nombre_archivo, nombre_random, rentabilidad)"
                . "values"
                . "(null,"
                . "'{$idSoli}',"
                . "'{$insti1}',"
                . "'{$cuenta1}',"
                . "'{$abono1}',"
                . "'{$nombre}',"
                . "'{$realName}',"
                . "'{$seleccion}')";
        $execute = $db->execute($sql);
        $rescate = "insert into rescate (id, idPeticion, estado, tipoSolicitud, descripcion, monto, fechaRescate, montoRescatado, diasTranscurridos, tasaInteresMensual)"
                . "values"
                . "(null,"
                . "'{$idSoli}',"
                . "'4',"
                . "'{$tipoSoli}',"
                . "'{$descripcion}',"
                . "'{$montoI}',"
                . "'{$fechaRescate}',"
                . "'{$monto}',"
                . "'{$diasTranscurridos}',"
                . "'{$tasaInteres}')";
        $execute2 = $db->execute($rescate);
        if ($execute && $execute2) {
            $sql2 = "update peticion set estado = 4 where id=" . $idSoli;
            $query = $db->execute($sql2);
            echo '<script languaje="javascript">alert("Se realizó correctamente el rescate!"); window.location.href ="../usuario_solicitante/historial_solicitudes.php?idEstado=0"; </script>';
        } else {
            echo '<script languaje="javascript">alert("lo sentimos, algo salió mal!"); </script>';
        }
    }
} else if (!empty($abono2) && empty($abono3)) {
    $abonoDos = ($abono1 + $abono2);
    if ($abonoDos < $monto || $abonoDos > $monto) {
        echo '<script language="javascript">alert("El monto abonado debe ser igual al monto rescatado!"); history.back(); </script>;';
    } else if ($abonoDos == $monto) {
        $cuenta2 = $_POST['cuenta2'];
        $institucion2 = $_POST['institucion2'];
        $otraInsti2 = $_POST['otrainsti2'];
        for ($i = 0; $i < count($institucion2); $i++) {
            $instiDos = $institucion2[$i];
        }
        if ($instiDos == 'otro2') {
            $insti2 = $otraInsti2;
        } else {
            $insti2 = $instiDos;
        }
        if ($montoI < $monto) {
            $resultado = ($monto - $montoI);
            $seleccion = $resultado;
        } elseif ($montoI > $monto) {
            $resultado = ($montoI - $monto);
            $seleccion = $o . $resultado;
        } elseif ($montoI == $monto) {
            $seleccion = 0;
        }
        //archivo 1
        $nombre1 = $_FILES['archivo1']['name'];
        $prefix1 = "doc_";
        $ext1 = explode(".", $nombre1)[1];
        $realName1 = uniqid($prefix1, TRUE) . '.' . $ext1;
        $ruta1 = $_FILES['archivo1']['tmp_name'];
        $destino1 = "..//usuario_solicitante/archivos_abono/" . $nombre1;
        move_uploaded_file($ruta1, $destino1);
        //archivo2
        $nombre2 = $_FILES['archivo2']['name'];
        $prefix2 = "doc_";
        $ext2 = explode(".", $nombre2)[1];
        $realName2 = uniqid($prefix2, TRUE) . '.' . $ext2;
        $ruta2 = $_FILES['archivo2']['tmp_name'];
        $destino2 = "..//usuario_solicitante/archivos_abono/" . $nombre2;
        $sql = "insert into abonos (id, idPeticion, institucion, numeroCuenta, montoAbono, nombre_archivo"
                . ", nombre_random, institucion2, numeroCuenta2, montoAbono2, nombre_archivo2, nombre_random2, rentabilidad)"
                . "values"
                . "(null,"
                . "'{$idSoli}',"
                . "'{$insti1}',"
                . "'{$cuenta1}',"
                . "'{$abono1}',"
                . "'{$nombre1}',"
                . "'{$realName1}',"
                . "'{$insti2}',"
                . "'{$cuenta2}',"
                . "'{$abono2}',"
                . "'{$nombre2}',"
                . "'{$realName2}',"
                . "'{$seleccion}')";
        $execute = $db->execute($sql);
        $rescate = "insert into rescate (id, idPeticion, estado, tipoSolicitud, descripcion, monto, fechaRescate, montoRescatado, diasTranscurridos, tasaInteresMensual)"
                . "values"
                . "(null,"
                . "'{$idSoli}',"
                . "'4',"
                . "'{$tipoSoli}',"
                . "'{$descripcion}',"
                . "'{$montoI}',"
                . "'{$fechaRescate}',"
                . "'{$monto}',"
                . "'{$diasTranscurridos}',"
                . "'{$tasaInteres}')";
        $execute2 = $db->execute($rescate);

        if ($execute && $execute2) {
            $sql2 = "update peticion set estado = 4 where id=" . $idSoli;
            $query = $db->execute($sql2);
            echo '<script languaje="javascript">alert("Se realizó correctamente el rescate!"); window.location.href ="../usuario_solicitante/historial_solicitudes.php?idEstado=0";</script>';
        } else {
            echo '<script languaje="javascript">alert("lo sentimos, algo salió mal!");</script>';
        }
    }
} else if (!empty($abono2) && !empty($abono3)) {
    $abonoTres = ($abono1 + $abono2 + $abono3);
    if ($abonoTres < $monto || $abonoTres > $monto) {
        echo '<script language="javascript">alert("El monto abonado debe ser igual al monto rescatado!"); history.back(); </script>;';
    } else if ($abonoTres == $monto) {
        $cuenta2 = $_POST['cuenta2'];
        $institucion2 = $_POST['institucion2'];
        $otraInsti2 = $_POST['otrainsti2'];
        for ($i = 0; $i < count($institucion2); $i++) {
            $instiDos = $institucion2[$i];
        }
        if ($instiDos == 'otro2') {
            $insti2 = $otraInsti2;
        } else {
            $insti2 = $instiDos;
        }
        $cuenta3 = $_POST['cuenta3'];
        $institucion3 = $_POST['institucion3'];
        $otraInsti3 = $_POST['otrainsti3'];
        for ($i = 0; $i < count($institucion3); $i++) {
            $instiTres = $institucion3[$i];
        }
        if ($instiTres == 'otro3') {
            $insti3 = $otraInsti3;
        } else {
            $insti3 = $instiTres;
        }
        if ($montoI < $monto) {
            $resultado = ($monto - $montoI);
            $seleccion = $resultado;
        } elseif ($montoI > $monto) {
            $resultado = ($montoI - $monto);
            $seleccion = $o . $resultado;
        } elseif ($montoI == $monto) {
            $seleccion = 0;
        }
        //archivo 1
        $nombre1 = $_FILES['archivo1']['name'];
        $prefix1 = "doc_";
        $ext1 = explode(".", $nombre1)[1];
        $realName1 = uniqid($prefix1, TRUE) . '.' . $ext1;
        $ruta1 = $_FILES['archivo1']['tmp_name'];
        $destino1 = "..//usuario_solicitante/archivos_abono/" . $nombre1;
        move_uploaded_file($ruta1, $destino1);
        //archivo2
        $nombre2 = $_FILES['archivo2']['name'];
        $prefix2 = "doc_";
        $ext2 = explode(".", $nombre2)[1];
        $realName2 = uniqid($prefix2, TRUE) . '.' . $ext2;
        $ruta2 = $_FILES['archivo2']['tmp_name'];
        $destino2 = "..//usuario_solicitante/archivos_abono/" . $nombre2;
        move_uploaded_file($ruta2, $destino2);
        //archivo3
        $nombre3 = $_FILES['archivo3']['name'];
        $prefix3 = "doc_";
        $ext3 = explode(".", $nombre3)[1];
        $realName3 = uniqid($prefix3, TRUE) . '.' . $ext3;
        $ruta3 = $_FILES['archivo3']['tmp_name'];
        $destino3 = "..//usuario_solicitante/archivos_abono/" . $nombre3;
        $sql = "insert into abonos (id, idPeticion, institucion, numeroCuenta, montoAbono, nombre_archivo,"
                . "nombre_random, institucion2, numeroCuenta2, montoAbono2, nombre_archivo2, nombre_random2,"
                . "institucion3, numeroCuenta3, montoAbono3, nombre_archivo3, nombre_random3, rentabilidad)"
                . "values"
                . "(null,"
                . "'{$idSoli}',"
                . "'{$insti1}',"
                . "'{$cuenta1}',"
                . "'{$abono1}',"
                . "'{$nombre1}',"
                . "'{$realName1}',"
                . "'{$insti2}',"
                . "'{$cuenta2}',"
                . "'{$abono2}',"
                . "'{$nombre2}',"
                . "'{$realName2}',"
                . "'{$insti3}',"
                . "'{$cuenta3}',"
                . "'{$abono3}',"
                . "'{$nombre3}',"
                . "'{$realName3}',"
                . "'{$seleccion}')";
        $execute = $db->execute($sql);
        $rescate = "insert into rescate (id, idPeticion, estado, tipoSolicitud, descripcion, monto, fechaRescate, montoRescatado, diasTranscurridos, tasaInteresMensual)"
                . "values"
                . "(null,"
                . "'{$idSoli}',"
                . "'4',"
                . "'{$tipoSoli}',"
                . "'{$descripcion}',"
                . "'{$montoI}',"
                . "'{$fechaRescate}',"
                . "'{$monto}',"
                . "'{$diasTranscurridos}',"
                . "'{$tasaInteres}')";
        $execute2 = $db->execute($rescate);
        // $ejecuta3 && $ejecuta1 && $ejecuta2 &&
        if ($execute && $execute2) {
            $sql2 = "update peticion set estado = 4 where id=" . $idSoli;
            $query = $db->execute($sql2);
            echo '<script languaje="javascript">alert("Se realizó correctamente el rescate!"); window.location.href ="../usuario_solicitante/historial_solicitudes.php?idEstado=0";</script>';
        } else {
            echo '<script languaje="javascript">alert("lo sentimos, algo salió mal!");</script>';
        }
    }
}
?>