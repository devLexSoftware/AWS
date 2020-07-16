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
    $com_cliente       = $_POST['Cliente_Reporte'];
    $com_obra       = $_POST['Obra_Reporte'];
    $com_fecha      = $_POST['fecha_Reporte'];
    $com_semana     = $_POST['Semana_Reporte'];
    $com_proveedor  = $_POST['Proveedor_Reporte'];
    $com_descripcion = $_POST['Descripcion_Reporte'];
    $com_frente     = $_POST['Frente_Reporte'];
    $com_numero     = $_POST['NomFactura_Reporte'];
    $com_unidad     = $_POST['Unidad_Reporte'];
    $com_costo      = $_POST['CostoUnit_Reporte'];
    $com_iva        = $_POST['Iva_Reporte'];
    $com_subtotal   = $_POST['Subtotal_Reporte'];
    $com_cantidad   = $_POST['Cantidad_Reporte'];
    $com_importe    = $_POST['Importe_Reporte'];
    $com_nota       = $_POST['Notas_Reporte'];
    $com_fechInicial = $_POST['fechInicial_Reporte'];
    $com_fechFinal = $_POST['fechFinal_Reporte'];
    $com_proceso = $_POST['Proceso_Reporte'];


    $cadena = explode("_",$com_proveedor);
    if($cadena[0] == "prv"){
      $result = mysqli_query($con,"INSERT INTO compras(usuCreacion,identificador, descripcion, fecha, semana, frente, factura, unidad, costo, cantidad, importe, iva, subtotal, comentario, fk_proveedor, fk_obra, fk_clientes, foto, fechInicial, fechFinal, estado, fk_contratista, proceso)
      VALUES('admin', 'ref', '$com_descripcion', '$com_fecha', '$com_semana','$com_frente', '$com_numero', '$com_unidad', '$com_costo', '$com_cantidad', '$com_importe', '$com_iva', '$com_subtotal', '$com_nota', '$cadena[1]', '$com_obra', '$com_cliente', '', '$com_fechInicial', '$com_fechFinal', '0', null, '$com_proceso')");

      //$dat= "INSERT INTO compras(usuCreacion,identificador, descripcion, fecha, semana, frente, factura, unidad, costo, cantidad, importe, iva, subtotal, comentario, fk_proveedor, fk_obra, fk_clientes, foto, fechInicial, fechFinal, estado, fk_contratista)
      // VALUES('admin', 'ref', '$com_descripcion', '$com_fecha', '$com_semana','$com_frente', '$com_numero', '$com_unidad', '$com_costo', '$com_cantidad', '$com_importe', '$com_iva', '$com_subtotal', '$com_nota', '$cadena[1]', '$com_obra', '$com_cliente', '', '$com_fechInicial', '$com_fechFinal', '0', null)";
    }
    else if($cadena[0] == "ctr"){
      $result = mysqli_query($con,"INSERT INTO compras(usuCreacion,identificador, descripcion, fecha, semana, frente, factura, unidad, costo, cantidad, importe, iva, subtotal, comentario, fk_proveedor, fk_obra, fk_clientes, foto, fechInicial, fechFinal, estado, fk_contratista, proceso)
      VALUES('admin', 'ref', '$com_descripcion', '$com_fecha', '$com_semana','$com_frente', '$com_numero', '$com_unidad', '$com_costo', '$com_cantidad', '$com_importe', '$com_iva', '$com_subtotal', '$com_nota', null, '$com_obra', '$com_cliente', '', '$com_fechInicial', '$com_fechFinal', '0', '$cadena[1]', '$com_proceso')");
      
     // $dat = "INSERT INTO compras(usuCreacion,identificador, descripcion, fecha, semana, frente, factura, unidad, costo, cantidad, importe, iva, subtotal, comentario, fk_proveedor, fk_obra, fk_clientes, foto, fechInicial, fechFinal, estado, fk_contratista)
      // VALUES('admin', 'ref', '$com_descripcion', '$com_fecha', '$com_semana','$com_frente', '$com_numero', '$com_unidad', '$com_costo', '$com_cantidad', '$com_importe', '$com_iva', '$com_subtotal', '$com_nota', null, '$com_obra', '$com_cliente', '', '$com_fechInicial', '$com_fechFinal', '0', '$cadena[1]')";
    }
    

    //--Insertar nuevo proveedor
    //$ref = "COM-".$com_fecha.$com_numero.;
    

    //header("Location: ../../../../../index.php?p=compras");
  }
 ?>
