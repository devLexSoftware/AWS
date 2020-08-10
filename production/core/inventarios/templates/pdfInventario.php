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
    
    $result1 = mysqli_query($con,"SELECT i.nombre, i.cantidad, i.categoria, i.ubicacion, i.descripcion, a.nombre as almacen, i.estado from inventarios i
            inner join almacenes a on i.fk_almacen = a.id 
            where i.estado = 0 order by i.nombre asc");                              
    while($row1 = $result1->fetch_array(MYSQLI_ASSOC)) 
        $el1[] = $row1;          


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
            <td style="text-align: center; padding: 5px 2px; background-color: #BFCCD7; width:200px;" >Nota</td>
            <td style="width:520px;"></td>
            <td style="text-align: center; padding: 5px 2px; background-color: #BFCCD7; width:200px;">Fecha impresión</td>
            <td style="width:520px;"><?php echo date("d/m/Y"); ?></td>
        </tr>

        <tr>            
            <td style="text-align: center; padding: 5px 2px; background-color: #BFCCD7; width:200px;" ></td>
            <td style="width:520px;"></td>
            <td style="text-align: center; padding: 5px 2px; background-color: #BFCCD7; width:200px;">Fecha de revisión</td>
            <td style="width:520px;"></td>
        </tr>

      
    </table>
    <table bordercolor="#007"  style="font-size: 11px; width:100%; " >           
            <tr style="background-color: #1E8EC6; color:#333333; text-align: center;">
                <th style=" padding: 3px 2px; width: 20px; "> </th>
                <th style=" padding: 3px 2px; width: 300px; ">Nombre </th>
                <th style="width: 70px;">Cantidad </th>
                <th style="width: 200px;">Categoría</th>
                <th style="width: 250px;">Almacén</th>
                <th style="width: 250px;">Ubicación</th>
                <th style="width: 315px;">Descripción</th>
            </tr>
            <tr style="color:black;">
                <?php
                $bandera = true;                

                foreach ($el1 as $elemento1) {                
                        
                        echo '
                        <tr'; if($bandera == false){ echo ' style="background-color: #CFE1F5;"'; } echo '>
                            <td style="border-bottom: 1px solid #B4B5B0; ">[___]</td>            

                            <td style=" padding: 4px 2px; border-bottom: 1px solid #B4B5B0; ">'.$elemento1[nombre].'</td>                            
                            <td style="border-bottom: 1px solid #B4B5B0; ">'.$elemento1[cantidad].'</td>            
                            <td style="border-bottom: 1px solid #B4B5B0; ">'.$elemento1[categoria].'</td> 
                            <td style="border-bottom: 1px solid #B4B5B0; ">'.$elemento1[almacen].'</td>            
                            <td style="border-bottom: 1px solid #B4B5B0; ">'.$elemento1[ubicacion].'</td>            
                            <td style="border-bottom: 1px solid #B4B5B0; ">'.$elemento1[descripcion].'</td>                                        
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