<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
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
        <title>Editar/Eliminar Peticiones</title>
    </head>
    <body>
        <br>

    <center><h1 class="offset-sm-0" style="font-size: 27px">EDITAR / ELIMINAR</h1></center>
    <div class="container-fluid">
        <br>
        <table class="table table-bordered anotherhover table-striped table-responsive-sm" style="font-size: 13px">
            <tr>
                <td class="btn-info" style="background-color: #12548c">ID</td>
                <td class="btn-info" style="background-color: #12548c">Institución</td>
                <td class="btn-info" style="background-color: #12548c">Fecha Solicitud</td>
                <td class="btn-info" style="background-color: #12548c">Moneda</td>
                <td class="btn-info" style="background-color: #12548c">Estado</td>
                <td class="btn-info" style="background-color: #12548c">Tipo</td>
                <td class="btn-info" style="background-color: #12548c">Nro° Cuenta</td>
                <td class="btn-info" style="background-color: #12548c">Descripción</td>
                <td class="btn-info" style="background-color: #12548c">Monto</td>
                <td class="btn-info" style="background-color: #12548c">Tasa Mensual</td>
                <td class="btn-info" style="background-color: #12548c">Editar</td>
                <td class="btn-info" style="background-color: #12548c">Eliminar</td>
            </tr>
            <?php
            include '../core/conexion.php';
            $db = new Conect_MySql();

            $limitpage = 10;
            $page = 1;
            if (isset($_GET["page"]) && $_GET["page"] != "") {
                $page = $_GET["page"];
            }
            $startpage = 0;
            $endpage = $limitpage;
            if ($page > 1) {
                $startpage = ($page - 1) * $limitpage;
                $endpage = ($page) * $limitpage;
            }
            //echo $startpage;
            $user_id = null;
            $sql0 = "select count(*) as c from peticion where estado=1";
            $query0 = $db->execute($sql0);
            $count = $query0->fetch_array();
            $npages = $count["c"] / $limitpage;
            $sql1 = "select * from peticion limit $startpage,$limitpage";
            $query1 = $db->execute($sql1);

            $sql = "select
                            pet.id,
                            pet.institucion,
                            pet.`tipoMoneda`,
                            pet.fechaSolicitud,
                            est.nombre as estado,
                            pet.tipoSolicitud,
                            pet.`cuentaCheque`,
                            pet.descripcion,
                            pet.monto,
                            pet.`tasaMensual`,
                            pet.`cuentaOcheque`
                        from peticion pet
                        left join estado est on est.id=pet.estado
                        where estado=1
                        ORDER BY id DESC limit $startpage,$limitpage";
            $query = $db->execute($sql);
            while ($datos = $db->fetch_row($query)) {
                ?>
                <tr>
                    <td><?php echo $datos['id']; ?></td>
                    <td><?php echo $datos['institucion']; ?></td>
                    <td><?php echo $datos['tipoMoneda']; ?></td>
                    <td><?php echo $datos['fechaSolicitud']; ?></td>
                    <td><?php echo $datos['estado']; ?></td>
                    <td><?php echo $datos['tipoSolicitud']; ?></td>
                    <td><?php echo $datos['cuentaCheque'] . $datos['cuentaOcheque']; ?></td>
                    <td><?php echo $datos['descripcion']; ?></td>
                    <td><?php $z = number_format($datos['monto']); echo str_replace(',', '.', $z);?></td>
                    <td><?php echo $datos['tasaMensual']; ?></td>
                    <td><?php echo '<center><a href="../usuario_solicitante/update_solicitud.php?id=' . $datos['id'] . '"><input type="image" src="../imagenes/Editar.png" width="30" height="30"></a></center>'; ?></td>
                    <td><?php echo "<center><input type='image' onClick='confirmarEliminacion({$datos['id']});' src='../imagenes/Eliminar.png' width='30' height='30'><center>"; ?></td>

                </tr>

            <?php } $db->close_db(); ?>

        </table>
        <?php if ($count["c"] > $limitpage) { ?>
            <ul class="pagination" style="float: right">
                <?php if ($page > 1): ?>
                    <div><li>
                            <a href="<?php if ($page > 2): ?>./editar_peticiones_vista.php?page=<?php echo $page - 1; ?><?php else: ?> ./editar_peticiones_vista.php <?php endif; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                            <a href="editar_peticiones_vista.php">1</a>
                        </li>
                    </div>
                <?php endif; ?>
                <?php
                for ($i = 2; $i < $npages + 1; $i += 1):
                    ?>
                    <div>
                        <li><a href="editar_peticiones_vista.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    </div>
                <?php endfor; ?>
                <?php if ($page < $npages): ?>
                    <div>
                        <li>
                            <a href="editar_peticiones_vista.php?page=<?php echo $page + 1; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </div>
                <?php endif; ?>
            </ul>
        <?php }else { ?>
            <!--<p class="alert alert-warning">No hay resultados</p>-->
            <?php
        }
        ?>
    </div>
    <script src = "../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/funciones.js"></script>

</body>
</html>
