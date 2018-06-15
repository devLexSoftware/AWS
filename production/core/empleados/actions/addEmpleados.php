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
    $emp_nombre     = $_POST['Empl_NombreEmpleado'];
    $emp_rfc        = $_POST['Empl_RFCEmpleado'];
    $emp_direccion  = $_POST['Empl_DireccionEmpleado'];
    $emp_giro       = $_POST['Empl_GiroEmpleado'];
    $emp_empresa    = $_POST['Empl_EmpresaEmpleado'];
    $emp_email      = $_POST['Empl_CorreoEmpleado'];
    $emp_tel        = $_POST['Empl_OficinaEmpleado'];
    $emp_movil      = $_POST['Empl_CelEmpleado'];
    $emp_grupo      = $_POST['Empl_GrupoEmpleado'];
    $emp_nota       = $_POST['Empl_nota'];

    //--Insertar nuevo proveedor
    $ref = "EMP-".substr($emp_nombre,0, 4).$emp_movil;
    $result = mysqli_query($con,"INSERT INTO empleados(usuCreacion, identificador, nombre, rfc, direccion, movil, telefono, email, empresa, giro, grupo, nota, estado)
                        VALUES('admin', '$ref', '$emp_nombre', '$emp_rfc', '$emp_direccion', '$emp_movil', '$emp_tel', '$emp_email', '$emp_empresa', '$emp_giro', '$emp_grupo', '$emp_nota', '0')");

header("Location: ../../../../../workshop.com/index.php?p=empleados");
  }
 ?>
