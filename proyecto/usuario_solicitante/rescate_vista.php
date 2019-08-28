
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Rescate Vista</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/estilos.css">
        <link rel="stylesheet" href="../css/menu.css">
        <style type="text/css">
            .anotherhover tbody tr:hover td {
                background-color: #D3D3D3;
            }
            .table-striped tbody tr:nth-child(odd){
                background-color: #ECF7FF;
            }
        </style>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <br>
            <center><h1 class="offset-sm-0" style="font-size: 27px">RESCATAR</h1></center>
        <div class="container-fluid">
            <div class="col-sm-3 offset-sm-9">
                <form action="../usuario_solicitante/rescate_vista.php" method="post">
                    <div class="input-group">
                        <input class="form-control" placeholder="Buscar Por ID" name="id" id="id" required="" type="number">

                        <button class="btn btn-primary" name="buscar" style="background-color: #12548c; border:  #12548c" type="submit">Buscar</button>
                    </div>
                </form>
            </div>
            <table class="table table-bordered anotherhover table-striped table-responsive-sm" style="font-size: 13px">
                <tr>
                    <td class="btn-info" style="background-color: #12548c">ID</td>
                    <td class="btn-info" style="background-color: #12548c">Institución</td>
                    <td class="btn-info" style="background-color: #12548c">Fecha Solicitud</td>
                    <td class="btn-info" style="background-color: #12548c">Moneda</td>
                    <td class="btn-info" style="background-color: #12548c">Estado</td>
                    <td class="btn-info" style="background-color: #12548c">Tipo</td>
                    <td class="btn-info" style="background-color: #12548c">Nro° Cuenta</td>
                    <td class="btn-info" style="background-color: #12548c">Descripcion</td>
                    <td class="btn-info" style="background-color: #12548c">Monto</td>
                    <td class="btn-info" style="background-color: #12548c">Tasa Mensual</td>
                    <td class="btn-info" style="background-color: #12548c">Archivo</td>
                    <td class="btn-info" style="background-color: #12548c">Rescatar</td>
                </tr>
                <?php
                require '../core/conexion.php';
                $db = new Conect_MySql();
                if (isset($_POST['id'])) {
                    $palabra = $_POST['id'];
                    $query = "SELECT
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
                            pet.nombre_archivo,
                            pet.nombre_random,
                            pet.nombre_archivo2,
                            pet.nombre_random2,
                            pet.tasaMensual,
                            pet.cuentaOcheque,
                            res.`fechaRescate`,
                            res.`porcentajeGanancia`,
                            res.`montoRescatado`
                        from peticion pet
                        left join estado est on est.id=pet.estado
                        left join rescate res on pet.id = res.`idPeticion`
                        WHERE pet.id LIKE '%$palabra%' AND pet.estado <> 1 AND pet.estado <> 3 AND pet.estado <> 7 AND pet.estado <> 4 AND pet.estado <> 5 AND pet.estado <> 2 AND pet.nombre_archivo != ''
                        ORDER BY id DESC";

                    $consulta3 = $db->execute($query);
                    while ($datos = $consulta3->fetch_array(MYSQLI_ASSOC)) {
                        ?>
                        <tr>
                            <td><?php echo $datos['id']; ?></td>
                            <td><?php echo $datos['institucion']; ?></td>
                            <td><?php echo $datos['fechaSolicitud']; ?></td>
                            <td><?php echo $datos['tipoMoneda']; ?></td>
                            <td><?php echo $datos['estado']; ?></td>
                            <td><?php echo $datos['tipoSolicitud']; ?></td>
                            <td><?php echo $datos['cuentaCheque'] . $datos['cuentaOcheque']; ?></td>
                            <td><?php echo $datos['descripcion']; ?></td>
                            <td><?php $z = number_format($datos['monto']); echo str_replace(',', '.', $z); ?></td>
                            <td><?php echo $datos['tasaMensual']; ?></td>
                            <?php
                            if (empty($datos['nombre_archivo'])) {
                                ?>
                                <td><?php echo ''; ?></td>
                                <?php
                            } else {
                                ?>
                                <td><?php echo '<a target="_blank" class="btn btn-primary" style="color: #fff; width: 120px; height: 35px" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '&n=1">Ver</a>' ?></td>
                                <?php
                            }
                            ?>
                            <td><?php echo '<center><a href="../usuario_solicitante/rescate.php?id=' . $datos['id'] . '" style="color: #12548c"><input type="image" src="../imagenes/Editar.png" width="30" height="30"></a></center>'; ?></td>
                        </tr>

                        <?php
                    }
                } else {
                    $query = "SELECT
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
                            pet.nombre_archivo,
                            pet.nombre_random,
                            pet.nombre_archivo2,
                            pet.nombre_random2,
                            pet.tasaMensual,
                            pet.cuentaOcheque,
                            res.`fechaRescate`,
                            res.`porcentajeGanancia`,
                            res.`montoRescatado`
                        from peticion pet
                        left join estado est on est.id=pet.estado
                        left join rescate res on pet.id = res.`idPeticion`
                        WHERE pet.estado <> 1 AND pet.estado <> 3 AND pet.estado <> 4 AND pet.estado <> 7 AND pet.estado <> 5 AND pet.estado <> 2 AND pet.nombre_archivo != ''
                        ORDER BY id DESC";

                    $consulta3 = $db->execute($query);
                    while ($datos = $consulta3->fetch_array(MYSQLI_ASSOC)) {
                        ?>
                        <tr>
                            <td><?php echo $datos['id']; ?></td>
                            <td><?php echo $datos['institucion']; ?></td>
                            <td><?php echo $datos['fechaSolicitud']; ?></td>
                            <td><?php echo $datos['tipoMoneda']; ?></td>
                            <td><?php echo $datos['estado']; ?></td>
                            <td><?php echo $datos['tipoSolicitud']; ?></td>
                            <td><?php echo $datos['cuentaCheque'] . $datos['cuentaOcheque']; ?></td>
                            <td><?php echo $datos['descripcion']; ?></td>
                            <td><?php $z = number_format($datos['monto']); echo str_replace(',', '.', $z); ?></td>
                            <td><?php echo $datos['tasaMensual']; ?></td>
                            <?php
                            if (empty($datos['nombre_archivo'])) {
                                ?>
                                <td><?php echo ''; ?></td>
                                <?php
                            } else {
                                ?>
                                <td><?php echo '<center><a target="_blank" class="" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '&n=1"><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></a></center>' ?></td>
                                <?php
                            }
                            ?>
                            <td><?php echo '<center><a href="../usuario_solicitante/rescate.php?id=' . $datos['id'] . '" style="color: #12548c"><input type="image" src="../imagenes/Editar.png" width="30" height="30"></a></center>'; ?></td>
                        </tr>

                        <?php
                    }
                }
                ?>
            </table>
        </div>
        <script src="../js/jquery-3.3.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/guardar.js"></script>
    </body>
</html>
