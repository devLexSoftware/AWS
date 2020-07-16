<?php
include("../../../config/conexion.php");
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else {
    $result =  mysqli_query($con,"SELECT compras.id, compras.descripcion, compras.fecha, compras.frente, compras.semana,
    compras.numero, compras.unidad, compras.factura, compras.costo, compras.cantidad, compras.importe, compras.subtotal, compras.iva, compras.fechInicial, compras.fechFinal,
    compras.comentario FROM compras order by compras.id desc limit 3;");


}
?>

<table id="datatable23" class="table table-striped table-bordered">
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
            <th>Subtotal</th>
            <th>IVA</th>
            <th>Importe</th>
            <th>Costo</th>
        </tr>
    </thead>

    <tbody>
    <?php
     while($elemento = mysqli_fetch_array($result)){
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
            
            <td>'.$elemento[subtotal].'</td>
            <td>'.$elemento[iva].'</td>
            <td>'.$elemento[importe].'</td>
            <td>'.$elemento[costo].'</td>
        </tr>
        ';
       }
    ?>
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function() {
      $('#datatable2').DataTable();
    } );
</script>
