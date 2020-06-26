<?php
include("../../../config/conexion.php");
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else {
    $result = mysqli_query($con,"SELECT * FROM proveedores WHERE estado = 0 ORDER BY id DESC limit 2;");    
}
?>

<!--Table begin-->
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Nombre del Proveedor</th>
            <th>Dirección</th>
            <th>Teléfono Celular</th>
            <th>Teléfono de Oficina</th>
            <th>Correo</th>
            <th>Empresa / Negocio</th>
            <th>RFC</th>
            <th>Opciones</th>     
        </tr>
    </thead>

    <tbody>
        <?php
        while($elemento = mysqli_fetch_array($result)){
            echo '
            <tr>
                <td>'.$elemento[proveedor].'</td>            
                <td>'.$elemento[direccion].'</td>            
                <td>'.$elemento[contacto1].'</td>            
                <td>'.$elemento[contacto2].'</td>            
                <td>'.$elemento[email].'</td>            
                <td>'.$elemento[empresa].'</td>
                <td>'.$elemento[rfc].'</td>       
                <td><button type="button" id="mostrar" name="boton1"  class="btn btn-primary btn-sm">
                        <a style="text-decoration: none; text-align:center; color: white; " href="index.php?p=optionProveedores&ref='.$elemento[id].'"> Editar</a>
                    </button>
                </td>     
            </tr>
            ';
        }
        ?>        
    </tbody>
</table>
