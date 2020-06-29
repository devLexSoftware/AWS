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
    $con_id                   = $_POST['con_id'];
    $con_identificador        = $_POST['con_identificador'];
    $con_encargado     = $_POST['con_encargado'];
    $con_frente        = $_POST['con_frente'];
    $con_empresa      = $_POST['con_empresa'];
    $con_movil     = $_POST['con_movil'];
    $con_correo     = $_POST['con_correo'];
    $con_descripcion    = $_POST['con_descripcion']; 
    

    $result = mysqli_query($con, "UPDATE contratistas SET identificador = '$con_identificador', encargado = '$con_encargado', frente = '$con_frente', 
                                    empresa = '$con_empresa', movil = '$con_movil', email = '$con_correo', descripcion = '$con_descripcion'
                                    WHERE id = '$con_id'");
    
    header("Location: ../../../../../index.php?p=contratistasOk");
  }
 ?>
