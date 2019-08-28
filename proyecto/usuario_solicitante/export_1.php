<?php
require '../core/conexion.php';
$db = new Conect_MySql();
$output = '';

//if (isset($_POST["export"])) {
$consulta = "select *";

$query = "select
                            pet.id, 
                            pet.institucion,  
                            pet.fechaSolicitud,
                            pet.fechaAutorizacion,
                            pet.tipoMoneda,
                            est.id as idEstado,
                            est.nombre as estado,
                            pet.tipoSolicitud,
                            pet.cuentaCheque,
                            pet.descripcion,
                            pet.monto,
                            pet.tasaMensual,
                            pet.cuentaOcheque,
                            res.`fechaRescate`,
                            res.`porcentajeGanancia`,
                            res.`montoRescatado`,
                            res.`diasTranscurridos`,
                            res.`tasaInteresMensual`,
                            ing.numeroIngreso,
                            ing.numeroEgreso
                        from peticion pet
                        left join estado est on est.id=pet.estado
                        left join rescate res on pet.id = res.`idPeticion`
                        left join ingreso_procesado ing on pet.id = ing.`idPeticion`
                        where pet.estado = 7
                        ORDER BY id DESC";
$result = $db->execute($query);
if ($db->get_num_rows($result) > 0) {
    $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>ID</th>  
                         <th>Institución</th>  
                         <th>Fecha Autorización</th>  
                         <th>Moneda</th>
                         <th>Tipo</th>
                         <th>Nro° Cuenta</th>
                         <th>Descripción</th>
                         <th>Monto Inversión</th>
                         <th>Tasa Mensual</th>
                         <th>Estado</th>
                         <th>Fecha Rescate</th>
                         <th>Monto Rescatado</th>
                         <th>Días Permanencia</th>
                         <th>Tasa Interes Mensual</th>
                         <th>Número Egreso</th>
                         <th>Número Ingreso</th>
                    </tr>
  ';
    while ($row = mysqli_fetch_array($result)) {
        $output .= '
                    <tr>  
                         <td>' . $row["id"] . '</td>  
                         <td>' . $row["institucion"] . '</td>  
                         <td>' . $row["fechaAutorizacion"] . '</td>  
                         <td>' . $row["tipoMoneda"] . '</td>  
                         <td>' . $row["tipoSolicitud"] . '</td>
                         <td>' . $row["cuentaCheque"] . '</td>
                         <td>' . $row["descripcion"] . '</td>
                         <td>' . $row["monto"] . '</td>
                         <td>' . $row["tasaMensual"] . '</td>
                         <td>' . $row["estado"] . '</td>
                         <td>' . $row["fechaRescate"] . '</td>   
                         <td>' . $row["montoRescatado"] . '</td> 
                         <td>' . $row["diasTranscurridos"] . '</td>
                         <td>' . $row["tasaInteresMensual"] . '</td>
                         <td>' . $row["numeroEgreso"] . '</td>
                         <td>' . $row["numeroIngreso"] . '</td>
                    </tr>
   ';
        
    }
    $output .= '</table>';
    header('Content-Type: application/xls; charset=UTF-8');
    header('Content-Disposition: attachment; filename=Historial.xls');
    echo utf8_decode($output);
}
?> 
