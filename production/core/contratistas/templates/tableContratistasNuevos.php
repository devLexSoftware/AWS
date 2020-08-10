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

    $result = mysqli_query($con,"SELECT * FROM contratistas where estado = 0 ORDER BY id DESC limit 3;");    
}
?>


<!--Table begin-->
  <table id="datatable" class="table table-striped table-bordered">
      <thead>
          <tr>
                <th>Identificador</th>                
                <th>Encargado</th>
                <th>Frente</th>                
                <th>Empresa</th>
                <th>Móvil</th>              
                <th>Email</th>              
                <th>Opciones</th>    
          </tr>
      </thead>

      <tbody>
      <?php
        while($elemento = mysqli_fetch_array($result)){          
            echo '
            <tr>            
            <td>'.$elemento[identificador].'</td>            
            <td>'.$elemento[encargado].'</td>            
            <td>'.$elemento[frente].'</td>            
            <td>'.$elemento[empresa].'</td>     
            <td>'.$elemento[movil].'</td>                            
            <td>'.$elemento[email].'</td>                            
            <td><button type="button" id="mostrar" name="boton1"  class="btn btn-primary btn-sm">
            <a style="text-decoration: none; text-align:center; color: white; " href="index.php?p=optionContratistas&ref='.$elemento[id].'"> Editar</a>
                </button>
            </td>  
            </tr>
            ';
        }
        ?>       
      </tbody>
  </table>