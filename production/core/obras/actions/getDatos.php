<?php
    include("../../../config/conexion.php");
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    if (mysqli_connect_errno()) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    else {
        $id = $_POST["id"];
        $tabla = $_POST["tabla"];
        if($tabla == "obras"){
            $result = mysqli_query($con,"SELECT * FROM $tabla WHERE fk_clientes = $id and estado = 0;");   
            while($elemento = mysqli_fetch_array($result)){
                echo '<option value="'.$elemento["id"].'">'.$elemento["nombre"].'</option>';
            }
        }
        else{
            $result = mysqli_query($con,"SELECT * FROM $tabla WHERE id = $id and WHERE estado = 0;");   
            $elemento = mysqli_fetch_array($result);
            echo json_encode($elemento);
        }                
    }
 ?>
