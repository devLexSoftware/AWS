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
    // $result2 = mysqli_query($con,"SELECT distinct descripcion FROM compras where estado = 0");        
}
?>


<div role="main">
    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>C O M P R A S</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_title form-group row">
                    <div class="col-md-2">
                        <h2>Checar compras</h2>
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
                                                <select name="asis_obra" id="asis_obra" class="form-control" onchange="obtenerCompras(this.value,'comprasObra')"> 
                                                <option>Selecciona la obra</option>
                                                <?php 
                                                    while($elemento = mysqli_fetch_array($result)){
                                                    echo '<option value="'.$elemento["id"].'">'.$elemento["nombre"].'</option>';
                                                }                                                
                                                ?>
                                                </select>
                                            </div>                                           
                                        </div>                                                                                
                                        <br>                                     
                                    </div>
                                </div>  
                            </div>

                            <div class="row" div="divInformacionNominas">
                                <div class="col-md-12 col-xs-12">
                                    <div class="x_content">                                        
                                        <div class="from-group row">
                                            <div class="col-md-2">
                                                <label for="Semana_Reporte">Producto:<span class="required">*</span></label>                                                
                                                <select name="asis_producto" id="asis_producto" class="form-control" onchange="deshabilitar(this.value,'producto')"> 
                                                <option>Selecciona el producto</option>                                                                                                
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="Semana_Reporte">Proveedor:<span class="required">*</span></label>                                                
                                                <select name="asis_proveedor" id="asis_proveedor" class="form-control" onchange="deshabilitar(this.value, 'proveedor')"> 
                                                <option>Selecciona el proveedor</option>                                                
                                               
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="Semana_Reporte">Contratista:<span class="required">*</span></label>                                                
                                                <select name="asis_contratista" id="asis_contratista" class="form-control" onchange="deshabilitar(this.value, 'contratista')"> 
                                                <option>Selecciona el contratista</option>                                                
                                               
                                                </select>
                                            </div>                                        
                                        </div>                                                                                
                                        <br>                                     
                                    </div>
                                </div>  
                            </div>

                            <div class="row" div="divInformacionNominas">
                                <div class="col-md-12 col-xs-12">
                                    <div class="x_content">                                        
                                        <div class="from-group row">
                                            <div class="col-md-2">
                                                <label for="Semana_Reporte">Semana:<span class="required">*</span></label>                                                
                                                <select name="asis_semana" id="asis_semana" class="form-control" onchange="ajustarSemana(this.value,'asistenciasListaNominas')"> 
                                                <option>Selecciona la semana</option>                                                
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="Semana_Reporte">Periodo Inicial:<span class="required">*</span></label>
                                                <input readonly required class="form-control" id="fechInicial_Reporte" name="fechInicial_Reporte" placeholder="DD/MM/YYYY" type="text"/>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="Semana_Reporte">Periodo Final:<span class="required">*</span></label>
                                                <input readonly class="form-control" id="fechFinal_Reporte" name="fechFinal_Reporte" placeholder="DD/MM/YYYY" type="text"/>                                                
                                            </div>
                                            <div class="col-md-2">
                                            </div>
                                            <div class="col-md-2">
                                                <label for="Semana_Reporte">Opciones</label>                                                
                                                <input onclick="imprimirReporte()" class="form-control btn btn-info" value="Imprimir">                                                
                                            </div>                                
                                        </div>                                                                                
                                        <br>                                     
                                    </div>
                                </div>  
                            </div>


                            <div class="row" id="tablaAsistencas">
                                
                               

                            </div>


                            
                    </div>
                    

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>




<script src="../../../production/components/js/files/compras/general.js"></script>


<script>
    $(document).ready(function() {
    $('#fechInicial_Reporte').datepicker({
        autoclose: true,
        daysOfWeekDisabled: "0,2,3,4,5,6",
        format: 'dd-mm-yyyy'//check change

    });
    $('#fechFinal_Reporte').datepicker({
        autoclose: true,
        daysOfWeekDisabled: "1,2,3,4,5,6",
        format: 'dd-mm-yyyy'//check change
    });
});
</script>

<script type="text/javascript">
    function asignarFinal(){
      var fecha = $("#fechInicial_Reporte").datepicker("getDate");
      fecha.setDate(fecha.getDate() + 6);
      $("#fechFinal_Reporte").datepicker("setDate", fecha);
    }
</script>


<script type="text/javascript">
    $(document).ready(function() {
      $('#datatable').DataTable();
    } );
</script>