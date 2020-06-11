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
    $emp_id         = $_POST['Empl_Referencia'];
    $emp_nombre     = $_POST['Empl_NombreEmpleado'];
    $emp_rfc        = $_POST['Empl_RFCEmpleado'];
    $emp_direccion  = $_POST['Empl_DireccionEmpleado'];
    $emp_giro       = $_POST['Empl_GiroEmpleado'];
    $emp_empresa    = $_POST['Empl_EmpresaEmpleado'];
    $emp_email      = $_POST['Empl_CorreoEmpleado'];
    $emp_tel        = $_POST['Empl_OficinaEmpleado'];
    $emp_movil      = $_POST['Empl_CelEmpleado'];    
    $emp_nota       = $_POST['Empl_nota'];
    $emp_salario       = $_POST['Empl_Salario'];
    


    $result = mysqli_query($con, "UPDATE empleados SET nombre = '$emp_nombre', rfc = '$emp_rfc', direccion = '$emp_direccion', giro = '$emp_giro',
                                    empresa = '$emp_empresa', email = '$emp_email', movil = '$emp_movil', telefono = '$emp_tel',
                                    nota = '$emp_nota', salario = '$emp_salario'
                                    WHERE identificador = '$emp_id'");

header("Location: ../../../../../index.php?p=empleadosOk");

  }
 ?>
