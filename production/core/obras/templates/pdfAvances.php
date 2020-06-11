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

    $result = mysqli_query($con,"SELECT a.id, o.nombre, a.fechCreacion, a.periodoInicial, a.periodoFinal, a.semana, a.comentario as detalles, a.avance from detalles_obras a
                                inner join obras o on a.fk_obra = o.id
                                where a.fk_obra = $id order by a.fechCreacion");
    
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $myArray[] = $row;
    }

}


?>



<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="UTF-8"/>
        <title>Generar PDF con PHP</title>
        <style type="text/css">
        #cabecera{
            background:#eee;
            padding:20px;
        }
        h2,h3{
            float:left;
        }
        #cabecera img{
            width: 140px;
            float:right;
        }
        </style>
    </head>
    <body>
        <div>
            <table style="width: 100%;border: solid 3px #5544DD" >
                <tr>            
                    <td style="width: 40%; text-align: center;"><br><i>légende</i></td>
                    <td style="width: 60%; text-align: center; ">
                        <table style="width: 100%;border: solid 3px #5544DD" >
                            <tr>
                                <td style="width: 100%; text-align: center;"><b>Semana: </b><?php echo $myArray[0][periodoInicial].' al '.$myArray[0][periodoFinal]; ?></td>            
                            </tr>
                            <tr>
                                <td style="width: 100%; text-align: center;"><b>Proyecto: </b><?php echo $myArray[0][nombre]; ?></td>            
                            </tr>
                        </table>
                    </td>            
                </tr>    
            </table>  
        </div> 
        <br>
        <br>
        <div>

        <?php

            foreach ($myArray as $value) {                    

                $new_date = date("d-m-Y",strtotime($value[fechCreacion]));                


                $result2 = mysqli_query($con,"SELECT imagen from fotos_detalles_obras
                            where fk_detalle_obra = $value[id];");  

                ?>

                <table style="width: 100%;border: solid 3px #5544DD; font-size:16px;" >
                    <tr>            
                        <td style="width: 100%; text-align: right;"><b>Reporte de obra <?php echo $new_date; ?></b></td>
                        
                    </tr>    
                    <tr>            
                        <td style="width: 100%; text-align: justify;"><p><?php echo $value[detalles]; ?></p></td>                        
                    </tr>    

                    <tr> 
                        <?php

                            while($row2 = $result2->fetch_array(MYSQLI_ASSOC)) { 

                                $img_base64_encoded = $row2[imagen];
                                $imageContent = file_get_contents($img_base64_encoded);
                                $path = tempnam(sys_get_temp_dir(), 'prefix');
                                file_put_contents ($path, $imageContent);
                                echo '                            
                                            
                                        <td style="width: 100%; ">
                                            <img style="width:200px;" src="'.$path.'"/>
                                        </td>                        
                            
                                ';
                        
                            }

                        ?>
                    </tr>   

                </table>                  

            <?php
            }
        ?>


        </div>


        
    <div >        
       <p style="text-align: center;">Arq. Norberto Morales González</p>       
       <p style="text-align: center;">Tel. (462) 265 0531 brake_premier@hotmail.com</p>
       <p style="text-align: center;">Paseo del Altiplanicie 3, Interior 6, Irapuato Guanajuato</p>
    </div>
 <!-- <br><br>
    <p>Lista ordenada:
        <ol>
            <li>PHP</li>
            <li>Python</li>
            <li>Ruby</li>
            <li>Java</li>
        </ol>
    </p> -->
    </body>
</html>
