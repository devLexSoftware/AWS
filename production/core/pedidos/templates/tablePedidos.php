<?php
include("../../../config/conexion.php");
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else {
    $con -> set_charset("utf8");

    $result =  mysqli_query($con,"SELECT pedidos.id, pedidos.frente, pedidos.descripcion, pedidos.estado,  obras.nombre from pedidos
    inner join obras on pedidos.fk_obra = obras.id where pedidos.estatus=0 ORDER by pedidos.id DESC;");


}
?>

<table id="datatable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Opciones</th>
            <th>Obra</th>
            <th>Frente</th>
            <th>Descripción</th>
            <th>Estado</th>
        </tr>
    </thead>

    <tbody>
    <?php
     while($elemento = mysqli_fetch_array($result)){
        echo '
        <tr>
            <td><button type="button" id="mostrar" name="boton1"  class="btn btn-primary btn-sm">
                    <a style="text-decoration: none; text-align:center; color: white; " href="index.php?p=optionPedidos&ref='.$elemento[id].'"> Editar</a>
                </button>
            </td>
            <td>'.$elemento[nombre].'</td>            
            <td>'.$elemento[frente].'</td>
            <td>'.$elemento[descripcion].'</td>
            <td>'.$elemento[estado].'</td>            
        </tr>
        ';
       }
    ?>
    </tbody>
</table>