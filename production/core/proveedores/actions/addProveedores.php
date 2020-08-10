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
    $prv_proveedor    = $_POST['prv_proveedor'];
    $prv_rfc          = $_POST['prv_rfc'];
    $prv_nombre       = $_POST['prv_nombre'];
    $prv_direccion    = $_POST['prv_direccion'];
    $prv_celular      = $_POST['prv_celular'];
    $prv_telefono     = $_POST['prv_telefono'];
    $prv_email        = $_POST['prv_email'];
    $prv_descripcion  = $_POST['prv_descripcion'];
    //$prv_unidad       = $_POST['prv_unidad'];
    $prv_nota         = $_POST['prv_nota'];
    //$prv_importe         = $_POST['prv_importe'];

    //--Insertar nuevo proveedor
    $ref = "PRV-".substr($prv_nombre,0, 3).$prv_celular;
    $result = mysqli_query($con,"INSERT INTO proveedores(usuCreacion,identificador,empresa,proveedor,descripcion,rfc,contacto1,contacto2,email,direccion,comentario, estado)
        VALUES('admin', '$ref', '$prv_nombre', '$prv_proveedor','$prv_descripcion', '$prv_rfc', '$prv_celular', '$prv_telefono', '$prv_email','$prv_direccion', '$prv_nota', 0)");   

header("Location: ../../../../../index.php?p=proveedores");
  }
 ?>
