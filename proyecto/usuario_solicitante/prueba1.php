<?php

$idSoli = $_POST['id'];
$montoIngresado = $_POST['monto'];
$monto = $_POST['montoRescatado'];

function dias_transcurridos($fechaAcep, $fechaRescate) {
        $dias = (strtotime($fechaAcep) - strtotime($fechaRescate)) / 86400;
        $dias = abs($dias);
        $dias = floor($dias);
        return $dias + 1;
    }
$diasTranscurridos = dias_transcurridos($fechaAcep, $fechaRescate);
    
$interes = ($monto - $montoIngresado);
$tasa = (($interes/$monto)*30)/$diasTranscurridos;
$tasaInteres = bcdiv($tasa, '1', 2);




?>