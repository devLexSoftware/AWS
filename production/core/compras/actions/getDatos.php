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

        if($tabla == "comprasObra")
        {

            $myArray  = null;
            $result = mysqli_query($con,"SELECT c.nombre, c.descripcion, c.fecha, c.frente, c.semana, c.cantidad, c.unidad, c.factura, p.proveedor, c.subtotal, c.importe, c.costo from compras c
                                inner join proveedores p on c.fk_proveedor = p.id
                                where o.fk_obra = $id;");                           
            

            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
            }
            echo json_encode($myArray);
        }
        else{
            $id = $_POST["id"];
            $tabla = $_POST["tabla"];
            $result = mysqli_query($con,"SELECT * FROM $tabla WHERE id = $id and estado = 0;");   
            $elemento = mysqli_fetch_array($result);
            echo json_encode($elemento);
        }        
    }
 ?>
