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
    $result = mysqli_query($con,"SELECT f.id, f.nombre, f.descripcion from frentes f                        
                        where f.id = '$id';");    
    $elemento = mysqli_fetch_array($result);   
    
    
    

}
?>



<!-- Page content -->
<div class="">

    <div class="page-title">
    <div class="row">
        <div class="col-md-10">        
            <h3>F R E N T E S</h3>        
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
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="production/core/frentes/actions/updateFrentes.php">                    
                                                                  

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Nombre:<span class="required">*</span></label>
                                <input value="<?php echo($elemento['nombre']); ?>" type="text" name="fre_nombre" required="required" class="form-control col-md-7 col-xs-12" placeholder="Nombre">
                            </div>
                            
                        </div>
                        

                        <div class="form-group row">
                            <div class="col-md-10">
                                <label >Descripción:</label>
                                <textarea value="<?php echo($elemento['descripcion']); ?>" class="form-control" name="fre_descripcion" id="fre_descripcion" rows="1" cols="50"><?php echo($elemento['descripcion']); ?></textarea>
                            </div>
                            <div class="col-md-2">
                                <label > Da click para</label>
                                <input value="<?php echo($elemento['id']); ?>" type="hidden" name="fre_id" id="fre_id">

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
          <button class="btn btn-warning" type="button" data-dismiss="modal"  onclick="del('frentes', '<?php echo $id;?>')">Aceptar</button>
          </div>
          <div class="form-group col-md-2">
          <button class="btn btn-secundary" type="button" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div>