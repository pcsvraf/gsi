function enviarSolicitud() {
                include '../core/conexion.php';
                if (isset($this->dataForm['enviar'])) {
                    echo "Institucion: " . $_POST["institucion"];
                    echo "<br>Monto: " . $_POST["monto"];
                    echo "<br>descripcion: " . $_POST ["descripcion"];
                    $moneda = $_POST["moneda"];
                    $tipo = $_POST["tipo"];

                    //recorremos el array de cervezas seleccionadas. No olvidarse q la primera posición de un array es la 0 

                    for ($i = 0; $i < count($moneda); $i++) {
                        echo "<br> Moneda " . $i . ": " . $moneda[$i];
                    }
                    for ($i = 0; $i < count($tipo); $i++) {
                        echo "<br> Tipo " . $i . ": " . $tipo[$i];
                    }
                }
            }
                    
                    function setDataform($dataForm) {
                    $this->dataForm = $dataForm;
                    }