<?php
    include("../../../config/conexion.php");
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    if (mysqli_connect_errno()) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    else {

        $obra = $_POST['val3'];
        $cliente = $_POST['val2'];
        $factura  = $_POST['val4'];

        $result = mysqli_query($con,"select sum(importe) as importe from compras where fk_obra = $obra and fk_clientes = $cliente and factura = '$factura';");
        $elemento = mysqli_fetch_array($result);
        echo json_encode($elemento);
    }
 ?>
