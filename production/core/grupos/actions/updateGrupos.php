<?php
include("../../../config/conexion.php");
 //   error_reporting(E_ALL);
 //   ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  if (mysqli_connect_errno()) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }
  else {

    //--Datos de usuario
    $Grp_Id            = $_POST['detalleId'];
    $Grp_Nombre        = $_POST['Grp_Nombre'];    
    $Grp_Nota         = $_POST['Grp_Nota'];   
    $Grp_cantidad       = $_POST['detalleCantidad'];
    $Grp_cantidad2       = $_POST['detalleCantidad2'];
    
    $result = mysqli_query($con, "SET FOREIGN_KEY_CHECKS=0");
    $result = mysqli_query($con, "Delete from grupos_empleados where fk_grupo = '$Grp_Id'");    
    $result = mysqli_query($con, "Delete from grupos_contratistas where fk_grupo = '$Grp_Id'");    

    $result = mysqli_query($con, "UPDATE grupos SET nombre = '$Grp_Nombre', nota = '$Grp_Nota'
                                    WHERE id = '$Grp_Id'");

    for ($i=0 ; $i <  $Grp_cantidad; $i++ ) {
        $detalleEmpleado           = $_POST['detalleEmpleado'.$i];      
        
        $result = mysqli_query($con,"INSERT INTO grupos_empleados(usuCreacion, fk_grupo, fk_empleado, estado)
            VALUES('admin','$Grp_Id', '$detalleEmpleado',  '0' )");
      }    

      for ($i=0 ; $i <  $Grp_cantidad2; $i++ ) {
        $detalleContratista           = $_POST['detalleContratista'.$i];      
        
        $result = mysqli_query($con,"INSERT INTO grupos_contratistas(usuCreacion, fk_grupo, fk_contratista, estado)
            VALUES('admin','$Grp_Id', '$detalleContratista',  '0' )");
      }    
        
    header("Location: ../../../../../index.php?p=gruposOk");

  }
 ?>
