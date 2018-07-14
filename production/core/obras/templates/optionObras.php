<?php
include("../../../config/conexion.php");
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else {

    $id = $_GET["ref"];    
    $result = mysqli_query($con,"SELECT * FROM obras WHERE identificador = '$id';");    
    $elemento = mysqli_fetch_array($result);  
    
    $result1 = mysqli_query($con,"SELECT * FROM clientes WHERE estado = 0");        
    
    $result = mysqli_query($con,"SELECT * FROM clientes WHERE id = $elemento[fk_clientes];");    
    $elemento2 = mysqli_fetch_array($result);   

    $result2 = mysqli_query($con,"SELECT * FROM grupos WHERE estado = 0;");    

    $result = mysqli_query($con,"SELECT * FROM grupos WHERE id = $elemento[fk_grupo];");    
    $elemento3 = mysqli_fetch_array($result);   


}
?>



<!-- Page content -->
<div class="">

    <div class="page-title">
    <div class="row">
        <div class="col-md-10">
            <h3>O B R A </h3>
        </div>
        <div class="col-md-2">
            <input type="submit" class="form-control btn btn-danger" value="Borrar" data-toggle="modal" data-target="#deleteModal">
        </div>
    </div>
</div>


    <div class="clearfix"></div>

    <div class="row">

                            <div class="x_content" id="target" >
                                <br/>
                                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="production/core/obras/actions/updateObras.php">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                        <label >Código de la obra:</label>
                                            <input name="obr_ref" type="text" class="form-control" readonly="readonly" placeholder="Código de la obra" value="<?php echo($elemento['identificador']); ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label >Nombre de la obra:</label>
                                            <input name="obr_nombre" type="text" class="form-control" placeholder="Nombre de la obra" value="<?php echo($elemento['nombre']); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label >Cliente:</label>                                            
                                                <select class="form-control" name="obr_cliente" id="obr_cliente">                                                    
                                                    <option value="<?php echo($elemento['fk_clientes']); ?>"><?php echo($elemento2['nombre']); ?></option>
                                                    <?php
                                                        while($elemento1 = mysqli_fetch_array($result1)){
                                                            echo '                                                
                                                                <option id="'.$elemento1[id].'" value="'.$elemento1[id].'" name="'.$elemento1[id].'">'.$elemento1[nombre].'</option>
                                                            ';
                                                        }
                                                    ?>                                        
                                                </select>                                    
                                        </div>
                                        <div class="col-md-6">
                                        <label >Grupo:</label>                                            
                                                <select class="form-control" name="obr_grupo" id="obr_grupo">
                                                <option value="<?php echo($elemento['fk_grupos']); ?>"><?php echo($elemento3['nombre']); ?></option>
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
                                        <input type="text" name="obr_calle"calle required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese la calle" value="<?php echo($elemento['calle']); ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label  for="CalleNum-Client">Número Ext.:<span class="required">*</span></label>
                                        <input type="text" name="obr_numExt" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el número" value="<?php echo($elemento['numExt']); ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label  for="CalleNum-Client">Número Int.:</label>
                                        <input type="text" name="obr_numInt" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el número" value="<?php echo($elemento['numInt']); ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="Col-Client">Colonia:<span class="required">*</span></label>
                                        <input type="text" name="obr_colonia" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese la colonia" value="<?php echo($elemento['colonia']); ?>">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="Col-Client">C.P:</label>
                                        <input type="number" name="obr_cp"  class="form-control col-md-7 col-xs-12" placeholder="Ingrese el CP" value="<?php echo($elemento['cp']); ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label  for="Ciudad-Client">Ciudad:</label>
                                        <input type="text"name="obr_ciudad"class="form-control col-md-7 col-xs-12" placeholder="Ingrese la ciudad" value="<?php echo($elemento['ciudad']); ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="Municipio-Client">Municipio:<span class="required">*</span></label>
                                        <input type="text" name="obr_municipio" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el municipio" value="<?php echo($elemento['municipio']); ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label >Fecha de Inicio:</label>
                                        <input type="date" name="obr_fechInicio" class="form-control" placeholder="Fecha de inicio de la obra" value="<?php echo($elemento['fechInicio']); ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label >Fecha de Entrega:</label>
                                        <input type="date" name="obr_fechFin" class="form-control" placeholder="Fecha de Entrega" value="<?php echo($elemento['fechFin']); ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label >Avance:</label>
                                        <input type="text" name="obr_avance" class="form-control" placeholder="Avance" value="<?php echo($elemento['avance']); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                            <div class="col-md-10">
                            <label >Notas:</label>
                            <textarea class="form-control" name="obr_nota" id="obr_nota" rows="1" cols="50"><?php echo($elemento['comentario']); ?></textarea>
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
          <button class="btn btn-warning" type="button" data-dismiss="modal"  onclick="del('obras', '<?php echo $id;?>')">Aceptar</button>
          </div>
          <div class="form-group col-md-2">
          <button class="btn btn-secundary" type="button" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
