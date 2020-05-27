<?php
include("../../../config/conexion.php");
error_reporting(E_ALL);
ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else {

    $idCliente = $_GET["ref"];    
    $result = mysqli_query($con,"SELECT * FROM clientes WHERE identificador = '$idCliente';");    
    $elemento = mysqli_fetch_array($result);    
}
?>

<div class="">
    
<div class="page-title">
<div class="page-title">
    <div class="row">
        <div class="col-md-10">
            <h3>C L I E N T E </h3>
        </div>
        <div class="col-md-2">
            <input type="submit" class="form-control btn btn-danger" value="Borrar" data-toggle="modal" data-target="#deleteModal">
        </div>
    </div> 
</div> 

    <div class="x_content" id="target" >
        <br/>
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="production/core/clientes/actions/updateClientes.php">
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="Nom-Client">Nombre de cliente:<span class="required">*</span></label>
                    <input type="text" name="cli_nombre" id="cli_nombre" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el nombre del cliente" value="<?php echo($elemento['nombre']); ?>">                        
                </div>
                <div class="col-md-3">
                    <label for="RFC-Client">RFC:</label>                            
                    <input type="text" name="cli_rfc" id="cli_rfc" class="form-control col-md-7 col-xs-12" placeholder="Ingrse el RFC del cliente" value="<?php echo($elemento['rfc']); ?>">                                                      
                </div>
                <div class="col-md-3">
                    <label for="RFC-Client">Referencia:</label>                            
                    <input type="text" name="cli_ref" id="cli_ref" class="form-control col-md-7 col-xs-12" placeholder="Ingrse el RFC del cliente" readonly="readonly"  value="<?php echo($elemento['identificador']); ?>">                                                      
                </div>
            </div>

            <div class="form-group row">                            
                <div class="col-md-6">
                <label for="Dir-Client">Calle:</label>                            
                    <input type="text" name="cli_calle" id="cli_calle"  class="form-control col-md-7 col-xs-12" placeholder="Ingrese la calle" value="<?php echo($elemento['calle']); ?>">
                </div>
                <div class="col-md-3">
                    <label  for="CalleNum-Client">Número Ext.:</label>                            
                    <input type="text" name="cli_numext" id="cli_numext" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el número" value="<?php echo($elemento['numExt']); ?>">
                </div>                    
                <div class="col-md-3">
                    <label  for="CalleNum-Client">Número Int.:</label>                            
                    <input type="text" name="cli_numint" id="cli_numint" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el número" value="<?php echo($elemento['numInt']); ?>">
                </div>                    
            </div>

            <div class="form-group row">
                <div class="col-md-4">
                    <label for="Col-Client">Colonia:</label>                            
                    <input type="text" name="cli_colonia" id="cli_colonia" class="form-control col-md-7 col-xs-12" placeholder="Ingrese la colonia" value="<?php echo($elemento['colonia']); ?>">
                </div>                    
                <div class="col-md-2">
                    <label for="Col-Client">C.P:</label>                            
                    <input type="number" name="cli_cp" id="cli_cp" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el CP" value="<?php echo($elemento['cp']); ?>">
                </div>
                <div class="col-md-3">
                    <label  for="Ciudad-Client">Ciudad:</label>                            
                    <input type="text" name="cli_ciudad" id="cli_ciudad" class="form-control col-md-7 col-xs-12" placeholder="Ingrese la ciudad" value="<?php echo($elemento['ciudad']); ?>">
                </div>
                <div class="col-md-3">
                    <label for="Municipio-Client">Municipio:</label>                            
                    <input type="text" name="cli_municipio" id="cli_municipio" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el municipio" value="<?php echo($elemento['municipio']); ?>">
                </div>
            </div>

            <div class="form-group row">                                                              
                <div class="col-md-4">
                    <label >Empresa:</label>                            
                    <input type="text" name="cli_empresa"  class="form-control col-md-7 col-xs-12" placeholder="Ingrese el nombre de la empresa" value="<?php echo($elemento['empresa']); ?>">
                </div>
                <div class="col-md-2">
                    <label >Correo:</label>                            
                    <input type="email" name="cli_email" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el correo" value="<?php echo($elemento['email']); ?>">
                </div>
                <div class="col-md-3">
                    <label >Teléfono móvil:<span class="required">*</span></label>                            
                    <input type="number" name="cli_movil" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese número móvil" value="<?php echo($elemento['movil']); ?>">
                </div>
                <div class="col-md-3">
                    <label >Teléfono de oficina:</label>                            
                    <input type="text" name="cli_telefono"  class="form-control col-md-7 col-xs-12" placeholder="Ingrese el número de teléfono de oficina" value="<?php echo($elemento['telefono']); ?>">
                </div>              
            </div>

            <div class="form-group row">
                <div class="col-md-10">
                <label >Notas:</label>
                <textarea class="form-control" name="cli_nota" id="cli_nota" rows="1" cols="50"><?php echo($elemento["nota"]); ?></textarea>
                </div>
                <div class="col-md-2">
                    <label > Da click para</label>
                    <input type="submit" class="form-control btn btn-success" value="Guardar">
                </div>
            </div>
        </form>
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
          <button class="btn btn-warning" type="button" data-dismiss="modal"  onclick="del('clientes', '<?php echo $idCliente;?>')">Aceptar</button>
          </div>
          <div class="form-group col-md-2">
          <button class="btn btn-secundary" type="button" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
