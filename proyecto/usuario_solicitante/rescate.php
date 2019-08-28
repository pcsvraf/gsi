<?php
include '../core/conexion.php';
// esta página recibe el id de la peticion, y gracias a eso podemos
//actualizar el campo específico que selecciono el usuario
$db = new Conect_MySql();
$idSoli = $_GET['id'];
$sql = "select * from peticion where id=" . $idSoli;
$solicitud = $db->execute($sql);
$fila = mysqli_fetch_object($solicitud);
$db->close_db();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Formulario de Rescate</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/estilos.css">
        <link rel="stylesheet" href="../css/menu.css">
        <style>
            @media (max-width: 500px) {
                #archivo1 {
                    font-size: 8px;

                }
            }

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

            input[type=file]{
                width: 50px;
            }
        </style>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div class="container-fluid" id="divi">
            <br>
            <center><h1 class="offset-sm-0" style="font-size: 27px">RESCATE INVERSIÓN</h1></center>
            <form action="../usuario_solicitante/funcion_rescate.php" enctype="multipart/form-data" id="formulario" method="post">
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
                    <center><input class="form-control col-sm-6" name="monto" id="monto" value="<?php $z = number_format($fila->monto);
                                    echo str_replace(',', '.', $z); ?>" readonly=""></center>
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
                <br>
                <center><h1 class="offset-sm-0" style="font-size: 20px"><b>RESCATE</b></h1></center>
                <div class="form-inline">
                    <div class="form-group offset-sm-2">
                        <label class="offset-sm-5"><b>Monto</b></label>
                        <input class="form-control col-sm-10 offset-sm-5" name="montoRescatado" id="montoRescatado" type="number">
                    </div>
                    <div class="form-group offset-sm-2">
                        <label class="offset-sm-4"><b>Fecha</b></label>
                        <input class="form-control col-sm-10 offset-sm-4" name="fechaRescate" id="fechaxd" type="date">
                    </div>
                </div>
                <br>
                <center><h1 class="offset-sm-0" style="font-size: 20px"><b>ABONO</b></h1></center>
                <br>
                <div class="form-inline offset-sm-3" id="div2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="height: 38px"  id="basic-addon1">Institución 1</span>
                        </div>
                        <select class="form-control col-sm-2" id="institucion1" onchange="d1(this)" name="institucion[]">
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
                        <div class="input-group-prepend">
                            <input class="form-control col-sm-1" style="height: 38px; visibility: hidden" required="" type="text" id="prg1" name="otrainsti1" disabled="true">
                            <a class="invisible">as</a>
                            <input class="form-control col-sm-2" style="height: 38px" placeholder="N° Cta." required="" type="number" id="cuenta1" name="cuenta1">
                            <a class="invisible">as</a>
                            <input class="form-control col-sm-2 montoAbono1" style="height: 38px" placeholder="Monto" required="" type="number" id="" name="abono1">
                            <a class="invisible">asixd</a>
                            <!--<div id="divi">
                                <input type="file" class="file-input" accept=".pdf, .jpg" id="archivo1" name="archivo1"/>
                                <label id="label1" style=""></label>
                            </div>-->
                        </div>
                    </div>
                    <br>
                </div>
                <div class="form-inline offset-sm-3">
                    <div class="input-group">
                        <div class="check input-group-text" style="height: 38px">
                            <input class="btn btn-primary" onchange="habilitar(this.checked);" onclick="input();" type="checkbox" name="habilita1" id="habilita1">
                        </div>
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="height: 38px"  id="basic-addon2">Institución 2</span>
                        </div>
                        <select class="form-control col-sm-1" required="" disabled="true"  id="institucion2" onchange="d2(this)" name="institucion2[]">
                            <option value="Scotiabank">Scotiabank</option>
                            <option value="Banco Estado">Banco Estado</option>
                            <option value="BCI">BCI</option>
                            <option value="Banco Itaú-Corpbanca">Banco Itaú-Corpbanca</option>
                            <option value="BBVA">BBVA</option>
                            <option value="Banco de Chile">Banco de Chile</option>
                            <option value="Banco Bice">Banco Bice</option>
                            <option value="Banco Santander">Banco Santander</option>
                            <option value="Larraín Vial">Larraín Vial</option>
                            <option value="otro2">Otra</option>
                        </select>
                        <br>
                        <div class="input-group-prepend">
                            <input class="form-control col-sm-1" style="height: 38px; visibility: hidden" placeholder="Otra" required="" type="text" id="prg2" name="otrainsti2" disabled="true">
                            <a class="invisible">asa</a>
                            <input class="form-control col-sm-2" style="height: 38px" placeholder="N° Cta." required="" type="number" id="cuenta2" disabled="true" name="cuenta2">
                            <a class="invisible">asa</a>
                            <input class="form-control col-sm-2 montoAbono2" style="height: 38px" placeholder="Monto" required="" type="number" id="abono2" disabled="true" name="abono2">
                            <a class="invisible">asix</a>
                            <!--<div class="image-upload" id="prueba" style="visibility: hidden">
                                <label for="file-input">
                                    <img src="../imagenes/2018-07-18.png" id="imagen" alt ="Click aquí para subir tu foto" title ="Click aquí para subir tu foto">
                                </label>
                                <input  id="file-input" type="file" accept=".pdf, .jpg" name="archivo2"/>
                            </div>
                            <input type="file" name="archivo2" class="" required="true" accept=".pdf, .jpg" id="prueba" style="visibility: hidden">
                            <label id="label2" style=""></label>-->
                        </div>
                    </div>
                    <br>
                </div>
                <div class="form-inline offset-sm-3">
                    <div class="input-group">
                        <div class="check input-group-text" style="height: 38px">
                            <input class="btn btn-primary" onchange="habilitar2(this.checked);" onclick="input();" type="checkbox" name="habilita2" id="habilita2">
                        </div>
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="height: 38px"  id="basic-addon3">Institución 2</span>
                        </div>
                        <select class="form-control col-sm-1" required="" disabled="true"  id="institucion3" onchange="d3(this)" name="institucion3[]">
                            <option value="Scotiabank">Scotiabank</option>
                            <option value="Banco Estado">Banco Estado</option>
                            <option value="BCI">BCI</option>
                            <option value="Banco Itaú-Corpbanca">Banco Itaú-Corpbanca</option>
                            <option value="BBVA">BBVA</option>
                            <option value="Banco de Chile">Banco de Chile</option>
                            <option value="Banco Bice">Banco Bice</option>
                            <option value="Banco Santander">Banco Santander</option>
                            <option value="Larraín Vial">Larraín Vial</option>
                            <option value="otro3">Otra</option>
                        </select>
                        <br>
                        <div class="input-group-prepend">
                            <input class="form-control col-sm-1" style="height: 38px; visibility: hidden" placeholder="Otra" required="" type="text" id="prg3" name="otrainsti3" disabled="true">
                            <a class="invisible">asa</a>
                            <input class="form-control col-sm-2" style="height: 38px" placeholder="N° Cta." required="" type="number" id="cuenta3" disabled="true" name="cuenta3">
                            <a class="invisible">asa</a>
                            <input class="form-control col-sm-2 montoAbono3" style="height: 38px" placeholder="Monto" required="" type="number" id="abono3" disabled="true" name="abono3">
                            <a class="invisible">asix</a>
                            <!--<div class="image-upload" id="pruebita" style="visibility: hidden">
                                <label for="file-input">
                                    <img src="../imagenes/2018-07-18.png" id="imagen" alt ="Click aquí para subir tu foto" title ="Click aquí para subir tu foto">
                                </label>
                                <input  id="file-input" type="file" accept=".pdf, .jpg" name="archivo3"/>
                            </div>
                            <input type="file" accept=".pdf, .jpg" name="archivo3" required="true" id="pruebita" style="visibility: hidden">
                            <label id="label3" style=""></label>
                            -->
                        </div>
                    </div>
                    <br>
                </div>
                <!-- <div class="form-group offset-sm-3">
                     <fieldset id="buildyourform" name="campos">
                     </fieldset>
                     <br>
                     <input type="button" onclick="agregar();" value="Abonar a otra Intitución" class="btn btn-secondary offset" id="add" />
                 </div>-->
                <br>
                <button type="button" onclick="window.location = 'https://pcspucv.cl/gsi/proyecto/usuario_solicitante/rescate_vista.php'" class="btn btn-primary offset-sm-3"style="background-color: #12548c; border: #12548c;" name="volver">Volver</button>
                <button type="button" class="btn btn-primary offset-sm-4"  style="background-color: #12548c; border: #12548c;"
                        name="guardar" id="guardar">Guardar</button>
                <!--onclick="rescate();"-->

            </form>
        </div>
    </body>

    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/guardar.js"></script>
    <script src="../js/funciones.js"></script>
    <script language="javascript" type="text/javascript">
                    function d1(selectTag) {
                        var otro = document.getElementById('prg1');
                        if (selectTag.value == 'otro1') {
                            document.getElementById('prg1').placeholder = "Otra";
                            otro.style.visibility = "visible";
                            document.getElementById('prg1').disabled = false;
                        } else {
                            otro.style.visibility = "hidden";
                            document.getElementById('prg1').disabled = true;
                        }
                    }

                    function d2(selectTag) {
                        var otro2 = document.getElementById('prg2');
                        if (selectTag.value == 'otro2') {
                            document.getElementById('prg2').placeholder = "Otra";
                            otro2.style.visibility = "visible";
                            document.getElementById('prg2').disabled = false;
                        } else {
                            otro2.style.visibility = "hidden";
                            document.getElementById('prg2').disabled = true;
                        }
                    }

                    function d3(selectTag) {
                        var otro3 = document.getElementById('prg3');
                        if (selectTag.value == 'otro3') {
                            document.getElementById('prg3').placeholder = "Otra";
                            otro3.style.visibility = "visible";
                            document.getElementById('prg3').disabled = false;
                        } else {
                            otro3.style.visibility = "hidden";
                            document.getElementById('prg3').disabled = true;
                        }
                    }
    </script>
    <script>

        $('#archivo1').on('change', function () {
            var doc = document.getElementById("basic-addon1");
            var doc2 = document.getElementById("institucion1");
            var doc3 = document.getElementById("prg1");
            doc.style.backgroundColor = "#12548c";
            doc.style.color = "white";
            doc2.style.backgroundColor = "#12548c";
            doc2.style.color = "white";
            doc3.style.backgroundColor = "#12548c";
            doc3.style.color = "white";
        });

        $('#prueba').on('change', function () {
            var doc = document.getElementById("basic-addon2");
            var doc2 = document.getElementById("institucion2");
            var doc3 = document.getElementById("prg2");
            var doc4 = document.getElementById("habilita1");
            doc.style.backgroundColor = "#12548c";
            doc.style.color = "white";
            doc2.style.backgroundColor = "#12548c";
            doc2.style.color = "white";
            doc3.style.backgroundColor = "#12548c";
            doc3.style.color = "white";
            doc4.style.backgroundColor = "#12548c";
            doc4.style.color = "white";
        });

        $('#pruebita').on('change', function () {
            var doc = document.getElementById("basic-addon3");
            var doc2 = document.getElementById("institucion3");
            var doc3 = document.getElementById("prg3");
            var doc4 = document.getElementById("habilita2");
            doc.style.backgroundColor = "#12548c";
            doc.style.color = "white";
            doc2.style.backgroundColor = "#12548c";
            doc2.style.color = "white";
            doc3.style.backgroundColor = "#12548c";
            doc3.style.color = "white";
            doc4.style.backgroundColor = "#12548c";
            doc4.style.color = "white";
        });
    </script>
    <script>
        function habilitar(value)
        {
            if (value == false)
            {
                // deshabilitamos
                document.getElementById("institucion2").disabled = true;
                document.getElementById("cuenta2").disabled = true;
                document.getElementById("abono2").disabled = true;
            } else if (value == true) {
                // habilitamos
                document.getElementById("institucion2").disabled = false;
                document.getElementById("cuenta2").disabled = false;
                document.getElementById("abono2").disabled = false;
            }

        }
        function habilitar2(value)
        {
            if (value == false)
            {
                // deshabilitamos
                document.getElementById("institucion3").disabled = true;
                document.getElementById("cuenta3").disabled = true;
                document.getElementById("abono3").disabled = true;
            } else if (value == true) {
                // habilitamos
                document.getElementById("institucion3").disabled = false;
                document.getElementById("cuenta3").disabled = false;
                document.getElementById("abono3").disabled = false;
            }

        }
        function input() {
            var checkbox = document.getElementById("habilita1");
            var checkbox2 = document.getElementById("habilita2");
            var input = document.getElementById("prueba");
            var otra1 = document.getElementById('prg2');
            var otra2 = document.getElementById('prg3');
            var input2 = document.getElementById("pruebita");
            if (checkbox.checked == true) {
                input.style.visibility = "visible";
            } else {
                input.style.visibility = "hidden";
                otra1.style.visibility = "hidden";
            }

            if (checkbox2.checked == true) {
                input2.style.visibility = "visible";
            } else {
                input2.style.visibility = "hidden";
                //otra2.style.visibility = "hidden";
            }
        }
    </script>
    <script type="text/javascript">
        $('#guardar').on('click', function () {
            var monto1 = $('.montoAbono1').val();
            var monto2 = $('.montoAbono2').val();
            var montoDos = document.getElementById("abono2");
            var monto3 = $('.montoAbono3').val();
            var montoTres = document.getElementById("abono3");
            var fecha = $('#fechaxd').val();
            var cuenta1 = $('#cuenta1').val();
            var cuenta2 = $('#cuenta2').val();
            var cuenta3 = $('#cuenta3').val();
            var montoRescatado = $('#montoRescatado').val();
            if (monto1 == '' || fecha == '' || cuenta1 == '' || montoRescatado == '') {
                alert("Todos los campos son obligatorios");
                return false;
            } else if (montoDos.disabled == true && parseInt(monto1) == montoRescatado) {
                $("#formulario").submit();
            } else if (montoDos.disabled == true && parseInt(monto1) != montoRescatado) {
                alert("el monto abonado debe ser igual al monto rescatado");
                return false;
            } else if (montoDos.disabled == false && monto2 == '' || cuenta2 == '') {
                alert("Los campos no pueden estar vacíos");
                return false;
            } else if (montoDos.disabled == false && montoTres.disabled == true && parseInt(monto1) + parseInt(monto2) == montoRescatado) {
                $("#formulario").submit();
            } else if (montoDos.disabled == false && montoTres.disabled == true && parseInt(monto1) +
                    parseInt(monto2) != montoRescatado) {
                alert("el monto abonado debe ser igual al monto rescatado");
                return false;
            } else if (montoTres.disabled == false && monto3 == '' || cuenta3 == '') {
                alert("los campos no pueden estar vacíos");
                return false;
            } else if (montoTres.disabled == false && montoDos.disabled == false && parseInt(monto1) + parseInt(monto2) +
                    parseInt(monto3) == montoRescatado) {
                $("#formulario").submit();
            } else if (montoTres.disabled == false && parseInt(monto1) + parseInt(monto2) +
                    parseInt(monto3) != montoRescatado) {
                alert("el monto abonado debe ser igual al monto rescatado");
                return false;
            }
        });
    </script>

<!--<script type="text/javascript">
    function onChangeMontoAbono(){
        var monto1 = $('.montoAbono1').val();
        var monto2 = $('.montoAbono2').val();
        var monto3 = $('.montoAbono3').val();

        $('#montoRescatado').val(monto1 + monto2 + monto3);
    }
</script>-->
<!--  <script languaje="javaScript">
     function agregar (){
                 var intId = $("#buildyourform div").length + 2;
                 var fieldWrapper = $("<div class=\"fieldwrapper\" id=\"field" + intId + "\"/>");
                 var label1 = $("<label><b>Nombre Institución <a>" + intId + "</a></b></label>");
                 var fName = $("<input type=\"text\" class=\"form-control col-sm-6\" name=\"institucion" + intId + "\" required/>");
                 var label2 = $("<label><b>Número Cuenta Corriente</b></label>");
                 var fName2 = $("<input type=\"number\" class=\"form-control col-sm-6\" name=\"cuenta" + intId + "\" required/>");
                 var label3 = $("<label><b>Monto Abono</b></label>");
                 var fName3 = $("<input type=\"number\" class=\"form-control col-sm-6\" name=\"abono" + intId + "\" required/><br>");
                 var fName4 = $("<input type=\"file\" class=\"form-control col-sm-6\" name=\"archivo" + intId + "\" /><br>");
                 var removeButton = $("<input type=\"button\" class=\"btn btn-secondary\" value=\"Eliminar\" />");
                 removeButton.click(function () {
                     $(this).parent().remove();
                 });
                 if( intId < 4){
                 fieldWrapper.append(label1);
                 fieldWrapper.append(fName);
                 fieldWrapper.append(label2);
                 fieldWrapper.append(fName2);
                 fieldWrapper.append(label3);
                 fieldWrapper.append(fName3);
                 fieldWrapper.append(fName4);
                 fieldWrapper.append(removeButton);
                 $("#buildyourform").append(fieldWrapper);
             }else{
                 alert("no se puede abonar a mas de 3 instituciones");
             }
             };
    </script>
<script>
         $(document).ready(function () {
             $("#preview").click(function () {
                 $("#yourform").remove();
                 var fieldSet = $("<fieldset id=\"yourform\"><legend>Your Form</legend></fieldset>");
                 $("#buildyourform div").each(function () {
                     var id = "input" + $(this).attr("id").replace("field", "");
                     var label = $("<label for=\"" + id + "\">" + $(this).find("input.fieldname").first().val() + "</label>");
                     var input;
                     switch ($(this).find("select.fieldtype").first().val()) {
                         case "checkbox":
                             input = $("<input type=\"checkbox\" id=\"" + id + "\" name=\"" + id + "\" />");
                             break;
                         case "textbox":
                             input = $("<input type=\"text\" id=\"" + id + "\" name=\"" + id + "\" />");
                             break;
                         case "textarea":
                             input = $("<textarea id=\"" + id + "\" name=\"" + id + "\" ></textarea>");
                             break;
                     }
                     fieldSet.append(label);
                     fieldSet.append(input);
                 });
                 $("body").append(fieldSet);
             });
         });
</script>-->
</html>
