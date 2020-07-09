<?php
include("../../../config/conexion.php");
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else {
    $result = mysqli_query($con,"SELECT * FROM frentes where estado = 0 ORDER BY id DESC limit 3;");    
}
?>


<!--Table begin-->
  <table id="" class="table table-striped table-bordered">
      <thead>
          <tr>
                <th>Nombre</th>                
                <th>Descripción</th>                
                <th>Opciones</th>    
          </tr>
      </thead>

      <tbody>
      <?php
        while($elemento = mysqli_fetch_array($result)){          
            echo '
            <tr>            
            <td>'.$elemento[nombre].'</td>            
            <td>'.$elemento[descripcion].'</td>                        
            <td><button type="button" id="mostrar" name="boton1"  class="btn btn-primary btn-sm">
            <a style="text-decoration: none; text-align:center; color: white; " href="index.php?p=optionFrentes&ref='.$elemento[id].'"> Editar</a>
                </button>
            </td>  
            </tr>
            ';
        }
        ?>       
      </tbody>
  </table>