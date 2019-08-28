<?php
//export.php  
$connect = mysqli_connect("localhost", "root", "", "probando");
$output = '';
if (isset($_POST["export"])) {
    $query = "select
                            pet.id, 
                            pet.institucion,  
                            pet.fechaSolicitud,
                            pet.tipoMoneda,
                            est.id as idEstado,
                            est.nombre as estado,
                            pet.tipoSolicitud,
                            pet.cuentaCheque,
                            pet.descripcion,
                            pet.monto,
                            res.`fechaRescate`,
                            res.`porcentajeGanancia`,
                            res.`montoRescatado`
                        from peticion pet
                        left join estado est on est.id=pet.estado
                        left join rescate res on pet.id = res.`idPeticion`
                        ORDER BY id DESC";
    $result = mysqli_query($connect, $query);
    if (mysqli_num_rows($result) > 0) {
        $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>ID</th>  
                         <th>Institucion</th>  
                         <th>Fecha Solicitud</th>  
                         <th>Moneda</th>
                         <th>Estado</th>
                         <th>Tipo</th>
                         <th>Cuenta Cargo/ Numero Cheque</th>
                         <th>Descripcion</th>
                         <th>Monto</th>
                    </tr>
  ';
        while ($row = mysqli_fetch_array($result)) {
            $output .= '
    <tr>  
                         <td>' . $row["id"] . '</td>  
                         <td>' . $row["institucion"] . '</td>  
                         <td>' . $row["fechaSolicitud"] . '</td>  
                         <td>' . $row["tipoMoneda"] . '</td>  
                         <td>' . $row["estado"] . '</td>
                         <td>' . $row["tipoSolicitud"] . '</td>
                         <td>' . $row["cuentaCheque"] . '</td>
                         <td>' . $row["descripcion"] . '</td>
                         <td>' . $row["monto"] . '</td>
                    </tr>
   ';
        }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=download.xls');
        echo $output;
    }
}
?>
