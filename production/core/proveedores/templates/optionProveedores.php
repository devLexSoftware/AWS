<?php
include("../../../config/conexion.php");
error_reporting(E_ALL);
ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else {

    $id = $_GET["ref"];    
    $result = mysqli_query($con,"SELECT * FROM proveedores WHERE id = '$id';");    
    $elemento = mysqli_fetch_array($result);    
}
?>

<div class="">

<div class="page-title">
<div class="row">
        <div class="col-md-10">
            <h3>P R O V E E D O R </h3>
        </div>
        <div class="col-md-2">
            <input type="submit" class="form-control btn btn-danger" value="Borrar" data-toggle="modal" data-target="#deleteModal">
        </div>
    </div>
</div>

<div class="clearfix"></div>

<div class="row">
            <div class="x_content" id="target">
                <br/>
                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="production/core/proveedores/actions/updateProveedores.php">

                    <div class="form-group row">
                        <div class="col-md-6">
                        <label>Nombre del proveedor:<span class="required">*</span></label>
                        <input type="text" required="required" name="prv_proveedor" id="prv_proveedor" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el nombre del proveedor" value="<?php echo($elemento['proveedor']); ?>">
                        </div>
                        <div class="col-md-3">
                        <label for="RFC-Client">RFC:</label>
                        <input  maxlength="13" minlength="13" type="text"  name="prv_rfc" id="prv_rfc" class="form-control col-md-7 col-xs-12" placeholder="Ingrse el RFC del cliente" value="<?php echo($elemento['rfc']); ?>">
                        </div>
                        <div class="col-md-3">
                        <label for="RFC-Client">Referencia:</label>
                        <input type="text"  name="prv_referencia" id="prv_referencia" class="form-control col-md-7 col-xs-12" placeholder="Ingrse el RFC del cliente"  readonly="readonly"   value="<?php echo($elemento['identificador']); ?>">
                        <input type="hidden"  name="prv_id" id="prv_id" value="<?php echo($elemento['id']); ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                        <label >Nombre de la empresa:</label>
                        <input type="text" required="required" name="prv_nombre" id="prv_nombre" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el nombre de la empresa" value="<?php echo($elemento['empresa']); ?>">
                        </div>
                        <div class="col-md-6">
                        <label>Dirección:</label>
                            <input type="text" required="required" name="prv_direccion" id="prv_direccion" class="form-control col-md-7 col-xs-12" placeholder="Ingrese la dirección" value="<?php echo($elemento['direccion']); ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                        <label>Teléfono de celular:<span class="required">*</span></label>
                        <input type="number" required="required" name="prv_celular" id="prv_celular" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el número de teléfono celular" value="<?php echo($elemento['contacto1']); ?>">
                        </div>
                        <div class="col-md-4">
                        <label >Teléfono de oficina:</label>
                        <input type="text"  name="prv_telefono" id="prv_telefono" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el número de teléfono de oficina" value="<?php echo($elemento['contacto2']); ?>">
                        </div>
                        <div class="col-md-4">
                        <label>Correo:</label>
                        <input type="email"  name="prv_email" id="prv_email" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el correo" value="<?php echo($elemento['email']); ?>" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                        <label >Descripcion:</label>
                        <input type="text"  name="prv_descripcion" id="prv_descripcion" class="form-control col-md-7 col-xs-12" placeholder="Ingresa descripción" value="<?php echo($elemento['descripcion']); ?>">
                        </div>                        
                    </div>


                    <div class="form-group row">
                        <div class="col-md-10">
                        <label >Notas:</label>
                        <textarea class="form-control" name="prv_nota" id="prv_nota" rows="1" cols="50"><?php echo($elemento['comentario']); ?></textarea>
                        </div>
                        <div class="col-md-2">
                            <label > Da click para</label>
                            <input type="submit" class="form-control btn btn-success" value="Guardar">
                        </div>
                    </div>
                    <hr>
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
          <button class="btn btn-warning" type="button" data-dismiss="modal"  onclick="del('proveedores', '<?php echo $id;?>')">Aceptar</button>
          </div>
          <div class="form-group col-md-2">
          <button class="btn btn-secundary" type="button" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
