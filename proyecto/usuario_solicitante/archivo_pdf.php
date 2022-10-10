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
        include '..//core/conexion.php';

        $db = new Conect_MySql();
        $var1 = $_GET['var1'];
        $n = $_GET['n'];
        $sql = "select * from peticion where id = " . $_GET['id'] . " limit 1";
        $sql2 = "select * from abonos where idPeticion = " . $_GET['id'] . " limit 1";
        $datos = $db->execute($sql)->fetch_assoc();
        $abono = $db->execute($sql2)->fetch_assoc();
        if ($datos['estado'] == 6 || $datos['estado'] == 2) {
            ?>
            <div class="embed-container">
                <iframe width="1200" height="630" src="../usuario_solicitante/archivos/<?php echo $datos['nombre_archivo']; ?>" frameborder="0" allowfullscreen>
                </iframe>

                <?php
            } elseif ($datos['estado'] == 4 && $var1 == 1) {
                ?>
                <iframe width="1200" height="630" src="../usuario_solicitante/archivos/<?php echo $datos['nombre_archivo']; ?>" frameborder="0" allowfullscreen>
                </iframe> 

                <?php
            } elseif ($datos['estado'] == 4 && $var1 == 2) {
                ?>
                <iframe width="1200" height="630" src="../usuario_solicitante/archivos/<?php echo $datos['nombre_archivo2']; ?>" frameborder="0" allowfullscreen>
                </iframe>

                <?php
            } elseif ($datos['estado'] == 5 && $var1 == 2) {
                ?>
                <iframe width="1200" height="630" src="../usuario_solicitante/archivos/<?php echo $datos['nombre_archivo2']; ?>" frameborder="0" allowfullscreen>
                </iframe>

            <?php } elseif ($datos['estado'] == 5 && $var1 == 1) { ?>
                <iframe width="1200" height="630" src="../usuario_solicitante/archivos/<?php echo $datos['nombre_archivo']; ?>" frameborder="0" allowfullscreen>
                </iframe>
            </div>
        <?php } else if ($datos['estado'] == 7 && $var1 == 1) { ?>
            <iframe width="1200" height="630" src="../usuario_solicitante/archivos/<?php echo $datos['nombre_archivo']; ?>" frameborder="0" allowfullscreen>
            </iframe>
        <?php } else if ($datos['estado'] == 7 && $var1 == 2) { ?>
            <iframe width="1200" height="630" src="../usuario_solicitante/archivos/<?php echo $datos['nombre_archivo2']; ?>" frameborder="0" allowfullscreen>
            </iframe>
        <?php } else if ($datos['estado'] == 7 && $var1 == 3) {
            ?>
            <iframe width="1200" height="630" src="../usuario_solicitante/archivos_abono/<?php echo $abono['nombre_archivo']; ?>" frameborder="0" allowfullscreen>
            </iframe>
            <?php } else if ($datos['estado'] == 7 && $var1 == 4) {
            ?>
            <iframe width = "1200" height = "630" src = "../usuario_solicitante/archivos_abono/<?php echo $abono['nombre_archivo2']; ?>" frameborder = "0" allowfullscreen>
            </iframe>
        <?php } else if ($datos['estado'] == 7 && $var1 == 5) { ?>
            <iframe width="1200" height="630" src="../usuario_solicitante/archivos_abono/<?php echo $abono['nombre_archivo3']; ?>" frameborder="0" allowfullscreen>
            </iframe>

        <?php } else if ($datos['estado'] == 7 && $var1 == 6){ ?>
            <iframe width="1200" height="630" src="../usuario_solicitante/archivos_abono/<?php echo $abono['nombre_archivo3']; ?>" frameborder="0" allowfullscreen>
            </iframe>
                
      <?php  }else if ($datos['estado'] == 7 && $n == 1){?>
             <iframe width="1200" height="630" src="../usuario_solicitante/archivos/<?php echo $datos['nombre_archivo2']; ?>" frameborder="0" allowfullscreen>
                </iframe>
     
        
      <?php  }
        else {
            ?>
            <p>NO tiene archivos</p>

            <?php
        }
        ?>
    </body>
</html>


