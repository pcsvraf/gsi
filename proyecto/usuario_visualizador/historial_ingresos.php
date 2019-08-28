
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/estilos.css"  type="text/css">
        <link rel="stylesheet" href="../css/menu.css">
        <style type="text/css">
            .anotherhover tbody tr:hover td {
                background-color: #D3D3D3;
            }
            .table-striped tbody tr:nth-child(odd){
                background-color: #ECF7FF;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <br>
            <center><h1 style="font-size: 27px">PROCESAR INGRESO</h1></center>
            <br>
            <center><table class="table table-bordered anotherhover table-striped table-responsive-sm" id="tabla" style="font-size: 13px; color: #424242">
                    <tr>
                        <td class="btn-info" style="background-color: #12548c">ID</td>
                        <td class="btn-info" style="background-color: #12548c">Institución</td>
                        <td class="btn-info" style="background-color: #12548c">Fecha Solicitud</td>
                        <td class="btn-info" style="background-color: #12548c">Moneda</td>
                        <td class="btn-info" style="background-color: #12548c">Estado</td>
                        <td class="btn-info" style="background-color: #12548c">Tipo</td>
                        <td class="btn-info" style="background-color: #12548c">Cta. Cargo/ N° Cheque:</td>
                        <td class="btn-info" style="background-color: #12548c">Descripcion</td>
                        <td class="btn-info" style="background-color: #12548c">Monto</td>
                        <td class="btn-info" style="background-color: #12548c">Fecha Autorización</td>
                        <td class="btn-info" style="background-color: #12548c">Ingreso</td>
                    </tr>
                    <?php
                    include '../core/conexion.php';
                    $db = new Conect_MySql();

                    $sql = "select
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
                            pet.`fechaAutorizacion`,
                            pet.nombre_archivo
                        from peticion pet
                        left join estado est on est.id=pet.estado
                        where pet.estado = 4 AND pet.nombre_archivo2 != ''
                        ORDER BY id DESC";




                    $query = $db->execute($sql);
                    while ($datos = $db->fetch_row($query)) {
                        ?>
                        <tr>
                            <td><?php echo $datos['id']; ?></td>
                            <td><?php echo $datos['institucion']; ?></td>
                            <td><?php echo $datos['fechaSolicitud']; ?></td>
                            <td><?php echo $datos['tipoMoneda']; ?></td>
                            <td><?php echo $datos['estado'] ?></td>
                            <td><?php echo $datos['tipoSolicitud']; ?></td>
                            <td><?php echo $datos['cuentaCheque']; ?></td>
                            <td><?php echo $datos['descripcion']; ?></td>
                            <td><?php $z = number_format($datos['monto']);
                                echo str_replace(',', '.', $z); ?></td>
                            <td><?php echo $datos['fechaAutorizacion']; ?></td>
                            <td><?php echo '<center><a href="../usuario_visualizador/ingreso_procesado.php?id=' . $datos['id'] . '"><input type="image" src="../imagenes/Editar.png" width="30" height="30"></a></center>'; ?></td>
                        </tr>

                        <?php
                    }$db->close_db();
                    ?>
                </table></center>
        </div>
        <script src="../js/jquery-3.3.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/popper.min.js"></script>
    </body>
</html>
