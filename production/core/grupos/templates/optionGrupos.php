<?php
include("../../../config/conexion.php");

$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else {
  $con -> set_charset("utf8");

    $id = $_GET["ref"];
    $result0 = mysqli_query($con,"select * from grupos where id = '$id';");
    $elemento0 = mysqli_fetch_array($result0);

    $result = mysqli_query($con,"SELECT * FROM empleados where estado = 0");    
    $result2 = mysqli_query($con,"SELECT * FROM contratistas where estado = 0");    


}
?>

<!-- Page content -->
<div role="main">
  <div class="">
    <div class="page-title">
      <div class="row">
        <div class="col-md-10">
            <h3>G R U P O </h3>
        </div>
        <div class="col-md-2">
            <input type="submit" class="form-control btn btn-danger" value="Borrar" data-toggle="modal" data-target="#deleteModal">
        </div>
      </div> 
    </div>
    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_title form-group row">                 
          </div>
          <div class="x_content" id="target" >
            <br/>
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="production/core/grupos/actions/updateGrupos.php">
              <div class="form-group row">
                <div class="col-md-6">
                  <label>Nombre del grupo:<span class="required">*</span></label>
                  <input type="text" value="<?php echo($elemento0['nombre']); ?>" id="Grp_Nombre" name="Grp_Nombre" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el nombre del grupo">
                </div>    
                <div class="col-md-6">                                 
                </div>                                
              </div>                            
              <div class="form-group row">
                <div class="col-md-10">
                  <label >Notas:</label>
                  <textarea class="form-control" name="Grp_Nota" id="Grp_Nota" rows="1" cols="50"><?php echo($elemento0['nota']); ?></textarea>
                </div>
                <div class="col-md-2">                                    
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
                      <div class="col-md-1">
                        <input style="visibility:hidden;"  id="detalleId" name="detalleId" readonly class="form-control" value="<?php echo($elemento0['id']); ?>">
                      </div>
                    </div>
                    <br>
                    <div id="divTable" style="overflow-x:auto;">                             
                      <?php
                      include("tableEmpleadosGrupos.php");
                      ?>
                    </div>                                
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
                      <div class="col-md-1">
                        <input style="visibility:hidden;"  id="detalleId2" name="detalleId" readonly class="form-control" value="<?php echo($elemento0['id']); ?>">
                      </div>
                    </div>
                    <br>
                    <div id="divTable" style="overflow-x:auto;">                             
                      <?php
                      include("tableContratistasGrupos.php");
                      ?>
                    </div>                                
                  </div>
                </div>                                                                                                     
              </div>

              <div class="form-group row">                
                  <div class="col-md-2 col-sm-2 col-xs-2 ">
                      <button type="submit" class="btn btn-success"> Guardar</button>
                  </div>
              </div>


            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<script src="../../../production/components/js/files/grupos/general.js"></script>

<script>
$(document).ready(function(){ cargarEmpleados(); })
</script>



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
          <button class="btn btn-warning" type="button" data-dismiss="modal"  onclick="del('grupos', '<?php echo $id;?>')">Aceptar</button>
          </div>
          <div class="form-group col-md-2">
          <button class="btn btn-secundary" type="button" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
