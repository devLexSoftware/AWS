<?php
include("production/config/conexion.php");
error_reporting(E_ALL);
ini_set('display_errors', '1');
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


    function fuNomina($el2) {

        while($elemento2 = mysqli_fetch_array($el2)){


            $seguro = $elemento2[salario] * 0.31;                        
            $count = $elemento2["lunes"] + $elemento2["martes"] + $elemento2["miercoles"] + $elemento2["jueves"] + $elemento2["viernes"] + $elemento2["sabado"];            
            $importeLibre = ($elemento2[salario]/6) * $count;
            $importeSeguro = $importeLibre + $seguro;

            // $GLOBALS['totNomi'] = 11;
        }
        $GLOBALS['totNomi'] = 11;

    }

    fuNomina($result2);
                            
      

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
            <td style="text-align: center; padding: 5px 2px; background-color: #BFCCD7; width:100px;" ></td>
            <td style="width:100px;">000</td>
            <td style="text-align: center; padding: 5px 2px; background-color: #BFCCD7; width:100px;">Fecha impresión</td>
            <td style="width:100px;">25/02/2020</td>
        </tr>

      
        
        <tr >            
            <td colspan="2" style="text-align: center; padding: 5px 2px; background-color: #BFCCD7;">Lista Nominal</td>
            
            <td style="width: 100px; background-color: #BFCCD7;">Total Nomina Obra</td>
            <td style="width: 100px;">$<?php echo $totNomi;  ?></td>
        </tr>        
        
    </table>
    <table bordercolor="#007"  style="font-size: 11px; width:100%; " >           
            <tr style="background-color: #1E8EC6; color:#333333; text-align: center;">
                <th style=" padding: 3px 2px; width: 25px; ">Sem </th>
                <th style="width: 150px;">Periodo </th>
                <th style="width: 250px;">Nombre</th>
                <th style="width: 150px;">Puesto</th>
                <th style="width: 150px;">Categoría</th>
                <th style="width: 100px;">N.S.S</th>            
                <th style="width: 20px; text-align: center; ">Lu</th>
                <th style="width: 20px; text-align: center; ">Ma</th>
                <th style="width: 20px; text-align: center; ">Mi</th>
                <th style="width: 20px; text-align: center; ">Ju</th>
                <th style="width: 20px; text-align: center; ">Vi</th>
                <th style="width: 20px; text-align: center; ">Sa</th>
                <th style="width: 55px;">D. Labo</th>
                <th style="width: 80px;">Seguro</th>
                <th style="width: 70px;">Pago</th>
                <th style="width: 75px;">Imp. Libre</th>
                <th style="width: 75px;">Imp. Segu</th>                
                <th style="width: 90px;">Coment</th>
            </tr>
            <tr style="color:black;">
                <?php
                $bandera = true;
                $totalSemanaLibre = 0;
                $totalSemanaSeguro = 0;
                $totalCategoria = 0; 
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
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">';if($elemento2[lunes] == 1){$count++; echo 'x'; } else if($elemento2[lunes] == 0.5){$count = $count + 0.5; echo '1/2'; }  echo'</td>
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">';if($elemento2[miercoles] == 1){ $count++; echo 'x'; } else if($elemento2[martes] == 0.5){$count = $count + 0.5; echo '1/2'; } echo'</td>
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">';if($elemento2[martes] == 1){ $count++; echo 'x'; } else if($elemento2[miercoles] == 0.5){$count = $count + 0.5; echo '1/2'; } echo'</td>
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
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">$'.$importeLibre.'</td>       
                                <td style="border-bottom: 1px solid #B4B5B0; text-align: center; ">$'.$importeSeguro.'</td>                                       
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
                    ?>
            </tr>        
        </table>

    <br><br>


    <table  border="1"  style="font-size: 14px; width:100%; " >           
        <tr style=" color:#333333; text-align: center;">
            <th style="background-color: #5aa3e2; color:white; padding: 3px 2px; width: 200px; ">Total Semana Libre </th>
            <th style="width: 150px;">$<?php echo $totalSemanaLibre; ?> </th>
        </tr>
        <tr style=" color:#333333; text-align: center;">
            <th style="background-color: #5aa3e2; color:white; padding: 3px 2px; width: 200px; ">Total Semana con Seguro </th>
            <th style="width: 150px;">$<?php echo $totalSemanaSeguro; ?> </th>
        </tr>
    </table>

    
    <br>


</page>