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

        $sql = "select * from peticion where id = " . $_GET['id'] . " limit 1";
        $datos = $db->execute($sql)->fetch_assoc();
        if ($datos['nombre_archivo'] != '') {
            ?>
        <div class="embed-container">
            <iframe width="1200" height="630" src="../../usuario_solicitante/archivos/<?php echo $datos['nombre_archivo']; ?>" frameborder="0" allowfullscreen>
            </iframe>
        
        <?php  }else { ?>
            <p>NO tiene archivos</p>

            <?php
        }
        ?>
    </body>
</html>
