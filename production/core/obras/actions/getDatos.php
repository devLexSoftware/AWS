<?php
    include("../../../config/conexion.php");
    // error_reporting(E_ALL);
    // ini_set('display_errors', '1');
    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    $con -> set_charset("utf8");
    if (mysqli_connect_errno()) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    else {
    $con -> set_charset("utf8");

        $id = $_POST["id"];
        $tabla = $_POST["tabla"];
        if($tabla == "obras"){
            $result = mysqli_query($con,"SELECT * FROM $tabla WHERE fk_clientes = $id and estado = 0;");   
            while($elemento = mysqli_fetch_array($result)){
                echo '<option value="'.$elemento["id"].'">'.$elemento["nombre"].'</option>';
            }
        }
        else if($tabla == "detallesObras")
        {
            $myArray  = null;
            $result = mysqli_query($con,"SELECT o.id, o.avance, o.semana, o.periodoInicial, o.periodoFinal, o.comentario from detalles_obras o 
            where o.fk_obra = $id;");               

            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
            }
            echo json_encode($myArray);
        }
        else if($tabla == "totalSemanas") 
        {
         
            $result = mysqli_query($con,"SELECT ae.lunes, ae.martes, ae.miercoles, ae.jueves, ae.viernes, ae.sabado, e.salario, a.semana, a.periodoInicial, a.periodoFinal from asistencias_empleados ae
                                        inner join asistencias a on ae.fk_asistencia = a.id
                                        inner join empleados e on ae.fk_empleado = e.id
                                        where a.fk_obra = $id and a.estado = 0 order by a.semana;");               

            $result2 = mysqli_query($con,"SELECT c.semana, c.importe, c.fechInicial, c.fechFinal from compras c
                                        where c.fk_obra = $id and c.estado = 0 order by c.semana;");      


            $result3 = mysqli_query($con,"SELECT porcentajeGanancia, costoTotal from obras
                                        where id = $id;"); 

            $result4 = mysqli_query($con,"SELECT semana, pago, comentario from pagos_obras
                                        where fk_obra = $id;"); 


            while($row = $result->fetch_array(MYSQLI_ASSOC)) 
                $elemento[] = $row;                            
            while($row = $result2->fetch_array(MYSQLI_ASSOC)) 
                $elemento2[] = $row;                       
                
            $elemento3 = mysqli_fetch_array($result3);

            while($row = $result4->fetch_array(MYSQLI_ASSOC)) 
                $elemento4[] = $row; 
                
            
            $maxE1 = max(array_column($elemento, "semana"));
            $maxE2 = max(array_column($elemento2, "semana"));

            $max = $maxE1 > $maxE2 ? $maxE1 : $maxE2;

            $semanas = 1;


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
                                                <th>Semana</th>
                                                <th>Periodo</th>
                                                <th>Mano de obra</th>
                                                <th>M.O. Honorario</th>
                                                <th>Total Mano de Obra</th>              
                                                <th>Material</th>    
                                                <th>Mat. Hono.</th>    
                                                <th>Total Honorarios</th>                                                    
                                                <th>Total Semana</th>    
                                                <th>Total Honorarios</th>    
                                                <th>Total con Honorarios</th>    
                                                <th>Pago</th>    
                                                <th>Comentarios</th>    
                                            </tr>
                                        </thead>                                            
                                        <tbody> 
                                            ';                                                
                                            for ($i=1; $i <= $max; $i++) { 

                                                $manoObra = 0;                                                                                               
                                                $semanaDato = "";
                                                foreach ($elemento as $key) {
                                                    if($key["semana"] == $i)
                                                    {
                                                        $count = $key["lunes"] + $key["martes"] + $key["miercoles"] + $key["jueves"] + $key["viernes"] + $key["sabado"];
                                                        if($count > 0)
                                                        {
                                                            $importeLibre = ($key["salario"]/6) * $count;
                                                            $seguro = $key["salario"] * 0.31;                        
                                                            $importeSeguro = $importeLibre + $seguro;                                                                                                                
                                                            $manoObra = $manoObra + $importeSeguro;
                                                        }
                                                        
                    
                                                        $semanaDato = $key["periodoInicial"]." al ".$key["periodoFinal"];                                                        
                                                    }
                                                }

                                                $material = 0;
                                                foreach ($elemento2 as $key) {
                                                    if($key["semana"] == $i)
                                                    {                                                        
                                                        $material = $material + $key["importe"];                                                        
                                                        if($semanaDato == "")          
                                                        {
                                                            $semanaDato = $key["fechInicial"]." al ".$key["fechFinal"];                                                        

                                                        }                                                                                                                                                                                                                                      
                                                    }
                                                }

                                                $honorariosMo = $manoObra * ($elemento3["porcentajeGanancia"] / 100);
                                                $totalMano = $honorariosMo + $manoObra;
                                                $honorariosMa = $material * ($elemento3["porcentajeGanancia"] / 100);
                                                $totalMate = $honorariosMa + $material;


                                                $comenVal = "";
                                                $pagoVal = "";
                                                foreach ($elemento4 as $key) {
                                                    if($key['semana'] == $i){
                                                        $comenVal = $key['comentario'];
                                                        $pagoVal = $key['pago'];
                                                    }
                                                }
                                                
                                                echo '
                                                    <tr>
                                                        <td>'.($i).'</td>                                                                     
                                                        <td>'.$semanaDato.'</td>                                                                     
                                                        <td>$'.round($manoObra,2).'</td>                                                                     
                                                        <td>$'.round($honorariosMo,2).'</td>                                                                     
                                                        <td>$'.round($totalMano,2).'</td>                                                                     
                                                        <td>$'.round($material,2).'</td>                                                                     
                                                        <td>$'.round($honorariosMa,2).'</td>                                                                     
                                                        <td>$'.round($totalMate,2).'</td>                                                                                                                                                                                                 
                                                        <td>$'.round(($material + $manoObra),2).'</td>                                                                     
                                                        <td>$'.round(($honorariosMo + $honorariosMa),2).'</td>
                                                        <td>$'.round(($totalMano + $totalMate),2).'</td> 
                                                        <td><input id="pago'.$semanas.'" value="'.$pagoVal.'" name="pago'.$semanas.'" type="number"></td>
                                                        <td><input id="come'.$semanas.'" value="'.$comenVal.'" name="come'.$semanas.'" type="text"></td>                                                                                                                      
                                                    </tr>
                                                ';                                                 
                                                $semanas++;
                                            }
                                            echo '
                                        </tbody>
                                    </table>
                                    <input type="hidden" value="'.($semanas-1).'" name="semregi" id="semregi">
                                </div>
                            </div>
                        </div>                                        
                    </div>                                                                                                    
                </div>
            </div>  
        ';



                                        


        }
        else{
            $result = mysqli_query($con,"SELECT * FROM $tabla WHERE id = $id and WHERE estado = 0;");   
            $elemento = mysqli_fetch_array($result);
            echo json_encode($elemento);
        }                
    }
