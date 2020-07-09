<?php
include("../../../config/conexion.php");
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  if (mysqli_connect_errno()) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }
  else {

    //--Datos de usuario
    $fre_id                   = $_POST['fre_id'];

    $fre_nombre              = $_POST['fre_nombre'];    
    $fre_contratista         = $_POST['fre_contratista'];
    $fre_descripcion         = $_POST['fre_descripcion'];
    

    $result = mysqli_query($con, "UPDATE frentes SET nombre = '$fre_nombre', descripcion = '$fre_descripcion', fk_contratista = '$fre_contratista'                                     
                                    WHERE id = '$fre_id'");
    
    header("Location: ../../../../../index.php?p=frentesOk");
  }
 ?>
