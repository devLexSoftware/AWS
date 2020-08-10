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
    $result = mysqli_query($con,"SELECT i.id, i.identificador, i.nombre, i.cantidad, i.categoria, i.ubicacion, i.descripcion,  i.fk_almacen, a.nombre as nomAlmacen FROM inventarios i inner join almacenes a on i.fk_almacen = a.id WHERE i.id = '$id';");    
    $elemento = mysqli_fetch_array($result);  
    
    $result2 = mysqli_query($con,"SELECT * FROM almacenes WHERE estado = 0;");        
    $result3 = mysqli_query($con,"SELECT * FROM categorias_inventarios WHERE estado = 0;");        

}
?>



<!-- Page content -->
<div class="">

    <div class="page-title">
    <div class="row">
        <div class="col-md-10">        
            <h3>I N V E N T A R I O</h3>        
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
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="production/core/inventarios/actions/updateInventarios.php">                    
                        
                        
                        <div class="form-group row">                                        
                            <div class="col-md-6">
                                <label >Almacén:</label>                                            
                                <select class="form-control" name="item_idAlmacen" id="item_idAlmacen">
                                    <option value="<?php echo($elemento['fk_almacen']); ?>"><?php echo($elemento['nomAlmacen']); ?></option>
                                    
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
                                <input value="<?php echo($elemento['nombre']); ?>" type="text" name="item_nombre" required="required" class="form-control col-md-7 col-xs-12" placeholder="Nombre del producto">
                                <input name="item_id" type="hidden" class="form-control" value="<?php echo($elemento['id']); ?>">

                            </div>
                            <div class="col-md-2">
                                <label>Cantidad:<span class="required">*</span></label>
                                <input value="<?php echo($elemento['cantidad']); ?>" type="number" name="item_cantidad" required="required" class="form-control col-md-7 col-xs-12" placeholder="Cantidad">
                            </div>
                            <div class="col-md-3">
                                <label >Categoría:</label>                                            
                                <select class="form-control" name="item_categoria" id="item_categoria">
                                    <option value="<?php echo($elemento['categoria']); ?>"><?php echo($elemento['categoria']); ?></option>
                                    
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
                                <input value="<?php echo($elemento['ubicacion']); ?>" type="text" name="item_ubicacion" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ubicación">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-10">
                                <label >Descripción:</label>
                                <textarea value="<?php echo($elemento['descripcion']); ?>" class="form-control" name="item_descripcion" id="item_descripcion" rows="1" cols="50"><?php echo($elemento['descripcion']); ?></textarea>
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
          <button class="btn btn-warning" type="button" data-dismiss="modal"  onclick="del('inventarios', '<?php echo $id;?>')">Aceptar</button>
          </div>
          <div class="form-group col-md-2">
          <button class="btn btn-secundary" type="button" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div>