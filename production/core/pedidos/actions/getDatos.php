<?php
    include("../../../config/conexion.php");
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    if (mysqli_connect_errno()) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    else {
    $con -> set_charset("utf8");

        $id = $_POST["id"];
        $tabla = $_POST["tabla"];
        $result = mysqli_query($con,"SELECT * FROM $tabla WHERE id = $id and estado = 0;");   
        $elemento = mysqli_fetch_array($result);
        echo json_encode($elemento);
    }
 ?>
