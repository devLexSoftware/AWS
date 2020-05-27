 <?php
include("../../../config/conexion.php");
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

<!-- Contenido de la página, esto varia dependiendo del modulo-->
<div class="" role="">
        <!-- top tiles for works-->

      <div class="x_content" >
        <ul class="nav nav-pills">
          <li class="active"><a href="index.php">Home</a></li>
          <li><a href="index.php?p=cotizaciones">Cotizaciones</a></li>
          <li><a href="index.php?p=obras">Listado de obras</a></li>                    
          <li><a href="index.php?p=clientes">Clientes</a></li>
          <li><a href="index.php?p=compras">Compras</a></li>
          <li><a href="index.php?p=proveedores">Proveedores</a></li>
          <li><a href="#">Empleados</a></li>
          <li><a href="#">Grupos</a></li>
        </ul>
      </div>
      <hr>
      <br>      
<hr>
</div>
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
        
        <!-- Begin carousel --> 
        <div class="col-md-12 col-sm-12 col-xs-12">
              <div id="myCarousel" class="carousel slide" data-ride="carousel"> 
                <ol class="carousel-indicators">
                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#myCarousel" data-slide-to="1"></li>
                  <li data-target="#myCarousel" data-slide-to="2"></li>
                  <li data-target="#myCarousel" data-slide-to="3"></li>
                </ol>
 
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="pictures/c1.PNG">
                  </div>

                  <div class="item">
                    <img src="pictures/c2.PNG">
                  </div>

                  <div class="item">
                    <img src="pictures/c3.PNG">
                  </div>

                  <div class="item">
                    <img src="pictures/c4.PNG">
                  </div>
                </div>

                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left"></span>
                  <span class="sr-only">Previous</span>
                </a>

                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            </div>
            <!-- End carousel -->