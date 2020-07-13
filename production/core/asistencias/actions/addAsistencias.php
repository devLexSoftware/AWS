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
    $asis_obra         = $_POST['asis_obra'];    
    $asis_semana           = $_POST['asis_semana'];   
    $fechInicial_Reporte       = $_POST['fechInicial_Reporte'];
    $fechFinal_Reporte      = $_POST['fechFinal_Reporte'];
    $asis_grupo      = $_POST['asis_grupo'];
    $count_empleados      = $_POST['countEmpleados'];
    $count_contratista      = $_POST['countContratista'];

    //--Insertar asistencia    
    $result = mysqli_query($con,"INSERT INTO asistencias(usuCreacion, periodoInicial, periodoFinal,semana, descripcion, fk_obra, fk_grupo, estado)
                        VALUES('admin',  '$fechInicial_Reporte', '$fechFinal_Reporte', '$asis_semana', '', '$asis_obra','$asis_grupo', '0')");
    $id = mysqli_insert_id($con);
    

    // echo $count_empleados;
    for ($i=0 ; $i <  $count_empleados; $i++ ) {
      $idEmpleado           = $_POST['empleado_'.$i];           
      $salarioEmpleado           = $_POST['empleado_salario_'.$i];           
      // $lunes                = isset($_POST['empleado_dia_1_'.$idEmpleado]) ? 1 : 0;
      if(isset($_POST['empleado_dia_1_'.$idEmpleado])){
        $lunes = $_POST['empleado_dia_1_'.$idEmpleado];
      }
      else{
        $lunes = 0;
      }      
      if(isset($_POST['empleado_dia_2_'.$idEmpleado])){
        $martes = $_POST['empleado_dia_2_'.$idEmpleado];
      }
      else{
        $martes = 0;
      }
      if(isset($_POST['empleado_dia_3_'.$idEmpleado])){
        $miercoles = $_POST['empleado_dia_3_'.$idEmpleado];
      }
      else{
        $miercoles = 0;
      }
      if(isset($_POST['empleado_dia_4_'.$idEmpleado])){
        $jueves = $_POST['empleado_dia_4_'.$idEmpleado];
      }
      else{
        $jueves = 0;
      }
      if(isset($_POST['empleado_dia_5_'.$idEmpleado])){
        $viernes = $_POST['empleado_dia_5_'.$idEmpleado];
      }
      else{
        $viernes = 0;
      }
      if(isset($_POST['empleado_dia_6_'.$idEmpleado])){
        $sabado = $_POST['empleado_dia_6_'.$idEmpleado];
      }
      else{
        $sabado = 0;
      }
 
      
      $result = mysqli_query($con,"INSERT INTO asistencias_empleados(usuCreacion, lunes, martes, miercoles, jueves, viernes, sabado, domingo, monto, fk_empleado, fk_asistencia, estado)
          VALUES('admin','$lunes', '$martes', '$miercoles', '$jueves', '$viernes', '$sabado', '0',  '$salarioEmpleado', '$idEmpleado', '$id', '0' )");
    }  

    for ($i=0 ; $i <  $count_contratista; $i++ ) {
      $idEmpleado           = $_POST['contratista_'.$i];           
      
      // $lunes                = isset($_POST['empleado_dia_1_'.$idEmpleado]) ? 1 : 0;
      if(isset($_POST['contratista_dia_1_'.$idEmpleado])){
        $lunes = $_POST['contratista_dia_1_'.$idEmpleado];
      }
      else{
        $lunes = 0;
      }      
      if(isset($_POST['contratista_dia_2_'.$idEmpleado])){
        $martes = $_POST['contratista_dia_2_'.$idEmpleado];
      }
      else{
        $martes = 0;
      }
      if(isset($_POST['contratista_dia_3_'.$idEmpleado])){
        $miercoles = $_POST['contratista_dia_3_'.$idEmpleado];
      }
      else{
        $miercoles = 0;
      }
      if(isset($_POST['contratista_dia_4_'.$idEmpleado])){
        $jueves = $_POST['contratista_dia_4_'.$idEmpleado];
      }
      else{
        $jueves = 0;
      }
      if(isset($_POST['contratista_dia_5_'.$idEmpleado])){
        $viernes = $_POST['contratista_dia_5_'.$idEmpleado];
      }
      else{
        $viernes = 0;
      }
      if(isset($_POST['contratista_dia_6_'.$idEmpleado])){
        $sabado = $_POST['contratista_dia_6_'.$idEmpleado];
      }
      else{
        $sabado = 0;
      }
      

      $monto = $_POST['contratista_monto_'.$i];
      $restante = $_POST['contratista_restante_'.$i];
      $pago = $_POST['contratista_pago_'.$i];

      if($restante == "")
      {
        $res = $monto - $pago;
      }
      else
      {
        $res = $restante - $pago;
      }
      

      
      
      
      $result = mysqli_query($con,"INSERT INTO asistencias_contratistas(usuCreacion, lunes, martes, miercoles, jueves, viernes, sabado, domingo, monto, fk_contratista, fk_asistencia, estado, abono, totalpagar)
          VALUES('admin','$lunes', '$martes', '$miercoles', '$jueves', '$viernes', '$sabado', '0',  '$monto', '$idEmpleado', '$id', '0', '$pago', '$res' )");
    }  


 header("Location: ../../../../../index.php?p=asistencias");
  }
 ?>
