<?php
include("../../../config/conexion.php");
 //   error_reporting(E_ALL);
 //   ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  if (mysqli_connect_errno()) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }
  else {
    $con -> set_charset("utf8");

    //--Datos de usuario
    $item_id                = $_POST['item_id'];
    $item_idAlmacen         = $_POST['item_idAlmacen'];
    $item_nombre            = $_POST['item_nombre'];
    $item_cantidad          = $_POST['item_cantidad'];
    $item_categoria         = $_POST['item_categoria'];
    $item_ubicacion         = $_POST['item_ubicacion'];
    $item_descripcion       = $_POST['item_descripcion'];    

 

    //--Insertar nuevo proveedor
    //$ref = "CLI-".substr($cli_nombre,0, 4).$cli_rfc."-".$cli_email;    
    //$result = mysqli_query($con,"INSERT INTO clientes(usuCreacion,identificador,nombre,rfc,calle,numExt,numInt,colonia,cp,ciudad,municipio,empresa,email,movil,telefono,nota)
      //  VALUES('eliot', '$ref', '$cli_nombre', '$cli_rfc', '$cli_calle', '$cli_numExt', '$cli_numInt', '$cli_colonia', '$cli_cp', '$cli_ciudad', '$cli_municipio', '$cli_empresa', '$cli_email', '$cli_movil', '$cli_tel', '$cli_nota')");   

    $result = mysqli_query($con, "UPDATE inventarios SET nombre = '$item_nombre', cantidad = '$item_cantidad', categoria = '$item_categoria',
                                    ubicacion = '$item_ubicacion', descripcion = '$item_descripcion', fk_almacen = '$item_idAlmacen'
                                    WHERE id = '$item_id'");
    
     header("Location: ../../../../../index.php?p=inventarioOk");

  }
 ?>
