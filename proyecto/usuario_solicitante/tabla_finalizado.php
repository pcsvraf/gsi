<?php

function cambiarColor($idEstado, $estado) {

    $msg = "";

    switch ($idEstado) {

        case 1:
            $color = "style='color: #12548c'";
            break;

        case 2:
            $color = "style='color: #04b431'";
            break;

        case 3:
            $color = "style='color: #f80000'";
            break;

        case 4:
            $color = "style='color: #FFFF00'";
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
    </head>
    <body>
        <header>
            <div class="container-fluid">
                <nav class="menu">
                    <ul>
                        <li><a href="../usuario_solicitante/index.php">Solicitar</a></li>
                        <li><a href="https://localhost/proyecto/usuario_solicitante/historial_solicitudes.php?idEstado=0">Historial</a></li>
                        <li><a href="../usuario_solicitante/editar_peticiones_vista.php">Editar/Eliminar</a></li>
                        <li><a href="../usuario_solicitante/rescate_vista.php">Rescate</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <div class="container-fluid">
            <br>
            <h1><center>Historial de Peticiones</center></h1>
            <br>
            <center><table class="table table-bordered table-hover" id="tabla">
                    <tr>
                        <td class="btn-info" style="background-color: #12548c">ID</td>
                        <td class="btn-info" style="background-color: #12548c">Nombre Solicitud</td>
                        <td class="btn-info" style="background-color: #12548c">Solicitante</td>
                        <td class="btn-info" style="background-color: #12548c">Fecha Solicitud</td>
                        <td class="btn-info" style="background-color: #12548c">Fecha Respuesta</td>
                        <td style="background-color: #12548c">
                            <select onchange="redireccionar(this);" id="select">
                                <option selected disabled>Estado</option>
                                <option value="0">Todo</option>
                                <option value="1">Enviado</option>
                                <option value="2">Aceptado</option>
                                <option value="3">Rechazado</option>
                                <option value="4">Finalizado</option>
                            </select></td>
                        <td class="btn-info" style="background-color: #12548c">Tipo</td>
                        <td class="btn-info" style="background-color: #12548c">Descripcion</td>
                        <td class="btn-info" style="background-color: #12548c">Monto</td>
                    </tr>
                    <?php
                    include '../core/conexion.php';
                    $db = new Conect_MySql();

                    $sqlFilter = "";
                    if (!empty($_REQUEST['idEstado'])) {
                        $sqlFilter = "where pet.estado ={$_REQUEST['idEstado']}";
                    }

                    $sql = "select
                            pet.id,
                            pet.nombreSolicitud,
                            pet.solicitante,
                            pet.fechaSolicitud,
                            pet.fechaRespuesta,
                            est.id as idEstado,
                            est.nombre as estado,
                            pet.tipoSolicitud,
                            pet.descripcion,
                            pet.monto
                        from peticion pet
                        left join estado est on est.id=pet.estado
                        $sqlFilter
                        ORDER BY id DESC";


                    $query = $db->execute($sql);
                    while ($datos = $db->fetch_row($query)) {
                        ?>
                        <tr>
                            <td><?php echo $datos['id']; ?></td>
                            <td><?php echo $datos['nombreSolicitud']; ?></td>
                            <td><?php echo $datos['solicitante']; ?></td>
                            <td><?php echo $datos['fechaSolicitud']; ?></td>
                            <td><?php echo $datos['fechaRespuesta']; ?></td>
                            <td><?php echo cambiarColor($datos['idEstado'], $datos['estado']); ?></td>
                            <td><?php echo $datos['tipoSolicitud']; ?></td>
                            <td><?php echo $datos['descripcion']; ?></td>
                            <td><?php echo $datos['monto']; ?></td>
                        </tr>

                    <?php } $db->close_db();
                    ?>

                </table></center>
        </div>
        <script src="../js/jquery-3.3.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script type="text/javascript">

                                document.getElementById('select').value = '<?php echo $_REQUEST['idEstado']; ?>';

                                function redireccionar(obj) {

                                    var valorSeleccionado = obj.options[obj.selectedIndex].value;
                                    document.location = 'https://localhost/proyecto/usuario_solicitante/historial_solicitudes.php?idEstado=' + valorSeleccionado;

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
