<?php
require '../core/conexion.php';

$db = new Conect_MySql();

$idSoli = $_GET['id'];

$query = "select * from peticion where id=" . $idSoli;

$ejecuta = $db->execute($query);

$fila = mysqli_fetch_object($ejecuta);


$query = "SELECT numeroEgreso FROM egreso_procesado order by id DESC LIMIT 1";

$resultado = $db->execute($query);

$id = $db->fetch_row($resultado);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Procesar Egreso</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/estilos.css">
        <link rel="stylesheet" href="../css/menu.css">
        <style>
            input[type=text], select, textarea{
                width: 100%;
                padding: 12px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
                resize: vertical;
            }

            .check{
                margin-top: 0px;
                resize: vertical;
            }
        </style>
        <style type="text/css">
            .image-upload > input
            {
                display: none;
            }

            .image-upload img
            {
                width: 42px;
                cursor: pointer;
            }
        </style>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div class="container-fluid">
            <br>
            <center><h1 class="offset-sm-0" style="font-size: 27px">PROCESAR EGRESO</h1></center>
            <form action="../usuario_visualizador/funciones/funcion_egreso.php" enctype="multipart/form-data" id="formulario" method="post">
                <input type="hidden" name="id" value="<?php echo $idSoli; ?>">
                <div class="form-group">
                    <label class="offset-sm-3"><b>ID</b></label>
                    <center><input class="form-control col-sm-6" name="id" id="id" value="<?php echo $idSoli; ?>" type="text" readonly=""></center>
                </div>
                <div class="form-group">
                    <label class="offset-sm-3"><b>INSTITUCIÓN</b></label>
                    <center><input class="form-control col-sm-6" name="institucion" id="institucion" value="<?php echo $fila->institucion; ?>" type="text" readonly=""></center>
                </div>
                <div class="form-group">
                    <label class="offset-sm-3"><b>TIPO MONEDA</b></label>
                    <center><textarea class="form-control col-sm-6" name="tipoMoneda"  id="tipoMoneda" type="text" readonly=""><?php echo $fila->tipoMoneda; ?></textarea></center>
                </div>
                <div class="form-group">
                    <label class="offset-sm-3"><b>MONTO INVERSIÓN</b></label>
                    <center><input class="form-control col-sm-6" name="monto" id="monto" value="<?php echo $fila->monto; ?>" readonly=""></center>
                </div>
                <div class="form-group">
                    <label class="offset-sm-3"><b>TIPO</b></label>
                    <center><input class="form-control col-sm-6" name="tipo" id="tipo" type="text" value="<?php echo $fila->tipoSolicitud; ?>" readonly=""></center>
                </div> 
                <div class="form-group">
                    <label class="offset-sm-3"><b>NÚMERO CUENTA CORRIENTE</b></label>
                    <center><input class="form-control col-sm-6" name="tipo" id="cuenta" type="text" value="<?php echo $fila->cuentaCheque; ?>" readonly=""></center>
                </div> 
                <div class="form-group">
                    <label class="offset-sm-3"><b>DESCRIPCIÓN</b></label>
                    <center><textarea class="form-control col-sm-6" name="descripcion"  id="descripcion" type="text" readonly=""><?php echo $fila->descripcion; ?></textarea></center>
                </div>
                <div class="form-group">
                    <br>
                    <center><h1 class="offset-sm-0" style="font-size: 20px"><b>NÚMERO EGRESO</b></h1></center>
                    <center><input type="number" class="form-control col-sm-3" id="numeroEgreso" name="numeroEgreso" placeholder="Ingrese número de Egreso" required="" style="height: 38px"></center>
                    <br>
                </div>
                <div class="form-group">
                    <center><button type="button" onclick="redireccionar();" class="btn btn-primary"><img src="../imagenes/2018-07-10.png" height="25px">Doc. Aceptación</button></center>
                </div> 
                <div class="form-group">
                    <br>
                    <a href="../usuario_visualizador/historial_egresos.php"><button type="button" style="background-color: #12548c; border: #12548c;" class="btn btn-primary offset-sm-3">Volver</button></a>
                    <a class="invisible">asasasaasasasasaaaasas</a>
                    <input type="button" onclick="generaPdf();" value="Generar PDF" style="background-color: #12548c; border: #12548c;" id="pdf" class="btn btn-primary">
                    <a class="invisible">aaaasasa</a>
                    <button type="button" onclick="egreso();" style="background-color: #12548c; border: #12548c;" class="btn btn-primary offset-sm-1">Procesar</button>
                </div>
            </form>
        </div>
    </body>
</html>
<script type="text/javascript">
    function redireccionar() {
        window.open('../usuario_visualizador/funciones/ver_archivo.php?id=<?php echo $idSoli; ?>', '_blank');
    }

    function generaPdf() {
        if (document.getElementById('numeroEgreso').value == '') {
            alert("No se puede generar PDF sin número de Egreso");
            document.getElementById('numeroEgreso').focus();
        } else {
            var nose = document.getElementById("numeroEgreso").value;
            window.open('../usuario_visualizador/funciones/genera_pdf.php?id=<?php echo $idSoli; ?>&insti=<?php echo $fila->institucion; ?>&moneda=<?php echo $fila->tipoMoneda; ?>&monto=<?php echo $fila->monto; ?>&tipo=<?php echo $fila->tipoSolicitud; ?>&cuenta=<?php echo $fila->cuentaCheque; ?>&desc=<?php echo $fila->descripcion; ?>&numero='+nose, '_blank' );
        }
    }


    function egreso() {
        if (document.getElementById('numeroEgreso').value == '') {
            alert("Debe Tener número de Egreso");
            document.getElementById('numeroEgreso').focus();
        } else {
            document.getElementById('formulario').submit();
        }
    }
</script>