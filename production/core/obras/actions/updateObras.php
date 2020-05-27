<?php
include("../../../config/conexion.php");
 //   error_reporting(E_ALL);
 //   ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  if (mysqli_connect_errno()) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }
  else {

    //--Datos de usuario
    $obr_ref            = $_POST['obr_ref'];
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

    //--Insertar nuevo proveedor
    //$ref = "CLI-".substr($cli_nombre,0, 4).$cli_rfc."-".$cli_email;    
    //$result = mysqli_query($con,"INSERT INTO clientes(usuCreacion,identificador,nombre,rfc,calle,numExt,numInt,colonia,cp,ciudad,municipio,empresa,email,movil,telefono,nota)
      //  VALUES('eliot', '$ref', '$cli_nombre', '$cli_rfc', '$cli_calle', '$cli_numExt', '$cli_numInt', '$cli_colonia', '$cli_cp', '$cli_ciudad', '$cli_municipio', '$cli_empresa', '$cli_email', '$cli_movil', '$cli_tel', '$cli_nota')");   

    $result = mysqli_query($con, "UPDATE obras SET nombre = '$obr_nombre', calle = '$obr_calle', numExt = '$obr_numExt', numInt = '$obr_numInt', colonia = '$obr_colonia',
                                    cp = '$obr_cp', ciudad = '$obr_ciudad', municipio = '$obr_municipio', comentario = '$obr_nota', fechInicio = '$obr_fechInicio', fechFin = '$obr_fechFin',
                                    avance = '$obr_avance', fk_clientes = '$obr_cliente', fk_grupo = '$obr_grupo'
                                    WHERE identificador = '$obr_ref'");
    
    // header("Location: ../../../../../index.php?p=obrasOk");

  }
 ?>
