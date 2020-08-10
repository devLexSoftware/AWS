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
    $fre_nombre              = $_POST['fre_nombre'];    
    // $fre_contratista         = $_POST['fre_contratista'];
    $fre_descripcion         = $_POST['fre_descripcion'];
    

    //--Insertar nuevo proveedor    
    $result = mysqli_query($con,"INSERT INTO frentes(usuCreacion, nombre, descripcion, fk_contratista, estado)
        VALUES('admin', '$fre_nombre', '$fre_descripcion', null, 0)");         


    header("Location: ../../../../../index.php?p=frentes");
  }
 ?>
