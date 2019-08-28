<?php
require '../core/conexion.php';

$db = new Conect_MySql();

$idSoli = $_GET['id'];

$sql = "select * from peticion where id=" . $idSoli;

$solicitud = $db->execute($sql);

$fila = mysqli_fetch_object($solicitud);

$consulta = "select * from rescate where idPeticion=" . $idSoli;

$ejecuta = $db->execute($consulta);

$datos = mysqli_fetch_object($ejecuta);

$soli2 = "select * from abonos where idPeticion=" . $idSoli;

$ejec2 = $db->execute($soli2);

$abono = mysqli_fetch_object($ejec2);

$soli3 = "select * from egreso_procesado where idPeticion=" . $idSoli;

$ejec3 = $db->execute($soli3);

$egreso = mysqli_fetch_object($ejec3);

$query = "SELECT numeroIngreso FROM ingreso_procesado order by id DESC LIMIT 1";

$resultado = $db->execute($query);

$id = $db->fetch_row($resultado);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Procesar Ingreso</title>
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
            <center><h1 class="offset-sm-0" style="font-size: 27px">PROCESAR INGRESO</h1></center>
            <form action="../usuario_visualizador/funciones/funcion_ingreso.php" enctype="multipart/form-data" id="formulario" method="post">
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
                    <center><input class="form-control col-sm-6" name="monto" id="monto" value="<?php echo str_replace(',','.',number_format($fila->monto)); ?>" readonly=""></center>
                </div>
                <div class="form-group">
                    <label class="offset-sm-3"><b>TIPO</b></label>
                    <center><input class="form-control col-sm-6" name="tipo" id="tipo" type="text" value="<?php echo $fila->tipoSolicitud; ?>" readonly=""></center>
                </div>
                <div class="form-group">
                    <label class="offset-sm-3"><b>NÚMERO CUENTA CORRIENTE</b></label>
                    <center><input class="form-control col-sm-6" name="tipo" id="tipo" type="text" value="<?php echo $fila->cuentaCheque; ?>" readonly=""></center>
                </div>
                <div class="form-group">
                    <label class="offset-sm-3"><b>DESCRIPCIÓN</b></label>
                    <center><textarea class="form-control col-sm-6" name="descripcion"  id="descripcion" type="text" readonly=""><?php echo $fila->descripcion; ?></textarea></center>
                </div>
                <div class="form-group">
                    <label class="offset-sm-3"><b>NÚMERO EGRESO</b></label>
                    <center><input class="form-control col-sm-6" name="numeroEgreso" id="numeroEgreso" type="text" value="<?php echo $egreso->numeroEgreso; ?>" readonly=""></center>
                </div>
                <br>
                <center><h1 class="offset-sm-0" style="font-size: 20px"><b>RESCATE</b></h1></center>
                <br>
                <div class="form-inline">
                    <div class="form-group offset-sm-2">
                        <label class="offset-sm-5"><b>Monto</b></label>
                        <input class="form-control col-sm-7 offset-sm-5" value="<?php echo str_replace(',','.',number_format($datos->montoRescatado)); ?>" name="montoRescatado" style="height: 38px" id="montoRescatado" type="text" readonly="">
                    </div>
                    <div class="form-group">
                        <label class="offset-sm-3"><b>Rentabilidad</b></label>
                        <input class="form-control col-sm-7 offset-sm-3" name="rentabilidad" value="<?php echo str_replace(',','.',number_format($abono->rentabilidad)); ?>" id="rentabilidad" type="text" readonly="">
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
                            <input class="form-control col-sm-3 montoAbono1" style="height: 38px" value="<?php echo str_replace(',','.',number_format($abono->montoAbono)); ?>" readonly="" type="text" id="" name="abono1">
                            <a class="invisible">asixd</a>
                            <input type="image" onclick="redireccionar();" src="../imagenes/2018-07-10.png" height="38px" width="38px">
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
                                <a class="invisible">as</a>
                                <input class="form-control col-sm-3 montoAbono2" style="height: 38px" value="<?php echo $abono->montoAbono2; ?>"  required="" type="number" id="abono2" readonly="" name="abono2">
                                <a class="invisible">asixd</a>
                                <input type="image" onclick="redireccionar2();" src="../imagenes/2018-07-10.png" height="38px" width="38px">
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
                                <a class="invisible">as</a>
                                <input class="form-control col-sm-3 montoAbono3" style="height: 38px" value="<?php echo $abono->montoAbono3; ?>" readonly="" type="number" id="abono3" name="abono3">
                                <a class="invisible">asixd</a>
                                <img type="image" onclick="redireccionar3();" src="../imagenes/2018-07-10.png" height="38px" width="38px">
                            </div>
                        </div>
                        <br>
                    </div>
                <?php } ?>
                <br>
                <div class="form-group">
                    <center><label style="font-size: 20px"><b>N° INGRESO</b></label></center>
                    <center><input type="number" required="true" class="form-control col-sm-3" id="numeroIngreso" placeholder="Ingrese número de Ingreso" name="numeroIngreso" style="height: 38px"></center>
                    <br>
                </div>
                <!-- <div class="form-group offset-sm-3">
                     <fieldset id="buildyourform" name="campos">
                     </fieldset>
                     <br>
                     <input type="button" onclick="agregar();" value="Abonar a otra Intitución" class="btn btn-secondary offset" id="add" />
                 </div>-->
                <br>
                <button type="button" onclick="window.location = 'http://pcspucv.cl/gsi/proyecto/usuario_visualizador/historial_ingresos.php'" class="btn btn-primary offset-sm-3"style="background-color: #12548c; border: #12548c;" name="volver">Volver</button>
                <input type="button" onclick="generaPDF();" value="Generar PDF" id="pdf" style="background-color: #12548c; border: #12548c;" class="btn btn-primary offset-sm-2">
                <a class="invisible">asaaa</a>
                <button type="submit" class="btn btn-primary offset-sm-1"  style="background-color: #12548c; border: #12548c;"
                        name="guardar" id="guardar">Procesar</button>
                <!--onclick="rescate();"-->

            </form>
        </div>
    </body>
</html>

<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/guardar.js"></script>
<script src="../js/funciones.js"></script>
<script>
                    function redireccionar() {
                        window.open('../usuario_visualizador/funciones/mostrar_pdf.php?id=<?php echo $idSoli; ?>&var1=1', '_blank');
                    }

                    function redireccionar2() {
                        window.open('../usuario_visualizador/funciones/mostrar_pdf.php?id=<?php echo $idSoli; ?>&var1=2', '_blank');
                    }

                    function redireccionar3() {
                        window.open('../usuario_visualizador/funciones/mostrar_pdf.php?id=<?php echo $idSoli; ?>&var1=3', '_blank');
                    }

                    function generaPDF() {
                        if (document.getElementById('numeroIngreso').value == '') {
                            alert("No se puede generar PDF sin número de Ingreso");
                            document.getElementById('numeroIngreso').focus();
                        } else {
                            var nose = document.getElementById("numeroIngreso").value;
                            window.open('../usuario_visualizador/funciones/genera_pdf_ingreso.php?id=<?php echo $idSoli; ?>&rescate=<?php echo $datos->montoRescatado; ?>&renta=<?php echo $abono->rentabilidad; ?>&fecha=<?php echo $datos->fechaRescate; ?>&ins1=<?php echo $abono->institucion; ?>&cuenta1=<?php echo $abono->numeroCuenta; ?>&abono1=<?php echo $abono->montoAbono; ?>&ins3=<?php echo $abono->institucion3; ?>&cuenta3=<?php echo $abono->numeroCuenta3; ?>&abono3=<?php echo $abono->montoAbono3; ?>&insti=<?php echo $fila->institucion; ?>&moneda=<?php echo $fila->tipoMoneda; ?>&monto=<?php echo $fila->monto; ?>&tipo=<?php echo $fila->tipoSolicitud; ?>&cuenta=<?php echo $fila->cuentaCheque; ?>&desc=<?php echo $fila->descripcion; ?>&ins2=<?php echo $abono->institucion2; ?>&cuenta2=<?php echo $abono->numeroCuenta2; ?>&abono2=<?php echo $abono->montoAbono2; ?>&egreso=<?php echo $egreso->numeroEgreso ?>&numero='+nose);
                        }
                    }

</script>
