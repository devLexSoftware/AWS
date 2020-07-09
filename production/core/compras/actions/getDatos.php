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

            $finArray = null;
            $myArray  = null;
            $myArray2  = null;
            $myArray3  = null;
            $myArray4  = null;

            $result = mysqli_query($con,"SELECT distinct semana, fechInicial, fechFinal from compras 
            where fk_obra = $id and estado = 0 order by semana;");        
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $myArray[] = $row;
            }
            $result02 = mysqli_query($con,"SELECT distinct c.fk_proveedor, p.empresa from compras c
                        inner join proveedores p on c.fk_proveedor = p.id
                        where c.fk_obra = $id;");        
            while($row02 = $result02->fetch_array(MYSQLI_ASSOC)) {
                $myArray2[] = $row02;
            }
            $result03 = mysqli_query($con,"SELECT distinct descripcion from compras 
                        where fk_obra = $id;");        
            while($row03 = $result03->fetch_array(MYSQLI_ASSOC)) {
                $myArray3[] = $row03;
            }
            $result04 = mysqli_query($con,"SELECT distinct c.empresa, c.id from contratistas c
                        inner join compras cc on c.id = cc.fk_contratista
                        where cc.fk_obra = $id;");        
            while($row04 = $result04->fetch_array(MYSQLI_ASSOC)) {
                $myArray4[] = $row04;
            }
            $finArray[0] = $myArray;
            $finArray[1] = $myArray2;
            $finArray[2] = $myArray3;
            $finArray[3] = $myArray4;

            echo json_encode($finArray);
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
