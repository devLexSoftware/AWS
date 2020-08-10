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
    $cli_ref        = $_POST['cli_id'];
    $cli_nombre     = $_POST['cli_nombre'];
    $cli_rfc        = $_POST['cli_rfc'];
    $cli_calle      = $_POST['cli_calle'];
    $cli_numExt     = $_POST['cli_numext'];
    $cli_numInt     = $_POST['cli_numint'];
    $cli_colonia    = $_POST['cli_colonia'];
    $cli_cp         = $_POST['cli_cp'];
    $cli_ciudad     = $_POST['cli_ciudad'];
    $cli_municipio  = $_POST['cli_municipio'];
    $cli_empresa    = $_POST['cli_empresa'];
    $cli_email      = $_POST['cli_email'];
    $cli_tel        = $_POST['cli_telefono'];
    $cli_movil      = $_POST['cli_movil'];
    $cli_nota       = $_POST['cli_nota'];

    //--Insertar nuevo proveedor
    //$ref = "CLI-".substr($cli_nombre,0, 4).$cli_rfc."-".$cli_email;    
    //$result = mysqli_query($con,"INSERT INTO clientes(usuCreacion,identificador,nombre,rfc,calle,numExt,numInt,colonia,cp,ciudad,municipio,empresa,email,movil,telefono,nota)
      //  VALUES('eliot', '$ref', '$cli_nombre', '$cli_rfc', '$cli_calle', '$cli_numExt', '$cli_numInt', '$cli_colonia', '$cli_cp', '$cli_ciudad', '$cli_municipio', '$cli_empresa', '$cli_email', '$cli_movil', '$cli_tel', '$cli_nota')");   

    $result = mysqli_query($con, "UPDATE clientes SET nombre = '$cli_nombre', rfc = '$cli_rfc', calle =' $cli_calle', numExt = '$cli_numExt', numInt = '$cli_numInt', colonia = '$cli_colonia',
                                    cp = '$cli_cp', ciudad = '$cli_ciudad', municipio = '$cli_municipio', empresa = '$cli_empresa', email = '$cli_email', movil = '$cli_movil', telefono = '$cli_tel', nota = '$cli_nota'
                                    WHERE id = '$cli_ref'");
    
    header("Location: ../../../../../index.php?p=clientesOk");
  }
 ?>
