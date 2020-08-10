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

    $result = mysqli_query($con,"SELECT * FROM contratistas WHERE estado = 0;");            

}
?>

<!-- Page content -->
<div class="">

    <div class="page-title">
        <div class="title_left">
            <h3>F R E N T E S</h3>
        </div>
    </div>

    <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_title form-group row">                
                    <div class="col-md-2">
                    <button type="button" id="mostrar" name="boton1"  class="btn btn-info">Nuevo Frente</button>
                    </div>
                </div>
                
                <div class="x_content" id="target" style="display: none;">
                    <br/>
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="production/core/frentes/actions/addFrentes.php">                    
                                                                                

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Nombre:<span class="required">*</span></label>
                                <input type="text" name="fre_nombre" required="required" class="form-control col-md-7 col-xs-12" placeholder="Nombre">
                            </div>
                                               
                            
                        </div>
                      

                        <div class="form-group row">
                            <div class="col-md-10">
                                <label >Descripción:</label>
                                <textarea class="form-control" name="fre_descripcion" id="fre_descripcion" rows="1" cols="50"></textarea>
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
                                <h3>Ultimos registros agregados</h3>
                                <?php
                                    include("tableFrentesNuevos.php");
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <h4>Registros agregados</h4>
                                <?php
                                    include("tableFrentes.php");
                                ?>
                            </div>
                        </div>
                    </div>
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
                $("#mostrar").text("Nuevo Frente");
                n = 0;
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
      $('#datatable').DataTable();
    } );
</script>

<!-- /page content -->

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
        if(vars['p'] == "frentesOk"){            
            $('#modal').modal('show');
        }    
        else if(vars['p'] == "frentesDel"){
            $('#modalDel').modal('show');
        }            
      });
</script>