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

    //--Datos de usuario
    $Grp_Nombre         = $_POST['Grp_Nombre'];    
    $Grp_Nota           = $_POST['Grp_Nota'];   
    $Grp_cantidad       = $_POST['detalleCantidad'];
    $Grp_cantidad2      = $_POST['detalleCantidad2'];

    //--Insertar nuevo proveedor
    $ref = "GRP-".substr($Grp_Nombre,0, 5);
    $result = mysqli_query($con,"INSERT INTO grupos(usuCreacion, nombre, nota, estado)
                        VALUES('admin',  '$Grp_Nombre', '$Grp_Nota', '0')");
    $id = mysqli_insert_id($con);

    for ($i=0 ; $i <  $Grp_cantidad; $i++ ) {
      $detalleEmpleado           = $_POST['detalleEmpleado'.$i];      
      
      $result = mysqli_query($con,"INSERT INTO grupos_empleados(usuCreacion, fk_grupo, fk_empleado, estado)
          VALUES('admin','$id', '$detalleEmpleado',  '0' )");
    }  

    for ($i=0 ; $i <  $Grp_cantidad2; $i++ ) {
      $detalleContratistas           = $_POST['detalleContratista'.$i];      
      
      $result = mysqli_query($con,"INSERT INTO grupos_contratistas(usuCreacion, fk_grupo, fk_contratista, estado)
          VALUES('admin','$id', '$detalleContratistas',  '0' )");
    }   



header("Location: ../../../../../index.php?p=grupos");
  }
 ?>
