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



    $id = $_GET["id"];
    $count = $_GET["count"];    




    function foo($el1, $el2, $el3, $max, $el4, $el5) {

        for ($i=1; $i <= $max; $i++) { 

            $manoObra = 0;                                                                                               
            foreach ($el1 as $key) {
                if($key["semana"] == $i)
                {
                    $count = $key["lunes"] + $key["martes"] + $key["miercoles"] + $key["jueves"] + $key["viernes"] + $key["sabado"];
                    if($count > 0){
                        $importeLibre = ($key["salario"]/6) * $count;
                        $seguro = $key["salario"] * 0.31;                        
                        $importeSeguro = $importeLibre + $seguro;                                                                                                                
                        $manoObra = $manoObra + $importeSeguro;                    
                    }
                    
                }
            }

            $material = 0;
            foreach ($el2 as $key) {
                if($key["semana"] == $i)
                {                                                        
                    $material = $material + $key["importe"];                    
                }
            }

            $pagoVal = 0;            
            foreach ($el5 as $key) {
                if($key["semana"] == $i)
                {                                                        
                    $pagoVal = $key["pago"];                    
                }
            }

            //---Contratistas
            foreach ($el4 as $key) {
                if($key["semana"] == $i)
                {
                    $count = $key["lunes"] + $key["martes"] + $key["miercoles"] + $key["jueves"] + $key["viernes"] + $key["sabado"];
                    if($count > 0 && $key[pago] > 0)
                    {
                       $abono = $abono + $key['abono'];  
                    }

                    
                }
            }

            $manoObra = $manoObra + $abono;
          

            $honorariosMo = $manoObra * ($el3["porcentajeGanancia"] / 100);
            $totalMano = $honorariosMo + $manoObra;

            $honorariosMa = $material * ($el3["porcentajeGanancia"] / 100);
            $totalMate = $honorariosMa + $material;
            
            $totManoObra = $totManoObra + $totalMano;


            $GLOBALS['totDir'] = $GLOBALS['totDir'] + ($material + $manoObra);

            $GLOBALS['totMaOb'] = $GLOBALS['totMaOb'] + $totalMano;
            $GLOBALS['totMate'] = $GLOBALS['totMate'] + $totalMate;
            $GLOBALS['totCobr'] = $GLOBALS['totCobr'] + $pagoVal;

            $GLOBALS['totconHono'] = $GLOBALS['totconHono'] + ($totalMano + $totalMate);


            $GLOBALS['deudaActual'] = $el3['costoTotal'] - $GLOBALS['totCobr'];

            $GLOBALS['totHono'] = $GLOBALS['totHono'] + ($honorariosMo + $honorariosMa);


        }

        $GLOBALS['totHono'] = $GLOBALS['totHono'] / $el3[superficieConstruir];

        $GLOBALS['deudaActual'] = $GLOBALS['totconHono'] -  $GLOBALS['totCobr'];


        // foreach ($el5 as $key) {
        //     $GLOBALS['totCobr'] = $GLOBALS['totCobr'] + $key['pago'];
        // }

        // $GLOBALS['postresquefaltaran']         
    }


    $result = mysqli_query($con,"SELECT ae.lunes, ae.martes, ae.miercoles, ae.jueves, ae.viernes, ae.sabado, e.salario, a.semana, a.periodoInicial, a.periodoFinal from asistencias_empleados ae
                inner join asistencias a on ae.fk_asistencia = a.id
                inner join empleados e on ae.fk_empleado = e.id
                where a.fk_obra = $id and a.estado = 0 order by a.semana;");               

    $result2 = mysqli_query($con,"SELECT c.semana, c.importe, c.fechInicial, c.fechFinal from compras c
                where c.fk_obra = $id and c.estado = 0 order by c.semana;");      

    $result3 = mysqli_query($con,"SELECT o.porcentajeGanancia, o.costoTotal, c.nombre as cliente, o.nombre as obra, o.superficie, o.superficieConstruir  from obras o
                inner join clientes c on o.fk_clientes = c.id    
                where o.id = $id;");                              
    
    $result4 = mysqli_query($con, "SELECT a.semana, c.id, c.empresa, c.categoria, ac.lunes, ac.martes, ac.miercoles, ac.jueves, ac.viernes, ac.sabado, ac.monto, ac.totalpagar, ac.abono
                from asistencias_contratistas ac
                inner join contratistas c on ac.fk_contratista = c.id
                inner join asistencias a on ac.fk_asistencia = a.id
                where a.fk_obra = $id;");

    $result5 = mysqli_query($con,"SELECT semana, pago, comentario from pagos_obras
                where fk_obra = $id;"); 

  
    while($row = $result->fetch_array(MYSQLI_ASSOC)) 
        $elemento[] = $row;                            
    while($row = $result2->fetch_array(MYSQLI_ASSOC)) 
        $elemento2[] = $row;                 
    $elemento3 = mysqli_fetch_array($result3);
    while($row = $result4->fetch_array(MYSQLI_ASSOC)) 
        $elemento4[] = $row;
    while($row = $result5->fetch_array(MYSQLI_ASSOC)) 
        $elemento5[] = $row; 
        

    $maxE1 = max(array_column($elemento, "semana"));
    $maxE2 = max(array_column($elemento2, "semana"));    

    $max = $maxE1 > $maxE2 ? $maxE1 : $maxE2;    

    $semanas = 0;    

    foo($elemento, $elemento2, $elemento3, $max, $elemento4, $elemento5);
      
}



?>

<page style="font-size: 14px">
    
    <table bordercolor="#73879ca3" width=1440 height=150>    
        <tr align="center" >
            <th style="width:550px; height:150px" ></th>
            <th >
            <img style="width:300px;" src="production/components/images/logo3.png"> 
            </th>            
        </tr>    
        <!-- <tr align="center" >
            <th style="width:100%; height:120px;"><h1> WorkShop Studio Premier</h1>Architecture + 3D Visualization</th>            
        </tr>         -->
    </table>

    <table border=0.5   bordercolor="#73879ca3" width=1440 >
        <tr>
            <td style=" text-align: center; padding: 5px 2px; background-color: #BFCCD7;width:200px;" >Cliente</td>
            <td  style="width:1216px;"  ><b><?php echo $elemento3["cliente"] ?></b></td>
            
        </tr>
    </table>

    <table border=0.5   bordercolor="#73879ca3" width=1440 >
        <tr>
            <td style=" text-align: center; padding: 5px 2px; background-color: #BFCCD7; width:200px;">Obra</td>
            <td style="width:520px;"><b><?php echo $elemento3["obra"] ?></b></td>            
            <td style=" text-align: center; padding: 5px 2px; background-color: #BFCCD7;width:200px;" >No. Control</td>
            <td style="width:200px;" ></td>            
            <td style=" text-align: center; padding: 5px 2px; background-color: #BFCCD7;width:264px;" ></td>            
        </tr>
        
        <tr>            
            <td style="text-align: center; padding: 5px 2px; background-color: #BFCCD7; width:100px;" >Frente</td>
            <td style="width:100px;"></td>
            <td style="text-align: center; padding: 5px 2px; background-color: #BFCCD7; width:100px;">Fecha</td>
            <td style="width:100px;"><b><?php echo date("d/m/Y") ?></b></td>
            <td style=" text-align: center; padding: 5px 2px; background-color: #BFCCD7;width:264px;" ></td>            

        </tr>        
    </table>
<hr>
    <table border=0.5   bordercolor="#73879ca3" width=1440 >
        <tr>
            <td style=" text-align: center; padding: 5px 2px; background-color: #BFCCD7; width:520px;">Relación Materiales, Equipo, Maquinaria y Personal ->Costo M2</td>
            <td style="width:150px;"><b>$<?php echo money_format("%.2n", $totHono)?></b></td>            
            <td style=" text-align: center; padding: 5px 2px; background-color: #BFCCD7;width:200px;" >Total Directo</td>
            <td style="width:150px;" ><b>$<?php echo money_format("%.2n", $totDir) ?></b></td>            
            <td style=" text-align: center; padding: 5px 2px; background-color: #BFCCD7;width:206px;" >Total con Honorarios <?php echo $elemento3["porcentajeGanancia"] ?> %</td>
            <td style="width:150px;" ><b>$<?php echo money_format("%.2n", $totconHono)?></b></td>            
            
        </tr>
    </table>
<br>
    <table border=0.5   bordercolor="#73879ca3" width=1440 >
        <tr>
            <td style="width:335px; text-align:right;" >Tot. Mano de Obra</td>
            <td style=" text-align: center; padding: 5px 2px; background-color: #BFCCD7; width:150px;" ><b>$<?php echo money_format("%.2n", $totMaOb);?></b></td>            
            <td style=" text-align: center; width:175px;" >Tot. Materiales</td>
            <td style=" text-align: center; width:150px; padding: 5px 2px; background-color: #BFCCD7;" ><b>$<?php echo money_format("%.2n", $totMate);?></b></td>            
            <td style=" text-align: center; width:130px;" >Total cobrado</td>
            <td style=" text-align: center; width:143px; padding: 5px 2px; background-color: #BFCCD7;" ><b>$<?php echo money_format("%.2n", $totCobr);?></b></td>                        
            <td style=" text-align: center; width:130px;" >Deuda</td>
            <td style=" text-align: center; width:143px; padding: 5px 2px; background-color: #BFCCD7;" ><b>$<?php echo money_format("%.2n", $deudaActual);?></b></td>                        
        </tr>
    </table>

    <table bordercolor="#007"  style="font-size: 11px; width:100%; " >           
            <tr style="background-color: #48b4d4; color:#333333; text-align: center;">
                <th style=" padding: 3px 2px; width: 25px; ">Sem </th>
                <th style="width: 140px;">Periodo </th>
                <th style="width: 110px;">Mano Obra</th>
                <th style="width: 110px;">M.O. Honorarios</th>
                <th style="width: 110px;">Total Mano Obra</th>
                <th style="width: 110px;">Material</th>
                <th style="width: 110px;">Mat. Hono.</th>
                <th style="width: 110px;">Total Materiales</th>                
                <th style="width: 110px;">Total Semana</th>
                <th style="width: 110px;">Total Hono</th>
                <th style="width: 110px;">Total con Hono</th>
                <th style="width: 110px;">Pago</th>                
                <th style="width: 136px;">Coment</th>
            </tr>
            <tr style="color:black;">
                <?php
                    $bandera = true;
                    $totManoObra = 0;
                    for ($i=1; $i <= $max; $i++) { 

                        $manoObra = 0;                                                                                               
                        $semanaDato = "";
                        //---Empleados
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

                        //---Contratistas
                        foreach ($elemento4 as $key) {
                            if($key["semana"] == $i)
                            {
                                $count = $key["lunes"] + $key["martes"] + $key["miercoles"] + $key["jueves"] + $key["viernes"] + $key["sabado"];
                                if($count > 0 && $key[pago] > 0)
                                {
                                   $abono = $abono + $key['abono'];  
                                }

                                
                            }
                        }
                        
                        //---Materiales
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

                        //---Pagos
                        $pagoVal = "";
                        $comeVal = "";
                        foreach ($elemento5 as $key) {
                            if($key["semana"] == $i)
                            {                                                        
                                $pagoVal = $key["pago"];
                                $comeVal = $key["comentario"];
                            }
                        }

                        $manoObra = $manoObra + $abono;

                        $honorariosMo = $manoObra * ($elemento3["porcentajeGanancia"] / 100);
                        $totalMano = $honorariosMo + $manoObra;
                        $honorariosMa = $material * ($elemento3["porcentajeGanancia"] / 100);
                        $totalMate = $honorariosMa + $material;
                        $totManoObra = $totManoObra + $totalMano;

                        
                        $tosum = $material + $honorariosMo;
                        $tosumSem = $material + $manoObra;
                        $tosumHon = $honorariosMo + $honorariosMa;
                        $tosumcHo = $totalMano + $totalMate;
                        

                        echo '
                        <tr'; if($bandera == false){ echo ' style="background-color: #CFE1F5;"'; } echo '>
                                <td>'.($i).'</td>                                                                     
                                <td>'.$semanaDato.'</td>                                                                     
                                <td>$'. money_format("%.2n", $manoObra) .'</td>                                                                     
                                <td>$'. money_format("%.2n", $honorariosMo) .'</td>                                                                     
                                <td>$'. money_format("%.2n", $totalMano) .'</td>                                                                     
                                <td>$'. money_format("%.2n", $material) .'</td>                                                                     
                                <td>$'. money_format("%.2n", $honorariosMa) .'</td>                                                                     
                                <td>$'. money_format("%.2n", $totalMate) .'</td>                                                                                                                                                               
                                <td>$'. money_format("%.2n", $tosumSem) .'</td>  
                                                                                                   
                                <td>$'. money_format("%.2n", $tosumHon) .'</td>
                                <td>$'. money_format("%.2n", $tosumcHo) .'</td> 
                                <td>$'.$pagoVal.'</td>
                                <td>'.$comeVal.'</td>                                
                            </tr>
                        ';                                                 
                        $semanas++;

                        if($bandera == false)
                            $bandera = true;
                        else
                            $bandera = false;
                    }                                 

                ?>                
            </tr>        
        </table>

    
    <br>
<?php echo $pago;?>

</page>