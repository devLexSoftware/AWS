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
        if($tabla == "grupos"){
            $result = mysqli_query($con,"SELECT g.id, g.nombre FROM obras o INNER JOIN grupos g on o.fk_grupo = g.id WHERE o.id = $id;");   
            $elemento = mysqli_fetch_array($result);

            $result2 = mysqli_query($con,"SELECT e.id, e.nombre FROM empleados e INNER JOIN grupos_empleados ge on e.id = ge.fk_empleado WHERE ge.fk_grupo = $elemento[id];");   
            // $elemento2 = mysqli_fetch_array($result2);
            echo '
                <div class="col-md-12 col-xs-12">
                    <div class="x_content">       
                        <div class="from-group row">
                            <div class="col-md-3">
                                <h2>Equipo</h2>
                            </div>
                        </div>                                 
                        <div class="from-group row">
                            <div class="col-md-6">
                                <select name="asis_grupo" id="asis_grupo" class="form-control" >      
                                    <option default value="'.$elemento["id"].'">'.$elemento["nombre"].'</option>                           
                                </select>
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
                                                    while($elemento2 = mysqli_fetch_array($result2)){                                                                                                                
                                                        echo '
                                                            <tr>
                                                                <td style="display: none;"><input name="empleado_'.$count.'" id="empleado_'.$count.'" type="text" value="'.$elemento2[id].'" /></td>            
                                                                <td>'.$elemento2[nombre].'</td>            
                                                                <td><input name="empleado_dia_1_'.$elemento2[id].'"  type="checkbox" id="empleado_dia_1_'.$elemento2[id].'" ></td>
                                                                <td><input name="empleado_dia_2_'.$elemento2[id].'"  type="checkbox" id="empleado_dia_2_'.$elemento2[id].'" ></td>
                                                                <td><input name="empleado_dia_3_'.$elemento2[id].'" type="checkbox" id="empleado_dia_3_'.$elemento2[id].'" ></td>
                                                                <td><input name="empleado_dia_4_'.$elemento2[id].'" type="checkbox" id="empleado_dia_4_'.$elemento2[id].'" ></td>
                                                                <td><input name="empleado_dia_5_'.$elemento2[id].'" type="checkbox" id="empleado_dia_5_'.$elemento2[id].'" ></td>
                                                                <td><input name="empleado_dia_6_'.$elemento2[id].'" type="checkbox" id="empleado_dia_6_'.$elemento2[id].'" ></td>
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
        else if($tabla == "gruposActualizar")
        {            


            $result3 = mysqli_query($con,"SELECT  e.id, e.nombre, ae.lunes, ae.martes, ae.miercoles, ae.jueves, ae.viernes  FROM empleados e 
                                            INNER JOIN grupos_empleados ge on e.id = ge.fk_empleado
                                            INNER JOIN asistencias_empleados ae on ge.fk_empleado = ae.fk_empleado
                                            WHERE ae.fk_asistencia = $id;");   

            

            $result = mysqli_query($con,"SELECT g.nombre, g.id FROM grupos g 
                                            inner join asistencias a on g.id = a.fk_grupo
                                            where a.id = $id;");   
            $elemento = mysqli_fetch_array($result);

            // $elemento2 = mysqli_fetch_array($result2);
            echo '
                <div class="col-md-12 col-xs-12">
                    <div class="x_content">       
                        <div class="from-group row">
                            <div class="col-md-3">
                                <h2>Equipo</h2>
                            </div>
                        </div>                                 
                        <div class="from-group row">
                            <div class="col-md-6">
                                <select name="asis_grupo" id="asis_grupo" class="form-control" >      
                                    <option default value="'.$elemento["id"].'">'.$elemento["nombre"].'</option>                           
                                </select>
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
                                                                <td><input '; if($elemento3[lunes] == 1){ echo 'checked'; } echo ' name="empleado_dia_1_'.$elemento3[id].'"  type="checkbox" id="empleado_dia_1_'.$elemento3[id].'" ></td>
                                                                <td><input '; if($elemento3[martes] == 1){ echo 'checked'; } echo ' name="empleado_dia_2_'.$elemento3[id].'"  type="checkbox" id="empleado_dia_2_'.$elemento3[id].'" ></td>
                                                                <td><input '; if($elemento3[miercoles] == 1){ echo 'checked'; } echo ' name="empleado_dia_3_'.$elemento3[id].'" type="checkbox" id="empleado_dia_3_'.$elemento3[id].'" ></td>
                                                                <td><input '; if($elemento3[jueves] == 1){ echo 'checked'; } echo ' name="empleado_dia_4_'.$elemento3[id].'" type="checkbox" id="empleado_dia_4_'.$elemento3[id].'" ></td>
                                                                <td><input '; if($elemento3[viernes] == 1){ echo 'checked'; } echo ' name="empleado_dia_5_'.$elemento3[id].'" type="checkbox" id="empleado_dia_5_'.$elemento3[id].'" ></td>
                                                                <td><input '; if($elemento3[sabado] == 1){ echo 'checked'; } echo ' dname="empleado_dia_6_'.$elemento3[id].'" type="checkbox" id="empleado_dia_6_'.$elemento3[id].'" ></td>
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
