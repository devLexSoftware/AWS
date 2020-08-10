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

        if($id == "todos")
        {
            $result = mysqli_query($con,"SELECT e.id, e.nombre, e.email from clientes e
                                    where estado = 0 order by nombre");               

            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
            }
            echo json_encode($myArray);
        }
        else
        {
            $result = mysqli_query($con,"SELECT * FROM users WHERE fk_vinculada = $id and perfil = 'cliente'");   
            $elemento = mysqli_fetch_array($result);
            echo json_encode($elemento);
        }
        /*$result = mysqli_query($con,"SELECT * FROM empleados");      
        $html = "";
        while($elemento = mysqli_fetch_array($result)){
            $html = $html.'<option value="'.$elemento["id"].'">'.$elemento["nombre"].'</option>';
        }*/
       return json_encode('<option> hola</option>');
        
    }
 ?>
