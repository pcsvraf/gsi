<?php
include '../core/conexion.php';
// esta página recibe el id de la peticion, y gracias a eso podemos
//actualizar el campo específico que selecciono el usuario
$db = new Conect_MySql();
$idSoli = $_GET['id'];
$sql = "select * from peticion where id=" . $idSoli;
$solicitud = $db->execute($sql);
$fila = mysqli_fetch_object($solicitud);
?>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/estilos.css"  type="text/css">
        <link rel="stylesheet" href="../css/menu.css">
        <link rel="stylesheet" href="../css/archivo.css">
    </head>
    <body>
        <div class="container-fluid">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $idSoli; ?>">
                <br>
                <center><h1>Subir Archivo</h1></center>
                <br>
                <br>
                <div class="form-group">
                    <label class="offset-sm-3"><b>Institución:</b></label>
                    <center><input class="form-control col-sm-6" name="institucion" id="institucion" value="<?php echo $fila->institucion; ?>" type="text" readonly=""></center>
                </div>
                <div class="form-group">
                    <label class="offset-sm-3"><b>Tipo Moneda:</b></label>
                    <center><textarea class="form-control col-sm-6" name="tipoMoneda"  id="tipoMoneda" type="text" readonly=""><?php echo $fila->tipoMoneda; ?></textarea></center>
                </div>
                <div class="form-group">
                    <label class="offset-sm-3"><b>Monto Inversión:</b></label>
                    <center><input class="form-control col-sm-6" name="monto" id="monto" type="number" value="<?php echo $fila->monto; ?>" readonly=""></center>
                </div>
                <div class="form-group">
                    <center><input type="file" name="archivo" accept=".pdf,.jpg" class="btn btn-primary" style="background-color: #12548c; border: #12548c;"></center>
                </div>
                <br>
                <a href="../usuario_solicitante/historial_solicitudes.php?idEstado=0"><button class="btn btn-primary offset-sm-3"style="background-color: #12548c; border: #12548c;"
                                                                                   type="button" name="volver">Volver</button></a>
                <button type="submit" class="btn btn-primary offset-sm-4" onclick="archivo();" style="background-color: #12548c; border: #12548c;"
                        name="guardar">Guardar</button>
            </form>
        </div>
    </body>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/guardar.js"></script>
    <script src="../js/funciones.js"></script>
</html>
<?php
if (isset($_POST['guardar'])) {
    $sqlo = "select estado from peticion where id=$idSoli limit 1";
    $estado = $db->execute($sqlo)->fetch_assoc()['estado'];
    $nombre = $_FILES['archivo']['name'];
    $tipo = $_FILES['archivo']['type'];
    $tamanio = $_FILES['archivo']['size'];
    $prefix = "doc_";
    $ext = explode(".", $nombre)[1];
    $ruta = $_FILES['archivo']['tmp_name'];
    $destino = "..//usuario_solicitante/archivos/" . $idSoli.$nombre;
    $realName = uniqid($prefix, TRUE) . '.' . $ext;
    if ($nombre != "") {
        if (move_uploaded_file($ruta, $destino)) {
            if($estado == 2){
                $sql = "update peticion set nombre_archivo='$idSoli$nombre',nombre_random='$realName' where id=".$idSoli;
            }
            if($estado == 4){
                $sql = "update peticion set nombre_archivo2='$idSoli$nombre', nombre_random2='$realName' where id=".$idSoli;
            }
            $isInsert = $db->execute($sql);
            if ($isInsert) {
                 echo '<script language="javascript">window.location="https://pcspucv.cl/gsi/proyecto/usuario_solicitante/historial_solicitudes.php?idEstado=0"</script>;';
            }
        } else {
            echo "Error";
        }
    }
}
?>
