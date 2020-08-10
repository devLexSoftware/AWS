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

            $result2 = mysqli_query($con,"SELECT e.id, e.nombre, e.salario FROM empleados e INNER JOIN grupos_empleados ge on e.id = ge.fk_empleado WHERE ge.fk_grupo = $elemento[id];");   
            
            $result02 = mysqli_query($con,"SELECT c.id, c.empresa, c.salario FROM contratistas c INNER JOIN grupos_contratistas gc on c.id = gc.fk_contratista WHERE gc.fk_grupo = $elemento[id];");               


            $result5 = mysqli_query($con,"SELECT ac.fk_contratista, max(monto) as monto, max(monto)-sum(abono) as restante from asistencias_contratistas ac
                            inner join asistencias a on ac.fk_asistencia = a.id
                            where a.fk_obra = $id group by ac.fk_contratista;"); 
            while($row = $result5->fetch_array(MYSQLI_ASSOC)) {
                $elemento5[] = $row;
            }


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
                                                    <th>Opción</th>    
                                                </tr>
                                            </thead>                                            
                                            <tbody> 
                                                ';                            
                                                    $tipo = 1;                    
                                                    while($elemento2 = mysqli_fetch_array($result2)){                                                                                                                
                                                        echo '
                                                            <tr>
                                                                <td style="display: none;"><input name="empleado_'.$count.'" id="empleado_'.$count.'" type="text" value="'.$elemento2[id].'" />
                                                                <input name="empleado_salario_'.$count.'" id="empleado_salario_'.$count.'" type="text" value="'.$elemento2[salario].'" /></td>            
                                                                <td>'.$elemento2[nombre].'</td>            
                                                                <td>
                                                                    <input value="1" name="empleado_dia_1_'.$elemento2[id].'"  type="radio" id="empleado_dia_1_'.$elemento2[id].'" > día 
                                                                    <input value="0.5" name="empleado_dia_1_'.$elemento2[id].'"  type="radio" id="empleado_dia_1_'.$elemento2[id].'" > medio día
                                                                </td>
                                                                <td>
                                                                    <input value="1" name="empleado_dia_2_'.$elemento2[id].'"  type="radio" id="empleado_dia_2_'.$elemento2[id].'" > día
                                                                    <input value="0.5" name="empleado_dia_2_'.$elemento2[id].'"  type="radio" id="empleado_dia_2_'.$elemento2[id].'" > medio día
                                                                </td>
                                                                <td>
                                                                    <input value="1" name="empleado_dia_3_'.$elemento2[id].'" type="radio" id="empleado_dia_3_'.$elemento2[id].'" > día
                                                                    <input value="0.5" name="empleado_dia_3_'.$elemento2[id].'" type="radio" id="empleado_dia_3_'.$elemento2[id].'" > medio día
                                                                </td>
                                                                <td>
                                                                    <input value="1" name="empleado_dia_4_'.$elemento2[id].'" type="radio" id="empleado_dia_4_'.$elemento2[id].'" > día
                                                                    <input value="0.5" name="empleado_dia_4_'.$elemento2[id].'" type="radio" id="empleado_dia_4_'.$elemento2[id].'" > medio día
                                                                </td>
                                                                <td>
                                                                    <input value="1" name="empleado_dia_5_'.$elemento2[id].'" type="radio" id="empleado_dia_5_'.$elemento2[id].'" > día
                                                                    <input value="0.5" name="empleado_dia_5_'.$elemento2[id].'" type="radio" id="empleado_dia_5_'.$elemento2[id].'" > medio día
                                                                </td>
                                                                <td>
                                                                    <input value="1" name="empleado_dia_6_'.$elemento2[id].'" type="radio" id="empleado_dia_6_'.$elemento2[id].'" > día
                                                                    <input value="0.5" name="empleado_dia_6_'.$elemento2[id].'" type="radio" id="empleado_dia_6_'.$elemento2[id].'" > medio día
                                                                </td>
                                                                <td>
                                                                    <input value="limpiar" onclick="limpiarCampos('.$elemento2[id].', '.$tipo.')" name="limpiar" type="button" id="limpiar" >                                                                    
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
                        
                        <div class="from-group row">                                             
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_content">
                                        <h4Empleado</h4>
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>                                                                                                         
                                                    <th>Empresa contratista</th>
                                                    <th>Lunes</th>
                                                    <th>Martes</th>
                                                    <th>Miercoles</th>
                                                    <th>Jueves</th>              
                                                    <th>Viernes</th>    
                                                    <th>Sábado</th>  
                                                    <th>Total a pagar</th>  
                                                    <th>Restante</th>
                                                    <th>Pago</th>                                                        
                                                    <th>Opción</th>    
                                                </tr>
                                            </thead>                                            
                                            <tbody> 
                                                ';                              
                                                $count2 = 0;                  
                                                $tipo = 2;
                                                    while($elemento02 = mysqli_fetch_array($result02)){      
                                                        
                                                        $objeto = null;
                                                        foreach ($elemento5 as $valor) {
                                                            if($valor[fk_contratista] == $elemento02[id])                                                            
                                                            {
                                                                $objeto = $valor;
                                                                break;
                                                            }
                                                        }
                                                        echo '
                                                            <tr>
                                                                <td style="display: none;"><input name="contratista_'.$count2.'" id="contratista_'.$count2.'" type="text" value="'.$elemento02[id].'" />
                                                                </td>            
                                                                <td>'.$elemento02[empresa].'</td>            
                                                                <td>
                                                                    <input value="1" name="contratista_dia_1_'.$elemento02[id].'"  type="radio" id="contratista_dia_1_'.$elemento02[id].'" > día 
                                                                    <input value="0.5" name="contratista_dia_1_'.$elemento02[id].'"  type="radio" id="contratista_dia_1_'.$elemento02[id].'" > medio día
                                                                </td>
                                                                <td>
                                                                    <input value="1" name="contratista_dia_2_'.$elemento02[id].'"  type="radio" id="contratista_dia_2_'.$elemento02[id].'" > día
                                                                    <input value="0.5" name="contratista_dia_2_'.$elemento02[id].'"  type="radio" id="contratista_dia_2_'.$elemento02[id].'" > medio día
                                                                </td>
                                                                <td>
                                                                    <input value="1" name="contratista_dia_3_'.$elemento02[id].'" type="radio" id="contratista_dia_3_'.$elemento02[id].'" > día
                                                                    <input value="0.5" name="contratista_dia_3_'.$elemento02[id].'" type="radio" id="contratista_dia_3_'.$elemento02[id].'" > medio día
                                                                </td>
                                                                <td>
                                                                    <input value="1" name="contratista_dia_4_'.$elemento02[id].'" type="radio" id="contratista_dia_4_'.$elemento02[id].'" > día
                                                                    <input value="0.5" name="contratista_dia_4_'.$elemento02[id].'" type="radio" id="contratista_dia_4_'.$elemento02[id].'" > medio día
                                                                </td>
                                                                <td>
                                                                    <input value="1" name="contratista_dia_5_'.$elemento02[id].'" type="radio" id="contratista_dia_5_'.$elemento02[id].'" > día
                                                                    <input value="0.5" name="contratista_dia_5_'.$elemento02[id].'" type="radio" id="contratista_dia_5_'.$elemento02[id].'" > medio día
                                                                </td>
                                                                <td>
                                                                    <input value="1" name="contratista_dia_6_'.$elemento02[id].'" type="radio" id="contratista_dia_6_'.$elemento02[id].'" > día
                                                                    <input value="0.5" name="contratista_dia_6_'.$elemento02[id].'" type="radio" id="empleado_dia_6_'.$elemento02[id].'" > medio día
                                                                </td>                                                              


                                                                ';
                                                                if($objeto[monto] != ""){
                                                                    echo'
                                                                    <td>
                                                                        <input style="width:100px" readonly value="'.$objeto[monto].'" name="contratista_monto_'.$count2.'" type="number" id="contratista_monto_'.$count2.'" >                                                                    
                                                                    </td>';
                                                                }
                                                                else{
                                                                    echo'
                                                                    <td>
                                                                        <input style="width:100px" name="contratista_monto_'.$count2.'" type="number" id="contratista_monto_'.$count2.'" >                                                                    
                                                                    </td>';
                                                                }

                                                                if($objeto[restante] != "")
                                                                {
                                                                    echo'                                                                                                                                                      
                                                                    <td>
                                                                        <input style="width:100px" readonly value="'.$objeto[restante].'" name="contratista_restante_'.$count2.'" type="number" id="contratista_restante_'.$count2.'" >                                                                    
                                                                    </td>';
                                                                }
                                                                else{
                                                                    echo'                                                                                                                                                      
                                                                    <td>
                                                                        <input style="width:100px"  name="contratista_restante_'.$count2.'" type="number" id="contratista_restante_'.$count2.'" >                                                                    
                                                                    </td>';
                                                                }

                                                                echo'
                                                                <td>
                                                                    <input style="width:100px" name="contratista_pago_'.$count2.'" type="number" id="contratista_pago_'.$count2.'" >                                                                    
                                                                </td>
                                                                
                                                                <td>
                                                                    <input value="limpiar" onclick="limpiarCampos('.$elemento02[id].', '.$tipo.')" name="limpiar" type="button" id="limpiar" >                                                                    
                                                                </td>
                                                            </tr>
                                                        ';
                                                        $count2++;
                                                    }                                                
                                                echo '
                                            </tbody>
                                        </table>
                                        <input type="hidden" value="'.$count2.'" name="countContratista" id="countContratista"/>
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


            $result3 = mysqli_query($con,"SELECT distinct(e.id), e.nombre, ae.lunes, ae.martes, ae.miercoles, ae.jueves, ae.viernes, ae.sabado  FROM empleados e 
                                            INNER JOIN grupos_empleados ge on e.id = ge.fk_empleado
                                            INNER JOIN asistencias_empleados ae on ge.fk_empleado = ae.fk_empleado
                                            WHERE ae.fk_asistencia = $id;");   

            $result03 = mysqli_query($con,"SELECT distinct(c.id),  ae.id as fk_ac, c.empresa, ae.lunes, ae.martes, ae.miercoles, ae.jueves, ae.viernes, ae.sabado, ae.monto, ae.abono, ae.totalpagar  FROM contratistas c 
                                            INNER JOIN grupos_contratistas ge on c.id = ge.fk_contratista
                                            INNER JOIN asistencias_contratistas ae on ge.fk_contratista = ae.fk_contratista
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
                                        <h4>Empleado</h4>
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
                                                    <th>Opción</th>    
                                                </tr>
                                            </thead>                                            
                                            <tbody> 
                                                ';             
                                                $tipo = 1;

                                                    while($elemento3 = mysqli_fetch_array($result3)){                                                                                                                
                                                        echo '
                                                            <tr>
                                                                <td style="display: none;"><input name="empleado_'.$count.'" id="empleado_'.$count.'" type="text" value="'.$elemento3[id].'" />
                                                                <input name="empleado_salario_'.$count.'" id="empleado_salario_'.$count.'" type="text" value="'.$elemento3[salario].'" /></td>           
                                                                <td>'.$elemento3[nombre].'</td>            
                                                                <td>
                                                                    <input value="1" '; if($elemento3[lunes] == 1){ echo 'checked'; } echo ' name="empleado_dia_1_'.$elemento3[id].'"  type="radio" id="empleado_dia_1_'.$elemento3[id].'" > día
                                                                    <input value="0.5" '; if($elemento3[lunes] == 0.5){ echo 'checked'; } echo ' name="empleado_dia_1_'.$elemento3[id].'"  type="radio" id="empleado_dia_1_'.$elemento3[id].'" > medio día
                                                                </td>
                                                                <td>
                                                                    <input value="1" '; if($elemento3[martes] == 1){ echo 'checked'; } echo ' name="empleado_dia_2_'.$elemento3[id].'"  type="radio" id="empleado_dia_2_'.$elemento3[id].'" > día
                                                                    <input value="0.5" '; if($elemento3[martes] == 0.5){ echo 'checked'; } echo ' name="empleado_dia_2_'.$elemento3[id].'"  type="radio" id="empleado_dia_2_'.$elemento3[id].'" > medio día
                                                                </td>
                                                                <td>
                                                                    <input value="1" '; if($elemento3[miercoles] == 1){ echo 'checked'; } echo ' name="empleado_dia_3_'.$elemento3[id].'" type="radio" id="empleado_dia_3_'.$elemento3[id].'" > día
                                                                    <input value="0.5" '; if($elemento3[miercoles] == 0.5){ echo 'checked'; } echo ' name="empleado_dia_3_'.$elemento3[id].'" type="radio" id="empleado_dia_3_'.$elemento3[id].'" > medio día
                                                                </td>
                                                                <td>
                                                                    <input value="1" '; if($elemento3[jueves] == 1){ echo 'checked'; } echo ' name="empleado_dia_4_'.$elemento3[id].'" type="radio" id="empleado_dia_4_'.$elemento3[id].'" > día
                                                                    <input value="0.5" '; if($elemento3[jueves] == 0.5){ echo 'checked'; } echo ' name="empleado_dia_4_'.$elemento3[id].'" type="radio" id="empleado_dia_4_'.$elemento3[id].'" > medio día
                                                                </td>
                                                                <td>
                                                                    <input value="1" '; if($elemento3[viernes] == 1){ echo 'checked'; } echo ' name="empleado_dia_5_'.$elemento3[id].'" type="radio" id="empleado_dia_5_'.$elemento3[id].'" > día
                                                                    <input value="0.5" '; if($elemento3[viernes] == 0.5){ echo 'checked'; } echo ' name="empleado_dia_5_'.$elemento3[id].'" type="radio" id="empleado_dia_5_'.$elemento3[id].'" > medio día
                                                                </td>
                                                                <td>
                                                                    <input value="1" '; if($elemento3[sabado] == 1){ echo 'checked'; } echo ' name="empleado_dia_6_'.$elemento3[id].'" type="radio" id="empleado_dia_6_'.$elemento3[id].'" > día
                                                                    <input value="0.5" '; if($elemento3[sabado] == 0.5){ echo 'checked'; } echo ' name="empleado_dia_6_'.$elemento3[id].'" type="radio" id="empleado_dia_6_'.$elemento3[id].'" > medio día
                                                                </td>                                                                
                                                                <td>
                                                                    <input value="limpiar" onclick="limpiarCampos2('.$elemento3[id].', '.$tipo.')" name="limpiar" type="button" id="limpiar" >                                                                    
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
                        
                        <div class="from-group row">                                             
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_content">
                                        <h4>Contratista</h4>
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>                                                                                                   
                                                    <th>Empresa contratista</th>
                                                    <th>Lunes</th>
                                                    <th>Martes</th>
                                                    <th>Miercoles</th>
                                                    <th>Jueves</th>              
                                                    <th>Viernes</th>    
                                                    <th>Sábado</th>  
                                                    <th>Total a pagar</th>  
                                                    <th>Restante</th>
                                                    <th>Pago</th>                                                        
                                                    <th>Opción</th>      
                                                </tr>
                                            </thead>                                            
                                            <tbody> 
                                                ';                                      
                                                $count2 = 0;     
                                                $tipo = 2;     
                                                    while($elemento03 = mysqli_fetch_array($result03)){                                                                                                                
                                                        
                                                        echo '
                                                            <tr>
                                                                <td style="display: none;">
                                                                    <input name="id_asistencia_'.$count2.'" id="id_asistencia_'.$count2.'" type="text" value="'.$id.'" />
                                                                    <input name="fk_asistencia_'.$count2.'" id="fk_asistencia_'.$count2.'" type="text" value="'.$elemento03[fk_ac].'" />
                                                                    <input name="contratista_'.$count2.'" id="contratista_'.$count2.'" type="text" value="'.$elemento03[id].'" />
                                                                    <input name="contratista_salario_'.$count2.'" id="contratista_salario_'.$count2.'" type="text" value="'.$elemento03[salario].'" />
                                                                </td>           
                                                                <td>'.$elemento03[empresa].'</td>            
                                                                <td>
                                                                    <input value="1" '; if($elemento03[lunes] == 1){ echo 'checked'; } echo ' name="contratista_dia_1_'.$elemento03[id].'"  type="radio" id="contratista_dia_1_'.$elemento03[id].'" > día
                                                                    <input value="0.5" '; if($elemento03[lunes] == 0.5){ echo 'checked'; } echo ' name="contratista_dia_1_'.$elemento03[id].'"  type="radio" id="contratista_dia_1_'.$elemento03[id].'" > medio día
                                                                </td>
                                                                <td>
                                                                    <input value="1" '; if($elemento03[martes] == 1){ echo 'checked'; } echo ' name="contratista_dia_2_'.$elemento03[id].'"  type="radio" id="contratista_dia_2_'.$elemento03[id].'" > día
                                                                    <input value="0.5" '; if($elemento03[martes] == 0.5){ echo 'checked'; } echo ' name="contratista_dia_2_'.$elemento03[id].'"  type="radio" id="contratista_dia_2_'.$elemento03[id].'" > medio día
                                                                </td>
                                                                <td>
                                                                    <input value="1" '; if($elemento03[miercoles] == 1){ echo 'checked'; } echo ' name="contratista_dia_3_'.$elemento03[id].'" type="radio" id="contratista_dia_3_'.$elemento03[id].'" > día
                                                                    <input value="0.5" '; if($elemento03[miercoles] == 0.5){ echo 'checked'; } echo ' name="contratista_dia_3_'.$elemento03[id].'" type="radio" id="contratista_dia_3_'.$elemento03[id].'" > medio día
                                                                </td>
                                                                <td>
                                                                    <input value="1" '; if($elemento03[jueves] == 1){ echo 'checked'; } echo ' name="contratista_dia_4_'.$elemento03[id].'" type="radio" id="contratista_dia_4_'.$elemento03[id].'" > día
                                                                    <input value="0.5" '; if($elemento03[jueves] == 0.5){ echo 'checked'; } echo ' name="contratista_dia_4_'.$elemento03[id].'" type="radio" id="contratista_dia_4_'.$elemento03[id].'" > medio día
                                                                </td>
                                                                <td>
                                                                    <input value="1" '; if($elemento03[viernes] == 1){ echo 'checked'; } echo ' name="contratista_dia_5_'.$elemento03[id].'" type="radio" id="contratista_dia_5_'.$elemento03[id].'" > día
                                                                    <input value="0.5" '; if($elemento03[viernes] == 0.5){ echo 'checked'; } echo ' name="contratista_dia_5_'.$elemento03[id].'" type="radio" id="contratista_dia_5_'.$elemento03[id].'" > medio día
                                                                </td>
                                                                <td>
                                                                    <input value="1" '; if($elemento03[sabado] == 1){ echo 'checked'; } echo ' name="contratista_dia_6_'.$elemento03[id].'" type="radio" id="contratista_dia_6_'.$elemento03[id].'" > día
                                                                    <input value="0.5" '; if($elemento03[sabado] == 0.5){ echo 'checked'; } echo ' name="contratista_dia_6_'.$elemento03[id].'" type="radio" id="contratista_dia_6_'.$elemento03[id].'" > medio día
                                                                </td>
                                                                ';
                                                                if($elemento03[monto] != ""){
                                                                    echo'
                                                                    <td>
                                                                        <input style="width:100px" readonly value="'.$elemento03[monto].'" name="contratista_monto_'.$count2.'" type="number" id="contratista_monto_'.$count2.'" >                                                                    
                                                                        <input value="'.$elemento03[monto].'" name="contratista_monto_original_'.$count2.'" type="hidden" id="contratista_monto_original_'.$count2.'" >                                                                    
                                                                    </td>';
                                                                }
                                                                else{
                                                                    echo'
                                                                    <td>
                                                                        <input style="width:100px" name="contratista_monto_'.$count2.'" type="number" id="contratista_monto_'.$count2.'" >                                                                    
                                                                    </td>';
                                                                }

                                                                if($elemento03[totalpagar] != "")
                                                                {
                                                                    echo'                                                                                                                                                      
                                                                    <td>
                                                                        <input style="width:100px" readonly value="'.$elemento03[totalpagar].'" name="contratista_restante_'.$count2.'" type="number" id="contratista_restante_'.$count2.'" >                                                                                                                                            
                                                                        
                                                                    </td>';
                                                                }
                                                                else{
                                                                    echo'                                                                                                                                                      
                                                                    <td>
                                                                        <input style="width:100px"  name="contratista_restante_'.$count2.'" type="number" id="contratista_restante_'.$count2.'" >                                                                    
                                                                    </td>';
                                                                }

                                                                echo'
                                                                <td>
                                                                    <input style="width:100px" readonly value="'.$elemento03[abono].'" name="contratista_pago_'.$count2.'" type="number" id="contratista_pago_'.$count2.'" >                                                                    
                                                                    <input value="'.$elemento03[abono].'" name="contratista_pago_original_'.$count2.'" type="hidden" id="contratista_pago_original_'.$count2.'" >                                                                    
                                                                </td>
                                                                <td>
                                                                    <input value="editar" onclick="editarCampos2('.$count2.', '.$tipo.')" name="editar" type="button" id="editar" >                                                                    
                                                                    <input value="limpiar" onclick="limpiarCampos2('.$elemento03[id].', '.$tipo.')" name="limpiar" type="button" id="limpiar" >                                                                    
                                                                </td>
                                                            </tr>
                                                        ';
                                                        $count2++;
                                                    }                                                
                                                echo '
                                            </tbody>
                                        </table>
                                        <input type="hidden" value="'.$count2.'" name="countContratistas" id="countContratistas"/>
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
