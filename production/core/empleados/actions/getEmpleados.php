<?php
    include("../../../config/conexion.php");
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    if (mysqli_connect_errno()) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    else {                
        /*$result = mysqli_query($con,"SELECT * FROM empleados");      
        $html = "";
        while($elemento = mysqli_fetch_array($result)){
            $html = $html.'<option value="'.$elemento["id"].'">'.$elemento["nombre"].'</option>';
        }*/
       return json_encode('<option> hola</option>');
        
    }
 ?>
