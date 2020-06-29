<?php
    include("../../../config/conexion.php");
    // error_reporting(E_ALL);
    // ini_set('display_errors', '1');
    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    if (mysqli_connect_errno()) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    else {
        $id = $_POST["id"];
        $tabla = $_POST["tabla"];
        $count = 0;
        if($tabla == "asistenciasNominas"){
            $result = mysqli_query($con,"SELECT a.id, a.fk_grupo, a.semana, a.periodoInicial, a.periodoFinal, a.estado from asistencias a 
                                        inner join obras o on a.fk_obra = o.id
                                        where o.id = $id and a.estado = 0;");               

            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $myArray[] = $row;
            }
            echo json_encode($myArray);
            

        }
        else if($tabla == "asistenciasListaNominas")
        {      
            $result3 = mysqli_query($con,"SELECT e.id, e.nombre, e.rfc, ae.lunes, ae.martes, ae.miercoles, ae.jueves, ae.viernes, ae.sabado from empleados e 
                                        inner join asistencias_empleados ae on e.id = ae.fk_empleado
                                        where ae.fk_asistencia = $id;");    
            
            

            echo '
                <div class="col-md-12 col-xs-12">
                    <div class="x_content">       
                        <div class="from-group row">
                            <div class="col-md-3">
                                <h2>Empleados</h2>
                            </div>
                        </div>                                                         
                        <hr>
                        <div class="from-group row">                                             
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_content">
                                        <h4Empleado</h4>
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>                                                                                                   
                                                    <th>Nombre del empleado</th>
                                                    <th>Lunes</th>
                                                    <th>Martes</th>
                                                    <th>Miercoles</th>
                                                    <th>Jueves</th>              
                                                    <th>Viernes</th>    
                                                    <th>Sábado</th>    
                                                </tr>
                                            </thead>                                            
                                            <tbody> 
                                                ';                                                
                                                    while($elemento3 = mysqli_fetch_array($result3)){                                                                                                                
                                                        echo '
                                                            <tr>
                                                                <td style="display: none;"><input name="empleado_'.$count.'" id="empleado_'.$count.'" type="text" value="'.$elemento3[id].'" /></td>            
                                                                <td>'.$elemento3[nombre].'</td>            
                                                                <td>
                                                                    <input disabled '; if($elemento3[lunes] == 1){ echo 'checked'; } echo ' name="empleado_dia_1_'.$elemento3[id].'"  type="radio" id="empleado_dia_1_'.$elemento3[id].'" > día
                                                                    <input disabled '; if($elemento3[lunes] == 0.5){ echo 'checked'; } echo ' name="empleado_dia_1_'.$elemento3[id].'"  type="radio" id="empleado_dia_1_'.$elemento3[id].'" > medio día
                                                                </td>
                                                                <td>
                                                                    <input disabled '; if($elemento3[martes] == 1){ echo 'checked'; } echo ' name="empleado_dia_2_'.$elemento3[id].'"  type="radio" id="empleado_dia_2_'.$elemento3[id].'" > día
                                                                    <input disabled '; if($elemento3[martes] == 0.5){ echo 'checked'; } echo ' name="empleado_dia_2_'.$elemento3[id].'"  type="radio" id="empleado_dia_2_'.$elemento3[id].'" > medio día
                                                                </td>
                                                                <td>
                                                                    <input disabled '; if($elemento3[miercoles] == 1){ echo 'checked'; } echo ' name="empleado_dia_3_'.$elemento3[id].'" type="radio" id="empleado_dia_3_'.$elemento3[id].'" > día
                                                                    <input disabled '; if($elemento3[miercoles] == 0.5){ echo 'checked'; } echo ' name="empleado_dia_3_'.$elemento3[id].'" type="radio" id="empleado_dia_3_'.$elemento3[id].'" > medio día
                                                                </td>
                                                                <td>
                                                                    <input disabled '; if($elemento3[jueves] == 1){ echo 'checked'; } echo ' name="empleado_dia_4_'.$elemento3[id].'" type="radio" id="empleado_dia_4_'.$elemento3[id].'" > día
                                                                    <input disabled '; if($elemento3[jueves] == 0.5){ echo 'checked'; } echo ' name="empleado_dia_4_'.$elemento3[id].'" type="radio" id="empleado_dia_4_'.$elemento3[id].'" > medio día
                                                                </td>
                                                                <td>
                                                                    <input disabled '; if($elemento3[viernes] == 1){ echo 'checked'; } echo ' name="empleado_dia_5_'.$elemento3[id].'" type="radio" id="empleado_dia_5_'.$elemento3[id].'" > día
                                                                    <input disabled '; if($elemento3[viernes] == 0.5){ echo 'checked'; } echo ' name="empleado_dia_5_'.$elemento3[id].'" type="radio" id="empleado_dia_5_'.$elemento3[id].'" > medio día
                                                                </td>
                                                                <td>
                                                                    <input disabled '; if($elemento3[sabado] == 1){ echo 'checked'; } echo ' dname="empleado_dia_6_'.$elemento3[id].'" type="radio" id="empleado_dia_6_'.$elemento3[id].'" > día
                                                                    <input disabled '; if($elemento3[sabado] == 0.5){ echo 'checked'; } echo ' dname="empleado_dia_6_'.$elemento3[id].'" type="radio" id="empleado_dia_6_'.$elemento3[id].'" > medio día
                                                                </td>
                                                            </tr>
                                                        ';
                                                        $count++;
                                                    }                                                
                                                echo '
                                            </tbody>
                                        </table>
                                        <input type="hidden" value="'.$count.'" name="countEmpleados" id="countEmpleados"/>
                                    </div>
                                </div>
                            </div>                                        
                        </div>                                                                                                    
                    </div>
                </div>  
            ';
        }

        //---Grupos
        else{
            $result = mysqli_query($con,"SELECT * FROM obras o INNER JOIN grupos g on o.fk_grupo = g.id WHERE o.id = $id;");   
            $elemento = mysqli_fetch_array($result);
            echo json_encode($elemento);
        }                
    }
 ?>
