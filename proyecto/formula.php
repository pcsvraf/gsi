<html>

    <body>
        <form action="formula.php" method="POST">
            <label>fecha 1</label>
            <br>
            <input type="text" name="fecha1">
            <br>
            <label>fecha 2</label>
            <br>
            <input type="text" name="fecha2">
            <br>
            <label>ivertido</label>
            <input type="number" name="numero">
            <label>rescatado</label>
            <input type="number" name="numero2">
            <input type="submit" name="enviar">          
        </form>
    </body>
</html>
<?php
require './core/conexion.php';
$db = new Conect_MySql();
if (isset($_POST['enviar'])) {
    $fecha1 = $_POST['fecha1'];
    $fecha2 = $_POST['fecha2'];
    $invertido = $_POST['numero'];
    $rescatado = $_POST['numero2'];
    
    $query1 = "select * from rescate where idPeticion = 123";
    
    $eje2 = $db->execute($query1);
    
    $d = $db->fetch_row($eje2);
    
    $query = "select * from peticion where id = 123";
    
    $eje = $db->execute($query);
    
    $datos = $db->fetch_row($eje);
    


    function dias_transcurridos($fecha1, $fecha2) {
        $dias = (strtotime($fecha1) - strtotime($fecha2)) / 86400;
        $dias = abs($dias);
        $dias = floor($dias);
        return $dias;
    }
    $d2 = "%";
    //$invertido = $datos['monto'];
    //$rescatado = $d['montoRescatado'];
    $days = dias_transcurridos($fecha1,$fecha2); 
    $interes = ($rescatado - $invertido);
    
    $tasa = (($interes/$invertido)*30/$days);
    echo 'monto invertido:'.$invertido;
    echo '<br>';
    echo 'monto rescatado:'.$rescatado;
    echo '<br>';
    echo 'días:'.$days;
    echo '<br>';
    echo 'interes:'.$interes;
    echo '<br>';
    echo round($tasa * 100, 2).$d2;

}
?>