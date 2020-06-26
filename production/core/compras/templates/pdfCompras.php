<?php
include("production/config/conexion.php");
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else {        

    $result = mysqli_query($con,"SELECT factura, sum(importe) as suma from compras
                                where fk_obra = $id  group by(factura);");                            
    // $elemento = mysqli_fetch_array($result);

    $result2 = mysqli_query($con,"SELECT c.nombre, c.descripcion, c.fecha, c.frente, c.semana, c.cantidad, c.unidad, c.factura, p.proveedor, c.subtotal, c.importe, c.costo, c.fechInicial, c.fechFinal from compras c
                            inner join proveedores p on c.fk_proveedor = p.id
                            where c.fk_obra = $id and c.estado = 0 order by semana;");             

    $result3 = mysqli_query($con,"SELECT c.nombre as cliente, o.nombre as obra from obras o
                            inner join clientes c on o.fk_clientes = c.id    
                            where o.id = $id;");                              
    $elemento3 = mysqli_fetch_array($result3);

    $result4 = mysqli_query($con,"SELECT semana, sum(importe) as suma from compras  
                                where fk_obra = $id group by(semana);");                            


                            
                               
    while($row = $result2->fetch_array(MYSQLI_ASSOC)) 
        $el2[] = $row;                       
      
    while($row2 = $result->fetch_array(MYSQLI_ASSOC)) 
        $el[] = $row2;
        
    while($row4 = $result4->fetch_array(MYSQLI_ASSOC)) 
        $el4[] = $row4;
    
    $totalFrente = 0;                                
    foreach ($el as $valor) {                
        $totalFrente = $totalFrente + $valor[suma];
    }



}

?>

<page style="font-size: 14px">
    
    <table width=1440 height=150>
        <tr align="center" >
            <th style="width:100%; height:120px;"><h1> WorkShop Studio Premier</h1>Architecture + 3D Visualization</th>            
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
                <th style="width: 250px;">Descripcion</th>
                <th style="width: 90px;">Unidad</th>
                <th style="width: 150px;">Frente</th>
                <th style="width: 70px;">Fecha</th>            
                <th style="width: 70px;">Factura</th>    
                <th style="width: 116px;">Proveedor</th>    
                <th style="width: 90px;">SubTotal</th>    
                <th style="width: 90px;">Importe</th>    
                <th style="width: 90px;">Costo Uni</th>    
                <th style="width: 90px;">Total Sem</th>                    
                <th style="width: 90px;">Total Fac</th>                    


            </tr>
            <tr style="color:black;">
                <?php
                $bandera = true;
                

                foreach ($el2 as $elemento2) {                
                                                
                        $totFac = array_search($elemento2[factura], array_column($el, 'factura'));
                        $totSem = array_search($elemento2[semana], array_column($el4, 'semana'));

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
                                <td style="border-bottom: 1px solid #B4B5B0; ">'.$elemento2[proveedor].'</td>            
                                <td style="border-bottom: 1px solid #B4B5B0; ">$'.$elemento2[subtotal].'</td>            
                                <td style="border-bottom: 1px solid #B4B5B0; ">$'.$elemento2[importe].'</td>            
                                <td style="border-bottom: 1px solid #B4B5B0; ">$'.$elemento2[costo].'</td>                                                                            
                                <td style="border-bottom: 1px solid #B4B5B0; ">$'.$el[$totFac][suma].'</td>                                                                            
                                <td style="border-bottom: 1px solid #B4B5B0;">$'.$el[$totFac][suma].'</td>       
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