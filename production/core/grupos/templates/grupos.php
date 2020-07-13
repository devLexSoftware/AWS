<?php
include("../../../config/conexion.php");
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else {        
    $result = mysqli_query($con,"SELECT * FROM empleados where estado = 0");    
    $result2 = mysqli_query($con,"SELECT * FROM contratistas where estado = 0");    
}
?>


<!-- Page content -->
<div role="main">
    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>G R U P O S</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_title form-group row">
                    <div class="col-md-2">
                        <h2>Nuevo Grupo</h2>
                    </div>
                    <div class="col-md-2">
                    <button type="button" id="mostrar" name="boton1"  class="btn btn-info">Nuevo Grupo</button>
                    </div>
                </div>

                    <div class="x_content" id="target" style="display: none;">
                        <br/>
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="production/core/grupos/actions/addGrupos.php">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label>Nombre del grupo:<span class="required">*</span></label>
                                    <input type="text" required="required" id="Grp_Nombre" name="Grp_Nombre" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el nombre del grupo">
                                </div>    
                                <div class="col-md-6">
                                    <label >Notas:</label>
                                    <textarea class="form-control" name="Grp_Nota" id="Grp_Nota" rows="1" cols="50"></textarea>  
                                </div>                                
                            </div>                                                        
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div class="x_content">
                                        <div class="from-group row">
                                            <div class="col-md-3">
                                                <h2>Empleados</h2>
                                            </div>
                                        </div>
                                        <div class="from-group row">
                                            <div class="col-md-7">
                                                <select name="empleados" id="empleados" class="form-control"> 
                                                <?php 
                                                    while($elemento = mysqli_fetch_array($result)){
                                                    echo '<option value="'.$elemento["id"].'">'.$elemento["nombre"].'</option>';
                                                }                                                
                                                ?>
                                                </select>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" onclick="addDetalles('empleados')" class="btn btn-success"> Agregar</button>
                                            </div>
                                            <div class="col-md-1">
                                                <input id="detalleCantidad" name="detalleCantidad" readonly class="form-control" value="0">
                                            </div>
                                        </div>
                                        <br>
                                        <div style="overflow-x:auto;">
                                            <table id="tableDetalles" class="table table-striped table-bordered" >
                                                <thead>
                                                    <tr>
                                                        <th>Empleado</th>            
                                                        <th>Seleccionado</th>                                                    
                                                    </tr>
                                                </thead>
                                                <tbody style="">                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        <br>                                     
                                    </div>
                                </div>  
                            </div>




                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div class="x_content">
                                        <div class="from-group row">
                                            <div class="col-md-3">
                                                <h2>Contratistas</h2>
                                            </div>
                                        </div>
                                        <div class="from-group row">
                                            <div class="col-md-7">
                                                <select name="contratistas" id="contratistas" class="form-control"> 
                                                <?php 
                                                    while($elemento2 = mysqli_fetch_array($result2)){
                                                    echo '<option value="'.$elemento2["id"].'">'.$elemento2["identificador"].'</option>';
                                                }                                                
                                                ?>
                                                </select>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" onclick="addDetalles('contratistas')" class="btn btn-success"> Agregar</button>
                                            </div>
                                            <div class="col-md-1">
                                                <input id="detalleCantidad2" name="detalleCantidad2" readonly class="form-control" value="0">
                                            </div>
                                        </div>
                                        <br>
                                        <div style="overflow-x:auto;">
                                            <table id="tableDetalles2" class="table table-striped table-bordered" >
                                                <thead>
                                                    <tr>
                                                        <th>Contratista</th>            
                                                        <th>Seleccionado</th>                                                    
                                                    </tr>
                                                </thead>
                                                <tbody style="">                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        <br>
                                        <div class="form-group row">
                                            <div class="col-md-10 col-sm-10 col-xs-10 "></div>
                                            <div class="col-md-2 col-sm-2 col-xs-2 ">
                                                <button type="submit" class="btn btn-success"> Guardar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </form>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_content">                                                                       
                                <h4>Mis grupos</h4>
                                    <?php
                                        include("tableGrupos.php");
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
<!-- /page content -->


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
                $("#mostrar").text("Nuevo Grupo");
                n = 0;
            }
        });
    });
</script>

<script src="../../../production/components/js/files/grupos/general.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
      $('#datatable').DataTable();
    } );
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
        if(vars['p'] == "gruposOk"){            
            $('#modal').modal('show');
        }    
        else if(vars['p'] == "gruposDel"){
            $('#modalDel').modal('show');
        }            
      });
</script>