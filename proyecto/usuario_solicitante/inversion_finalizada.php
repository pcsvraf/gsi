<?php
require '../core/conexion.php';

$db = new Conect_MySql();

$idSoli = $_GET['id'];

$query = "select * from peticion where id=" . $idSoli;

$peticion = $db->execute($query);

$fila = mysqli_fetch_object($peticion);

$query2 = "select * from rescate where idPeticion=" . $idSoli;

$peticion2 = $db->execute($query2);

$datos = mysqli_fetch_object($peticion2);

$query3 = "select * from abonos where idPeticion=" . $idSoli;

$peticion3 = $db->execute($query3);

$abono = mysqli_fetch_object($peticion3);

$query4 = "select * from egreso_procesado";

$peticion4 = $db->execute($query4);

$egreso = mysqli_fetch_object($peticion4);

$query5 = "select * from ingreso_procesado";

$peticion5 = $db->execute($query5);

$ingreso = mysqli_fetch_object($peticion5);
?>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/estilos.css">
        <link rel="stylesheet" href="../css/menu.css">
    </head>
    <body>
        <br>
    <center><h1 class="offset-sm-0" style="font-size: 27px">INVERSIÓN FINALIZADA</h1></center>
    <div class="container-fluid">
        <form method="POST" id="form" action="../usuario_solicitante/pdf_finalizado.php">
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
                <center><input class="form-control col-sm-6" name="monto" id="monto" value="<?php $z = number_format($fila->monto);  echo str_replace(',', '.', $z);?>" readonly=""></center>
            </div>
            <div class="form-group">
                <label class="offset-sm-3"><b>TIPO</b></label>
                <center><input class="form-control col-sm-6" name="tipo" id="tipo" type="text" value="<?php echo $fila->tipoSolicitud; ?>" readonly=""></center>
            </div>
            <div class="form-group">
                <label class="offset-sm-3"><b>NÚMERO CUENTA CORRIENTE</b></label>
                <center><input class="form-control col-sm-6" name="cuenta" id="cuenta" type="text" value="<?php echo $fila->cuentaCheque; ?>" readonly=""></center>
            </div>
            <div class="form-group">
                <label class="offset-sm-3"><b>DESCRIPCIÓN</b></label>
                <center><textarea class="form-control col-sm-6" name="descripcion"  id="descripcion" type="text" readonly=""><?php echo $fila->descripcion; ?></textarea></center>
            </div>
            <div class="form-inline">
                <div class="form-group offset-sm-2">
                    <label class="offset-sm-4">NÚMERO EGRESO</label>
                    <input type="text" name="egreso" readonly="" value="<?php echo $egreso->numeroEgreso; ?>" class="form-control offset-sm-4">
                </div>
                <div class="form-group">
                    <label class="offset-sm-5">NÚMERO INGRESO</label>
                    <a class="invisible">asaaa</a>
                    <input type="text" name="ingreso" readonly="" value="<?php echo $ingreso->numeroIngreso; ?>" class="form-control offset-sm-5">
                </div>
            </div>
            <br>
            <center><h1 class="offset-sm-0" style="font-size: 20px"><b>RESCATE</b></h1></center>
            <br>
            <div class="form-inline">
                <div class="form-group offset-sm-2">
                    <label class="offset-sm-5"><b>Monto</b></label>
                    <input class="form-control col-sm-7 offset-sm-5" value="<?php echo str_replace(',', '.', (number_format($datos->montoRescatado))); ?>" name="montoRescatado" style="height: 38px" id="montoRescatado" type="text" readonly="">
                </div>
                <div class="form-group">
                    <label class="offset-sm-3"><b>Rentabilidad</b></label>
                    <input class="form-control col-sm-7 offset-sm-3" name="rentabilidad" value="<?php echo str_replace(',', '.', (number_format($abono->rentabilidad))); ?>" id="rentabilidad" type="text" readonly="">
                </div>
                <div class="form-group">
                    <label class="offset-sm-1"><b>Fecha</b></label>
                    <input class="form-control col-sm-8 offset-sm-1" style="height: 38px" name="fechaRescate" value="<?php echo $datos->fechaRescate; ?>" id="fechaxd" type="text" readonly="">
                </div>
            </div>
            <br>
            <center><h1 class="offset-sm-0" style="font-size: 20px"><b>ABONO</b></h1></center>
            <br>
            <div class="form-inline offset-sm-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="height: 38px"  id="basic-addon1">Institución 1</span>
                    </div>
                    <input type="text" name="institucion1" style="height: 38px" class="form-control col-sm-2" value="<?php echo $abono->institucion; ?>" readonly="">
                    <br>
                    <div class="input-group-prepend">
                        <a class="invisible">asas</a>
                        <input class="form-control col-sm-3" style="height: 38px" value="<?php echo $abono->numeroCuenta; ?>" readonly=""  type="number" id="cuenta1" name="cuenta1">
                        <a class="invisible">as</a>
                        <input class="form-control col-sm-3 montoAbono1" style="height: 38px" value="<?php echo str_replace(',', '.', (number_format($abono->montoAbono))); ?>" readonly="" type="text" id="" name="abono1">
                    </div>
                </div>
                <br>
                <br>
            </div>
            <?php
            if ($abono->institucion2 == null) {
                echo "<center><label class='alert alert-info'>no se realizaron más Abonos</label></center>";
            } else {
                ?>
                <div class="form-inline offset-sm-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="height: 38px"  id="basic-addon1">Institución 2</span>
                        </div>
                        <input type="text" name="institucion2" value="<?php echo $abono->institucion2; ?>" style="height: 38px" readonly="" class="form-control col-sm-2">
                        <br>
                        <a class="invisible">asas</a>
                        <div class="input-group-prepend">
                            <input class="form-control col-sm-3" style="height: 38px" value="<?php echo $abono->numeroCuenta2; ?>"  required="" type="number" id="cuenta2" readonly="" name="cuenta2">
                            <a class="invisible">asa</a>
                            <input class="form-control col-sm-3 montoAbono2" style="height: 38px" value="<?php echo $abono->montoAbono2; ?>"  required="" type="number" id="abono2" readonly="" name="abono2">
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                </div>
                <?php
            }if ($abono->institucion3 == null) {
                echo "<center><label class='alert alert-info'>no se realizaron más Abonos</label></center>";
            } else {
                ?>
                <div class="form-inline offset-sm-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="height: 38px"  id="basic-addon1">Institución 3</span>
                        </div>
                        <input type="text" name="institucion3" style="height: 38px" value="<?php echo $abono->institucion3; ?>" readonly="" class="form-control col-sm-2">
                        <br>
                        <a class="invisible">asas</a>
                        <div class="input-group-prepend">
                            <input class="form-control col-sm-3" style="height: 38px" value="<?php echo $abono->numeroCuenta3; ?>" readonly="" type="number" id="cuenta3" name="cuenta3">
                            <a class="invisible">asa</a>
                            <input class="form-control col-sm-3 montoAbono3" style="height: 38px" value="<?php echo $abono->montoAbono3; ?>" readonly="" type="number" id="abono3" name="abono3">
                        </div>
                    </div>
                    <br>
                </div>
            <?php } ?>
            <br>
            <div class="form-inline offset-sm-3">
                <div class="form-group offset-sm-1">
                    <button type="button" onclick="aceptacion();" class="btn btn-primary"><img src="../imagenes/2018-07-10.png" height="25px">Doc. Aceptación</button></a>
                </div>
                <div class="form-group offset-sm-2">
                    <button type="button" onclick="rescate();" class="btn btn-primary"><img src="../imagenes/2018-07-10.png" height="25px">Doc. Rescate</button>
                </div>
            </div>
            <br>
            <br>
            <a href="../usuario_solicitante/historial_solicitudes.php?idEstado=7"><input type="button" style="background-color: #12548c; border: #12548c;" value="Volver" class="btn btn-primary offset-sm-3"></a>
            <a class="invisible">espac</a>
            <button type="button" onclick="enviar();" class="btn btn-primary offset-sm-4" style="background-color: #12548c; border: #12548c;">Genera PDF</button>
        </form>
    </div>
</body>
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/guardar.js"></script>
<script type="text/javascript">
                function redirect() {
                    window.open('../usuario_solicitante/archivo_pdf.php?id=<?php echo $idSoli; ?>&var1=3');
                }

                function redirect2() {
                    window.open('../usuario_solicitante/archivo_pdf.php?id=<?php echo $idSoli; ?>&var1=4');
                }

                function redirect3() {
                    window.open('../usuario_solicitante/archivo_pdf.php?id=<?php echo $idSoli; ?>&var1=5');
                }

                function aceptacion() {
                    window.open('../usuario_solicitante/archivo_pdf.php?id=<?php echo $idSoli; ?>&var1=1');
                }

                function rescate() {
                    window.open('../usuario_solicitante/archivo_pdf.php?id=<?php echo $idSoli; ?>&var1=2');
                }

                function enviar() {
                    var form = document.getElementById('form');
                    form.setAttribute("target","_blank");
                    $('#form').submit();
                }
</script>
</html>
