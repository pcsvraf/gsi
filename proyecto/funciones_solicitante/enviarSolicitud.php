<!DOCTYPE html>

<html>
    <head>

    </head>

    <body>
        <?php

        class EnviarDatos {

            public $dataForm;

            const ENVIAR_SOL = 1;

            function enviarSolicitud() {
                include '../core/conexion.php';

                if (isset($this->dataForm['enviar'])) {
                    $db = new Conect_MySql();
                    date_default_timezone_set("America/Santiago");
                    $fecha = getdate();
                    $dia = $fecha['mday'];
                    $mes = $fecha['mon'];
                    $anio = $fecha['year'];
                    $institucion = $this->dataForm['institucion'];
                    $otro = $this->dataForm['otrainsti'];
                    for ($i = 0; $i < count($institucion); $i++) {
                        $insti = $institucion[$i];
                    }
                    if ($insti == 'otro1') {
                        $dato = $otro;
                    } else {
                        $dato = $insti;
                    }
                    $estado = self::ENVIAR_SOL;
                    $moneda = $this->dataForm["moneda"];
                    for ($i = 0; $i < count($moneda); $i++) {
                        $moneda[$i];
                        $monedasi = $moneda[$i];
                    }
                    $tipo = $this->dataForm["tipo"];
                    for ($i = 0; $i < count($tipo); $i++) {
                        $tipo[$i];
                        $tiposi = $tipo[$i];
                    }
                    $desc = $this->dataForm['descripcion'];
                    $monto = $this->dataForm['monto'];
                    //$montofinal = number_format($monto,0,'',',');
                    $tasa = $this->dataForm['tasaMensual'];
                    $seleccion = $this->dataForm['cuentaCargo'];

                    $query = "SELECT id FROM peticion order by id DESC LIMIT 1";
                    $resultado = $db->execute($query);
                    $id = $db->fetch_row($resultado);
                    $ide = $id[0] + 1;

                    $sql = "insert into peticion (id, institucion, `tipoMoneda`,fechaSolicitud, estado, tipoSolicitud, `cuentaCheque`, descripcion, monto,`tasaMensual`)
                    values ('$ide', '$dato','$monedasi','$dia-$mes-$anio', '$estado', '$tiposi','$seleccion', '$desc', '$monto','$tasa')";

                    $isInsert = $db->execute($sql);

                    if ($isInsert) {
                        $text = 'true';
                        echo "<script>"
                        . "alerta($text);"
                        . "</script>";
                    } else {
                        echo "No se insertaron los datos";
                    }
                }
            }

            function setDataform($dataForm) {
                $this->dataForm = $dataForm;
            }

        }
        ?>

    </body>
    <script src="../js/funciones.js"></script>
</html>
