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
    $com_id         = $_POST['referencia_Reporte'];
    $com_cliente    = $_POST['Cliente_Reporte'];
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

    $cadena = explode("_",$com_proveedor);

    if($cadena[0] == "prv"){
      $result = mysqli_query($con, "UPDATE compras SET descripcion = '$com_descripcion', fecha = '$com_fecha', frente = '$com_frente', semana = '$com_semana', unidad = '$com_unidad',
        factura = '$com_numero', costo = '$com_costo', cantidad = '$com_cantidad', importe = '$com_importe', iva = '$com_iva', subtotal = '$com_subtotal',
        comentario = '$com_nota', fk_obra = '$com_obra', fk_clientes = '$com_cliente', fk_proveedor = '$cadena[1]', fechInicial = '$com_fechInicial', fechFinal = '$com_fechFinal', fk_contratista = null
        WHERE id = $com_id");
    }
    else if($cadena[0] == "ctr"){
      $result = mysqli_query($con, "UPDATE compras SET descripcion = '$com_descripcion', fecha = '$com_fecha', frente = '$com_frente', semana = '$com_semana', unidad = '$com_unidad',
        factura = '$com_numero', costo = '$com_costo', cantidad = '$com_cantidad', importe = '$com_importe', iva = '$com_iva', subtotal = '$com_subtotal',
        comentario = '$com_nota', fk_obra = '$com_obra', fk_clientes = '$com_cliente', fk_proveedor = null, fechInicial = '$com_fechInicial', fechFinal = '$com_fechFinal', fk_contratista = $cadena[1]
        WHERE id = $com_id");
    }

     
     header("Location: ../../../../../index.php?p=comprasOk");

    //header("Location: ../../../../../index.php?p=compras");
  }
 ?>
