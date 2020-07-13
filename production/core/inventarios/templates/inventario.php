<?php
include("../../../config/conexion.php");
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else {
    $result1 = mysqli_query($con,"SELECT * FROM inventarios WHERE estado = 0;");        
    $result2 = mysqli_query($con,"SELECT * FROM almacenes WHERE estado = 0;");        
    $result3 = mysqli_query($con,"SELECT * FROM categorias_inventarios WHERE estado = 0;");        

}
?>

<!-- Page content -->
<div class="">

    <div class="page-title">
        <div class="title_left">
            <h3>I N V E N T A R I O</h3>
        </div>
    </div>

    <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_title form-group row">                
                    <div class="col-md-2">
                    <button type="button" id="mostrar" name="boton1"  class="btn btn-info">Registrar en almacén</button>
                    </div>
                </div>
                
                <div class="x_content" id="target" style="display: none;">
                    <br/>
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="production/core/inventarios/actions/addInventarios.php">                    
                        
                        
                        <div class="form-group row">                                        
                            <div class="col-md-6">
                                <label >Almacén:</label>                                            
                                <select class="form-control" name="item_idAlmacen" id="item_idAlmacen">
                                    <option>Seleciona el almacén</option>
                                    <?php
                                        while($elemento2 = mysqli_fetch_array($result2)){
                                            echo '                                                
                                                <option id="'.$elemento2[id].'" value="'.$elemento2[id].'" name="'.$elemento2[id].'">'.$elemento2[nombre].'</option>
                                            ';
                                        }
                                    ?>                                        
                                </select>   
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label>Nombre:<span class="required">*</span></label>
                                <input type="text" name="item_nombre" required="required" class="form-control col-md-7 col-xs-12" placeholder="Nombre del producto">
                            </div>
                            <div class="col-md-2">
                                <label>Cantidad:<span class="required">*</span></label>
                                <input type="number" name="item_cantidad" required="required" class="form-control col-md-7 col-xs-12" placeholder="Cantidad">
                            </div>
                            <div class="col-md-3">
                                <label >Categoría:</label>                                            
                                <select class="form-control" name="item_categoria" id="item_categoria">
                                    <option>Seleciona la categoría</option>                                
                                    <?php
                                        while($elemento3 = mysqli_fetch_array($result3)){
                                            echo '                                                
                                                <option id="'.$elemento3[nombre].'" value="'.$elemento3[nombre].'" name="'.$elemento3[nombre].'">'.$elemento3[nombre].'</option>
                                            ';
                                        }
                                    ?>                                        
                                </select>   
                            </div>
                            <div class="col-md-3">
                                <label>Ubicación:<span class="required">*</span></label>
                                <input type="text" name="item_ubicacion" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ubicación">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-10">
                                <label >Descripción:</label>
                                <textarea class="form-control" name="item_descripcion" id="item_descripcion" rows="1" cols="50"></textarea>
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
                                    include("tableInventariosNuevas.php");
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
                                    include("tableInventarios.php");
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
                $("#mostrar").text("Registrar en almacén");
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
        if(vars['p'] == "inventarioOk"){            
            $('#modal').modal('show');
        }    
        else if(vars['p'] == "inventariosDel"){
            $('#modalDel').modal('show');
        }            
      });
</script>