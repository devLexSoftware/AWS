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

    //--Insertar nuevo proveedor
    $ref = "COT-".$cot_cliente;
    $result = mysqli_query($con,"INSERT INTO cotizaciones(usuCreacion,identificador, cliente, obra, frente, superficie, costoPromedio, total, inicio, entrega, inversionSemanal, estado)
        VALUES('admin', '$ref', '$cot_cliente', '$cot_obra', '$cot_frente', '$cot_superficie', '$cot_costoPromedio', '$cot_costoTotal', '$cot_Inicial', '$cot_entrega', '$cot_inversion' ,0)");
    $id = mysqli_insert_id($con);

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
          VALUES('admin','$id', '$detalleConcepto', '$detalleUnidad', '$detalleCantidad', '$detalleCosto', '$detalleUtil', '$detalleAdmin', '$detalleDirecto', '$detalleCU', '$detalleDescuento', '$detalleCReal', '$detalleGanancia', '$detalleReal', '$detalleImporte')");

    }
   header("Location: ../../../../index.php?p=cotizacionesOk");
  }
 ?>
