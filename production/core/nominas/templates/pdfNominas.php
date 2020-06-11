<?php
include("production/config/conexion.php");
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else {        
    $result = mysqli_query($con,"SELECT a.periodoInicial, a.periodoFinal, a.semana, a.fk_obra from asistencias a
                                where id = $id;");
    $elemento = mysqli_fetch_array($result);

    $result2 = mysqli_query($con,"SELECT e.nombre, e.salario, e.categoria, e.rol, e.giro, ae.lunes, ae.martes, ae.miercoles, ae.jueves, ae.viernes, ae.sabado, ae.monto, e.nssi from asistencias_empleados ae
                            inner join empleados e on ae.fk_empleado = e.id
                            where ae.fk_asistencia = $id;");  

    $result3 = mysqli_query($con,"SELECT c.nombre as cliente, o.nombre as obra from obras o
                            inner join clientes c on o.fk_clientes = c.id    
                            where o.id = $elemento[fk_obra];");                              
    $elemento3 = mysqli_fetch_array($result3);
                            
      

}

?>

<page style="font-size: 14px">
    
    <table border="1" bordercolor="#007" width=1440 >
        <tr align="center" >
            <th style="width:100%; font-size: 30px">WorkShop</th>
        </tr>
    </table>
    <table    bordercolor="#007" width=1440 >
        <tr>            
            <td style=" text-align: center; padding: 5px 2px; background-color: #BFCCD7;width:200px;" >Cliente</td>
            <td style="width:520px;" ><?php echo $elemento3[cliente] ?></td>
            <td style=" text-align: center; padding: 5px 2px; background-color: #BFCCD7; width:200px;">Obra</td>
            <td style="width:520px;"><?php echo $elemento3[obra] ?></td>
        </tr>
        
        <tr>            
            <td style="text-align: center; padding: 5px 2px; background-color: #BFCCD7; width:100px;" >Frente</td>
            <td style="width:100px;">000</td>
            <td style="text-align: center; padding: 5px 2px; background-color: #BFCCD7; width:100px;">Fecha impresión</td>
            <td style="width:100px;">25/02/2020</td>
        </tr>

      
        
        <tr >            
            <td colspan="2" style="text-align: center; padding: 5px 2px; background-color: #BFCCD7;">Lista Nominal</td>
            
            <td style="width: 100px; background-color: #BFCCD7;">Total Nomina Obra</td>
            <td style="width: 100px;">$202000</td>
        </tr>        
        
    </table>
    <table bordercolor="#007"  style="font-size: 11px; width:100%; " >           
            <tr style="background-color: #1E8EC6; color:#333333; text-align: center;">
                <th style=" padding: 3px 2px; width: 25px; ">Sem </th>
                <th style="width: 120px;">Periodo </th>
                <th style="width: 160px;">Nombre</th>
                <th style="width: 70px;">Puesto</th>
                <th style="width: 120px;">Categoría</th>
                <th style="width: 100px;">N.S.S</th>            
                <th style="width: 17px; text-align: center; ">Lu</th>
                <th style="width: 17px; text-align: center; ">Ma</th>
                <th style="width: 17px; text-align: center; ">Mi</th>
                <th style="width: 17px; text-align: center; ">Ju</th>
                <th style="width: 17px; text-align: center; ">Vi</th>
                <th style="width: 17px; text-align: center; ">Sa</th>
                <th style="width: 55px;">D. Labo</th>
                <th style="width: 85px;">Seguro</th>
                <th style="width: 75px;">Pago</th>
                <th style="width: 75px;">Imp. Libre</th>
                <th style="width: 75px;">Imp. Segu</th>
                <th style="width: 80px;">Tot. Libre</th>
                <th style="width: 80px;">Tot. Segu</th>
                <th style="width: 80px;">Tot. Cat</th>
                <th style="width: 84px;">Coment</th>
            </tr>
            <tr style="color:black;">
                <?php
                $bandera = true;
                    while($elemento2 = mysqli_fetch_array($result2)){
                        $count = 0;
                        $seguro = $elemento2[salario] * 0.31;
                        
                        echo '
                            <tr'; if($bandera == false){ echo ' style="background-color: #CFE1F5;"'; } echo '>
                                <td style=" padding: 4px 2px; border-bottom: 1px solid #B4B5B0; ">'.$elemento[semana].'</td>
                                <td style="border-bottom: 1px solid #B4B5B0; ">'.$elemento[periodoInicial].' al '.$elemento[periodoFinal].'</td>            
                                <td style="border-bottom: 1px solid #B4B5B0; ">'.$elemento2[nombre].'</td>            
                                <td style="border-bottom: 1px solid #B4B5B0; ">'.$elemento2[rol].'</td> 
                                <td style="border-bottom: 1px solid #B4B5B0; ">'.$elemento2[categoria].'</td>            
                                <td style="border-bottom: 1px solid #B4B5B0; ">'.$elemento2[nssi].'</td>            
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">';if($elemento2[lunes] == 1){$count++; echo 'x'; } echo'</td>
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">';if($elemento2[miercoles] == 1){ $count++; echo 'x'; } echo'</td>
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">';if($elemento2[martes] == 1){ $count++; echo 'x'; } echo'</td>
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">';if($elemento2[jueves] == 1){ $count++; echo 'x'; } echo'</td>
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">';if($elemento2[viernes] == 1){ $count++; echo 'x'; } echo'</td>
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">';if($elemento2[sabado] == 1){ $count++; echo 'x'; } echo'</td>
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">'.$count.'</td>       
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">$'.$seguro.'</td>       
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">$'.$elemento2[salario].'</td>       
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">'.$elemento2[monto].'</td>       
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">'.$elemento2[monto].'</td>       
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">'.$elemento2[monto].'</td>       
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">'.$elemento2[monto].'</td>       
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">'.$elemento2[monto].'</td>       
                                <td style="border-bottom: 1px solid #B4B5B0;">'.$elemento2[monto].'</td>       
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



    <br><br><br>


</page>