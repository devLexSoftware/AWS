<?php
include("production/config/conexion.php");
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else {        

    $con -> set_charset("utf8");

    if($idObra == null){
        $result = mysqli_query($con,"SELECT a.periodoInicial, a.periodoFinal, a.semana, a.fk_obra from asistencias a
                                where id = $id;");
    $elemento = mysqli_fetch_array($result);




    $q2 = "SELECT e.nombre, e.salario, e.categoria, e.rol, e.giro, ae.lunes, ae.martes, ae.miercoles, ae.jueves, ae.viernes, ae.sabado, ae.monto, e.nssi from asistencias_empleados ae
    inner join empleados e on ae.fk_empleado = e.id";

    if($cateem != "todos")
        $q2 = $q2. " where ae.fk_asistencia = $id and e.categoria = '$cateem' ";
    else    
        $q2 = $q2. " where ae.fk_asistencia = $id ";    
                
    $result2 = mysqli_query($con,$q2);      

    while($row2 = $result2->fetch_array(MYSQLI_ASSOC)) 
         $el2[] = $row2; 

    
         

    $result3 = mysqli_query($con,"SELECT c.nombre as cliente, o.nombre as obra from obras o
                            inner join clientes c on o.fk_clientes = c.id    
                            where o.id = $elemento[fk_obra];");                              
    $elemento3 = mysqli_fetch_array($result3);




    $q4 = "SELECT c.empresa as nombre, c.categoria, ac.lunes, ac.martes, ac.miercoles, ac.jueves, ac.viernes, ac.sabado, ac.monto, ac.abono, ac.totalpagar
    from asistencias_contratistas ac
    inner join contratistas c on ac.fk_contratista = c.id";

    if($cateco != "todos")
        $q4 = $q4. " where ac.fk_asistencia = $id and c.categoria = '$cateco' ";
    else    
        $q4 = $q4. " where ac.fk_asistencia = $id ";    
    $result4 = mysqli_query($con,$q4);                                  
                               
    while($row4 = $result4->fetch_array(MYSQLI_ASSOC)) 
        $el4[] = $row4;          

    $el5 = $el2;    
    }
    else{


        $q2 = "SELECT a.semana, a.periodoInicial, a.periodoFinal, e.nombre, e.salario, e.categoria, e.rol, e.giro, ae.lunes, ae.martes, ae.miercoles, ae.jueves, ae.viernes, ae.sabado, ae.monto, e.nssi from asistencias_empleados ae
                inner join empleados e on ae.fk_empleado = e.id
                inner join asistencias a on a.id = ae.fk_asistencia
                where a.fk_obra = $idObra";
                    
        $result2 = mysqli_query($con,$q2);      
    
        while($row2 = $result2->fetch_array(MYSQLI_ASSOC)) 
             $el2[] = $row2;    


        $result3 = mysqli_query($con,"SELECT c.nombre as cliente, o.nombre as obra from obras o
                inner join clientes c on o.fk_clientes = c.id    
                where o.id = $idObra;");                              
        $elemento3 = mysqli_fetch_array($result3);


        $q4 = "SELECT a.semana, a.periodoInicial, a.periodoFinal, c.empresa as nombre, c.categoria, ac.lunes, ac.martes, ac.miercoles, ac.jueves, ac.viernes, ac.sabado, ac.monto, ac.abono, ac.totalpagar from asistencias_contratistas ac
                inner join contratistas c on ac.fk_contratista = c.id
                inner join asistencias a on a.id = ac.fk_asistencia
                where a.fk_obra = $idObra;";

        
        $result4 = mysqli_query($con,$q4);                                  
                                
        while($row4 = $result4->fetch_array(MYSQLI_ASSOC)) 
            $el4[] = $row4;     
            
        $el5 = $el2;    
    }

    


    
    

    function fuNomina($el2, $el4) {
        foreach ($el2 as $elemento02) {
            $count = $elemento02["lunes"] + $elemento02["martes"] + $elemento02["miercoles"] + $elemento02["jueves"] + $elemento02["viernes"] + $elemento02["sabado"];            
            if($count > 0)
            {
                $seguro = $elemento02[salario] * 0.31;                        
                $importeLibre = ($elemento02[salario]/6) * $count;
                $importeSeguro = $importeLibre + $seguro;
    
                $GLOBALS['totNomi'] = $GLOBALS['totNomi'] + $importeSeguro;    
            }
            
        }   
        
        foreach ($el4 as $elemen4){
            $count = $elemen4["lunes"] + $elemen4["martes"] + $elemen4["miercoles"] + $elemen4["jueves"] + $elemen4["viernes"] + $elemen4["sabado"];            
            if($count > 0 && $key[pago] > 0)
            {
                $GLOBALS['totAbono'] = $GLOBALS['totAbono'] + $elemen4[abono];    
                $GLOBALS['totNomi'] = $GLOBALS['totNomi'] + $elemen4[abono];        
            }
            
        }

    }

    fuNomina($el2, $el4);

}

?>

<page style="font-size: 14px">
    
    <table width=1440 height=150>
        <tr align="center" >
            <th style="width:550px; height:150px" ></th>
            <th >
            <img style="width:300px;" src="production/components/images/logo3.png"> 
            </th>            
        </tr>        
    </table>
    <table border=0.5   bordercolor="#73879ca3" width=1440 >
        <tr>            
            <td style=" text-align: center; padding: 5px 2px; background-color: #BFCCD7;width:200px;" >Cliente</td>
            <td style="width:520px;" ><?php echo $elemento3[cliente] ?></td>
            <td style=" text-align: center; padding: 5px 2px; background-color: #BFCCD7; width:200px;">Obra</td>
            <td style="width:520px;"><?php echo $elemento3[obra] ?></td>
        </tr>
        
        <tr>            
            <td style="text-align: center; padding: 5px 2px; background-color: #BFCCD7; width:100px;" >Frente</td>
            <td style="width:100px;"></td>
            <td style="text-align: center; padding: 5px 2px; background-color: #BFCCD7; width:100px;">Fecha impresión</td>
            <td style="width:100px;"><?php echo date("d/m/Y"); ?></td>
        </tr>

      
        
        <tr >            
            <td colspan="2" style="text-align: center; padding: 5px 2px; background-color: #BFCCD7;">Lista Nominal</td>
            
            <td style="width: 100px; background-color: #BFCCD7;">Total Nomina Obra</td>
            <td style="width: 100px;">$<?php echo round($totNomi,2); ?></td>
        </tr>        
        
    </table>
    <table bordercolor="#007"  style="font-size: 11px; width:100%; " >           
            <tr style="background-color: #1E8EC6; color:#333333; text-align: center;">
                <th style=" padding: 3px 2px; width: 25px; ">Sem </th>
                <th style="width: 150px;">Periodo </th>
                <th style="width: 170px;">Nombre</th>
                <th style="width: 90px;">Puesto</th>
                <th style="width: 90px;">Categoría</th>
                <th style="width: 90px;">N.S.S</th>            
                <th style="width: 20px; text-align: center; ">Lu</th>
                <th style="width: 20px; text-align: center; ">Ma</th>
                <th style="width: 20px; text-align: center; ">Mi</th>
                <th style="width: 20px; text-align: center; ">Ju</th>
                <th style="width: 20px; text-align: center; ">Vi</th>
                <th style="width: 20px; text-align: center; ">Sa</th>
                <th style="width: 40px;">D. Lab</th>
                <th style="width: 80px;">Seguro</th>
                <th style="width: 70px;">Pago</th>
                <th style="width: 75px;">Imp. Libre</th>
                <th style="width: 75px;">Imp. Segu</th>                
                <th style="width: 75px;">T. Sem Li</th>                
                <th style="width: 75px;">T. Sem Se</th>                
                <th style="width: 75px;">T. Cat</th>                
                <th style="width: 90px;">Coment</th>
            </tr>
            <tr style="color:black;">
                <?php
                $bandera = true;
                $totalSemanaLibre = 0;
                $totalSemanaSeguro = 0;
                $totalCategoria = 0; 

                foreach ($el5 as $elemento2) {                
                        $count = 0;
                        $seguro = $elemento2[salario] * 0.31;  
                        
                        
                        $totSemLi = "";
                        $totSemSe = "";
                        $totCate = "";                        
                        foreach ($el5 as $key) {
                            $asistenciaTemp = $key["lunes"] + $key["martes"] + $key["miercoles"] + $key["jueves"] + $key["viernes"] + $key["sabado"];            
                            if($key[semana] == $elemento2[semana])
                            {
                                if($asistenciaTemp > 0){
                                    $seguroTemp = $key[salario] * 0.31;  

                                    $importeLibreTemp = ($key[salario]/6) * $asistenciaTemp;
                                    $importeSeguroTemp = $importeLibreTemp + $seguroTemp;
                                    $totSemLi = $totSemLi + $importeLibreTemp;
                                    $totSemSe = $totSemSe + $importeSeguroTemp;
                                }
                            }
                            if($key[giro] == $elemento2[giro]){
                                if($asistenciaTemp > 0){

                                $seguroTemp = $key[salario] * 0.31;  
                                $importeLibreTemp = ($key[salario]/6) * $asistenciaTemp;
                                $importeSeguroTemp = $importeLibreTemp + $seguroTemp;
                                $totCate = $totCate + $importeSeguroTemp;
                                }
                            }
                        }

                        
                        $asistencia = $elemento2["lunes"] + $elemento2["martes"] + $elemento2["miercoles"] + $elemento2["jueves"] + $elemento2["viernes"] + $elemento2["sabado"];            
                        if($asistencia > 0)
                        {
                            $temSemIni = "";
                            $temSemFin = "";
                            $temSemana = "";
                            if($idObra == null)
                            {
                                $temSemIni = $elemento[periodoInicial];
                                $temSemFin = $elemento[periodoFinal] ;
                                $temSemana = $elemento[semana];
                            }
                            else
                            {
                                $temSemIni = $elemento2[periodoInicial];
                                $temSemFin = $elemento2[periodoFinal] ;
                                $temSemana = $elemento2[semana];
                            }
                            echo '
                            <tr'; if($bandera == false){ echo ' style="background-color: #CFE1F5;"'; } echo '>
                                <td style=" padding: 4px 2px; border-bottom: 1px solid #B4B5B0; ">'.$temSemana.'</td>
                                <td style="border-bottom: 1px solid #B4B5B0; ">'.$temSemIni.' al '.$temSemFin.'</td>            
                                <td style="border-bottom: 1px solid #B4B5B0; ">'.$elemento2[nombre].'</td>            
                                <td style="border-bottom: 1px solid #B4B5B0; ">'.$elemento2[categoria].'</td> 
                                <td style="border-bottom: 1px solid #B4B5B0; ">'.$elemento2[giro].'</td>            
                                <td style="border-bottom: 1px solid #B4B5B0; ">'.$elemento2[nssi].'</td>            
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">';if($elemento2[lunes] == 1){$count++; echo 'x'; } else if($elemento2[lunes] == 0.5){$count = $count + 0.5; echo '1/2'; }  echo'</td>
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">';if($elemento2[martes] == 1){ $count++; echo 'x'; } else if($elemento2[martes] == 0.5){$count = $count + 0.5; echo '1/2'; } echo'</td>
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">';if($elemento2[miercoles] == 1){ $count++; echo 'x'; } else if($elemento2[miercoles] == 0.5){$count = $count + 0.5; echo '1/2'; } echo'</td>
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">';if($elemento2[jueves] == 1){ $count++; echo 'x'; } else if($elemento2[jueves] == 0.5){$count = $count + 0.5; echo '1/2'; } echo'</td>
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">';if($elemento2[viernes] == 1){ $count++; echo 'x'; } else if($elemento2[viernes] == 0.5){$count = $count + 0.5; echo '1/2'; } echo'</td>
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">';if($elemento2[sabado] == 1){ $count++; echo 'x'; } else if($elemento2[sabado] == 0.5){$count = $count + 0.5; echo '1/2'; } echo'</td>
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">'.$count.'</td>       
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">$'.$seguro.'</td>       
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">$'.$elemento2[salario].'</td>                                       
                                ';
                                $importeLibre = ($elemento2[salario]/6) * $count;
                                $importeSeguro = $importeLibre + $seguro;


                                echo '
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">$'.round($importeLibre,2).'</td>       
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">$'.round($importeSeguro,2).'</td>                                       
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">$'.round($totSemLi,2).'</td>                                       
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">$'.round($totSemSe,2).'</td>                                       
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">$'.round($totCate,2).'</td>                                       
                                <td style="border-bottom: 1px solid #B4B5B0;">'.$elemento2[comentario].'</td>       
                            </tr>
                        ';                        
                        if($bandera == false)
                            $bandera = true;
                        else
                            $bandera = false;

                        $totalSemanaLibre = $totalSemanaLibre + $importeLibre;
                        $totalSemanaSeguro = $totalSemanaSeguro + $importeSeguro;

                        }
                        
                    }      
                    ?>
            </tr>        
        </table>


        <br>
        <hr>

        <table bordercolor="#007"  style="font-size: 11px; width:100%; " >           
            <tr style="background-color: #1E8EC6; color:#333333; text-align: center;">
                <th style=" padding: 3px 2px; width: 25px; ">Sem </th>
                <th style="width: 150px;">Periodo </th>
                <th style="width: 505px;">Empresa Contratista</th>                
                <th style="width: 150px;">Categoría</th>                
                <th style="width: 20px; text-align: center; ">Lu</th>
                <th style="width: 20px; text-align: center; ">Ma</th>
                <th style="width: 20px; text-align: center; ">Mi</th>
                <th style="width: 20px; text-align: center; ">Ju</th>
                <th style="width: 20px; text-align: center; ">Vi</th>
                <th style="width: 20px; text-align: center; ">Sa</th>
                <th style="width: 55px;">D. Labo</th>                
                <th style="width: 150px;">Total a pagar</th>
                <th style="width: 150px;">Pago</th>
                <th style="width: 90px;">Restante</th>                                
            </tr>
            <tr style="color:black;">
                <?php
                $bandera = true;                

                foreach ($el4 as $elemento2) {                
                        $count = 0;
                        $seguro = $elemento2[salario] * 0.31;                        
                        $asistencia = $elemento2["lunes"] + $elemento2["martes"] + $elemento2["miercoles"] + $elemento2["jueves"] + $elemento2["viernes"] + $elemento2["sabado"];            
                        if($asistencia > 0)
                        {
                            $temSemIni = "";
                            $temSemFin = "";
                            $temSemana = "";
                            if($idObra == null)
                            {
                                $temSemIni = $elemento[periodoInicial];
                                $temSemFin = $elemento[periodoFinal] ;
                                $temSemana = $elemento[semana];
                            }
                            else
                            {
                                $temSemIni = $elemento2[periodoInicial];
                                $temSemFin = $elemento2[periodoFinal] ;
                                $temSemana = $elemento2[semana];
                            }
                            echo '
                            <tr'; if($bandera == false){ echo ' style="background-color: #CFE1F5;"'; } echo '>
                                <td style=" padding: 4px 2px; border-bottom: 1px solid #B4B5B0; ">'.$temSemana.'</td>
                                <td style="border-bottom: 1px solid #B4B5B0; ">'.$temSemIni.' al '.$temSemFin.'</td>            
                                <td style="border-bottom: 1px solid #B4B5B0; ">'.$elemento2[nombre].'</td>                                            
                                <td style="border-bottom: 1px solid #B4B5B0; ">'.$elemento2[categoria].'</td>                                            
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">';if($elemento2[lunes] == 1){$count++; echo 'x'; } else if($elemento2[lunes] == 0.5){$count = $count + 0.5; echo '1/2'; }  echo'</td>
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">';if($elemento2[martes] == 1){ $count++; echo 'x'; } else if($elemento2[martes] == 0.5){$count = $count + 0.5; echo '1/2'; } echo'</td>
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">';if($elemento2[miercoles] == 1){ $count++; echo 'x'; } else if($elemento2[miercoles] == 0.5){$count = $count + 0.5; echo '1/2'; } echo'</td>
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">';if($elemento2[jueves] == 1){ $count++; echo 'x'; } else if($elemento2[jueves] == 0.5){$count = $count + 0.5; echo '1/2'; } echo'</td>
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">';if($elemento2[viernes] == 1){ $count++; echo 'x'; } else if($elemento2[viernes] == 0.5){$count = $count + 0.5; echo '1/2'; } echo'</td>
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">';if($elemento2[sabado] == 1){ $count++; echo 'x'; } else if($elemento2[sabado] == 0.5){$count = $count + 0.5; echo '1/2'; } echo'</td>
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">'.$count.'</td>                                       
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">$'.$elemento2[monto].'</td>                                                                       
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">$'.$elemento2[abono].'</td>
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">$'.$elemento2[totalpagar].'</td>                                                                 
                            </tr>
                        ';       
                        }
                                             
                        if($bandera == false)
                            $bandera = true;
                        else
                            $bandera = false;
                        
                    }      
                    ?>
            </tr>        
        </table>

    <br><br>


    
    <br>


</page>