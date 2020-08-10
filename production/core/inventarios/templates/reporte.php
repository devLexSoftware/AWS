<?php
include("../../../config/conexion.php");
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else {            
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
                        <h2>Imprimir inventario</h2>
                    </div>                    
                </div>

                    <div class="x_content" id="target"  >
                        <br/>                        
                                                                                                        

                            <div class="row" div="divInformacionNominas">
                                <div class="col-md-12 col-xs-12">
                                    <div class="x_content">                                        
                                        <div class="from-group row">
                                            
                                            <div class="col-md-2">
                                                <label for="Semana_Reporte">Opciones</label>
                                                <input onclick="imprimirReporte()" id="mostrar" name="boton1" value="Imprimir"  class="btn btn-info">                                                                                                    
                                            </div>
                                        </div>                                                                                
                                        <br>                                     
                                    </div>
                                </div>  
                            </div>


                    </div>
                    

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <hr>

        

    </div>
</div>



<script src="../../../production/components/js/files/inventarios/general.js"></script>

