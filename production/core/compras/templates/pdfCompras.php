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


    
    //--- Filtrado 1 para sumatorio total
    $query1 = "SELECT factura, sum(importe) as suma from compras
                where fk_obra = $id";

    if($sem != "Todas")
        $query1 = $query1 . " and semana = '$sem'";
    if($pro != "Todos")
        $query1 = $query1 . " and descripcion = '$pro'";
    if($prv != "Todos")
        $query1 = $query1 . " and fk_proveedor = '$prv'";
    if($ctr != "Todos")
        $query1 = $query1 . " and fk_contratista = '$ctr'";
                
    $query1 = $query1 . " and estado = 0 group by(factura);";
    $result = mysqli_query($con,$query1);     
    while($row = $result->fetch_array(MYSQLI_ASSOC)) 
        $el[] = $row;                       
    
    
    //--- Filtrado 2 para la tabla de compras
    $query2 = "SELECT c.nombre, c.descripcion, c.fecha, c.frente, c.semana, c.cantidad, c.unidad, c.factura, p.empresa, c.subtotal, c.iva, c.importe, c.costo, c.fechInicial, c.fechFinal from compras c
                inner join proveedores p on c.fk_proveedor = p.id
                where c.fk_obra = $id";

    if($sem != "Todas")
        $query2 = $query2 . " and c.semana = '$sem'";
    if($pro != "Todos")
        $query2 = $query2 . " and c.descripcion = '$pro'";
    if($prv != "Todos")
        $query2 = $query2 . " and c.fk_proveedor = '$prv'";
    if($ctr != "Todos")
        $query2 = $query2 . " and c.fk_contratista = '$ctr'";

    $query2 = $query2. " and c.estado = 0 order by cast(semana as unsigned);";
    $result2 = mysqli_query($con,$query2);             
    

    while($row2 = $result2->fetch_array(MYSQLI_ASSOC)) 
        $el2[] = $row2;   



    //--- Datos de la obra
    $result3 = mysqli_query($con,"SELECT c.nombre as cliente, o.nombre as obra from obras o
                            inner join clientes c on o.fk_clientes = c.id    
                            where o.id = $id;");                              
    $elemento3 = mysqli_fetch_array($result3);


    //--- Sumatoria de facturas
    $query4 = "SELECT semana, sum(importe) as suma ";
    $query4f = " and estado = 0 ";

    if($sem != "Todas"){        
        $query4f = $query4f . " and semana = '$sem'";
    }
    if($pro != "Todos"){
        $query4d = $query4d . ", descripcion";
        $query4f = $query4f . " and descripcion = '$pro'";
    }
    if($prv != "Todos"){
        $query4d = $query4d . ", fk_proveedor";
        $query4f = $query4f . " and fk_proveedor = '$prv'";
    }
    if($ctr != "Todos"){
        $query4d = $query4d . ", fk_contratista";
        $query4f = $query4f . " and fk_contratista = '$ctr'";
    }

    $query4g = "  group by semana". $query4d;

    $query4 = $query4 . $query4d ." from compras where fk_obra = $id";        
    $query04 = $query4.$query4f.$query4g;   
    $result4 = mysqli_query($con, $query04);                            
    while($row4 = $result4->fetch_array(MYSQLI_ASSOC)) 
        $el4[] = $row4;
                            
    $totalFrente = 0;                                
    foreach ($el as $valor)
        $totalFrente = $totalFrente + $valor[suma];
 

    //--- Sumatoria de frentes
    $query5 = "SELECT frente, sum(importe) as sumaFrente from compras where fk_obra = $id";

    if($sem != "Todas")
        $query5 = $query5 . " and semana = '$sem'";
    if($pro != "Todos")
        $query5 = $query5 . " and descripcion = '$pro'";
    if($prv != "Todos")
        $query5 = $query5 . " and fk_proveedor = '$prv'";
    if($ctr != "Todos")
        $query5 = $query5 . " and fk_contratista = '$ctr'";
        
    $query5 = $query5 . " and estado = 0 group by(frente);";
    $result5 = mysqli_query($con,$query5);     
    while($row5 = $result5->fetch_array(MYSQLI_ASSOC)) 
        $el5[] = $row5;        
    
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
            <td style="width:100px;"><?php echo date("d/m/Y");?></td>
        </tr>

      
        
        <tr >            
            <td colspan="2" style="text-align: center; padding: 5px 2px; background-color: #BFCCD7;">Relación de Materiales, Equipo y Maquinaria</td>
            
            <td style="width: 100px; background-color: #BFCCD7;">Total Material Obra</td>
            <td style="width: 100px;">$<?php echo round($totalFrente, 2); ?></td>
        </tr>        
        
    </table>
    
    <table bordercolor="#007"  style="font-size: 11px; width:100%; " >           
            <tr style="background-color: #1E8EC6; color:#333333; text-align: center;">
                <th style=" padding: 3px 2px; width: 25px; ">Sem </th>
                <th style="width: 140px;">Periodo </th>
                <th style="width: 40px;">Cant</th>
                <th style="width: 240px;">Descripcion</th>
                <th style="width: 80px;">Unidad</th>
                <th style="width: 110px;">Frente</th>
                <th style="width: 65px;">Fecha</th>            
                <th style="width: 35px;">Fac.</th>    
                <th style="width: 145px;">Proveedor</th>    
                <th style="width: 70px;">SubTotal</th>    
                <th style="width: 60px;">IVA</th>   
                <th style="width: 65px;">Importe</th>    
                <th style="width: 70px;">Costo Uni</th>  
                <th style="width: 70px;">Total Fac</th>  
                <th style="width: 70px;">Total Fre</th>                    
                <th style="width: 70px;">Total Sem</th>                    
                                   


            </tr>
            <tr style="color:black;">
                <?php
                $bandera = true;
                

                foreach ($el2 as $elemento2) {                
                                                
                        $totFac = array_search($elemento2[factura], array_column($el, 'factura'));                        
                        $totSem = array_search($elemento2[semana], array_column($el4, 'semana'));
                        $totFre = array_search($elemento2[frente], array_column($el5, 'frente'));
                                                

                        echo '
                            <tr'; if($bandera == false){ echo ' style="background-color: #CFE1F5;"'; } echo '>
                                <td style="border-bottom: 1px solid #B4B5B0; ">'.$elemento2[semana].'</td>
                                <td style="border-bottom: 1px solid #B4B5B0; ">'.$elemento2[fechInicial].' al '.$elemento2[fechFinal].'</td>            
                                <td style="border-bottom: 1px solid #B4B5B0; ">'.$elemento2[cantidad].'</td>            
                                <td style="border-bottom: 1px solid #B4B5B0; ">'.$elemento2[descripcion].'</td>            
                                <td style="border-bottom: 1px solid #B4B5B0; ">'.$elemento2[unidad].'</td> 
                                <td style="border-bottom: 1px solid #B4B5B0; ">'.$elemento2[frente].'</td>            
                                <td style="border-bottom: 1px solid #B4B5B0; ">'.$elemento2[fecha].'</td>            
                                <td style="border-bottom: 1px solid #B4B5B0; ">'.$elemento2[factura].'</td>            
                                <td style="border-bottom: 1px solid #B4B5B0; ">'.$elemento2[empresa].'</td>            
                                <td style="border-bottom: 1px solid #B4B5B0; ">$'.round($elemento2[subtotal],2).'</td>            
                                <td style="border-bottom: 1px solid #B4B5B0; ">$'.round($elemento2[iva],2).'</td>            
                                <td style="border-bottom: 1px solid #B4B5B0; ">$'.round($elemento2[importe],2).'</td>            
                                <td style="border-bottom: 1px solid #B4B5B0; ">$'.round($elemento2[costo],2).'</td>   
                                <td style="border-bottom: 1px solid #B4B5B0; ">$'.round($el[$totFac][suma],2).'</td>                                                                                                                
                                <td style="border-bottom: 1px solid #B4B5B0; ">$'.round($el5[$totFre][sumaFrente],2).'</td>                                                                            
                                <td style="border-bottom: 1px solid #B4B5B0; ">$'.round($el4[$totSem][suma],2).'</td>                                                                                                            
                                
                            </tr>
                        ';                        
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