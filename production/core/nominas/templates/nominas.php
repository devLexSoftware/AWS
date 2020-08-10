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

    $result = mysqli_query($con,"SELECT * FROM obras where estado = 0");        
    $result02 = mysqli_query($con,"SELECT distinct categoria FROM empleados ");        
    $result03 = mysqli_query($con,"SELECT distinct categoria FROM contratistas");        
}
?>


<div role="main">
    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>N O M I N A</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_title form-group row">
                    <div class="col-md-2">
                        <h2>Checar nomina</h2>
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
                                                <select name="asis_obra" id="asis_obra" class="form-control" onchange="obtenerAsistencia(this.value,'asistenciasNominas')"> 
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
                                                <label for="Semana_Reporte">Semana:<span class="required">*</span></label>                                                
                                                <select name="asis_semana" id="asis_semana" class="form-control" onchange="obtenerListaEmpleados(this.value,'asistenciasListaNominas')"> 
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
                                                <input readonly  id="asis_id" name="asis_id" type="hidden"/>
                                            </div>                                            
                                            <div class="col-md-2">
                                                <label for="Semana_Reporte">Categoría Empleado:</label>
                                                <select name="asis_cateem" id="asis_cateem" class="form-control"> 
                                                <option value="todos">Todos</option>
                                                <?php 
                                                    while($elemento02 = mysqli_fetch_array($result02)){
                                                    echo '<option value="'.$elemento02["categoria"].'">'.$elemento02["categoria"].'</option>';
                                                }                                                
                                                ?>                                                
                                                </select>
                                            </div>                                               
                                            <div class="col-md-2">
                                                <label for="Semana_Reporte">Categoría Contratista:</label>
                                                <select name="asis_cateco" id="asis_cateco" class="form-control"> 
                                                <option value="todos">Todos</option>
                                                <?php 
                                                    while($elemento03 = mysqli_fetch_array($result03)){
                                                    echo '<option value="'.$elemento03["categoria"].'">'.$elemento03["categoria"].'</option>';
                                                }                                                
                                                ?>
                                                </select>
                                            </div>                                               
                                            <div class="col-md-2">
                                                <label for="Semana_Reporte">Opciones</label>                                                
                                                <input onclick="imprimirNomina()" class="form-control btn btn-info" value="Imprimir">                                                
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




<script src="../../../production/components/js/files/asistencias/general.js"></script>


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