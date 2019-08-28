<?php

function cambiarColor($idEstado, $estado) {

    $msg = "";

    switch ($idEstado) {

        case 1:
            $color = "style='color: #702283; font-weight:bold'";
            break;

        case 2:
            $color = "style='color: #12548c; font-weight:bold'";
            break;

        case 3:
            $color = "style='color: #f80000; font-weight:bold'";
            break;

        case 4:
            $color = "style='color: #1ca2bb; font-weight:bold'";
            break;

        case 5:
            $color = "style='color: #04b431; font-weight:bold'";
            break;
    }
    return "<label $color>$estado</label>";
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/estilos.css"  type="text/css">
        <link rel="stylesheet" href="../css/menu.css">
        <link rel="stylesheet" href="../css/archivo.css">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/flick/jquery-ui.min.css">
        <script src="https://code.jquery.com/jquery-1.10.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <style type="text/css">
            .anotherhover tbody tr:hover td {
                background-color: #D3D3D3;
            }
            .table-striped tbody tr:nth-child(odd){
                background-color: #ECF7FF;
            }
        </style>
            <!--<style type="text/css">
                @media screen and (max-width: 600px) {
                    table {
                        width:100%;
                    }
                    thead {
                        display: none;
                    }
                    tr:nth-of-type(2n) {
                        background-color: inherit;
                    }
                    tr td:first-child {
                        background: #f0f0f0;
                        font-weight:bold;
                        font-size:1.3em;
                    }
                    tbody td {
                        display: block;
                        text-align:center;
                    }
                    tbody td:before {
                        content: attr(data-th);
                        display: block;
                        text-align:center;
                    }
                }
            </style>-->
           <!-- <style type="text/css">
                @media only screen and (max-width: 800px) {

                    /* Force table to not be like tables anymore */
                    table,
                    thead,
                    tbody,
                    th,
                    td,
                    tr {
                        display: block;
                    }

                    /* Hide table headers (but not display: none;, for accessibility) */
                    thead tr {
                        position: absolute;
                        top: -9999px;
                        left: -9999px;
                    }

                    tr { border: 1px solid #ccc; }

                    td {
                        /* Behave  like a "row" */
                        border: none;
                        border-bottom: 1px solid #eee;
                        position: relative;
                        padding-left: 50%;
                        white-space: normal;
                        text-align:left;
                    }

                    td:before {
                        /* Now like a table header */
                        position: absolute;
                        /* Top/left values mimic padding */
                        top: 6px;
                        left: 6px;
                        width: 45%;
                        padding-right: 10px;
                        white-space: nowrap;
                        text-align:left;
                        font-weight: bold;
                    }

                    /*
                    Label the data
                    */
                    td:before { content: attr(data-title); }
                }
            </style>-->
    </head>
    <body>
        <br>
    <center><h1 class="offset-sm-0" style="font-size: 27px">SOLICITUDES</h1></center>
    <div class="container-fluid">
        <div class="col-sm-5 offset-sm-7">
            <form action="historial_solicitudes.php" method="post">
                <div class="input-group">
                    <select style="height: 40px" id="select" name="idEstado" class="form-control" onchange="redireccionar(this);">
                        <option value="0">Todos los Estados</option>
                        <option value="1">Ingresado</option>
                        <option value="2">Aceptado</option>
                        <option value="6">Egreso Procesado</option>
                        <option value="3">Rechazado</option>
                        <option value="4">Rescatado</option>
                        <option value="7">Ingreso Procesado</option>
                    </select>
                    <input class="form-control" name="id" id="id" type="number" required="" placeholder="Buscar por ID">
                    <br>
                    <button class="btn btn-primary" style="background-color: #12548c; border:  #12548c" type="submit" name="buscar" id="buscar">Buscar</button>
                </div>
                <!--<div id="datepicker"></div>
                 <div id="datos">
                     <label for='fecha'>Fecha:</label>
                <!-- Campo de texto que recibira el valor seleccionado en el datepicker
                le he puesto el atributo readonly para no poder escribir directamente
                <input type='text' name='fecha' id='fecha' readonly />
            </div>-->
            </form>
        </div>
        <!-- <form method="post" action="export.php">
             <input type="image" src="../imagenes/excel-1.png" width="35px" height="35px" name="export" class="btn-success" value="Export" />
         </form>-->
        <center><table class="table table-bordered anotherhover table-striped table-responsive-sm" id="tabla" style="font-size: 13px; color: #424242">
                <tr>
                    <th class="btn-info" style="background-color: #12548c">ID</th>
                    <th class="btn-info" style="background-color: #12548c">Institución</th>
                    <th class="btn-info" style="background-color: #12548c">Fecha Solicitud</th>
                    <th class="btn-info" style="background-color: #12548c">Moneda</th>
                    <th class="btn-info" style="background-color: #12548c">Tipo</th>
                    <th class="btn-info" style="background-color: #12548c">Nro° Cuenta</th>
                    <th class="btn-info" style="background-color: #12548c">Descripción</th>
                    <th class="btn-info" style="background-color: #12548c">Monto</th>
                    <th class="btn-info" style="background-color: #12548c">Tasa Mensual</th>
                    <th class="btn-info" style="background-color: #12548c">Estado</th>
                    <?php if ($_REQUEST['idEstado'] == 2) {
                        ?>
                        <th class="btn-info" style="background-color: #12548c">Fecha Autorización</th>
                        <th class="btn-info" style="background-color: #12548c">Doc. Aceptación</th>
                        <?php
                    }
                    ?>
                    <?php
                    if ($_REQUEST['idEstado'] == 4) {
                        ?>
                        <th class = "btn-info" style = "background-color: #12548c">Fecha Rescate</th>
                        <th class = "btn-info" style = "background-color: #12548c">Porcentaje Rentabilidad</th>
                        <th class = "btn-info" style = "background-color: #12548c">Monto Rescatado</th>
                        <th class = "btn-info" style = "background-color: #12548c">Doc. Aceptación</th>
                        <th class = "btn-info" style = "background-color: #12548c">Doc. Rescate</th>
                        <?php
                    }
                    ?>
                    <?php
                    if ($_REQUEST['idEstado'] == 5) {
                        ?>
                        <th class = "btn-info" style = "background-color: #12548c">Fecha Rescate</th>
                        <th class = "btn-info" style = "background-color: #12548c">Porcentaje Rentabilidad</th>
                        <th class = "btn-info" style = "background-color: #12548c">Monto Rescatado</th>
                        <th class = "btn-info" style = "background-color: #12548c">Doc. Aceptación</th>
                        <th class = "btn-info" style = "background-color: #12548c">Doc. Rescate</th>
                        <?php
                    }
                    ?>
                    <?php
                    if ($_REQUEST['idEstado'] == 6) {
                        ?>
                        <th class = "btn-info" style = "background-color: #12548c">N° Egreso</th>
                        <th class = "btn-info" style = "background-color: #12548c">Doc. Aceptación</th>
                        <?php
                    }
                    ?>
                    <?php
                    if ($_REQUEST['idEstado'] == 7) {
                        ?>
                        <th class = "btn-info" style = "background-color: #12548c">Fecha Rescate</th>
                        <th class = "btn-info" style = "background-color: #12548c">Monto Rescatado</th>
                        <th class = "btn-info" style = "background-color: #12548c">Días Permanencia</th>
                        <th class = "btn-info" style = "background-color: #12548c">Tasa Interés Mensual</th>
                        <th class = "btn-info" style = "background-color: #12548c">Proceso Finalizado</th>
                        <?php
                    }
                    ?>

                </tr>
                <?php
                include '../core/conexion.php';
                $db = new Conect_MySql();
                if (isset($_POST['buscar'])) {
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
                    $sql0 = "select count(*) as c from peticion";
                    $query0 = $db->execute($sql0);
                    $count = $query0->fetch_array();
                    $npages = $count["c"] / $limitpage;
                    $sql1 = "select * from peticion limit $startpage,$limitpage";
                    $query1 = $db->execute($sql1);

                    $sqlFilter = "where ";
                    if (!empty($_POST['id'])) {
                        $sqlFilter .= "pet.id LIKE '%{$_POST['id']}%'";
                    }

                    if (!empty($_REQUEST['idEstado'])) {

                        if (!empty($_POST['id'])) {
                            $sqlFilter .= " && ";
                        }

                        $sqlFilter .= "pet.estado = {$_REQUEST['idEstado']}";
                    }

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
                                    pet.nombre_archivo,
                                    pet.nombre_random,
                                    pet.nombre_archivo2,
                                    pet.nombre_random2,
                                    pet.`tasaMensual`,
                                    pet.cuentaOcheque,
                                    res.`fechaRescate`,
                                    res.`porcentajeGanancia`,
                                    res.`montoRescatado`
                                from peticion pet
                                left join estado est on est.id=pet.estado
                                left join rescate res on pet.id = res.`idPeticion`
                                $sqlFilter
                                ORDER BY id DESC limit $startpage,$limitpage";

                    $query = $db->execute($sql);
                    while ($datos = $db->fetch_row($query)) {
                        ?>
                        <tr>
                            <td><?php echo $datos['id']; ?></td>
                            <td><?php echo $datos['institucion']; ?></td>
                            <td><?php echo $datos['fechaSolicitud']; ?></td>
                            <td><?php echo $datos['tipoMoneda']; ?></td>
                            <td><?php echo $datos['tipoSolicitud']; ?></td>
                            <td><?php echo $datos['cuentaCheque'] . $datos['cuentaOcheque']; ?></td>
                            <td><?php echo $datos['descripcion']; ?></td>
                            <td><?php $z = number_format($datos['monto']);
                                echo str_replace(',', '.', $z); ?></td>
                            <td><?php echo $datos['tasaMensual']; ?></td>
                            <!--<td><?php //echo cambiarColor($datos['idEstado'], $datos['estado']);                                   ?></td>-->
                            <?php if ($datos['estado'] == 'Ingresado') { ?>
                                <td style="background-color: #ff9f1a; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
                            <?php } else if ($datos['estado'] == 'Aceptado') { ?>
                                <td style="background-color: #98aab3; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
                            <?php } else if ($datos['estado'] == 'Rechazado') { ?>
                                <td style="background-color: #d93651; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
                            <?php } else if ($datos['estado'] == 'Rescatado') { ?>
                                <td style="background-color: #00aaff; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
                            <?php } else if ($datos['estado'] == 'Finalizado') { ?>
                                <td style="background-color: #8acc47; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
                            <?php } else if ($datos['estado'] == 'Egreso Procesado') { ?>
                                <td style="font-weight: bold"><?php echo $datos['estado']; ?></td>
                            <?php } else if ($datos['estado'] == 'Ingreso Procesado') { ?>
                                <td><?php echo $datos['estado']; ?></td>
                            <?php } ?>
                            <?php
                            if ($_REQUEST['idEstado'] == 2) {
                                ?>
                                <td><?php echo $datos['fechaAutorizacion']; ?></td>
                                <?php
                                if (empty($datos['nombre_archivo'])) {
                                    ?>
                                    <td><center><input type="image" style="width: 50px; height: 40px" src="../imagenes/nohay.png"></center></td>
                                <?php
                            } else {
                                ?>
                                <td><?php echo '<a target="_blank" class="" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '"><center><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></center></a>' ?></td>
                                <?php
                            }
                            ?>
                            <?php
                        }
                        ?>
                        <?php
                        if ($_REQUEST['idEstado'] == 4) {
                            ?>
                            <?php
                            $consulta = "select * from rescate where idPeticion=" . $datos['id'];
                            $ejecuta = $db->execute($consulta);
                            $filita = $db->fetch_row($ejecuta);
                            $consulta2 = "select rentabilidad from abonos where idPeticion=" . $datos['id'];
                            $ejecuta2 = $db->execute($consulta2);
                            $fila2 = $db->fetch_row($ejecuta2);
                            ?>
                            <td><?php echo $filita['fechaRescate']; ?></td>
                            <td><?php echo $fila2['rentabilidad']; ?></td>
                            <td><?php $z = number_format($filita['montoRescatado']);
                            echo str_replace(',', '.', $z); ?></td>
                            <?php
                            if (empty($datos['nombre_archivo2'])) {
                                ?>
                                <td><?php echo '<a target="_blank" class="" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '"><center><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></center></a>' ?></td>
                                <td><center><input type="image" style="width: 30px; height: 30px" src="../imagenes/nohay.png"></center></td>
            <?php } else {
                ?>
                                <td><?php echo '<a target="_blank" class="" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '&var1=1"><center><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></center></a>' ?></td>
                                <td><?php echo '<a target="_blank" class="" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '&var1=2"><center><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></center></a>' ?></td>
                                <?php
                            }
                        }
                        ?>
                        <?php
                        if ($_REQUEST['idEstado'] == 5) {
                            ?>
                            <td><?php echo $datos['fechaRescate']; ?></td>
                            <td><?php echo $datos['porcentajeGanancia']; ?></td>
                            <td><?php echo $datos['montoRescatado']; ?></td>
                            <td><?php echo '<center><a target="_blank" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '&var1=1"><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></a></center>' ?></td>
                            <td><?php echo '<center><a target="_blank" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '&var1=2"><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></a></a></center>' ?></td>
                            </tr>
                            <?php
                        }
                       $consulta = "select * from rescate where idPeticion=" . $datos['id'];
                        $quer = $db->execute($consulta);
                        $fila = $db->fetch_row($quer);

                        $consulta2 = "select * from ingreso_procesado where idPeticion=" . $datos['id'];
                        $quer2 = $db->execute($consulta2);
                        $fila2 = $db->fetch_row($quer2);
                        if ($_REQUEST['idEstado'] == 6) {
                            ?>
                            <td><?php echo $fila['numeroEgreso']; ?></td>
                            <td><?php echo '<a class="" target="_blank" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '"><center><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></center></a>' ?></td>
                            <?php
                        }
                        if ($_REQUEST['idEstado'] == 7) {
                            $d = "%";
                            ?>
                            <td><?php echo $datos['fechaRescate']; ?></td>
                            <td><?php
                                $z = number_format($fila['montoRescatado']);
                                echo str_replace(',', '.', $z);
                                ?></td>
                            <td><?php echo $fila['diasTranscurridos']; ?></td>
                            <td><?php echo $fila['tasaInteresMensual'] . $d; ?></td>
                            <td><?php echo '<a class="" href="../usuario_autorizador/inversion_finalizada.php?id=' . $datos['id'] . '"><center><input type="image" src="../imagenes/checklist2.png" width="35" height="35"></center></a>' ?></td>
                            <?php
                        }
                    }
                    //esto sucede en TODOS LOS ESTADOS, se muestran todas las solicitudes
                    //y se generan nuevas páginas según los datos que estén ingresados
                } elseif ($_REQUEST['idEstado'] == 0) {
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
                    $sql0 = "select count(*) as c from peticion";
                    $query0 = $db->execute($sql0);
                    $count = $query0->fetch_array();
                    $npages = $count["c"] / $limitpage;
                    $sql1 = "select * from peticion limit $startpage,$limitpage";
                    $query1 = $db->execute($sql1);

                    $sqlFilter = "";
                    if (!empty($_REQUEST['idEstado'])) {
                        $sqlFilter = "where pet.estado ={$_REQUEST['idEstado']}";
                    }

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
                            pet.nombre_archivo,
                            pet.nombre_random,
                            pet.nombre_archivo2,
                            pet.nombre_random2,
                            pet.`tasaMensual`,
                            pet.cuentaOcheque,
                            res.`fechaRescate`,
                            res.`porcentajeGanancia`,
                            res.`montoRescatado`
                        from peticion pet
                        left join estado est on est.id=pet.estado
                        left join rescate res on pet.id = res.`idPeticion`
                        $sqlFilter
                        ORDER BY id DESC limit $startpage,$limitpage";

                    $query = $db->execute($sql);
                    while ($datos = $db->fetch_row($query)) {
                        ?>
                        <tr>
                            <td><?php echo $datos['id']; ?></td>
                            <td><?php echo $datos['institucion']; ?></td>
                            <td><?php echo $datos['fechaSolicitud']; ?></td>
                            <td><?php echo $datos['tipoMoneda']; ?></td>
                            <td><?php echo $datos['tipoSolicitud']; ?></td>
                            <td><?php echo $datos['cuentaCheque'] . $datos['cuentaOcheque']; ?></td>
                            <td><?php echo $datos['descripcion']; ?></td>
                            <td><?php $z = number_format($datos['monto']);
                        echo str_replace(',', '.', $z); ?></td>
                            <td><?php echo $datos['tasaMensual']; ?></td>
                            <!--<td><?php //echo cambiarColor($datos['idEstado'], $datos['estado']);                                 ?></td>-->
                            <?php if ($datos['estado'] == 'Ingresado') { ?>
                                <td style="background-color: #ff9f1a; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
                            <?php } else if ($datos['estado'] == 'Aceptado') { ?>
                                <td style="background-color: #98aab3; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
                            <?php } else if ($datos['estado'] == 'Rechazado') { ?>
                                <td style="background-color: #d93651; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
                            <?php } else if ($datos['estado'] == 'Rescatado') { ?>
                                <td style="background-color: #00aaff; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
                            <?php } else if ($datos['estado'] == 'Finalizado') { ?>
                                <td style="background-color: #8acc47; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
                            <?php } else if ($datos['estado'] == 'Egreso Procesado') { ?>
                                <td style="font-weight:bold"><?php echo $datos['estado']; ?></td>
                            <?php } else if ($datos['estado'] == 'Ingreso Procesado') { ?>
                                <td><?php echo $datos['estado']; ?></td>
                                <?php
                            }
                            if ($_REQUEST['idEstado'] == 2) {
                                ?>
                                <td><?php echo $datos['fechaAutorizacion']; ?></td>
                                <?php
                                if (empty($datos['nombre_archivo'])) {
                                    ?>
                                    <td><?php echo '<a class="" href="../usuario_solicitante/archivo_aceptado.php?id=' . $datos['id'] . '"><center><input type="image" style="width: 30px; height: 30px" src="../imagenes/2018-07-18.png"></center></a>' ?></td>
                                    <?php
                                } else {
                                    ?>
                                    <td><?php echo '<a target="_blank" class="" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '"><center><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></center></a>' ?></td>
                                    <?php
                                }
                                ?>
                                <?php
                            }
                            ?>
        <?php
        if ($_REQUEST['idEstado'] == 4) {
            ?>
                                <td><?php echo $datos['fechaRescate']; ?></td>
                                <td><?php echo $datos['porcentajeGanancia']; ?></td>
                                <td><?php echo $datos['montoRescatado']; ?></td>
                                <?php
                                if (empty($datos['nombre_archivo2'])) {
                                    ?>
                                    <td><?php echo '<a class="" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '"><center><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></center></a>' ?></td>
                                    <td><?php echo '<a class="" href="../usuario_solicitante/archivo_aceptado.php?id=' . $datos['id'] . '"><center><input type="image" style="width: 30px; height: 30px" src="../imagenes/2018-07-18.png"></center></a>' ?></td>
                                    <?php
                                }
                            }
                            ?>
        <?php
        if ($_REQUEST['idEstado'] == 5) {
            ?>
                                <td><?php echo $datos['fechaRescate']; ?></td>
                                <td><?php echo $datos['porcentajeGanancia']; ?></td>
                                <td><?php echo $datos['montoRescatado']; ?></td>
                                <td><?php echo '<center><a target="_blank" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '&var1=1"><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></a></center>' ?></td>
                                <td><?php echo '<center><a target="_blank" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '&var1=2"><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></a></a></center>' ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                <?php }
                ?>
                </table></center>
    <?php if ($count["c"] > $limitpage) { ?>
                <ul class="pagination" style="float: right">
        <?php if ($page > 1): ?>
                        <div><li>
                                <a href="<?php if ($page > 2): ?>./historial_solicitudes.php?idEstado=0&page=<?php echo $page - 1; ?><?php else: ?> ./historial_solicitudes.php?idEstado=0 <?php endif; ?>" aria-label="Previous" class="btn btn-outline-primary">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                                <a href="historial_solicitudes.php?idEstado=0" class="btn btn-outline-primary">1</a>
                            </li>
                        </div>
        <?php endif; ?>
        <?php
        for ($i = 2; $i < $npages + 1; $i += 1):
            ?>
                        <div>
                            <li><a href="historial_solicitudes.php?page=<?php echo $i; ?>&idEstado=0" class="btn btn-outline-primary"><?php echo $i; ?></a></li>
                        </div>
        <?php endfor; ?>
        <?php if ($page < $npages): ?>
                        <div>
                            <li>
                                <a href="historial_solicitudes.php?page=<?php echo $page + 1; ?>&idEstado=0" aria-label="Next" class="btn btn-outline-primary">
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
        } elseif ($_REQUEST['idEstado'] == 1) {
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

            $sqlFilter = "";
            if (!empty($_REQUEST['idEstado'])) {
                $sqlFilter = "where pet.estado ={$_REQUEST['idEstado']}";
            }

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
                            pet.nombre_archivo,
                            pet.nombre_random,
                            pet.nombre_archivo2,
                            pet.nombre_random2,
                            pet.`tasaMensual`,
                            pet.cuentaOcheque,
                            res.`fechaRescate`,
                            res.`porcentajeGanancia`,
                            res.`montoRescatado`
                        from peticion pet
                        left join estado est on est.id=pet.estado
                        left join rescate res on pet.id = res.`idPeticion`
                        $sqlFilter
                        ORDER BY id DESC limit $startpage,$limitpage";

            $query = $db->execute($sql);
            while ($datos = $db->fetch_row($query)) {
                ?>
                <tr>
                    <td><?php echo $datos['id']; ?></td>
                    <td><?php echo $datos['institucion']; ?></td>
                    <td><?php echo $datos['fechaSolicitud']; ?></td>
                    <td><?php echo $datos['tipoMoneda']; ?></td>
                    <td><?php echo $datos['tipoSolicitud']; ?></td>
                    <td><?php echo $datos['cuentaCheque'] . $datos['cuentaOcheque']; ?></td>
                    <td><?php echo $datos['descripcion']; ?></td>
                    <td><?php $z = number_format($datos['monto']);
            echo str_replace(',', '.', $z); ?></td>
                    <td><?php echo $datos['tasaMensual']; ?></td>
                    <!--<td><?php //echo cambiarColor($datos['idEstado'], $datos['estado']);                                ?></td>-->
                    <?php if ($datos['estado'] == 'Ingresado') { ?>
                        <td style="background-color: #ff9f1a; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
                    <?php } else if ($datos['estado'] == 'Aceptado') { ?>
                        <td style="background-color: #98aab3; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
                    <?php } else if ($datos['estado'] == 'Rechazado') { ?>
                        <td style="background-color: #d93651; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
                    <?php } else if ($datos['estado'] == 'Rescatado') { ?>
                        <td style="background-color: #00aaff; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
                    <?php } else if ($datos['estado'] == 'Finalizado') { ?>
                        <td style="background-color: #8acc47; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
                    <?php } ?>
                    <?php
                    if ($_REQUEST['idEstado'] == 2) {
                        ?>
                        <td><?php echo $datos['fechaAutorizacion']; ?></td>
                        <?php
                        if (empty($datos['nombre_archivo'])) {
                            ?>
                            <td><?php echo '<a class="" href="../usuario_solicitante/archivo_aceptado.php?id=' . $datos['id'] . '"><center><input type="image" style="width: 30px; height: 30px" src="../imagenes/2018-07-18.png"></center></a>' ?></td>
                            <?php
                        } else {
                            ?>
                            <td><?php echo '<a target="_blank" class="" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '"><center><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></center></a>' ?></td>
                            <?php
                        }
                        ?>
                        <?php
                    }
                    ?>
                    <?php
                    if ($_REQUEST['idEstado'] == 4) {
                        ?>
                        <td><?php echo $datos['fechaRescate']; ?></td>
                        <td><?php echo $datos['porcentajeGanancia']; ?></td>
                        <td><?php echo $datos['montoRescatado']; ?></td>
                        <?php
                        if (empty($datos['nombre_archivo2'])) {
                            ?>
                            <td><?php echo '<a class="" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '"><center><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></center></a>' ?></td>
                            <td><?php echo '<a class="" href="../usuario_solicitante/archivo_aceptado.php?id=' . $datos['id'] . '"><center><input type="image" style="width: 30px; height: 30px" src="../imagenes/2018-07-18.png"></center></a>' ?></td>
                            <?php
                        }
                    }
                    ?>
        <?php
        if ($_REQUEST['idEstado'] == 5) {
            ?>
                        <td><?php echo $datos['fechaRescate']; ?></td>
                        <td><?php echo $datos['porcentajeGanancia']; ?></td>
                        <td><?php echo $datos['montoRescatado']; ?></td>
                        <td><?php echo '<center><a target="_blank" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '&var1=1"><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></a></center>' ?></td>
                        <td><?php echo '<center><a target="_blank" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '&var1=2"><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></a></a></center>' ?></td>
                    </tr>
            <?php
        }
        ?>
        <?php }
        ?>
        </table></center>
    <?php if ($count["c"] > $limitpage) { ?>
        <ul class="pagination" style="float: right">
        <?php if ($page > 1): ?>
                <div><li>
                        <a href="<?php if ($page > 2): ?>./historial_solicitudes.php?idEstado=1&page=<?php echo $page - 1; ?><?php else: ?> ./historial_solicitudes.php?idEstado=1 <?php endif; ?>" aria-label="Previous" class="btn btn-outline-primary">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                        <a href="historial_solicitudes.php?idEstado=1" class="btn btn-outline-primary">1</a>
                    </li>
                </div>
        <?php endif; ?>
            <?php
            for ($i = 2; $i < $npages + 1; $i += 1):
                ?>
                <div>
                    <li><a href="historial_solicitudes.php?page=<?php echo $i; ?>&idEstado=1" class="btn btn-outline-primary"><?php echo $i; ?></a></li>
                </div>
        <?php endfor; ?>
        <?php if ($page < $npages): ?>
                <div>
                    <li>
                        <a href="historial_solicitudes.php?page=<?php echo $page + 1; ?>&idEstado=1" aria-label="Next" class="btn btn-outline-primary">
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
} elseif ($_REQUEST['idEstado'] == 2) {
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
    $sql0 = "select count(*) as c from peticion where estado=2";
    $query0 = $db->execute($sql0);
    $count = $query0->fetch_array();
    $npages = $count["c"] / $limitpage;
    $sql1 = "select * from peticion limit $startpage,$limitpage";
    $query1 = $db->execute($sql1);

    $sqlFilter = "";
    if (!empty($_REQUEST['idEstado'])) {
        $sqlFilter = "where pet.estado ={$_REQUEST['idEstado']}";
    }

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
                            pet.nombre_archivo,
                            pet.nombre_random,
                            pet.nombre_archivo2,
                            pet.nombre_random2,
                            pet.`tasaMensual`,
                            pet.cuentaOcheque,
                            res.`fechaRescate`,
                            res.`porcentajeGanancia`,
                            res.`montoRescatado`
                        from peticion pet
                        left join estado est on est.id=pet.estado
                        left join rescate res on pet.id = res.`idPeticion`
                        $sqlFilter
                        ORDER BY id DESC limit $startpage,$limitpage";

    $query = $db->execute($sql);
    while ($datos = $db->fetch_row($query)) {
        ?>
        <tr>
            <td><?php echo $datos['id']; ?></td>
            <td><?php echo $datos['institucion']; ?></td>
            <td><?php echo $datos['fechaSolicitud']; ?></td>
            <td><?php echo $datos['tipoMoneda']; ?></td>
            <td><?php echo $datos['tipoSolicitud']; ?></td>
            <td><?php echo $datos['cuentaCheque'] . $datos['cuentaOcheque']; ?></td>
            <td><?php echo $datos['descripcion']; ?></td>
            <td><?php $z = number_format($datos['monto']);
        echo str_replace(',', '.', $z); ?></td>
            <td><?php echo $datos['tasaMensual']; ?></td>
            <!--<td><?php //echo cambiarColor($datos['idEstado'], $datos['estado']);                                 ?></td>-->
            <?php if ($datos['estado'] == 'Ingresado') { ?>
                <td style="background-color: #ff9f1a; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } else if ($datos['estado'] == 'Aceptado') { ?>
                <td style="background-color: #98aab3; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } else if ($datos['estado'] == 'Rechazado') { ?>
                <td style="background-color: #d93651; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } else if ($datos['estado'] == 'Rescatado') { ?>
                <td style="background-color: #00aaff; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } else if ($datos['estado'] == 'Finalizado') { ?>
                <td style="background-color: #8acc47; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } ?>
            <?php
            if ($_REQUEST['idEstado'] == 2) {
                ?>
                <td><?php echo $datos['fechaAutorizacion']; ?></td>
            <?php
            if (empty($datos['nombre_archivo'])) {
                ?>
                    <td><center><input type="image" style="width: 30px; height: 30px" src="../imagenes/nohay.png"></center></td>
                <?php
            } else {
                ?>
                <td><?php echo '<a target="_blank" class="" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '"><center><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></center></a>' ?></td>
                <?php
            }
            ?>
            <?php
        }
        ?>
        <?php
        if ($_REQUEST['idEstado'] == 4) {
            ?>
            <td><?php echo $datos['fechaRescate']; ?></td>
            <td><?php echo $datos['porcentajeGanancia']; ?></td>
            <td><?php echo $datos['montoRescatado']; ?></td>
            <?php
            if (empty($datos['nombre_archivo2'])) {
                ?>
                <td><?php echo '<a class="" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '"><center><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></center></a>' ?></td>
                <td><?php echo '<a class="" href="../usuario_solicitante/archivo_aceptado.php?id=' . $datos['id'] . '"><center><input type="image" style="width: 30px; height: 30px" src="../imagenes/2018-07-18.png"></center></a>' ?></td>
                <?php
            }
        }
        ?>
        <?php
        if ($_REQUEST['idEstado'] == 5) {
            ?>
            <td><?php echo $datos['fechaRescate']; ?></td>
            <td><?php echo $datos['porcentajeGanancia']; ?></td>
            <td><?php echo $datos['montoRescatado']; ?></td>
            <td><?php echo '<center><a target="_blank" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '&var1=1"><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></a></center>' ?></td>
            <td><?php echo '<center><a target="_blank" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '&var1=2"><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></a></a></center>' ?></td>
            </tr>
            <?php
        }
        ?>
    <?php }
    ?>
    </table></center>
    <?php if ($count["c"] > $limitpage) { ?>
        <ul class="pagination" style="float: right">
        <?php if ($page > 1): ?>
                <div><li>
                        <a href="<?php if ($page > 2): ?>./historial_solicitudes.php?idEstado=2&page=<?php echo $page - 1; ?><?php else: ?> ./historial_solicitudes.php?idEstado=2 <?php endif; ?>" aria-label="Previous" class="btn btn-outline-primary">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                        <a href="historial_solicitudes.php?idEstado=2" class="btn btn-outline-primary">1</a>
                    </li>
                </div>
            <?php endif; ?>
            <?php
            for ($i = 2; $i < $npages + 1; $i += 1):
                ?>
                <div>
                    <li><a href="historial_solicitudes.php?page=<?php echo $i; ?>&idEstado=2" class="btn btn-outline-primary"><?php echo $i; ?></a></li>
                </div>
        <?php endfor; ?>
        <?php if ($page < $npages): ?>
                <div>
                    <li>
                        <a href="historial_solicitudes.php?page=<?php echo $page + 1; ?>&idEstado=2" aria-label="Next" class="btn btn-outline-primary">
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
} elseif ($_REQUEST['idEstado'] == 3) {
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
    $sql0 = "select count(*) as c from peticion where estado=3";
    $query0 = $db->execute($sql0);
    $count = $query0->fetch_array();
    $npages = $count["c"] / $limitpage;
    $sql1 = "select * from peticion limit $startpage,$limitpage";
    $query1 = $db->execute($sql1);

    $sqlFilter = "";
    if (!empty($_REQUEST['idEstado'])) {
        $sqlFilter = "where pet.estado ={$_REQUEST['idEstado']}";
    }

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
                            pet.nombre_archivo,
                            pet.nombre_random,
                            pet.nombre_archivo2,
                            pet.nombre_random2,
                            pet.`tasaMensual`,
                            pet.cuentaOcheque,
                            res.`fechaRescate`,
                            res.`porcentajeGanancia`,
                            res.`montoRescatado`
                        from peticion pet
                        left join estado est on est.id=pet.estado
                        left join rescate res on pet.id = res.`idPeticion`
                        $sqlFilter
                        ORDER BY id DESC limit $startpage,$limitpage";

    $query = $db->execute($sql);
    while ($datos = $db->fetch_row($query)) {
        ?>
        <tr>
            <td><?php echo $datos['id']; ?></td>
            <td><?php echo $datos['institucion']; ?></td>
            <td><?php echo $datos['fechaSolicitud']; ?></td>
            <td><?php echo $datos['tipoMoneda']; ?></td>
            <td><?php echo $datos['tipoSolicitud']; ?></td>
            <td><?php echo $datos['cuentaCheque'] . $datos['cuentaOcheque']; ?></td>
            <td><?php echo $datos['descripcion']; ?></td>
            <td><?php echo $datos['monto']; ?></td>
            <td><?php echo $datos['tasaMensual']; ?></td>
            <!--<td><?php //echo cambiarColor($datos['idEstado'], $datos['estado']);                                ?></td>-->
            <?php if ($datos['estado'] == 'Ingresado') { ?>
                <td style="background-color: #ff9f1a; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } else if ($datos['estado'] == 'Aceptado') { ?>
                <td style="background-color: #98aab3; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } else if ($datos['estado'] == 'Rechazado') { ?>
                <td style="background-color: #d93651; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } else if ($datos['estado'] == 'Rescatado') { ?>
                <td style="background-color: #00aaff; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } else if ($datos['estado'] == 'Finalizado') { ?>
                <td style="background-color: #8acc47; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } ?>
            <?php
            if ($_REQUEST['idEstado'] == 2) {
                ?>
                <td><?php echo $datos['fechaAutorizacion']; ?></td>
                <?php
                if (empty($datos['nombre_archivo'])) {
                    ?>
                    <td><?php echo '<a class="" href="../usuario_solicitante/archivo_aceptado.php?id=' . $datos['id'] . '"><center><input type="image" style="width: 30px; height: 30px" src="../imagenes/2018-07-18.png"></center></a>' ?></td>
                    <?php
                } else {
                    ?>
                    <td><?php echo '<a target="_blank" class="" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '"><center><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></center></a>' ?></td>
                    <?php
                }
                ?>
            <?php
        }
        ?>
            <?php
            if ($_REQUEST['idEstado'] == 4) {
                ?>
                <td><?php echo $datos['fechaRescate']; ?></td>
                <td><?php echo $datos['porcentajeGanancia']; ?></td>
                <td><?php echo $datos['montoRescatado']; ?></td>
                <?php
                if (empty($datos['nombre_archivo2'])) {
                    ?>
                    <td><?php echo '<a class="" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '"><center><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></center></a>' ?></td>
                    <td><?php echo '<a class="" href="../usuario_solicitante/archivo_aceptado.php?id=' . $datos['id'] . '"><center><input type="image" style="width: 30px; height: 30px" src="../imagenes/2018-07-18.png"></center></a>' ?></td>
                    <?php
                }
            }
            ?>
        <?php
        if ($_REQUEST['idEstado'] == 5) {
            ?>
                <td><?php echo $datos['fechaRescate']; ?></td>
                <td><?php echo $datos['porcentajeGanancia']; ?></td>
                <td><?php echo $datos['montoRescatado']; ?></td>
                <td><?php echo '<center><a target="_blank" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '&var1=1"><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></a></center>' ?></td>
                <td><?php echo '<center><a target="_blank" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '&var1=2"><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></a></a></center>' ?></td>
            </tr>
            <?php
        }
        ?>
    <?php }
    ?>
    </table></center>
    <?php if ($count["c"] > $limitpage) { ?>
        <ul class="pagination" style="float: right">
        <?php if ($page > 1): ?>
                <div><li>
                        <a href="<?php if ($page > 2): ?>./historial_solicitudes.php?idEstado=3&page=<?php echo $page - 1; ?><?php else: ?> ./historial_solicitudes.php?idEstado=3 <?php endif; ?>" aria-label="Previous" class="btn btn-outline-primary">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                        <a href="historial_solicitudes.php?idEstado=3" class="btn btn-outline-primary">1</a>
                    </li>
                </div>
            <?php endif; ?>
            <?php
            for ($i = 2; $i < $npages + 1; $i += 1):
                ?>
                <div>
                    <li><a href="historial_solicitudes.php?page=<?php echo $i; ?>&idEstado=3" class="btn btn-outline-primary"><?php echo $i; ?></a></li>
                </div>
        <?php endfor; ?>
        <?php if ($page < $npages): ?>
                <div>
                    <li>
                        <a href="historial_solicitudes.php?page=<?php echo $page + 1; ?>&idEstado=3" aria-label="Next" class="btn btn-outline-primary">
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
} elseif ($_REQUEST['idEstado'] == 4) {
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
    $sql0 = "select count(*) as c from peticion where estado=4";
    $query0 = $db->execute($sql0);
    $count = $query0->fetch_array();
    $npages = $count["c"] / $limitpage;
    $sql1 = "select * from peticion limit $startpage,$limitpage";
    $query1 = $db->execute($sql1);

    $sqlFilter = "";
    if (!empty($_REQUEST['idEstado'])) {
        $sqlFilter = "where pet.estado ={$_REQUEST['idEstado']}";
    }

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
                            pet.nombre_archivo,
                            pet.nombre_random,
                            pet.nombre_archivo2,
                            pet.nombre_random2,
                            pet.`tasaMensual`,
                            pet.cuentaOcheque,
                            res.`fechaRescate`,
                            res.`porcentajeGanancia`,
                            res.`montoRescatado`
                        from peticion pet
                        left join estado est on est.id=pet.estado
                        left join rescate res on pet.id = res.`idPeticion`
                        $sqlFilter
                        ORDER BY id DESC limit $startpage,$limitpage";

    $query = $db->execute($sql);
    while ($datos = $db->fetch_row($query)) {
        ?>
        <tr>
            <td><?php echo $datos['id']; ?></td>
            <td><?php echo $datos['institucion']; ?></td>
            <td><?php echo $datos['fechaSolicitud']; ?></td>
            <td><?php echo $datos['tipoMoneda']; ?></td>
            <td><?php echo $datos['tipoSolicitud']; ?></td>
            <td><?php echo $datos['cuentaCheque'] . $datos['cuentaOcheque']; ?></td>
            <td><?php echo $datos['descripcion']; ?></td>
            <td><?php $z = number_format($datos['monto']);
        echo str_replace(',', '.', $z); ?></td>
            <td><?php echo $datos['tasaMensual']; ?></td>
            <!--<td><?php //echo cambiarColor($datos['idEstado'], $datos['estado']);                               ?></td>-->
            <?php if ($datos['estado'] == 'Ingresado') { ?>
                <td style="background-color: #ff9f1a; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } else if ($datos['estado'] == 'Aceptado') { ?>
                <td style="background-color: #98aab3; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } else if ($datos['estado'] == 'Rechazado') { ?>
                <td style="background-color: #d93651; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } else if ($datos['estado'] == 'Rescatado') { ?>
                <td style="background-color: #00aaff; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } else if ($datos['estado'] == 'Finalizado') { ?>
                <td style="background-color: #8acc47; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } ?>
            <?php
            if ($_REQUEST['idEstado'] == 2) {
                ?>
                <td><?php echo $datos['fechaAutorizacion']; ?></td>
                <?php
                if (empty($datos['nombre_archivo'])) {
                    ?>
                    <td><?php echo '<a target="_blank" class=""  href="../usuario_solicitante/archivo_aceptado.php?id=' . $datos['id'] . '"><center><input type="image" style="width: 30px; heighttarget="_blank": 30px" src="../imagenes/2018-07-18.png"></center></a>' ?></td>
                    <?php
                } else {
                    ?>
                    <td><?php echo '<a target="_blank" class="" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '"><center><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></center></a>' ?></td>
                    <?php
                }
                ?>
                <?php
            }
            ?>
            <?php
            if ($_REQUEST['idEstado'] == 4) {
                ?>
                <?php
                $consulta = "select * from rescate where idPeticion=" . $datos['id'];
                $ejecuta = $db->execute($consulta);
                $filita = $db->fetch_row($ejecuta);
                $consulta2 = "select rentabilidad from abonos where idPeticion=" . $datos['id'];
                $ejecuta2 = $db->execute($consulta2);
                $fila2 = $db->fetch_row($ejecuta2);
                ?>
                <td><?php echo $filita['fechaRescate']; ?></td>
                <td><?php echo $fila2['rentabilidad']; ?></td>
                <td><?php $z = number_format($filita['montoRescatado']);
            echo str_replace(',', '.', $z); ?></td>
            <?php
            if (empty($datos['nombre_archivo2'])) {
                ?>
                    <td><?php echo '<a target="_blank" class="" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '"><center><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></center></a>' ?></td>
                    <td><center><input type="image" style="width: 30px; height: 30px" src="../imagenes/nohay.png"></center></td>
            <?php } else {
                ?>
                <td><?php echo '<a target="_blank" class="" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '&var1=1"><center><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></center></a>' ?></td>
                <td><?php echo '<a target="_blank" class="" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '&var1=2"><center><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></center></a>' ?></td>
                <?php
            }
        }
        ?>
        <?php
        if ($_REQUEST['idEstado'] == 5) {
            ?>
            <td><?php echo $datos['fechaRescate']; ?></td>
            <td><?php echo $datos['porcentajeGanancia']; ?></td>
            <td><?php echo $datos['montoRescatado']; ?></td>
            <td><?php echo '<center><a target="_blank" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '&var1=1"><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></a></center>' ?></td>
            <td><?php echo '<center><a target="_blank" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '&var1=2"><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></a></a></center>' ?></td>
            </tr>
                <?php
            }
            ?>
    <?php }
    ?>
    </table></center>
    <?php if ($count["c"] > $limitpage) { ?>
        <ul class="pagination" style="float: right">
            <?php if ($page > 1): ?>
                <div><li>
                        <a href="<?php if ($page > 2): ?>./historial_solicitudes.php?idEstado=4&page=<?php echo $page - 1; ?><?php else: ?> ./historial_solicitudes.php?idEstado=4 <?php endif; ?>" aria-label="Previous" class="btn btn-outline-primary">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                        <a href="historial_solicitudes.php?idEstado=4" class="btn btn-outline-primary">1</a>
                    </li>
                </div>
            <?php endif; ?>
        <?php
        for ($i = 2; $i < $npages + 1; $i += 1):
            ?>
                <div>
                    <li><a href="historial_solicitudes.php?page=<?php echo $i; ?>&idEstado=4" class="btn btn-outline-primary"><?php echo $i; ?></a></li>
                </div>
            <?php endfor; ?>
            <?php if ($page < $npages): ?>
                <div>
                    <li>
                        <a href="historial_solicitudes.php?page=<?php echo $page + 1; ?>&idEstado=4" aria-label="Next" class="btn btn-outline-primary">
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
} elseif ($_REQUEST['idEstado'] == 5) {
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
    $sql0 = "select count(*) as c from peticion where estado=5";
    $query0 = $db->execute($sql0);
    $count = $query0->fetch_array();
    $npages = $count["c"] / $limitpage;
    $sql1 = "select * from peticion limit $startpage,$limitpage";
    $query1 = $db->execute($sql1);

    $sqlFilter = "";
    if (!empty($_REQUEST['idEstado'])) {
        $sqlFilter = "where pet.estado ={$_REQUEST['idEstado']}";
    }

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
                            pet.nombre_archivo,
                            pet.nombre_random,
                            pet.nombre_archivo2,
                            pet.nombre_random2,
                            pet.`tasaMensual`,
                            pet.cuentaOcheque,
                            res.`fechaRescate`,
                            res.`porcentajeGanancia`,
                            res.`montoRescatado`
                        from peticion pet
                        left join estado est on est.id=pet.estado
                        left join rescate res on pet.id = res.`idPeticion`
                        $sqlFilter
                        ORDER BY id DESC limit $startpage,$limitpage";

    $query = $db->execute($sql);
    while ($datos = $db->fetch_row($query)) {
        ?>
        <tr>
            <td><?php echo $datos['id']; ?></td>
            <td><?php echo $datos['institucion']; ?></td>
            <td><?php echo $datos['fechaSolicitud']; ?></td>
            <td><?php echo $datos['tipoMoneda']; ?></td>
            <td><?php echo $datos['tipoSolicitud']; ?></td>
            <td><?php echo $datos['cuentaCheque'] . $datos['cuentaOcheque']; ?></td>
            <td><?php echo $datos['descripcion']; ?></td>
            <td><?php echo $datos['monto']; ?></td>
            <td><?php echo $datos['tasaMensual']; ?></td>
            <!--<td><?php //echo cambiarColor($datos['idEstado'], $datos['estado']);                                ?></td>-->
            <?php if ($datos['estado'] == 'Ingresado') { ?>
                <td style="background-color: #ff9f1a; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } else if ($datos['estado'] == 'Aceptado') { ?>
                <td style="background-color: #98aab3; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } else if ($datos['estado'] == 'Rechazado') { ?>
                <td style="background-color: #d93651; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } else if ($datos['estado'] == 'Rescatado') { ?>
                <td style="background-color: #00aaff; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } else if ($datos['estado'] == 'Finalizado') { ?>
                <td style="background-color: #8acc47; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } ?>
            <?php
            if ($_REQUEST['idEstado'] == 2) {
                ?>
                <td><?php echo $datos['fechaAutorizacion']; ?></td>
                <?php
                if (empty($datos['nombre_archivo'])) {
                    ?>
                    <td><?php echo '<a class="" href="../usuario_solicitante/archivo_aceptado.php?id=' . $datos['id'] . '"><center><input type="image" style="width: 30px; height: 30px" src="../imagenes/2018-07-18.png"></center></a>' ?></td>
                    <?php
                } else {
                    ?>
                    <td><?php echo '<a target="_blank" class="" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '"><center><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></center></a>' ?></td>
                    <?php
                }
                ?>
                <?php
            }
            ?>
            <?php
            if ($_REQUEST['idEstado'] == 4) {
                ?>
                <td><?php echo $datos['fechaRescate']; ?></td>
                <td><?php echo $datos['porcentajeGanancia']; ?></td>
                <td><?php echo $datos['montoRescatado']; ?></td>
                <?php
                if (empty($datos['nombre_archivo2'])) {
                    ?>
                    <td><?php echo '<a class="" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '"><center><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></center></a>' ?></td>
                    <td><?php echo '<a class="" href="../usuario_solicitante/archivo_aceptado.php?id=' . $datos['id'] . '"><center><input type="image" style="width: 30px; height: 30px" src="../imagenes/2018-07-18.png"></center></a>' ?></td>
                <?php
            }
        }
        ?>
        <?php
        if ($_REQUEST['idEstado'] == 5) {
            ?>
                <td><?php echo $datos['fechaRescate']; ?></td>
                <td><?php echo $datos['porcentajeGanancia']; ?></td>
                <td><?php echo $datos['montoRescatado']; ?></td>
                <td><?php echo '<center><a target="_blank" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '&var1=1"><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></a></center>' ?></td>
                <td><?php echo '<center><a target="_blank" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '&var1=2"><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></a></a></center>' ?></td>
            </tr>
                <?php
            }
            ?>
    <?php }
    ?>
    </table></center>
    <?php if ($count["c"] > $limitpage) { ?>
        <ul class="pagination" style="float: right">
            <?php if ($page > 1): ?>
                <div><li>
                        <a href="<?php if ($page > 2): ?>./historial_solicitudes.php?idEstado=5&page=<?php echo $page - 1; ?><?php else: ?> ./historial_solicitudes.php?idEstado=5 <?php endif; ?>" aria-label="Previous" class="btn btn-outline-primary">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                        <a href="historial_solicitudes.php?idEstado=5" class="btn btn-outline-primary">1</a>
                    </li>
                </div>
            <?php endif; ?>
        <?php
        for ($i = 2; $i < $npages + 1; $i += 1):
            ?>
                <div>
                    <li><a href="historial_solicitudes.php?page=<?php echo $i; ?>&idEstado=5" class="btn btn-outline-primary"><?php echo $i; ?></a></li>
                </div>
            <?php endfor; ?>
            <?php if ($page < $npages): ?>
                <div>
                    <li>
                        <a href="historial_solicitudes.php?page=<?php echo $page + 1; ?>&idEstado=5" aria-label="Next" class="btn btn-outline-primary">
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
} elseif ($_REQUEST['idEstado'] == 6) {
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
    $sql0 = "select count(*) as c from peticion where estado=6";
    $query0 = $db->execute($sql0);
    $count = $query0->fetch_array();
    $npages = $count["c"] / $limitpage;
    $sql1 = "select * from peticion limit $startpage,$limitpage";
    $query1 = $db->execute($sql1);

    $sqlFilter = "";
    if (!empty($_REQUEST['idEstado'])) {
        $sqlFilter = "where pet.estado ={$_REQUEST['idEstado']}";
    }

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
                            pet.nombre_archivo,
                            pet.nombre_random,
                            pet.nombre_archivo2,
                            pet.nombre_random2,
                            pet.`tasaMensual`,
                            pet.cuentaOcheque,
                            res.`fechaRescate`,
                            res.`porcentajeGanancia`,
                            res.`montoRescatado`
                        from peticion pet
                        left join estado est on est.id=pet.estado
                        left join rescate res on pet.id = res.`idPeticion`
                        $sqlFilter
                        ORDER BY id DESC limit $startpage,$limitpage";

    $query = $db->execute($sql);
    while ($datos = $db->fetch_row($query)) {
        ?>
        <tr>
            <td><?php echo $datos['id']; ?></td>
            <td><?php echo $datos['institucion']; ?></td>
            <td><?php echo $datos['fechaSolicitud']; ?></td>
            <td><?php echo $datos['tipoMoneda']; ?></td>
            <td><?php echo $datos['tipoSolicitud']; ?></td>
            <td><?php echo $datos['cuentaCheque'] . $datos['cuentaOcheque']; ?></td>
            <td><?php echo $datos['descripcion']; ?></td>
            <td><?php $z = number_format($datos['monto']);
        echo str_replace(',', '.', $z); ?></td>
            <td><?php echo $datos['tasaMensual']; ?></td>
            <!--<td><?php //echo cambiarColor($datos['idEstado'], $datos['estado']);                               ?></td>-->
            <?php if ($datos['estado'] == 'Ingresado') { ?>
                <td style="background-color: #ff9f1a; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } else if ($datos['estado'] == 'Aceptado') { ?>
                <td style="background-color: #98aab3; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } else if ($datos['estado'] == 'Rechazado') { ?>
                <td style="background-color: #d93651; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } else if ($datos['estado'] == 'Rescatado') { ?>
                <td style="background-color: #00aaff; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } else if ($datos['estado'] == 'Finalizado') { ?>
                <td style="background-color: #8acc47; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } else if ($datos['estado'] == 'Egreso Procesado') { ?>
                <td style="font-weight:bold"><?php echo $datos['estado']; ?></td>
        <?php } ?>
        <?php
        if ($_REQUEST['idEstado'] == 2) {
            ?>
                <td><?php echo $datos['fechaAutorizacion']; ?></td>
            <?php
            if (empty($datos['nombre_archivo'])) {
                ?>
                    <td><center><input type="image" style="width: 30px; height: 30px" src="../imagenes/nohay.png"></center></td>
                <?php
            } else {
                ?>
                <td><?php echo '<a target="_blank" class="" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '"><center><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></center></a>' ?></td>
                <?php
            }
            ?>
            <?php
        }
        ?>
        <?php
        if ($_REQUEST['idEstado'] == 4) {
            ?>
            <td><?php echo $datos['fechaRescate']; ?></td>
            <td><?php echo $datos['porcentajeGanancia']; ?></td>
            <td><?php echo $datos['montoRescatado']; ?></td>
            <?php
            if (empty($datos['nombre_archivo2'])) {
                ?>
                <td><?php echo '<a class="" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '"><center><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></center></a>' ?></td>
                <td><?php echo '<a class="" href="../usuario_solicitante/archivo_aceptado.php?id=' . $datos['id'] . '"><center><input type="image" style="width: 30px; height: 30px" src="../imagenes/2018-07-18.png"></center></a>' ?></td>
                <?php
            }
        }
        ?>
        <?php
        if ($_REQUEST['idEstado'] == 5) {
            ?>
            <td><?php echo $datos['fechaRescate']; ?></td>
            <td><?php echo $datos['porcentajeGanancia']; ?></td>
            <td><?php echo $datos['montoRescatado']; ?></td>
            <td><?php echo '<center><a target="_blank" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '&var1=1"><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></a></center>' ?></td>
            <td><?php echo '<center><a target="_blank" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '&var1=2"><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></a></a></center>' ?></td>
            </tr>
            <?php
        }
        ?>
        <?php
        $consulta = "select * from egreso_procesado where idPeticion=" . $datos['id'];
        $quer = $db->execute($consulta);
        $fila = $db->fetch_row($quer);
        if ($_REQUEST['idEstado'] == 6) {
            ?>
            <td><?php echo $fila['numeroEgreso']; ?></td>
            <td><?php echo '<a class="" target="_blank" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '"><center><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></center></a>' ?></td>
            </tr>
            <?php
        }
    }
    ?>
    </table></center>
        <?php if ($count["c"] > $limitpage) { ?>
        <ul class="pagination" style="float: right">
            <?php if ($page > 1): ?>
                <div><li>
                        <a href="<?php if ($page > 2): ?>./historial_solicitudes.php?idEstado=6&page=<?php echo $page - 1; ?><?php else: ?> ./historial_solicitudes.php?idEstado=6 <?php endif; ?>" aria-label="Previous" class="btn btn-outline-primary">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                        <a href="historial_solicitudes.php?idEstado=6" class="btn btn-outline-primary">1</a>
                    </li>
                </div>
        <?php endif; ?>
        <?php
        for ($i = 2; $i < $npages + 1; $i += 1):
            ?>
                <div>
                    <li><a href="historial_solicitudes.php?page=<?php echo $i; ?>&idEstado=6" class="btn btn-outline-primary"><?php echo $i; ?></a></li>
                </div>
            <?php endfor; ?>
        <?php if ($page < $npages): ?>
                <div>
                    <li>
                        <a href="historial_solicitudes.php?page=<?php echo $page + 1; ?>&idEstado=6" aria-label="Next" class="btn btn-outline-primary">
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
} elseif ($_REQUEST['idEstado'] == 7) {
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
    $sql0 = "select count(*) as c from peticion where estado=7";
    $query0 = $db->execute($sql0);
    $count = $query0->fetch_array();
    $npages = $count["c"] / $limitpage;
    $sql1 = "select * from peticion limit $startpage,$limitpage";
    $query1 = $db->execute($sql1);

    $sqlFilter = "";
    if (!empty($_REQUEST['idEstado'])) {
        $sqlFilter = "where pet.estado ={$_REQUEST['idEstado']}";
    }

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
                            pet.nombre_archivo,
                            pet.nombre_random,
                            pet.nombre_archivo2,
                            pet.nombre_random2,
                            pet.`tasaMensual`,
                            pet.cuentaOcheque,
                            res.`fechaRescate`,
                            res.`porcentajeGanancia`,
                            res.`montoRescatado`
                        from peticion pet
                        left join estado est on est.id=pet.estado
                        left join rescate res on pet.id = res.`idPeticion`
                        $sqlFilter
                        ORDER BY id DESC limit $startpage,$limitpage";

    $query = $db->execute($sql);
    while ($datos = $db->fetch_row($query)) {
        ?>
        <tr>
            <td><?php echo $datos['id']; ?></td>
            <td><?php echo $datos['institucion']; ?></td>
            <td><?php echo $datos['fechaSolicitud']; ?></td>
            <td><?php echo $datos['tipoMoneda']; ?></td>
            <td><?php echo $datos['tipoSolicitud']; ?></td>
            <td><?php echo $datos['cuentaCheque'] . $datos['cuentaOcheque']; ?></td>
            <td><?php echo $datos['descripcion']; ?></td>
            <td><?php $z = number_format($datos['monto']);
                 echo str_replace(',', '.', $z); ?></td>
            <td><?php echo $datos['tasaMensual']; ?></td>
            <!--<td><?php //echo cambiarColor($datos['idEstado'], $datos['estado']);                               ?></td>-->
            <?php if ($datos['estado'] == 'Ingresado') { ?>
                <td style="background-color: #ff9f1a; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } else if ($datos['estado'] == 'Aceptado') { ?>
                <td style="background-color: #98aab3; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } else if ($datos['estado'] == 'Rechazado') { ?>
                <td style="background-color: #d93651; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } else if ($datos['estado'] == 'Rescatado') { ?>
                <td style="background-color: #00aaff; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } else if ($datos['estado'] == 'Finalizado') { ?>
                <td style="background-color: #8acc47; color: #fff; font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } else if ($datos['estado'] == 'Egreso Procesado') { ?>
                <td style="font-weight:bold"><?php echo $datos['estado']; ?></td>
            <?php } else if ($datos['estado'] == 'Ingreso Procesado') { ?>
                <td><?php echo $datos['estado']; ?></td>
                <?php
            }
            if ($_REQUEST['idEstado'] == 2) {
                ?>
                <td><?php echo $datos['fechaAutorizacion']; ?></td>
                <?php
                if (empty($datos['nombre_archivo'])) {
                    ?>
                    <td><?php echo '<a class="" href="../usuario_solicitante/archivo_aceptado.php?id=' . $datos['id'] . '"><center><input type="image" style="width: 30px; height: 30px" src="../imagenes/2018-07-18.png"></center></a>' ?></td>
                    <?php
                } else {
                    ?>
                    <td><?php echo '<a target="_blank" class="" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '"><center><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></center></a>' ?></td>
                <?php
            }
            ?>
                <?php
            }
            ?>
        <?php
        if ($_REQUEST['idEstado'] == 4) {
            ?>
                <td><?php echo $datos['fechaRescate']; ?></td>
                <td><?php echo $datos['porcentajeGanancia']; ?></td>
                <td><?php echo $datos['montoRescatado']; ?></td>
                <?php
                if (empty($datos['nombre_archivo2'])) {
                    ?>
                    <td><?php echo '<a class="" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '"><center><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></center></a>' ?></td>
                    <td><?php echo '<a class="" href="../usuario_solicitante/archivo_aceptado.php?id=' . $datos['id'] . '"><center><input type="image" style="width: 30px; height: 30px" src="../imagenes/2018-07-18.png"></center></a>' ?></td>
                <?php
            }
        }
        ?>
        <?php
        if ($_REQUEST['idEstado'] == 5) {
            ?>
                <td><?php echo $datos['fechaRescate']; ?></td>
                <td><?php echo $datos['porcentajeGanancia']; ?></td>
                <td><?php echo $datos['montoRescatado']; ?></td>
                <td><?php echo '<center><a target="_blank" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '&var1=1"><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></a></center>' ?></td>
                <td><?php echo '<center><a target="_blank" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '&var1=2"><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></a></a></center>' ?></td>
            </tr>
            <?php
        }
        ?>
        <?php
        $consulta = "select * from egreso_procesado where idPeticion=" . $datos['id'];
        $quer = $db->execute($consulta);
        $fi = $db->fetch_row($quer);
        $consulta2 = "select * from rescate where idPeticion=" . $datos['id'];
        $quer2 = $db->execute($consulta2);
        $f = $db->fetch_row($quer2);
        if ($_REQUEST['idEstado'] == 6) {
            ?>
            <td><?php echo $fila['numeroEgreso']; ?></td>
            <td><?php echo '<a class="" target="_blank" href="../usuario_solicitante/archivo_pdf.php?id=' . $datos['id'] . '"><center><input type="image" src="../imagenes/2018-07-10.png" width="30" height="30"></center></a>' ?></td>
            </tr>
            <?php
        }
        if ($_REQUEST['idEstado'] == 7) {
            $d = "%";
            ?>
            <td><?php echo $datos['fechaRescate']; ?></td>
            <td><?php
                $z = number_format($f['montoRescatado']);
                echo str_replace(',', '.', $z);
                ?></td>
            <td><?php echo $f['diasTranscurridos']; ?></td>
            <td><?php echo $f['tasaInteresMensual'] . $d; ?></td>
            <td><?php echo '<a class="" href="../usuario_autorizador/inversion_finalizada.php?id=' . $datos['id'] . '"><center><input type="image" src="../imagenes/checklist2.png" width="35" height="35"></center></a>' ?></td>
            <?php
        }
    }
    ?>
    </table></center>
        <?php if ($count["c"] > $limitpage) { ?>
        <ul class="pagination" style="float: right">
            <?php if ($page > 1): ?>
                <div><li>
                        <a href="<?php if ($page > 2): ?>./historial_solicitudes.php?idEstado=7&page=<?php echo $page - 1; ?><?php else: ?> ./historial_solicitudes.php?idEstado=7 <?php endif; ?>" aria-label="Previous" class="btn btn-outline-primary">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                        <a href="historial_solicitudes.php?idEstado=7" class="btn btn-outline-primary">1</a>
                    </li>
                </div>
        <?php endif; ?>
        <?php
        for ($i = 2; $i < $npages + 1; $i += 1):
            ?>
                <div>
                    <li><a href="historial_solicitudes.php?page=<?php echo $i; ?>&idEstado=7" class="btn btn-outline-primary"><?php echo $i; ?></a></li>
                </div>
        <?php endfor; ?>
        <?php if ($page < $npages): ?>
                <div>
                    <li>
                        <a href="historial_solicitudes.php?page=<?php echo $page + 1; ?>&idEstado=7" aria-label="Next" class="btn btn-outline-primary">
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
}
?>
</div>
<script src = "../js/bootstrap.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/funcionesPropias.js"></script>
<script type="text/javascript">
                        function mostrarInputFileModificado(numeroInput) {
                            $("#archivo_oculto" + numeroInput).change(function () {
                                $("#archivo" + numeroInput).val($("#archivo_oculto" + numeroInput).val());
                            });
                        }
</script>
<script>
    $("#datepicker").datepicker({
        // Formato de la fecha
        dateFormat: "dd/mm/yy",
        // Primer dia de la semana El lunes
        firstDay: 1,
        // Dias Largo en castellano
        dayNames: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
        // Dias cortos en castellano
        dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        // Nombres largos de los meses en castellano
        monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        // Nombres de los meses en formato corto
        monthNamesShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dec"],
        // Cuando seleccionamos la fecha esta se pone en el campo Input
        onSelect: function (dateText) {
            $('#fecha').val(dateText);
        }
    });
</script>
<script>

    document.getElementById('select').value = '<?php echo $_REQUEST['idEstado']; ?>';

    function redireccionar(obj) {
        var valorSeleccionado = obj.options[obj.selectedIndex].value;
        document.location = 'https://pcspucv.cl/gsi/proyecto/usuario_autorizador/historial_solicitudes.php?idEstado=' + valorSeleccionado;
    }

</script>
<!--  <script>
                    function actualizarTablaEstado(estado) {

                        var xmlHttp = new XMLHttpRequest();
                        var tabla = document.getElementById('tabla');
                        var row = '';
                        var cell = '';

                        xmlHttp.onreadystatechange = function () {
                            row = tabla.insertRow(tabla.length);
                            cell = row.insertCell(0);
                            cell.innerHTML = this.id;

                        }

                        xmlHttp.open("GET", "../funcion_filtro_estado.php?estado=" + estado, true);
                        xmlHttp.send();
                    }
</script>-->
</body>
</html>
