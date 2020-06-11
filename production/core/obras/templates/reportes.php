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

    $result0 = mysqli_query($con,"SELECT imagen from fotos_detalles_obras
    where fk_detalle_obra = 1;");  
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
                        <h2>Checar avance de la obra </h2>
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
                                                <select name="asis_obra" id="asis_obra" class="form-control" onchange="obtenerAvances(this.value,'detallesObras')"> 
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
                                            </div>
                                            <div class="col-md-2">
                                                <label for="Semana_Reporte">Opciones:<span class="required">*</span></label>
                                                <button type="button" onclick="imprimirReporte()" id="mostrar" name="boton1"  class="btn btn-info">                                                    
                                                Imprimir</utton>
                                            </div>
                                        </div>                                                                                
                                        <br>                                     
                                    </div>
                                </div>  
                            </div>


                            <div class="row" id="tablaAsistencas">
                                       <?php
                                            while($row = $result0->fetch_array(MYSQLI_ASSOC)) {
                                             print_r($row);
                                             echo '<img  width="400"  src="data:image/jpeg;base64,'.base64_encode( $row[imagen] ).'"/>';
                                             echo '<img src="'.$row[imagen].'"/>';
                                            }

                                       ?>
                            </div>
                            
                    </div>
                    

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="../../../production/components/js/files/obras/general.js"></script>


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
var n = 0;
 $(document).ready(function() {
        $('#mostrar').click(function() {
            $('#target').slideToggle("fast");
            if(n == 0){
                $("#mostrar").text("Ocultar formulario");
                n = 1;
            }
            else{
                $("#mostrar").text("Mostrar formulario");
                n = 0;
            }
        });
    });
</script>

<script type="text/javascript"> 
     $(document).ready(function(){
        query=window.location.search.substring(1);
        q=query.split("&");
        vars=[];
        for(i=0;i<q.length;i++){
          x=q[i].split("=");
          k=x[0];
          v=x[1];
          vars[k]=v;
        }
        if(vars['p'] == "asistenciasOk"){            
            $('#modal').modal('show');
        }    
        else if(vars['p'] == "asistenciasDel"){
            $('#modalDel').modal('show');
        }            
      });
</script>

<script type="text/javascript">
    $(document).ready(function() {
      $('#datatable').DataTable();
    } );
</script>