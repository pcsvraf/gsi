<?php
include '../funciones_solicitante/enviarSolicitud.php';
$enviar = new EnviarDatos();
$enviar->setDataForm($_REQUEST);
$enviar->enviarSolicitud();

?>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Enviar Solicitud</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/estilos.css">
        <link rel="stylesheet" href="../css/menu.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script language="JavaScript">
            // sólo permite que se ingresen números y puntos en el input de monto
            var nav4 = window.Event ? true : false;
            function acceptNum(evt) {
          // NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57
                var key = nav4 ? evt.which : evt.keyCode;
                return (key <= 13 || (key >= 48 && key <= 57) || key == 46);
            }
        </script>
    </head>
    <body>
        <div class="container-fluid">
            <br>
            <center><h1 class="offset-sm-0" style="font-size: 27px">SOLICITAR INVERSIÓN</h1></center>
            <form action="index.php" method="post" class="form-group">
                <br>
                <div class="form-group">
                    <label class="offset-sm-3"><b>INSTITUCIÓN</b></label>
                    <select class="form-control col-sm-2 offset-sm-3" required="" onchange="d1(this)" name="institucion[]">
                        <option value="Scotiabank">Scotiabank</option>
                        <option value="Banco Estado">Banco Estado</option>
                        <option value="BCI">BCI</option>
                        <option value="Banco Itaú-Corpbanca">Banco Itaú-Corpbanca</option>
                        <option value="BBVA">BBVA</option>
                        <option value="Banco de Chile">Banco de Chile</option>
                        <option value="Banco Bice">Banco Bice</option>
                        <option value="Banco Santander">Banco Santander</option>
                        <option value="Larraín Vial">Larraín Vial</option>
                        <option value="otro1">Otra</option>
                    </select>
                    <br>
                    <input class="form-control col-sm-2 offset-sm-3" style="display: none" placeholder="Otra Institución" required="" type="text" id="prg1" name="otrainsti" size="50" disabled="true">
                </div>
                <div class="form-group">
                    <label class="offset-sm-3" id="select"><b>MONEDA</b></label>
                    <select class="form-control col-sm-2 offset-sm-3" name="moneda[]">
                        <option value="Peso ($)">Peso ($)</option>
                        <option value="Dólar (US$)">Dólar (US$)</option>
                        <option value="Euro (€)">Euro (€)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="offset-sm-3"><b>MONTO INVERSIÓN</b></label>
                    <center><input class="form-control col-sm-6" name="monto" id="monto" step="1" type="number" required=""></center>
                </div>
                <div class="form-group">
                    <label class="offset-sm-3"><b>TASA MENSUAL</b></label>
                    <center><input class="form-control col-sm-6" name="tasaMensual" step="any" id="tasaMensual" type="number" required=""></center>
                </div>
                <div class="form-group">
                    <label class="offset-sm-3"><b>TIPO</b></label>
                    <select class="col-sm-2 form-control offset-sm-3" required="" name="tipo[]">
                        <option value="Depósito a Plazo">Depósito a Plazo</option>
                        <option value="Fondos Mutuos">Fondos Mutuos</option>
                        <option value="Acciones">Acciones</option>
                    </select>
                </div>
                <div id="cta" class="form-group" style="align-content: center"> <!--style="display:none"-->
                    <label class="offset-sm-3"><b>NÚMERO CUENTA CORRIENTE</b></label>
                    <input class="form-control form-inline offset-sm-3 col-sm-2" required="" name="cuentaCargo" id="nombreSolicitud" type="number">
                </div>
                <!-- <div class="form-group">
                     <label class="offset-sm-3"><b>Cuenta de Cargo/ N° Cheque:</b></label>
                     Cuenta de Cargo:<input type="checkbox" id="cta" onclick="myFunction()" name="cuenta">
                     Cheque:<input type="checkbox" id="cheque" onclick="myFunction()" name="cheque">
                     <div id="cuenta" style="display:none">
                         <a class="form-inline offset-sm-3">Ingrese Cuenta Cargo:</a><input class="form-control form-inline offset-3 col-sm-3" name="cuentaCargo" id="nombreSolicitud" type="number">
                     </div>
                     <div id="chequediv" style="display:none">
                         <a class="form-inline offset-sm-3">Ingrese N° Cheque:</a><input class="form-control form-inline offset-3 col-sm-3" name="cheque" id="nombreSolicitud" type="number">
                     </div>
                 </div>-->

                <div class="form-group">
                    <label class="offset-sm-3"><b>DESCRIPCIÓN</b></label>
                    <center><textarea class="form-control col-sm-6" rows=5 cols=10 name="descripcion"  id="descripcion" type="text" required=""></textarea></center>
                </div>
                <button type="submit" class="btn btn-primary offset-sm-3" style="background-color: #12548c; border: #12548c;"
                        name="enviar">Enviar</button>
            </form>
        </div>
        <script src="../js/jquery-3.3.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/guardar.js"></script>
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
    </body>
</html>
