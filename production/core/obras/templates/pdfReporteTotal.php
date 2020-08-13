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

  
    while($row = $result->fetch_array(MYSQLI_ASSOC)) 
        $elemento[] = $row;                            
    while($row = $result2->fetch_array(MYSQLI_ASSOC)) 
        $elemento2[] = $row;                 
    $elemento3 = mysqli_fetch_array($result3);
    while($row = $result4->fetch_array(MYSQLI_ASSOC)) 
        $elemento4[] = $row;
        

    $maxE1 = max(array_column($elemento, "semana"));
    $maxE2 = max(array_column($elemento2, "semana"));
    // $maxE4 = max(array_column($elemento4, "semana"));

    $max = $maxE1 > $maxE2 ? $maxE1 : $maxE2;
    // $max = $max > $maxE4 ? $max : $maxE4;

    $semanas = 0;    







    function foo($el1, $el2, $el3, $max, $el4) {

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

            // foreach ($el4 as $key) {
            //     if($key["semana"] == $i)
            //     {                                                        
            //         $material = $material + $key["importe"];                    
            //     }
            // }

            $honorariosMo = $manoObra * ($el3["porcentajeGanancia"] / 100);
            $totalMano = $honorariosMo + $manoObra;
            $honorariosMa = $material * ($el3["porcentajeGanancia"] / 100);
            $totalMate = $honorariosMa + $material;
            $totManoObra = $totManoObra + $totalMano;

            $GLOBALS['totMaOb'] = $GLOBALS['totMaOb'] + $totalMano;
            $GLOBALS['totMate'] = $GLOBALS['totMate'] + $totalMate;
            $GLOBALS['totCobr'] = $GLOBALS['totCobr'] + $_POST["pago".($i-1)];

            $GLOBALS['totconHono'] = $GLOBALS['totconHono'] + ($totalMano + $totalMate);

            $GLOBALS['costom2'] = $GLOBALS['totconHono'] / $el3[superficieConstruir];

            $GLOBALS['deudaActual'] = $el3['costoTotal'] - $GLOBALS['totCobr'];


        }

        // $GLOBALS['postresquefaltaran']         
    }

    foo($elemento, $elemento2, $elemento3, $max, $elemento4);
      
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
            <td  style="width:1216px;"  ><?php echo $elemento3["cliente"] ?></td>
            
        </tr>
    </table>

    <table border=0.5   bordercolor="#73879ca3" width=1440 >
        <tr>
            <td style=" text-align: center; padding: 5px 2px; background-color: #BFCCD7; width:200px;">Obra</td>
            <td style="width:520px;"><?php echo $elemento3["obra"] ?></td>            
            <td style=" text-align: center; padding: 5px 2px; background-color: #BFCCD7;width:200px;" >No. Control</td>
            <td style="width:200px;" ></td>            
            <td style=" text-align: center; padding: 5px 2px; background-color: #BFCCD7;width:264px;" ></td>            
        </tr>
        
        <tr>            
            <td style="text-align: center; padding: 5px 2px; background-color: #BFCCD7; width:100px;" >Frente</td>
            <td style="width:100px;"></td>
            <td style="text-align: center; padding: 5px 2px; background-color: #BFCCD7; width:100px;">Fecha</td>
            <td style="width:100px;"><?php echo date("d/m/Y") ?></td>
            <td style=" text-align: center; padding: 5px 2px; background-color: #BFCCD7;width:264px;" ></td>            

        </tr>        
    </table>
<hr>
    <table border=0.5   bordercolor="#73879ca3" width=1440 >
        <tr>
            <td style=" text-align: center; padding: 5px 2px; background-color: #BFCCD7; width:520px;">Relación Materiales, Equipo, Maquinaria y Personal -> <b>Costo M2</b></td>
            <td style="width:150px;">$<?php echo round($costom2,2)?></td>            
            <td style=" text-align: center; padding: 5px 2px; background-color: #BFCCD7;width:200px;" ><b>Total Directo</b></td>
            <td style="width:150px;" >$<?php echo round($totconHono,2)?></td>            
            <td style=" text-align: center; padding: 5px 2px; background-color: #BFCCD7;width:206px;" ><b>Total con Honorarios <?php echo $elemento3["porcentajeGanancia"] ?> %</b></td>
            <td style="width:150px;" >$<?php echo round($totconHono,2);?></td>            
            
        </tr>
    </table>
<br>
    <table border=0.5   bordercolor="#73879ca3" width=1440 >
        <tr>
            <td style="width:335px; text-align:right;" >Tot. Mano de Obra</td>
            <td style=" text-align: center; padding: 5px 2px; background-color: #BFCCD7; width:150px;" >$<?php echo round($totMaOb,2);?></td>            
            <td style=" text-align: center; width:175px;" ><b>Tot. Materiales </b></td>
            <td style=" text-align: center; width:150px; padding: 5px 2px; background-color: #BFCCD7;" >$<?php echo round($totMate,2);?></td>            
            <td style=" text-align: center; width:130px;" ><b>Total cobrado</b></td>
            <td style=" text-align: center; width:143px; padding: 5px 2px; background-color: #BFCCD7;" >$<?php echo round($totCobr,2);?></td>                        
            <td style=" text-align: center; width:130px;" ><b>Deuda</b></td>
            <td style=" text-align: center; width:143px; padding: 5px 2px; background-color: #BFCCD7;" >$<?php echo round($deudaActual,2);?></td>                        
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
                        $totManoObra = $totManoObra + $totalMano;
                        echo '
                        <tr'; if($bandera == false){ echo ' style="background-color: #CFE1F5;"'; } echo '>
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
                                <td>$'.$_POST["pago".($i-1)].'</td>
                                <td>'.$_POST["come".($i-1)].'</td>                                
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