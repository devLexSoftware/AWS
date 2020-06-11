<?php
include("../../../config/conexion.php");
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else {
    $result = mysqli_query($con,"SELECT * FROM grupos where estado = 0");    
    
}
?>

<table id="datatable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Nombre del grupo</th>
            <th>Nota</th>
            <th>N° Empleados</th>                    
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
      <?php
      while($elemento = mysqli_fetch_array($result)){
        $result2 = mysqli_query($con,"select count(fk_empleado) as count from grupos_empleados where fk_grupo = $elemento[id] and estado = '0';");
        $elemento2 = mysqli_fetch_array($result2);
        echo '
        <tr>
            <td>'.$elemento[nombre].'</td>
            <td>'.$elemento[nota].'</td>
            <td>'.$elemento2[count].'</td>            
            <td><button type="button" id="mostrar" name="boton1"  class="btn btn-primary btn-sm">
                        <a style="text-decoration: none; text-align:center; color: white; " href="index.php?p=optionGrupos&ref='.$elemento[id].'"> Editar</a>
                    </button>
                </td>
        </tr>
        ';
      }
       ?>
    </tbody>
</table>
