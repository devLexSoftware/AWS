<?php
include("../../../config/conexion.php");
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else {
    $result = mysqli_query($con,"SELECT * FROM obras where estado = 0;");    
}
?>


<!--Table begin-->
  <table id="datatable" class="table table-striped table-bordered">
      <thead>
          <tr>
          <th>Código de Obra</th>
              <th>Nombre de la Obra</th>
              <th>Cliente</th>
              <th>Dirección</th>
              <th>Cuidad</th>
              <th>Avance de la Obra</th>              
              <th>Opciones</th>    
          </tr>
      </thead>

      <tbody>
      <?php
        while($elemento = mysqli_fetch_array($result)){
          $direccion = $elemento[calle].", ".$elemento[numExt].", ".$elemento[colonia].", ".$elemento[ciudad];
            echo '
            <tr>
            <td>'.$elemento[identificador].'</td>            
            <td>'.$elemento[nombre].'</td>            
            <td>'.$elemento[cliente].'</td>            
            <td>'.$elemento[direccion].'</td>            
            <td>'.$elemento[ciudad].'</td>     
            <td>'.$elemento[avance].'</td>                            
            <td><button type="button" id="mostrar" name="boton1"  class="btn btn-primary btn-sm">
            <a style="text-decoration: none; text-align:center; color: white; " href="index.php?p=optionObras&ref='.$elemento[id].'"> Editar</a>
        </button>
    </td>  
            </tr>
            ';
        }
        ?>       
      </tbody>
  </table>