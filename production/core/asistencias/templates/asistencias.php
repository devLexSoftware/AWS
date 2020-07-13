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
                <h3>A S I S T E N C I A S</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_title form-group row">
                    <div class="col-md-2">
                        <h2>Nueva Asistencia</h2>
                    </div>
                    <div class="col-md-2">
                    <button type="button" id="mostrar" name="boton1"  class="btn btn-info">Nueva Relación de Asistencias</button>
                    </div>
                </div>

                    <div class="x_content" id="target"  style="display: none;">
                        <br/>
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="production/core/asistencias/actions/addAsistencias.php">
                                                                             
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
                                                <select name="asis_obra" id="asis_obra" class="form-control" onchange="obtenerEquipos(this.value,'grupos')"> 
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

                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div class="x_content">                                        
                                        <div class="from-group row">
                                            <div class="col-md-2">
                                                <label for="Semana_Reporte">Semana:<span class="required">*</span></label>
                                                <input type="number" id="asis_semana" name="asis_semana" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingresa la semana">
                                            </div>
                                            <div class="col-md-2">
                                                <label for="Semana_Reporte">Periodo Inicial:<span class="required">*</span></label>
                                                <input autocomplete="off" onchange="asignarFinal()" required class="form-control" id="fechInicial_Reporte" name="fechInicial_Reporte" placeholder="DD/MM/YYYY" type="text"/>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="Semana_Reporte">Periodo Final:<span class="required">*</span></label>
                                                <input autocomplete="off" required readonly class="form-control" id="fechFinal_Reporte" name="fechFinal_Reporte" placeholder="DD/MM/YYYY" type="text"/>
                                            </div>
                                        </div>                                                                                
                                        <br>                                     
                                    </div>
                                </div>  
                            </div>


                            <div class="row" id="tablaAsistencas">                                
                            </div>                            


                            <div class="form-group row">
                            <div class="col-md-10">                           
                            </div>
                            <div class="col-md-2">
                                <label > Da click para</label>
                                <input type="submit" class="form-control btn btn-success" value="Guardar">
                            </div>
                        </div>

                            
                        </form>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_content">
                                    <h3>Ultimas asistencias agregadas</h3>
                                    <?php
                                        include("tableAsistenciasNuevas.php");
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_content">                                                                       
                                <h4>Mis grupos</h4>
                                    <?php
                                        include("tableAsistencias.php");
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal de satisfactorio -->
<div class="modal fade" id="modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="">Exito</h3>          
        </div>
        <div class="modal-body row">
          <div class="form-group col-md-12">
            <h4 class="sMargen">Se actualizo el registro correctamente</h4>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-warning" type="button" data-dismiss="modal">Aceptar</button>          
        </div>
      </div>
    </div>
  </div>
 <!-- /Modal de satisfactorio -->

 <!-- Modal de satisfactorio -->
 <div class="modal fade" id="modalDel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="">Exito</h3>          
        </div>
        <div class="modal-body row">
          <div class="form-group col-md-12">
            <h4 class="sMargen">Se borro el registro seleccionado</h4>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-warning" type="button" data-dismiss="modal">Aceptar</button>          
        </div>
      </div>
    </div>
  </div>
 <!-- /Modal de satisfactorio -->



<script src="../../../production/components/js/files/grupos/general.js"></script>


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
      fecha.setDate(fecha.getDate() + 5);
      $("#fechFinal_Reporte").datepicker("setDate", fecha);
    }
</script>

<script type="text/javascript">
var n = 0;
 $(document).ready(function() {
        $('#mostrar').click(function() {
            $('#target').slideToggle("fast");
            if(n == 0){
                $("#mostrar").text("Ocultar");
                n = 1;
            }
            else{
                $("#mostrar").text("Nueva Relación de Asistencias");
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


<script type="text/javascript">
function limpiarCampos(id, tipo)
{    
    debugger;
    if(tipo == 1)
    {
        var lunes = document.getElementsByName('empleado_dia_1_'+id);
        lunes.forEach(element => {
            element.checked = false;
        });
        var martes = document.getElementsByName('empleado_dia_2_'+id);
        martes.forEach(element => {
            element.checked = false;
        });
        var miercoles = document.getElementsByName('empleado_dia_3_'+id);
        miercoles.forEach(element => {
            element.checked = false;
        });
        var jueves = document.getElementsByName('empleado_dia_4_'+id);
        jueves.forEach(element => {
            element.checked = false;
        });
        var viernes = document.getElementsByName('empleado_dia_5_'+id);
        viernes.forEach(element => {
            element.checked = false;
        });
        var sabado = document.getElementsByName('empleado_dia_6_'+id);
        sabado.forEach(element => {
            element.checked = false;
        });

    }
    else if(tipo == 2)
    {
        var lunes = document.getElementsByName('contratista_dia_1_'+id);
        lunes.forEach(element => {
            element.checked = false;
        });
        var martes = document.getElementsByName('contratista_dia_2_'+id);
        martes.forEach(element => {
            element.checked = false;
        });
        var miercoles = document.getElementsByName('contratista_dia_3_'+id);
        miercoles.forEach(element => {
            element.checked = false;
        });
        var jueves = document.getElementsByName('contratista_dia_4_'+id);
        jueves.forEach(element => {
            element.checked = false;
        });
        var viernes = document.getElementsByName('contratista_dia_5_'+id);
        viernes.forEach(element => {
            element.checked = false;
        });
        var sabado = document.getElementsByName('contratista_dia_6_'+id);
        sabado.forEach(element => {
            element.checked = false;
        });

    }

    
    
}
</script>