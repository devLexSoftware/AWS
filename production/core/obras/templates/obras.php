<?php
include("../../../config/conexion.php");
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else {
    $result1 = mysqli_query($con,"SELECT * FROM clientes WHERE estado = 0;");    
    $result2 = mysqli_query($con,"SELECT * FROM grupos WHERE estado = 0;");    

}
?>

<!-- Page content -->
<div class="">

    <div class="page-title">
        <div class="title_left">
            <h3>O B R A S</h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_title form-group row">                
                <div class="col-md-2">
                <button type="button" id="mostrar" name="boton1"  class="btn btn-info">Nueva obra</button>
                </div>
            </div>
                            <div class="x_content" id="target" style="display: none;">
                                <br/>
                                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="production/core/obras/actions/addObras.php">
                                    <div class="form-group row">                                        
                                        <div class="col-md-6">
                                            <label >Nombre de la obra:<span class="required">*</span></label>
                                            <input name="obr_nombre" required="required" type="text" class="form-control" placeholder="Nombre de la obra">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label >Cliente:</label>                                            
                                                <select class="form-control" name="obr_cliente" id="obr_cliente">
                                                    <option>Seleciona el cliente</option>
                                                    <?php
                                                        while($elemento = mysqli_fetch_array($result1)){
                                                            echo '                                                
                                                                <option id="'.$elemento[id].'" value="'.$elemento[id].'" name="'.$elemento[id].'">'.$elemento[nombre].'</option>
                                                            ';
                                                        }
                                                    ?>                                        
                                                </select>                                    
                                        </div>
                                        <div class="col-md-6">
                                        <label >Grupo:</label>                                            
                                                <select class="form-control" name="obr_grupo" id="obr_grupo">
                                                    <option>Seleciona el grupo</option>
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
                                    <div class="col-md-6">
                                        <label for="Dir-Client">Calle:<span class="required">*</span></label>
                                        <input type="text" name="obr_calle"calle required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese la calle">
                                    </div>
                                    <div class="col-md-3">
                                        <label  for="CalleNum-Client">Número Ext.:<span class="required">*</span></label>
                                        <input type="text" name="obr_numExt" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el número">
                                    </div>
                                    <div class="col-md-3">
                                        <label  for="CalleNum-Client">Número Int.:</label>
                                        <input type="text" name="obr_numInt" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el número">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="Col-Client">Colonia:<span class="required">*</span></label>
                                        <input type="text" name="obr_colonia" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese la colonia">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="Col-Client">C.P:</label>
                                        <input type="number" name="obr_cp"  class="form-control col-md-7 col-xs-12" placeholder="Ingrese el CP">
                                    </div>
                                    <div class="col-md-3">
                                        <label  for="Ciudad-Client">Ciudad:</label>
                                        <input type="text"name="obr_ciudad" class="form-control col-md-7 col-xs-12" placeholder="Ingrese la ciudad">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="Municipio-Client">Estado:<span class="required">*</span></label>
                                        <input type="text" name="obr_municipio" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el estado">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label >Fecha de Inicio:</label>
                                        <input type="date" name="obr_fechInicio" class="form-control" placeholder="Fecha de inicio de la obra">
                                    </div>
                                    <div class="col-md-3">
                                        <label >Fecha de Entrega:</label>
                                        <input type="date" name="obr_fechFin" class="form-control" placeholder="Fecha de Entrega">
                                    </div>
                                    <div class="col-md-3">
                                        <label >Avance:</label>
                                        <input type="text" name="obr_avance" class="form-control" placeholder="Avance">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label >Costo total:<span class="required">*</span></label>
                                        <input name="obr_costoTotal" required="required" type="number" class="form-control" placeholder="Costo de la obra">
                                    </div>
                                    <div class="col-md-3">
                                        <label >Porcentaje Ganancia:<span class="required">*</span></label>
                                        <input name="obr_porcentaje" required="required" type="number" class="form-control" placeholder="Porcentaje Ganancia">
                                    </div>
                                    <div class="col-md-3">
                                        <label >Superficie m2:<span class="required">*</span></label>
                                        <input name="obr_superficie" required="required" type="number" class="form-control" placeholder="Superficie">
                                    </div>
                                </div>
                                <div class="form-group row">
                            <div class="col-md-10">
                            <label >Notas:</label>
                            <textarea class="form-control" name="obr_nota" id="obr_nota" rows="1" cols="50"></textarea>
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
                                            <h3>Ultimas obras agregadas</h3>
                                            <?php
                                                include("tableObrasNuevas.php");
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_content">
                                    <h4>Mis obras</h4>
                                    <?php
                                        include("tableObras.php");
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
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
            <h4 class="sMargen">Se borro la obra seleccionado</h4>
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
                $("#mostrar").text("Ocultar nueva obra");
                n = 1;
            }            
            else{
                $("#mostrar").text("Nueva obra");
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
        if(vars['p'] == "obrasOk"){            
            $('#modal').modal('show');
        }    
        else if(vars['p'] == "obrasDel"){
            $('#modalDel').modal('show');
        }            
      });
</script>