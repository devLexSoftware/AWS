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

    $result = mysqli_query($con,"SELECT o.nombre as obra, g.nombre, a.semana, a.periodoInicial, a.periodoFinal, a.id from asistencias a inner join obras o on a.fk_obra = o.id inner join grupos g on a.fk_grupo = g.id where a.estado = '0' ORDER BY id DESC limit 2;");    
    
}
?>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Obra</th>
            <th>Grupo</th>
            <th>Semana</th>                    
            <th>Fecha Inicial</th>
            <th>Fecha Final</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
      <?php
      while($elemento = mysqli_fetch_array($result)){      
        echo '
        <tr>
            <td>'.$elemento[obra].'</td>
            <td>'.$elemento[nombre].'</td>
            <td>'.$elemento[semana].'</td>
            <td>'.$elemento[periodoInicial].'</td>
            <td>'.$elemento[periodoFinal].'</td>            
            <td><button type="button" id="mostrar" name="boton1"  class="btn btn-primary btn-sm">
                        <a style="text-decoration: none; text-align:center; color: white; " href="index.php?p=optionAsistencias&ref='.$elemento[id].'"> Editar</a>
                    </button>
                </td>
        </tr>
        ';
      }
       ?>
    </tbody>
</table>
