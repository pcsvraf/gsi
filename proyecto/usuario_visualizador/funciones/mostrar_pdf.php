<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Archivo</title>
        <style type="text/css">
            .embed-container {
                position: relative;
                padding-bottom: 56.25%;
                height: 0;
                overflow: hidden;
            }
            .embed-container iframe {
                position: absolute;
                top:0;
                left: 0;
                width: 100%;
                height: 100%;
            }

        </style>
    </head>
    <body>
        <?php
        include '../../core/conexion.php';


        $db = new Conect_MySql();
        $var1 = $_GET['var1'];

        $sql = "select * from abonos where idPeticion = " . $_GET['id'] . " limit 1";
        $datos = $db->execute($sql)->fetch_assoc();
        if ($datos['estado'] == 6) {
            ?>
            <div class="embed-container">
                <iframe width="1200" height="630" src="../../usuario_solicitante/archivos_abono/<?php echo $datos['nombre_archivo']; ?>" frameborder="0" allowfullscreen>
                </iframe>

                <?php
            } elseif ($var1 == 1) {
                ?>
                <iframe width="1200" height="630" src="../../usuario_solicitante/archivos_abono/<?php echo $datos['nombre_archivo']; ?>" frameborder="0" allowfullscreen>
                </iframe> 

                <?php
            } elseif ($var1 == 2) {
                ?>
                <iframe width="1200" height="630" src="../../usuario_solicitante/archivos_abono/<?php echo $datos['nombre_archivo2']; ?>" frameborder="0" allowfullscreen>
                </iframe>
            <?php } else if ($var1 == 3) { ?>
                <iframe width="1200" height="630" src="../../usuario_solicitante/archivos_abono/<?php echo $datos['nombre_archivo3']; ?>" frameborder="0" allowfullscreen>
                </iframe>
            <?php
            } else {
                ?>
                <p>NO tiene archivos</p>

                <?php
            }
            ?>
        </div>
    </body>
</html>


