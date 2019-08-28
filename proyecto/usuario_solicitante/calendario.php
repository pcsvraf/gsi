<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="author" content="Ruben Lacasa Mas - rubenlacasa.es">
<meta name="description" content="Demo de jQuery inline en castellano">
<title>datepicker demo</title>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/flick/jquery-ui.min.css">
<script src="https://code.jquery.com/jquery-1.10.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
</head>
<body>
<div id="datepicker"></div>
<div id="datos">
    <label for='fecha'>Fecha:</label>
    <!-- Campo de texto que recibira el valor seleccionado en el datepicker
    le he puesto el atributo readonly para no poder escribir directamente -->
    <input type='text' name='fecha' id='fecha' readonly />
    <form method="post">
    <input class="form-control" name="fecha" id="fecha" type="date">
    <button type="submit" name="boton">enviar</button>
    </form>
</div>
<script>
$( "#datepicker" ).datepicker({
    // Formato de la fecha
    dateFormat: "dd/mm/yy",
    // Primer dia de la semana El lunes
    firstDay: 1,
    // Dias Largo en castellano
    dayNames: [ "Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado" ],
    // Dias cortos en castellano
    dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
    // Nombres largos de los meses en castellano
    monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
    // Nombres de los meses en formato corto
    monthNamesShort: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dec" ],
    // Cuando seleccionamos la fecha esta se pone en el campo Input
    onSelect: function(dateText) {
          $('#fecha').val(dateText);
      }
});
</script>
</body>
</html>

<?php
require '../core/conexion.php';
$db = new Conect_MySql();
if(isset($_POST['boton'])){
    $fecha = $_POST['fecha'];

    $sql = "SELECT * FROM peticion WHERE `fechaSolicitud` LIKE '10-7-2018'";

    $ejecuta = $db->execute($sql);

    while ($datos = $db->fetch_row($ejecuta)){
            echo $datos['id'];
    }

}


?>
