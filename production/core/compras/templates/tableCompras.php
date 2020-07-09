<?php
include("../../../config/conexion.php");
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else {
  //  $fechInicio = $_GET['ini'];
  //  $fechFinal  = $_GET['fin'];
    $obra       = $_GET['obra'];
    $datos = array();
    $datos3 = array();
    $datos4 = array();

    $result =  mysqli_query($con,"SELECT compras.id, compras.descripcion, compras.fecha, compras.frente, compras.semana,
    compras.numero, compras.unidad, compras.factura, compras.costo, compras.cantidad, compras.importe, compras.subtotal, compras.iva, compras.fechInicial, compras.fechFinal,
    compras.comentario, proveedores.proveedor FROM compras INNER JOIN proveedores on proveedores.id = compras.fk_proveedor WHERE fk_obra = '$obra' "); //AND fecha between '$fechInicio' AND '$fechFinal';");

    $result2 = mysqli_query($con,"SELECT factura, SUM(importe) as total FROM compras WHERE fk_obra = '$obra' GROUP BY factura");
    while($elemento2 = mysqli_fetch_array($result2)){
        $datos[] = $elemento2;
    }
    $result3 = mysqli_query($con,"SELECT frente, SUM(importe) as total FROM compras WHERE fk_obra = '$obra' GROUP BY frente");
    while($elemento3 = mysqli_fetch_array($result3)){
        $datos3[] = $elemento3;
    }
    $result4 = mysqli_query($con,"SELECT semana, SUM(importe) as total FROM compras WHERE fk_obra = '$obra' GROUP BY semana");
    while($elemento4 = mysqli_fetch_array($result4)){
        $datos4[] = $elemento4;
    }
    $result5= mysqli_query($con,"SELECT SUM(importe) as total FROM compras WHERE fk_obra = '$obra'");
    $elemento5 = mysqli_fetch_array($result5);
}
?>

<h5>Total de la obra: $ <?php echo $elemento5[total];?></h5>
<table id="datatable3" class="table table-striped table-bordered" >
    <thead>
        <tr>
            <th>Opciones</th>
            <th>Semana</th>
            <th>Periodo de fechas</th>
            <th>Cantidad</th>
            <th>Descripcion</th>
            <th>Unidad</th>
            <th>Frente</th>
            <th>Fecha compra</th>
            <th>Factura</th>
            <th>Proveedor</th>
            <th>Subtotal</th>
            <th>IVA</th>
            <th>Importe</th>
            <th>Costo Unitario</th>
            <th>Total Factura</th>
            <th>Total Frente</th>
            <th>Total Semana</th>
        </tr>
    </thead>

    <tbody style="font-size:10px;">
    <?php
    $local = "";
    $count = 0;
     while($elemento = mysqli_fetch_array($result)){
       if($count == 0){
         $local = $elemento[fechInicial]."-".$elemento[fechFinal];
         $count = 1;
        echo '
        <tr>
            <td><button type="button" id="mostrar" name="boton1"  class="btn btn-primary btn-sm">
                    <a style="text-decoration: none; text-align:center; color: white; " href="index.php?p=optionCompras&ref='.$elemento[id].'"> Editar</a>
                </button>
            </td>
            <td>'.$elemento[semana].'</td>
            <td>'.$elemento[fechInicial].' al '.$elemento[fechFinal].'</td>
            <td>'.$elemento[cantidad].'</td>
            <td>'.$elemento[descripcion].'</td>
            <td>'.$elemento[unidad].'</td>
            <td>'.$elemento[frente].'</td>
            <td>'.$elemento[fecha].'</td>
            <td>'.$elemento[factura].'</td>
            <td>'.$elemento[proveedor].'</td>
            <td>'.$elemento[subtotal].'</td>
            <td>'.$elemento[iva].'</td>
            <td>'.$elemento[importe].'</td>
            <td>'.$elemento[costo].'</td>
            ';
            foreach($datos as $valor){
                if($elemento[factura] == $valor[0]){
                    echo '<td>$'.$valor[1].'</td>';
                    break;
                }
            }
            foreach($datos3 as $valor){
                if($elemento[frente] == $valor[0]){
                    echo '<td>$'.$valor[1].'</td>';
                    break;
                }
            }
            foreach($datos4 as $valor){
                if($elemento[semana] == $valor[0]){
                    echo '<td>$'.$valor[1].'</td>';
                    break;
                }
            }
            echo '
        </tr>
        ';
       }
       else if($local == $elemento[fechInicial]."-".$elemento[fechFinal]){
         echo '
         <tr>
            <td><button type="button" id="mostrar" name="boton1"  class="btn btn-primary btn-sm">
                <a style="text-decoration: none; text-align:center; color: white; " href="index.php?p=optionCompras&ref='.$elemento[id].'"> Editar</a>
                </button>
            </td>
             <td>'.$elemento[semana].'</td>
             <td>'.$elemento[fechInicial].' al '.$elemento[fechFinal].'</td>
             <td>'.$elemento[cantidad].'</td>
             <td>'.$elemento[descripcion].'</td>
             <td>'.$elemento[unidad].'</td>
             <td>'.$elemento[frente].'</td>
             <td>'.$elemento[fecha].'</td>
             <td>'.$elemento[factura].'</td>
             <td>'.$elemento[proveedor].'</td>
             <td>'.$elemento[subtotal].'</td>
             <td>'.$elemento[iva].'</td>
             <td>'.$elemento[importe].'</td>
             <td>'.$elemento[costo].'</td>
             ';
             foreach($datos as $valor){
                 if($elemento[factura] == $valor[0]){
                     echo '<td>$'.$valor[1].'</td>';
                     break;
                 }
             }
             foreach($datos3 as $valor){
                 if($elemento[frente] == $valor[0]){
                     echo '<td>$'.$valor[1].'</td>';
                     break;
                 }
             }
             foreach($datos4 as $valor){
                 if($elemento[semana] == $valor[0]){
                     echo '<td>$'.$valor[1].'</td>';
                     break;
                 }
             }
             echo '
         </tr>
         ';
       }
       else {
         echo "<tr><td></td></tr>";
         echo '
         <tr>
            <td><button type="button" id="mostrar" name="boton1"  class="btn btn-primary btn-sm">
                <a style="text-decoration: none; text-align:center; color: white; " href="index.php?p=optionCompras&ref='.$elemento[id].'"> Editar</a>
                </button>
            </td>
             <td>'.$elemento[semana].'</td>
             <td>'.$elemento[fechInicial].' al '.$elemento[fechFinal].'</td>
             <td>'.$elemento[cantidad].'</td>
             <td>'.$elemento[descripcion].'</td>
             <td>'.$elemento[unidad].'</td>
             <td>'.$elemento[frente].'</td>
             <td>'.$elemento[fecha].'</td>
             <td>'.$elemento[factura].'</td>
             <td>'.$elemento[proveedor].'</td>
             <td>'.$elemento[subtotal].'</td>
             <td>'.$elemento[iva].'</td>
             <td>'.$elemento[importe].'</td>
             <td>'.$elemento[costo].'</td>
             ';
             foreach($datos as $valor){
                 if($elemento[factura] == $valor[0]){
                     echo '<td>$'.$valor[1].'</td>';
                     break;
                 }
             }
             foreach($datos3 as $valor){
                 if($elemento[frente] == $valor[0]){
                     echo '<td>$'.$valor[1].'</td>';
                     break;
                 }
             }
             foreach($datos4 as $valor){
                 if($elemento[semana] == $valor[0]){
                     echo '<td>$'.$valor[1].'</td>';
                     break;
                 }
             }
             echo '
         </tr>
         ';
         $local = $elemento[fechInicial]."-".$elemento[fechFinal];
       }
    }
    ?>
    </tbody>
</table>

