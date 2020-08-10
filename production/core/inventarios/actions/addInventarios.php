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
    $item_idAlmacen         = $_POST['item_idAlmacen'];
    $item_nombre            = $_POST['item_nombre'];
    $item_cantidad          = $_POST['item_cantidad'];
    $item_categoria         = $_POST['item_categoria'];
    $item_ubicacion         = $_POST['item_ubicacion'];
    $item_descripcion       = $_POST['item_descripcion'];    

    //--Insertar nuevo proveedor
    $ref = "INV-".$item_nombre."-".$item_categoria;
    $result = mysqli_query($con,"INSERT INTO inventarios(usuCreacion,identificador, nombre, cantidad, categoria, ubicacion, descripcion, fk_almacen, estado)
        VALUES('admin', '$ref', '$item_nombre', '$item_cantidad', '$item_categoria', '$item_ubicacion', '$item_descripcion', '$item_idAlmacen', '0')");
    $id = mysqli_insert_id($con);    

    header("Location: ../../../../../index.php?p=inventario");
  }
 ?>
