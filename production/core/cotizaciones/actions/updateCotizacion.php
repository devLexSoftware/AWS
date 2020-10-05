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
    $cot_cliente        = $_POST['Nomcliente'];
    $cot_obra           = $_POST['Obra'];
    $cot_frente         = $_POST['Frente'];
    $cot_superficie     = $_POST['Superficie'];
    $cot_costoPromedio  = $_POST['costoPromedio'];
    $cot_costoTotal     = $_POST['costoTotal'];
    $cot_Inicial        = $_POST['Inicio'];
    $cot_entrega        = $_POST['Entrega'];
    $cot_inversion      = $_POST['Inversion'];
    $cot_cantidad       = $_POST['detalleCantidad'];
    $cot_id             = $_POST['cotizacionId'];

    //--Insertar nuevo proveedor
    $ref = "COT-".$cot_cliente;
    $result = mysqli_query($con,"UPDATE cotizaciones SET cliente = '$cot_cliente', obra = '$cot_obra', frente = '$cot_frente',
                superficie = '$cot_superficie', costoPromedio = '$cot_costoPromedio', total = '$cot_costoTotal',
                inicio = '$cot_Inicial', entrega = '$cot_entrega', inversionSemanal = '$cot_inversion'
                WHERE id = '$cot_id'");

    $result = mysqli_query($con, "SET FOREIGN_KEY_CHECKS=0");
    $result = mysqli_query($con, "Delete from cotizaciones_detalles where fk_cotizaciones = '$cot_id'");        
    

    for ($i=0 ; $i <  $cot_cantidad; $i++ ) {
      $detalleConcepto            = $_POST['detalleConcepto'.$i];
      $detalleUnidad              = $_POST['detalleUnidad'.$i];
      $detalleCantidad            = $_POST['detalleCantidad'.$i];
      $detalleCosto               = $_POST['detalleCosto'.$i];
      $detalleUtil                = $_POST['detalleUtil'.$i];
      $detalleAdmin               = $_POST['detalleAdmin'.$i];
      $detalleDirecto             = $_POST['detalleDirecto'.$i];
      $detalleCU                  = $_POST['detalleCostoUni'.$i];
      $detalleDescuento           = $_POST['detalleDescuento'.$i];
      $detalleCReal               = $_POST['detalleCReal'.$i];
      $detalleGanancia            = $_POST['detalleGanancia'.$i];
      $detalleReal                = $_POST['detalleReal'.$i];
      $detalleImporte             = $_POST['detalleImporte'.$i];
      

      $result = mysqli_query($con,"INSERT INTO cotizaciones_detalles(usuCreacion, fk_cotizaciones, concepto, unidad, cantidad, costo, util, admin, directo, cu, descuento, costo_real, ganancia_real, real_valor, importe)
          VALUES('admin','$cot_id', '$detalleConcepto', '$detalleUnidad', '$detalleCantidad', '$detalleCosto', '$detalleUtil', '$detalleAdmin', '$detalleDirecto', '$detalleCU', '$detalleDescuento', '$detalleCReal', '$detalleGanancia', '$detalleReal', '$detalleImporte')");

    }
   header("Location: ../../../../index.php?p=cotizacionesOk");
  }
 ?>
