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
    $obr_nombre         = $_POST['obr_nombre'];
    $obr_cliente        = $_POST['obr_cliente'];
    $obr_calle          = $_POST['obr_calle'];
    $obr_numExt         = $_POST['obr_numExt'];
    $obr_numInt         = $_POST['obr_numInt'];
    $obr_colonia        = $_POST['obr_colonia'];
    $obr_cp             = $_POST['obr_cp'];
    $obr_ciudad         = $_POST['obr_ciudad'];
    $obr_municipio      = $_POST['obr_municipio'];
    $obr_fechInicio     = $_POST['obr_fechInicio'];
    $obr_fechFin        = $_POST['obr_fechFin'];
    $obr_avance         = $_POST['obr_avance'];
    $obr_nota           = $_POST['obr_nota'];
    $obr_grupo          = $_POST['obr_grupo'];
    $obr_costo          = $_POST['obr_costoTotal'];
    $obr_porcentaje     = $_POST['obr_porcentaje'];
    $obr_superficie     = $_POST['obr_superficie'];
    $obr_superficieCon  = $_POST['obr_superficieConstruir'];


    //--Insertar nuevo proveedor
    $ref = "OBR-".$obr_nombre;
    $result = mysqli_query($con,"INSERT INTO obras(usuCreacion,identificador, nombre, calle, numExt, numInt, colonia, cp, ciudad, municipio, fechInicio, fechFin, avance, comentario, fk_clientes, estado, fk_grupo, costoTotal, porcentajeGanancia, superficie, superficieConstruir)
        VALUES('admin', '$ref', '$obr_nombre', '$obr_calle', '$obr_numExt', '$obr_numInt', '$obr_colonia', '$obr_cp', '$obr_ciudad', '$obr_municipio', '$obr_fechInicio', '$obr_fechFin', '$obr_avance', '$obr_nota', '$obr_cliente', 0, '$obr_grupo', '$obr_costo', '$obr_porcentaje', '$obr_superficie', '$obr_superficieCon' )");
    $id = mysqli_insert_id($con);

    // $result = mysqli_query($con,"INSERT INTO detalles_obras(usuCreacion,avance, comentario, fk_obra)
    //     VALUES('admin', '$obr_avance', '$obr_nota', '$id')");

    header("Location: ../../../../../index.php?p=obras");
  }
 ?>
