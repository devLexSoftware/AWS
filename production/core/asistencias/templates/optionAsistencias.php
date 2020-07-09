<?php
include("../../../config/conexion.php");
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else {

    $idAsistencia = $_GET["ref"];    
    $result = mysqli_query($con,"SELECT a.id, a.fk_obra, a.semana, a.periodoInicial, a.periodoFinal, a.fk_grupo, o.nombre from asistencias a INNER JOIN obras o on a.fk_obra = o.id WHERE a.id = '$idAsistencia';");    
    $elemento = mysqli_fetch_array($result);      

    $result2 = mysqli_query($con,"SELECT * FROM obras where estado = 0");        

}
?>






<div role="main">
    <div class="">

        <div class="page-title">
            <div class="row">
                <div class="col-md-10">
                    <h3>A S I S T E N C I A </h3>
                </div>
                <div class="col-md-2">
                    <input type="submit" class="form-control btn btn-danger" value="Borrar" data-toggle="modal" data-target="#deleteModal">
                </div>
            </div>  
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_title form-group row">
                    <div class="col-md-2">
                        
                    </div>                    
                </div>

                    <div class="x_content" id="target">
                        <br/>
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="production/core/asistencias/actions/updateAsistencias.php">
                                                                          
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
                                                <option value="<?php echo($elemento['fk_obra']); ?>"><?php echo($elemento['nombre']); ?></option>

                                                <?php 
                                                    while($elemento2 = mysqli_fetch_array($result2)){
                                                    echo '<option value="'.$elemento2["id"].'">'.$elemento2["nombre"].'</option>';
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
                                                <input value="<?php echo($elemento['semana']); ?>" type="number" id="asis_semana" name="asis_semana" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingresa la semana">
                                            </div>
                                            <div class="col-md-2">
                                                <label for="Semana_Reporte">Periodo Inicial:<span class="required">*</span></label>
                                                <input value="<?php echo($elemento['periodoInicial']); ?>" onchange="asignarFinal()" required class="form-control" id="fechInicial_Reporte" name="fechInicial_Reporte" placeholder="DD/MM/YYYY" type="text"/>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="Semana_Reporte">Periodo Final:<span class="required">*</span></label>
                                                <input value="<?php echo($elemento['periodoFinal']); ?>" required readonly class="form-control" id="fechFinal_Reporte" name="fechFinal_Reporte" placeholder="DD/MM/YYYY" type="text"/>
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
                                <input id="idAsistencia" name="idAsistencia" type ="hidden" value="<?php echo $idAsistencia?>"/>
                            </div>
                        </div>

                            
                        </form>
                    </div>
                  

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="modal fade" id="deleteModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="deleteModalLabel">Confirmar</h5>          
        </div>
        <div class="modal-body row">
          <div class="form-group col-md-12">
            <h4 class="sMargen">¿Esta seguro de borrar el registro?</p>
          </div>
        </div>
        <div class="modal-footer row">
        <div class="form-group col-md-2">
          <button class="btn btn-warning" type="button" data-dismiss="modal"  onclick="del('asistencias', '<?php echo $idAsistencia;?>')">Aceptar</button>
          </div>
          <div class="form-group col-md-2">
          <button class="btn btn-secundary" type="button" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div>




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

        var idAsistencia = $('#idAsistencia').val();

        $.ajax({
            type: 'POST', //aqui puede ser igual get
            url: '../../../production/core/grupos/actions/getDatos.php', //aqui va tu direccion donde esta tu funcion php
            data: { id: idAsistencia, tabla: "gruposActualizar" }, //aqui tus datos
            success: function(data) {
                
                $('#tablaAsistencas').html(data).fadeIn();

            },
            error: function(data) {
                alert("error");
            }
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
function limpiarCampos2(id, tipo)
{    

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
