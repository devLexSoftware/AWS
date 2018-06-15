 <?php
include("production/config/conexion.php");
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else {
    $result = mysqli_query($con,"SELECT sum(importe) as total, obras.nombre from compras inner join obras on compras.fk_obra = obras.id group by fk_obra limit 4;");   
}
?>


          <!-- top tiles for works-->
          <div class="row tile_count"> <!-- Code for total money -->

          <?php 
            while($elemento = mysqli_fetch_array($result)){
                echo '<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class=""></i>Compras totales</span>
                <div class="count">$'.$elemento["total"].'</div>
                <span class="count_bottom">De la obra: <i class="green">'.$elemento["nombre"].'</i></span>
              </div>';
            }
          ?>
            

                                                     
          </div>
          <!-- /top tiles -->
          <br />
          
        </div>