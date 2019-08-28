<?php
include '../core/conexion.php';
// esta página recibe el id de la peticion, y gracias a eso podemos
//actualizar el campo específico que selecciono el usuario
$db = new Conect_MySql();

$idSoli = $_GET['id'];

$sql = "select * from peticion where id=" . $idSoli;

$solicitud = $db->execute($sql);

$fila = mysqli_fetch_object($solicitud);
$se = "";
$sd = "";
$sf = "";
$ss = "";
$sa = "";
$sg = "";

$insti = "";
$insti2 = "";
$insti3 = "";
$insti4 = "";
$insti5 = "";
$insti6 = "";
$insti7 = "";
$insti8 = "";
$instibci = "";

if ($fila->tipoMoneda == 'Peso ($)') {
    $se = "selected";
} elseif ($fila->tipoMoneda == 'Dólar (US$)') {
    $sd = "selected";
} elseif ($fila->tipoMoneda == 'Euro (€)') {
    $sf = "selected";
}

if ($fila->tipoSolicitud == 'Depósito a Plazo') {
    $ss = "selected";
} elseif ($fila->tipoSolicitud == 'Fondos Mutuos') {
    $sa = "selected";
} elseif ($fila->tipoSolicitud == 'Acciones') {
    $sg = "selected";
}

if ($fila->institucion == 'Scotiabank') {
    $insti = "selected";
} elseif ($fila->institucion == 'Banco Estado') {
    $insti2 = "selected";
} elseif ($fila->institucion == 'BCI') {
    $instibci = "selected";
}elseif ($fila->institucion == 'Banco Itaú-Corpbanca') {
    $insti3 = "selected";
} elseif ($fila->institucion == 'BBVA') {
    $insti4 = "selected";
} elseif ($fila->institucion == 'Banco de Chile') {
    $insti5 = "selected";
} elseif ($fila->institucion == 'Banco Bice') {
    $insti6 = "selected";
} elseif ($fila->institucion == 'Banco Santander') {
    $insti7 = "selected";
} elseif ($fila->institucion == 'Larraín Vial') {
    $insti8 = "selected";
} elseif ($fila->institucion == 'otro1') {
    $insti9 = "selected";
}

$db->close_db();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Editar Peticion</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/estilos.css">
        <link rel="stylesheet" href="../css/menu.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <br>
        <center><h1 class="offset-sm-0" style="font-size: 27px">FORMULARIO DE EDICIÓN</h1></center>
        <br>
        <div class="container-fluid">
            <form action="../usuario_solicitante/funcion_editar.php" method="post">
                <input type="hidden" name="id" value="<?php echo $idSoli; ?>">
                <div class="form-group">
                    <label class="offset-sm-3" id="select"><b>INSTITUCIÓN</b></label>
                    <select class="form-control col-sm-2 offset-sm-3" onchange="d1(this)" name="institucion[]">
                        <option value="Scotiabank" <?php echo $insti; ?>>Scotiabank</option>
                        <option value="Banco Estado" <?php echo $insti2; ?>>Banco Estado</option>
                        <option value="BCI" <?php echo $instibci; ?>>BCI</option>
                        <option value="Banco Itaú-Corpbanca"<?php echo $insti3; ?>>Banco Itaú-Corpbanca</option>
                        <option value="BBVA" <?php echo $insti4; ?>>BBVA</option>
                        <option value="Banco de Chile" <?php echo $insti5; ?>>Banco de Chile</option>
                        <option value="Banco Bice" <?php echo $insti6; ?>>Banco Bice</option>
                        <option value="Banco Santander" <?php echo $insti7; ?>>Banco Santander</option>
                        <option value="Larraín Vial" <?php echo $insti8; ?>>Larraín Vial</option>
                        <option value="otro1"<?php echo $insti9; ?>>Otra</option>
                    </select>
                    <br>
                    <?php if (!$insti9) { ?>
                    <input class="form-control col-sm-3 offset-sm-3" style="display: none" required="" type="text" id="prg1" name="otrainsti" size="50" disabled="true">
                    <?php } else { ?>
                        <input class="form-control col-sm-3 offset-sm-3" required="" type="text" id="prg1" name="otrainsti" size="50" value="<?php echo $fila->institucion; ?>">
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label class="offset-sm-3" id="select"><b>TIPO MONEDA</b></label>
                    <select class="form-control col-sm-2 offset-sm-3" name="moneda[]">
                        <option value="Peso ($)"<?php echo $se; ?>>Peso ($)</option>
                        <option value="Dólar (US$)"<?php echo $sd; ?>>Dólar (US$)</option>
                        <option value="Euro (€)"<?php echo $sf; ?>>Euro (€)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="offset-sm-3"><b>MONTO INVERSIÓN</b></label> (utilice sólo números)
                    <center><input class="form-control col-sm-6" name="monto" id="monto" type="number" value="<?php echo $fila->monto; ?>" required=""></center>
                </div>
                <div class="form-group">
                    <label class="offset-sm-3"><b>TASA MENSUAL</b></label>
                    <center><input class="form-control col-sm-6" name="tasa" id="monto" type="number" value="<?php echo $fila->tasaMensual; ?>" required=""></center>
                </div>
                <div class="form-group">
                    <label class="offset-sm-3"><b>TIPO</b></label>
                    <select class="form-control col-sm-2 offset-sm-3" name="tipo[]">
                        <option value="Depósito a Plazo"<?php echo $ss; ?>>Depósito a Plazo</option>
                        <option value="Fondos Mutuos"<?php echo $sa; ?>>Fondos Mutuos</option>
                        <option value="Acciones"<?php echo $sg; ?>>Acciones</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="offset-sm-3"><b>NÚMERO CUENTA CORRIENTE</b></label>
                    <!--Cuenta de Cargo:<input type="checkbox" id="cta" onclick="myFunction()" name="cuenta">
                    Cheque:<input type="checkbox" id="cheque" onclick="myFunction()" name="cheque">-->
                    <div id="cta"> <!--style="display:none"-->
                        <input class="form-control form-inline offset-sm-3 col-sm-3" required="" name="cuentaCargo" id="nombreSolicitud" type="number" value="<?php echo $fila->cuentaCheque; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="offset-sm-3"><b>DESCRIPCIÓN</b></label>
                    <center><textarea class="form-control col-sm-6" rows=5 cols=10 name="descripcion"  id="descripcion" type="text" required=""><?php echo $fila->descripcion; ?></textarea></center> 
                </div>
                <a href="../usuario_solicitante/editar_peticiones_vista.php"><button type="button" class="btn btn-primary offset-sm-3" style="background-color: #12548c; border: #12548c;"
                                                                                     name="enviar">Volver</button></a>
                <button type="submit" onclick="" class="btn btn-primary offset-sm-4" style="background-color: #12548c; border: #12548c;"
                        name="enviar">Enviar</button>
                <input class="invisible" name="cuenta" value="<?php echo $fila->cuentaOcheque; ?>">
            </form>
        </div>    
    </body>


    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/guardar.js"></script>
    <script src="../js/funciones.js"></script>
    <script type="text/javascript">
                        function myFunction() {
                            // Get the checkbox
                            var checkBox = document.getElementById("cta");
                            var checkBox2 = document.getElementById("cheque");
                            // Get the output text
                            var text = document.getElementById("cuenta");
                            var text2 = document.getElementById("chequediv");

                            // If the checkbox is checked, display the output text
                            if (checkBox.checked == true) {
                                text.style.display = "block";
                            } else {
                                text.style.display = "none";
                            }
                            if (checkBox2.checked == true) {
                                text2.style.display = "block";
                            } else {
                                text2.style.display = "none";
                            }
                        }



    </script>
    <script language="javascript" type="text/javascript">
        function d1(selectTag) {
            if (selectTag.value == 'otro1') {
                document.getElementById('prg1').style.display = "block";
                document.getElementById('prg1').disabled = false;
            } else {
                document.getElementById('prg1').style.display = "none";
                document.getElementById('prg1').disabled = true;
            }
        }
    </script> 
    <script language="javascript" type="text/javascript">
  
                function update(){
                    alert("Se editó correctamente la solicitud");
                }
    </script>
</html>