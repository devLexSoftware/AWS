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
    $ped_obra       = $_POST['pedido_obra'];
    $ped_frente       = $_POST['pedido_frente'];
    $ped_nota      = $_POST['pedido_nota'];
    $ped_estado     = $_POST['pedido_estado'];
    



    //--Insertar nuevo proveedor
    //$ref = "COM-".$com_fecha.$com_numero.;
    $result = mysqli_query($con,"INSERT INTO pedidos(usuCreacion, identificador, fk_obra, frente, descripcion, estado, estatus)
        VALUES('admin', '', '$ped_obra', '$ped_frente', '$ped_nota','$ped_estado',  '0')");

    header("Location: ../../../../../index.php?p=pedidos");
  }
 ?>
