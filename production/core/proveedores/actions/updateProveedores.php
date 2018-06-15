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
    $prv_ref        = $_POST['prv_referencia'];
    $prv_proveedor    = $_POST['prv_proveedor'];
    $prv_rfc          = $_POST['prv_rfc'];
    $prv_nombre       = $_POST['prv_nombre'];
    $prv_direccion    = $_POST['prv_direccion'];
    $prv_celular      = $_POST['prv_celular'];
    $prv_telefono     = $_POST['prv_telefono'];
    $prv_email        = $_POST['prv_email'];
    $prv_descripcion  = $_POST['prv_descripcion'];
   // $prv_unidad       = $_POST['prv_unidad'];
    $prv_nota         = $_POST['prv_nota'];
    //$prv_importe         = $_POST['prv_importe'];

    //--Insertar nuevo proveedor
    //$ref = "CLI-".substr($cli_nombre,0, 4).$cli_rfc."-".$cli_email;    
    //$result = mysqli_query($con,"INSERT INTO clientes(usuCreacion,identificador,nombre,rfc,calle,numExt,numInt,colonia,cp,ciudad,municipio,empresa,email,movil,telefono,nota)
      //  VALUES('eliot', '$ref', '$cli_nombre', '$cli_rfc', '$cli_calle', '$cli_numExt', '$cli_numInt', '$cli_colonia', '$cli_cp', '$cli_ciudad', '$cli_municipio', '$cli_empresa', '$cli_email', '$cli_movil', '$cli_tel', '$cli_nota')");   

    $result = mysqli_query($con, "UPDATE proveedores SET proveedor = '$prv_proveedor', rfc = '$prv_rfc', empresa = '$prv_nombre', direccion = '$prv_direccion', contacto1 = '$prv_celular', 
                                    contacto2 = '$prv_telefono', email = '$prv_email', descripcion = '$prv_descripcion', comentario = '$prv_nota'
                                    WHERE identificador = '$prv_ref'");
    
    header("Location: ../../../../../workshop.com/index.php?p=proveedoresOk");

  }
 ?>
