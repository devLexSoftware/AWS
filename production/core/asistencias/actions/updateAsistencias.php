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
    $asis_obra         = $_POST['asis_obra'];    
    $asis_semana           = $_POST['asis_semana'];   
    $fechInicial_Reporte       = $_POST['fechInicial_Reporte'];
    $fechFinal_Reporte      = $_POST['fechFinal_Reporte'];
    $asis_grupo      = $_POST['asis_grupo'];
    $count_empleados      = $_POST['countEmpleados'];
    $idAsistencia      = $_POST['idAsistencia'];
    
    $result = mysqli_query($con, "SET FOREIGN_KEY_CHECKS=0");
    $result = mysqli_query($con, "Delete from asistencias_empleados where fk_asistencia = '$idAsistencia'");    


    $result = mysqli_query($con, "UPDATE asistencias SET fk_obra = '$asis_obra', semana = '$asis_semana', 
                                    periodoInicial = '$fechInicial_Reporte', periodoFinal = '$fechFinal_Reporte', fk_grupo = '$asis_grupo'
                                    WHERE id = '$idAsistencia'");

    // echo $count_empleados;
    for ($i=0 ; $i <  $count_empleados; $i++ ) {
        $idEmpleado           = $_POST['empleado_'.$i];     
        $lunes                = isset($_POST['empleado_dia_1_'.$idEmpleado]) ? 1 : 0;
        $martes                = isset($_POST['empleado_dia_2_'.$idEmpleado]) ? 1 : 0;
        $miercoles                = isset($_POST['empleado_dia_3_'.$idEmpleado]) ? 1 : 0;
        $jueves                = isset($_POST['empleado_dia_4_'.$idEmpleado]) ? 1 : 0;
        $viernes                = isset($_POST['empleado_dia_5_'.$idEmpleado]) ? 1 : 0;
        $sabado                = isset($_POST['empleado_dia_6_'.$idEmpleado]) ? 1 : 0;
        echo $idEmpleado.'-';
        echo $lunes.'+';
        
        $result = mysqli_query($con,"INSERT INTO asistencias_empleados(usuCreacion, lunes, martes, miercoles, jueves, viernes, sabado, domingo, monto, fk_empleado, fk_asistencia, estado)
            VALUES('admin','$lunes', '$martes', '$miercoles', '$jueves', '$viernes', '$sabado', '0',  '400', '$idEmpleado', '$idAsistencia', '0' )");
      }  
     
        
    header("Location: ../../../../../index.php?p=asistenciasOk");

  }
 ?>
