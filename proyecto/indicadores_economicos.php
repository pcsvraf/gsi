
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/estilos.css"  type="text/css">
        <link rel="stylesheet" href="css/menu.css">
        <title>Editar/Eliminar Peticiones</title>
    </head>
    <body>
        <div class="container-fluid">
            <?php
            $apiUrl = 'https://mindicador.cl/api';
//Es necesario tener habilitada la directiva allow_url_fopen para usar file_get_contents
            if (ini_get('allow_url_fopen')) {
                $json = file_get_contents($apiUrl);
            } else {
                //De otra forma utilizamos cURL
                $curl = curl_init($apiUrl);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $json = curl_exec($curl);
                curl_close($curl);
            }

            $dailyIndicators = json_decode($json);
            ?>
            <div class="input-group">
                <div class="btn-group">
                    <input type="image" src="https://www.dgaea.pucv.cl/wp-content/uploads/2018/06/chile.png" width="50" height="30" style="margin-top: 4px; margin-right: 10px">
                    <input type="button" style="background-color: #848484; color:#fff; border: #848484" class="btn btn-default" value="UF">
                    <input type="button" style="color: #F8EFFB; background-color: #BDBDBD;" class="btn btn-default" value="<?php echo '' . $dailyIndicators->uf->valor; ?>">
                </div>
                <div class="btn-group" style="margin-left: 20px">
                    <input type="button" style="background-color: #848484; color:#fff" class="btn btn-default" value="UTM">
                    <input type="button" style="color: #F8EFFB; background-color: #BDBDBD"class="btn btn-default" value="<?php echo '' . $dailyIndicators->utm->valor; ?>">
                </div>
                <div class="btn-group">
                    <input type="image" src="https://www.dgaea.pucv.cl/wp-content/uploads/2018/06/usa.png" width="50" height="30" style="margin-top: 4px; margin-left: 20px; margin-right: 10px">
                    <button type="button" style="background-color: #848484; color:#fff" class="btn btn-default">Dólar</button>
                    <button type="button" style="color: #F8EFFB; background-color: #BDBDBD"class="btn btn-default"><?php echo '' . $dailyIndicators->dolar->valor; ?></button>
                </div>
                <div class="btn-group">
                    <input type="image" src="https://www.dgaea.pucv.cl/wp-content/uploads/2018/06/euro.png" width="50" height="30" style="margin-top: 4px; margin-left: 20px; margin-right: 10px">
                    <button type="button" style="background-color: #848484; color:#fff" class="btn btn-default">Euro</button>
                    <button type="button" style="color: #F8EFFB; background-color: #BDBDBD"class="btn btn-default"><?php echo '' . $dailyIndicators->euro->valor; ?></button>
                </div>
            </div>
        </div>
    </body>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/funciones.js"></script>

</html>
