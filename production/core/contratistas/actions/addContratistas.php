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
    $con_identificador       = $_POST['con_identificador'];
    $con_encargado           = $_POST['con_encargado'];
    $con_frente              = $_POST['con_frente'];
    $con_empresa             = $_POST['con_empresa'];
    $con_movil               = $_POST['con_movil'];
    $con_correo              = $_POST['con_correo'];
    $con_descripcion         = $_POST['con_descripcion'];
    

    //--Insertar nuevo proveedor    
    $result = mysqli_query($con,"INSERT INTO contratistas(usuCreacion, identificador, frente, encargado, empresa, movil, email, descripcion,estado)
        VALUES('admin', '$con_identificador', '$con_frente', '$con_encargado', '$con_empresa', '$con_movil', '$con_correo', '$con_descripcion', 0)");         


    header("Location: ../../../../../index.php?p=contratistas");
  }
 ?>
