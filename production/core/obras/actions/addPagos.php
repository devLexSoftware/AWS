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
    $idObra         = $_POST["id"];
    $pagos          = $_POST["valor"];


    mysqli_query($con,"DELETE from pagos_obras where fk_obra = $idObra");   


    foreach ($pagos as $key) {
        $result = mysqli_query($con,"INSERT INTO pagos_obras(usuCreacion, semana, pago, fk_obra, estado, comentario)
        VALUES('admin','$key[semana]', '$key[pago]', '$idObra', 0, '$key[comen]' )");   
    }
    
    }
 ?>
