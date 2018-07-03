<?php
include("../../../config/conexion.php");
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else {
    $result = mysqli_query($con,"SELECT * FROM cotizaciones  where estado = 0 ORDER BY id DESC limit 2;");    
}
?>

<!--Table begin-->
<table class="table table-striped table-bordered">
    <thead>
        <tr>            
            <th>Cliente</th>
            <td>Obra</td>
            <td>Frente</td>
            <td>Costo Total</td>
            <td>Inicio</td>
            <td>Entrega</td>
            <th>Opciones</th>   
        </tr>
    </thead>

    <tbody>
    <?php
        while($elemento = mysqli_fetch_array($result)){
            echo '
        <tr>
            <td>'.$elemento[cliente].'</td>            
            <td>'.$elemento[obra].'</td>            
            <td>'.$elemento[frente].'</td>            
            <td>'.$elemento[total].'</td>            
            <td>'.$elemento[inicio].'</td>                                    
            <td>'.$elemento[entrega].'</td>                 
            <td><button type="button" id="mostrar" name="boton1"  class="btn btn-primary btn-sm">
            <a style="text-decoration: none; text-align:center; color: white; " href="index.php?p=optionCotizaciones&ref='.$elemento[id].'"> Editar</a>
        </tr>
        ';
    }
    ?>
    </tbody>
</table>                                