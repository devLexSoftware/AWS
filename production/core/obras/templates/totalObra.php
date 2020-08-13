<?php
include("../../../config/conexion.php");
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else {        
    $result = mysqli_query($con,"SELECT * FROM obras where estado = 0");            
}
?>


<div role="main">
    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>R E P O R T E  </h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_title form-group row">
                    <div class="col-md-2">
                        <h2>Gastos de la obra</h2>
                    </div>                    
                </div>

                    <div class="x_content" id="target"  >
                        <br/>                        
                                                                             
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div class="x_content">
                                        <div class="from-group row">
                                            <div class="col-md-3">
                                                <h2>Obra</h2>
                                            </div>
                                        </div>
                                        <div class="from-group row">
                                            <div class="col-md-6">
                                                <select name="asis_obra" id="asis_obra" class="form-control" onchange="obtenerTotal(this.value,'totalSemanas')"> 
                                                <option>Selecciona la obra</option>
                                                <?php 
                                                    while($elemento = mysqli_fetch_array($result)){
                                                    echo '<option value="'.$elemento["id"].'">'.$elemento["nombre"].'</option>';
                                                }                                                
                                                ?>
                                                </select>
                                            </div>   
                                            <div class="col-md-4"></div>   
                                            <div class="col-md-2">
                                                <label for="Semana_Reporte">Opciones</label>
                                                
                                                <input onclick="guardarPagos()" class="form-control btn btn-info" value="Imprimir">
                                                
                                            </div>                                            
                                        </div>                                                                                
                                        <br>                                     
                                    </div>
                                </div>  
                            </div>


                            <div class="row" id="tablaTotal">
                                
                               

                            </div>    
                    </div>
                    

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <hr>

        

    </div>
</div>



<script src="../../../production/components/js/files/obras/general.js"></script>

