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

    setlocale(LC_MONETARY, 'es_MX');
    

    // $id = $_GET["id"];
    // $count = $_GET["count"];    




    // function foo($el1, $el2, $el3, $max, $el4, $el5) {

    //     for ($i=1; $i <= $max; $i++) { 

    //         $manoObra = 0;                                                                                               
    //         foreach ($el1 as $key) {
    //             if($key["semana"] == $i)
    //             {
    //                 $count = $key["lunes"] + $key["martes"] + $key["miercoles"] + $key["jueves"] + $key["viernes"] + $key["sabado"];
    //                 if($count > 0){
    //                     $importeLibre = ($key["salario"]/6) * $count;
    //                     $seguro = $key["salario"] * 0.31;                        
    //                     $importeSeguro = $importeLibre + $seguro;                                                                                                                
    //                     $manoObra = $manoObra + $importeSeguro;                    
    //                 }
                    
    //             }
    //         }

    //         $material = 0;
    //         foreach ($el2 as $key) {
    //             if($key["semana"] == $i)
    //             {                                                        
    //                 $material = $material + $key["importe"];                    
    //             }
    //         }

    //         $pagoVal = 0;            
    //         foreach ($el5 as $key) {
    //             if($key["semana"] == $i)
    //             {                                                        
    //                 $pagoVal = $key["pago"];                    
    //             }
    //         }

    //         //---Contratistas
    //         foreach ($el4 as $key) {
    //             if($key["semana"] == $i)
    //             {
    //                 $count = $key["lunes"] + $key["martes"] + $key["miercoles"] + $key["jueves"] + $key["viernes"] + $key["sabado"];
    //                 if($count > 0 && $key[pago] > 0)
    //                 {
    //                    $abono = $abono + $key['abono'];  
    //                 }

                    
    //             }
    //         }

    //         $manoObra = $manoObra + $abono;
          

    //         $honorariosMo = $manoObra * ($el3["porcentajeGanancia"] / 100);
    //         $totalMano = $honorariosMo + $manoObra;
    //         $honorariosMa = $material * ($el3["porcentajeGanancia"] / 100);
    //         $totalMate = $honorariosMa + $material;
    //         $totManoObra = $totManoObra + $totalMano;


    //         $GLOBALS['totDir'] = $GLOBALS['totDir'] + ($material + $manoObra);

    //         $GLOBALS['totMaOb'] = $GLOBALS['totMaOb'] + $totalMano;
    //         $GLOBALS['totMate'] = $GLOBALS['totMate'] + $totalMate;
    //         $GLOBALS['totCobr'] = $GLOBALS['totCobr'] + $pagoVal;

    //         $GLOBALS['totconHono'] = $GLOBALS['totconHono'] + ($totalMano + $totalMate);

    //         $GLOBALS['costom2'] = $GLOBALS['totconHono'] / $el3[superficieConstruir];

    //         $GLOBALS['deudaActual'] = $el3['costoTotal'] - $GLOBALS['totCobr'];


    //     }

        
    //     $GLOBALS['deudaActual'] = $GLOBALS['totconHono'] -  $GLOBALS['totCobr'];


    //     // foreach ($el5 as $key) {
    //     //     $GLOBALS['totCobr'] = $GLOBALS['totCobr'] + $key['pago'];
    //     // }

    //     // $GLOBALS['postresquefaltaran']         
    // }


    //--Para obtener la fecha inicial menor y fecha final mayor
    $result1 = mysqli_query($con,"SELECT min(STR_TO_DATE(a.periodoInicial,  '%d-%m-%Y')) as fechInicial, max(STR_TO_DATE(a.periodoInicial,  '%d-%m-%Y')) as fechFinal
        from asistencias a where estado = 0 and 
        YEAR(STR_TO_DATE(a.periodoInicial,  '%d-%m-%Y')) = YEAR(CURDATE()) and 
        YEAR(STR_TO_DATE(a.periodoInicial,  '%d-%m-%Y')) = YEAR(CURDATE());");

    $result01 = mysqli_query($con,"SELECT min(STR_TO_DATE(c.fechInicial,  '%d-%m-%Y')) as fechInicial, max(STR_TO_DATE(c.fechInicial,  '%d-%m-%Y')) as fechFinal
        from compras c where estado = 0 and 
        YEAR(STR_TO_DATE(c.fechInicial,  '%d-%m-%Y')) = YEAR(CURDATE()) and 
        YEAR(STR_TO_DATE(c.fechInicial,  '%d-%m-%Y')) = YEAR(CURDATE());");
                
    $elemento1 = mysqli_fetch_array($result1);
    $elemento01 = mysqli_fetch_array($result01);

    // $fechaMinimo = $elemento1[fechInicial];
    // $fechaMaximo = $elemento1[fechFinal];
    // $fechaSelect = $elemento1[fechInicial];


    // $max = $maxE1 > $maxE2 ? $maxE1 : $maxE2;

    $fechaMin1 = DateTime::createFromFormat('Y-m-d', $elemento1[fechInicial])->format('Y-m-d');
    $fechaMin01 = DateTime::createFromFormat('Y-m-d', $elemento01[fechInicial])->format('Y-m-d');
    $fechaMax1 = DateTime::createFromFormat('Y-m-d', $elemento1[fechFinal])->format('Y-m-d');
    $fechaMax01 = DateTime::createFromFormat('Y-m-d', $elemento01[fechFinal])->format('Y-m-d');

    $fechaMinimo = $fechaMin1 < $fechaMin01 ? $fechaMin1 : $fechaMin01;
    $fechaMaximo = $fechaMax1 < $fechaMax01 ? $fechaMax01 : $fechaMax1;
    $fechaSelect = $fechaMinimo;

    // foo($elemento, $elemento2, $elemento3, $max, $elemento4, $elemento5);
      
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

    

   
<hr>
    
<br>
    

    <table bordercolor="#007"  style="font-size: 11px; width:100%; " >           
            <tr style="background-color: #48b4d4; color:#333333; text-align: center;">                
                <th style=" padding: 5px 4px; width: 170px;">Periodo </th>
                <th style="width: 130px;">Mano Obra</th>
                <th style="width: 130px;">M.O. Honorarios</th>
                <th style="width: 130px;">Total Mano Obra</th>
                <th style="width: 130px;">Material</th>
                <th style="width: 130px;">Mat. Hono.</th>
                <th style="width: 140px;">Total Materiales</th>                
                <th style="width: 140px;">Total Semana</th>
                <th style="width: 150px;">Total Hono</th>
                <th style="width: 150px;">Total con Hono</th>
                
            </tr>
            <tr style="color:black;">
                <?php
                    $bandera = true;
                    $cou = 0;                     
                    while($fechaSelect <= $fechaMaximo){
                    
                        $semanaDato = "";
                        $count = 0;
                        $importeLibre = 0;
                        $manoObra = 0;    
                        $seguro = 0;
                        $importeSeguro = 0;
                        $elemento2 = NULL;
                        $elemento3 = NULL;
                        $honorariosMo = 0;
                        $totalMano = 0;
                        $honorariosMa = 0;
                        $totalMate = 0;

                        //--obtener todas las asistencias de la fecha inicial
                        $result2 = mysqli_query($con,"SELECT ae.lunes, ae.martes, ae.miercoles, ae.jueves, ae.viernes, ae.sabado, e.salario, a.semana, a.periodoInicial, a.periodoFinal, o.porcentajeGanancia from asistencias_empleados ae
                                    inner join asistencias a on ae.fk_asistencia = a.id
                                    inner join empleados e on ae.fk_empleado = e.id
                                    inner join obras o on a.fk_obra = o.id
                                    where  STR_TO_DATE(a.periodoInicial,  '%d-%m-%Y') = '$fechaSelect' and a.estado = 0 order by a.semana;");
                        while($row2 = $result2->fetch_array(MYSQLI_ASSOC)) 
                            $elemento2[] = $row2;
                                    
                        // $honorariosMo = $manoObra * ($elemento3["porcentajeGanancia"] / 100);
                        // $totalMano = $honorariosMo + $manoObra;
                        // $honorariosMa = $material * ($elemento3["porcentajeGanancia"] / 100);
                        // $totalMate = $honorariosMa + $material;

                        
                        foreach ($elemento2 as $key) {
                            
                            $count = $key["lunes"] + $key["martes"] + $key["miercoles"] + $key["jueves"] + $key["viernes"] + $key["sabado"];
                            if($count > 0)
                            {
                                $importeLibre = ($key["salario"]/6) * $count;
                                $seguro = $key["salario"] * 0.31;                        
                                $importeSeguro = $importeLibre + $seguro;                                                                                                                
                                $manoObra = $manoObra + $importeSeguro;
                                $honorariosMo = $manoObra * ($key["porcentajeGanancia"] / 100);
                                $totalMano = $totalMano + ($honorariosMo + $manoObra);
                            }                                                        
                            $semanaDato = $key["periodoInicial"]." al ".$key["periodoFinal"];                                                        
                            
                        }

                        //--obtener todas las materias de la fecha inicial
                        $material = 0;
                        $result3 = mysqli_query($con,"SELECT c.semana, c.importe, c.fechInicial, c.fechFinal, o.porcentajeGanancia from compras c
                                    inner join obras o on c.fk_obra = o.id
                                    where STR_TO_DATE(c.fechInicial,  '%d-%m-%Y') = '$fechaSelect' and c.estado = 0 order by c.semana;");      
                        while($row3 = $result3->fetch_array(MYSQLI_ASSOC)) 
                            $elemento3[] = $row3;   

                        

                        foreach ($elemento3 as $key) {                                                        
                            $material = $material + $key["importe"];       
                            $honorariosMa = $material * ($key["porcentajeGanancia"] / 100);
                            $totalMate = $totalMate + ($honorariosMa + $material);                                                 
                            if($semanaDato == "")          
                            {
                                $semanaDato = $key["fechInicial"]." al ".$key["fechFinal"];                                                        
                            }
                        }
                        
                        

                        echo '
                            <tr'; if($bandera == false){ echo ' style="background-color: #CFE1F5;"'; } echo '>
                                                                                         
                                <td>'.$semanaDato.'</td>                                                                     
                                <td>$'.round($manoObra,2).'</td>                                                                     
                                    <td>$'. money_format("%.2n", $honorariosMo) .'</td>                                                                     
                                    <td>$'. money_format("%.2n", $totalMano) .'</td>                                                                     
                                    <td>$'. money_format("%.2n", $material).'</td>                                                                     
                                    <td>$'. money_format("%.2n", $honorariosMa).'</td>                                                                     
                                    <td>$'. money_format("%.2n", $totalMate).'</td>                                                                                                                                                                                                 
                                    <td>$'. money_format("%.2n", ($material + $manoObra)) .'</td>                                                                     
                                    <td>$'. money_format("%.2n", ($honorariosMo + $honorariosMa)) .'</td>
                                    <td>$'. money_format("%.2n", ($totalMano + $totalMate)) .'</td> 
                                                            
                            </tr>
                        ';                                                 
                        $fechaSelect = date('Y-m-d', strtotime($fechaSelect. ' + 7 days'));
                        $cou++;

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