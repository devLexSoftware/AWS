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
    
    $result0 = mysqli_query($con,"SELECT * FROM cotizaciones where id = $id;");
    $elemento = mysqli_fetch_array($result0);
    
    $result1 = mysqli_query($con,"SELECT * FROM cotizaciones_detalles where fk_cotizaciones = $id;");
    while($row1 = $result1->fetch_array(MYSQLI_ASSOC)) 
        $el1[] = $row1;          


    // $sumDirecto = 0;
    function calcular($el, $el1) {

        foreach ($el as $elemento) {
            $GLOBALS['totDirecto'] = $GLOBALS['totDirecto'] + $elemento[directo];
            $GLOBALS['totcReal'] = $GLOBALS['totcReal'] + $elemento[costo_real];
            
        }   
        
        $GLOBALS['totResta'] = $el1[total] - $GLOBALS['totDirecto']; 

    }

    calcular($el1, $elemento);   
}

?>

<page style="font-size: 14px">
    
    <!-- <table width=1440 height=150>
        <tr align="center" >
            <th style="width:550px; height:150px" ></th>
            <th >
            <img style="width:300px;" src="production/components/images/logo3.png"> 
            </th>            
        </tr>        
    </table> -->
    <table border=0.5   bordercolor="#73879ca3" width=1440 >
            
        <tr>            
            <td style="text-align: center; padding: 20px 2px; color: white; background-color: #7986a2; width:400px;" >Arq. Norberto Morales González </td>
            <td style="text-align: center; padding: 5px 2px; width:100px;">Dirección</td>
            <td style="text-align: center; padding: 5px 2px; width:900px;">Paseo del Altiplanicie # 3 Int. 3-A, C.P. 36670, Villas de Irapuato.</td>            
        </tr>

        <tr>            
            <td style="text-align: center; padding: 10px 2px; color:black; background-color: #a4bcda; width:400px;" >NoMoGo Arquitectura y Construcción</td>
            <td style="text-align: center; padding: 5px 2px; width:100px;">Contacto</td>
            <td style="padding: 5px 2px; width:900px;">Teléfono: 462 265 05 31, E-Mail: brake_premier@hotmail.com  </td>            
        </tr>
      
    </table>

    <table border=0.5   bordercolor="#73879ca3" width=1440 >            
        <tr>            
            <td style="text-align: center; padding: 20px 2px; color: white; background-color: #7986a2; width:400px;" >Cliente</td>
            <td style="text-align: center; padding: 5px 2px; width:400px;"><?php echo $elemento[cliente] ?></td>            
            <td style="text-align: center; padding: 20px 2px; color: white; background-color: #7986a2; width:100px;" >Costo M2</td>
            <td style="text-align: center; padding: 5px 2px; width:180px;">$<?php echo $elemento[costoPromedio] ?></td>       
            <td style="text-align: center; padding: 20px 2px; color: black; background-color: #f5c53e; width:100px;" >Total</td>
            <td style="text-align: center; padding: 5px 2px; color: black; background-color: #f1d484; width:184px;">$<?php echo $elemento[total] ?></td>           
        </tr>
    </table>

    <table border=0.5   bordercolor="#73879ca3" width=1440 >            
        <tr>            
            <td style="text-align: center; padding: 5px 2px; color: white; background-color: #7986a2; width:400px;" >Obra</td>
            <td style="text-align: center; padding: 5px 2px; width:1012px;"><?php echo $elemento[obra] ?></td>            
            
        </tr>
    </table>

    <table border=0.5   bordercolor="#73879ca3" width=1440 >            
        <tr>            
            <td style="text-align: center; padding: 5px 2px; color: white; width:1132px;" ></td>
            <td style="text-align: center; padding: 5px 2px;color:black; background-color: #a4bcda; width:120px;">Construcción M2</td>
            <td style="text-align: center; padding: 5px 2px; width:149px;"><?php echo $elemento[superficie] ?></td>
            
            
            
        </tr>
    </table>


    <table bordercolor="#007"  style="font-size: 11px; width:100%; " >           
            <tr style="background-color: #1E8EC6; color:#333333; text-align: center;">
                <th style=" padding: 10px 2px; width: 30px; "> </th>
                <th style="width: 639px; ">Concepto </th>
                <th style="width: 185px;">Unidad </th>
                <th style="width: 125px;">Cant</th>
                
                <th style="width: 145px;">C.U.</th>
                <th style="width: 145px;">Descuento</th>
            
                <th style="width: 145px;">% Importe</th>
            </tr>
            <tr style="color:black;">
                <?php
                $bandera = true;                

                foreach ($el1 as $elemento1) {                
                        
                        echo '
                        <tr'; if($bandera == false){ echo ' style=" background-color: #CFE1F5;"'; } echo '>
                            <td style="border-bottom: 1px solid #B4B5B0; "></td>            

                            <td style=" padding: 5px 2px; border-bottom: 1px solid #B4B5B0; ">'.wordwrap($elemento1[concepto],110,"<br>\n",TRUE).'</td>                            
                            <td style="border-bottom: 1px solid #B4B5B0; ">'.$elemento1[unidad].'</td>            
                            <td style="border-bottom: 1px solid #B4B5B0; ">'.$elemento1[cantidad].'</td> 
                            
                            <td style="border-bottom: 1px solid #B4B5B0; ">$'.$elemento1[cu].'</td>                                        
                            <td style="border-bottom: 1px solid #B4B5B0; ">$'.$elemento1[descuento].'</td>                                        
                            
                            <td style="border-bottom: 1px solid #B4B5B0; ">$'.$elemento1[importe].'</td>                                        
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

</page>