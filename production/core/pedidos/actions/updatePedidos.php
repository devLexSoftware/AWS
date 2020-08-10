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
    $ped_id         = $_POST['pedido_id'];
    $ped_obra       = $_POST['pedido_obra'];
    $ped_frente       = $_POST['pedido_frente'];
    $ped_nota      = $_POST['pedido_nota'];
    $ped_estado     = $_POST['pedido_estado'];



    //--Insertar nuevo proveedor
    //$ref = "COM-".$com_fecha.$com_numero.;
    //$result = mysqli_query($con,"INSERT INTO compras(usuCreacion,identificador, descripcion, fecha, semana, frente, factura, unidad, costo, cantidad, importe, iva, subtotal, comentario,fk_proveedor, fk_obra, fk_clientes, fechInicial, fechFinal)
      //  VALUES('eliot', 'ref', '$com_descripcion', '$com_fecha', '$com_semana','$com_frente', '$com_numero', '$com_unidad', '$com_costo', '$com_cantidad', '$com_importe', '$com_iva', '$com_subtotal', '$com_nota', '$com_proveedor', '$com_obra', '$com_cliente', '$com_fechInicial', '$com_fechFinal')");

      $result = mysqli_query($con, "UPDATE pedidos SET fk_obra = '$ped_obra', frente = '$ped_frente', descripcion ='$ped_nota',
        estado = '$ped_estado'
      WHERE id = $ped_id");
     
     header("Location: ../../../../../index.php?p=pedidosOk");

    //header("Location: ../../../../../index.php?p=compras");
  }
 ?>
