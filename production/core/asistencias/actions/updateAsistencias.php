<?php
include("../../../config/conexion.php");
 //   error_reporting(E_ALL);
 //   ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  if (mysqli_connect_errno()) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }
  else {

    $con -> set_charset("utf8");


    //--Datos de usuario
    $asis_obra         = $_POST['asis_obra'];    
    $asis_semana           = $_POST['asis_semana'];   
    $fechInicial_Reporte       = $_POST['fechInicial_Reporte'];
    $fechFinal_Reporte      = $_POST['fechFinal_Reporte'];
    $asis_grupo      = $_POST['asis_grupo'];
    $count_empleados      = $_POST['countEmpleados'];
    $count_contratista      = $_POST['countContratistas'];
    $idAsistencia      = $_POST['idAsistencia'];
    
    $result = mysqli_query($con, "SET FOREIGN_KEY_CHECKS=0");
    $result = mysqli_query($con, "Delete from asistencias_empleados where fk_asistencia = '$idAsistencia'");    
    // $result = mysqli_query($con, "Delete from asistencias_contratistas where fk_asistencia = '$idAsistencia'");    


    $result = mysqli_query($con, "UPDATE asistencias SET fk_obra = '$asis_obra', semana = '$asis_semana', 
                                    periodoInicial = '$fechInicial_Reporte', periodoFinal = '$fechFinal_Reporte', fk_grupo = '$asis_grupo'
                                    WHERE id = '$idAsistencia'");

    // echo $count_empleados;
    for ($i=0 ; $i <  $count_empleados; $i++ ) {
        $idEmpleado           = $_POST['empleado_'.$i];    
        $salarioEmpleado           = $_POST['empleado_salario_'.$i];            
        // $lunes                = isset($_POST['empleado_dia_1_'.$idEmpleado]) ? 1 : 0;
        // $martes                = isset($_POST['empleado_dia_2_'.$idEmpleado]) ? 1 : 0;
        // $miercoles                = isset($_POST['empleado_dia_3_'.$idEmpleado]) ? 1 : 0;
        // $jueves                = isset($_POST['empleado_dia_4_'.$idEmpleado]) ? 1 : 0;
        // $viernes                = isset($_POST['empleado_dia_5_'.$idEmpleado]) ? 1 : 0;
        // $sabado                = isset($_POST['empleado_dia_6_'.$idEmpleado]) ? 1 : 0;

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
            VALUES('admin','$lunes', '$martes', '$miercoles', '$jueves', '$viernes', '$sabado', '0',  '$salarioEmpleado', '$idEmpleado', '$idAsistencia', '0' )");
    }  


      for ($i=0 ; $i <  $count_contratista; $i++ ) {
        $idEmpleado           = $_POST['contratista_'.$i];                           
        $idAsisCont           = $_POST['fk_asistencia_'.$i];  
        $idAsistencia         = $_POST['id_asistencia_'.$i];    
        $flagCambios = false;                       

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

        $restante = $_POST['contratista_restante_'.$i];
        $monto = $_POST['contratista_monto_'.$i];
        $pago = $_POST['contratista_pago_'.$i];


        $montoOriginal = $_POST['contratista_monto_original_'.$i];        
        $pagoOriginal = $_POST['contratista_pago_original_'.$i];


        $result2 = mysqli_query($con,"SELECT fk_obra FROM asistencias a                          
                          where a.id = $idAsistencia;");   
        $elemento2 = mysqli_fetch_array($result2);



        //--Actualizar Semana
        $result = mysqli_query($con, "UPDATE asistencias_contratistas SET 
                          lunes = '$lunes', martes = '$martes', miercoles = '$miercoles', jueves = '$jueves', viernes = '$viernes', sabado = '$sabado',
                          abono = '$pago'
                          WHERE id = '$idAsisCont'");

        //---Actualizar en cascada porque hay cambio en monto
        if($monto != $montoOriginal || $pago != $pagoOriginal){
          $resultC1 = mysqli_query($con, "SELECT ac.monto, ac.abono, ac.totalpagar, ac.id as fk, a.id from asistencias a 
                          inner join asistencias_contratistas ac on a.id = ac.fk_asistencia
                          where ac.fk_contratista = $idEmpleado and a.fk_obra = $elemento2[fk_obra] order by cast(totalpagar as unsigned) desc");;

          while($row = $resultC1->fetch_array(MYSQLI_ASSOC)) 
            $el[] = $row;  

          foreach ($el as $valor) {            
            if($valor[monto] == NULL || $valor[monto] == "" || $valor[monto] == 0)              
              break;

            $sumAbono = $sumAbono + $valor[abono];  
            $totalPagarC = $monto - $sumAbono;            
            $resultU1 = mysqli_query($con, "UPDATE asistencias_contratistas SET
                            monto = '$monto', totalpagar = '$totalPagarC'
                            where id = $valor[fk]");            
          }
        }        
        // $result = mysqli_query($con,"INSERT INTO asistencias_contratistas(usuCreacion, lunes, martes, miercoles, jueves, viernes, sabado, domingo, monto, fk_contratista, fk_asistencia, estado, abono, totalpagar)
        //     VALUES('admin','$lunes', '$martes', '$miercoles', '$jueves', '$viernes', '$sabado', '0',  '$monto', '$idEmpleado', '$idAsistencia', '0', '$pago','$restante' )");
      }  
     
        
    header("Location: ../../../../../index.php?p=asistenciasOk");

  }
 ?>
