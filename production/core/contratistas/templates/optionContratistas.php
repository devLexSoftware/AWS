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
    $id = $_GET["ref"];    
    $result = mysqli_query($con,"SELECT * FROM contratistas WHERE id = '$id';");    
    $elemento = mysqli_fetch_array($result);      

}
?>



<!-- Page content -->
<div class="">

    <div class="page-title">
    <div class="row">
        <div class="col-md-10">        
            <h3>C O N T R A T I S T A</h3>        
        </div>
        <div class="col-md-2">
            <input type="submit" class="form-control btn btn-danger" value="Borrar" data-toggle="modal" data-target="#deleteModal">
        </div>
    </div>

 
    </div>

    <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">                
                
                <div class="x_content" id="target">
                    <br/>
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="production/core/contratistas/actions/updateContratistas.php">                    
                        
                       
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label>Identificador:<span class="required">*</span></label>
                                <input value="<?php echo($elemento['identificador']); ?>" type="text" name="con_identificador" required="required" class="form-control col-md-7 col-xs-12" placeholder="Identificador de Contratista">
                                <input value="<?php echo($elemento['id']); ?>" type="hidden" name="con_id">
                            </div>                          
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label>Encargado:<span class="required">*</span></label>
                                <input value="<?php echo($elemento['encargado']); ?>" type="text" name="con_encargado" required="required" class="form-control col-md-7 col-xs-12" placeholder="Nombre del Encargado">
                            </div>
                            <div class="col-md-4">
                                <label>Frente:<span class="required">*</span></label>
                                
                                <select class="form-control" id="con_frente" name="con_frente">
                                <option value="<?php echo($elemento['frente']); ?>"><?php echo($elemento['frente']); ?></option>                    
                                    
                                    <?php
                                        while($elemento10 = mysqli_fetch_array($result10)){
                                            echo '
                                                <option id="'.$elemento10[nombre].'" value="'.$elemento10[nombre].'">'.$elemento10[nombre].'</option>
                                            ';
                                        }
                                    ?>                                                                     
                                </select>
                            </div>                          
                            <div class="col-md-4">
                                <label>Empresa:<span class="required">*</span></label>
                                <input value="<?php echo($elemento['empresa']); ?>" type="text" name="con_empresa" required="required" class="form-control col-md-7 col-xs-12" placeholder="Nombre de la Empresa">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label>Móvil:<span class="required">*</span></label>
                                <input value="<?php echo($elemento['movil']); ?>" type="text" name="con_movil" required="required" class="form-control col-md-7 col-xs-12" placeholder="Nombre del Encargado">
                            </div>
                            <div class="col-md-4">
                                <label>Correo:<span class="required">*</span></label>
                                <input value="<?php echo($elemento['email']); ?>" type="email" name="con_correo" required="required" class="form-control col-md-7 col-xs-12" placeholder="Email">
                            </div>                                                      
                        </div>

                        <div class="form-group row">
                            <div class="col-md-10">
                                <label >Descripción:</label>
                                <textarea value="<?php echo($elemento['descripcion']); ?>" class="form-control" name="con_descripcion" id="con_descripcion" rows="1" cols="50"><?php echo($elemento['descripcion']); ?></textarea>
                            </div>
                            <div class="col-md-2">
                                <label > Da click para</label>
                                <input type="submit" class="form-control btn btn-success" value="Guardar">
                            </div>
                        </div>
                                                                                    
                    </form>
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
          <button class="btn btn-warning" type="button" data-dismiss="modal"  onclick="del('contratistas', '<?php echo $id;?>')">Aceptar</button>
          </div>
          <div class="form-group col-md-2">
          <button class="btn btn-secundary" type="button" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div>