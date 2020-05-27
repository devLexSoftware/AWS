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
    $result = mysqli_query($con,"SELECT * FROM empleados WHERE id = '$id';");
    $elemento = mysqli_fetch_array($result);
}
?>

<!-- Page content -->
<div class="page-title">
    <div class="row">
        <div class="col-md-10">
            <h3>E M P L E A D O </h3>
        </div>
        <div class="col-md-2">
            <input type="submit" class="form-control btn btn-danger" value="Borrar" data-toggle="modal" data-target="#deleteModal">
        </div>
    </div> 
</div>     
    

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">              

                    <div class="x_content" id="target" >
                        <br/>
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="production/core/empleados/actions/updateEmpleados.php">
                            <div class="form-group row">
                              <div class="col-md-6">
                                  <label>Nombre del empleado:<span class="required">*</span></label>
                                    <input type="text" required="required" id="Empl_NombreEmpleado" name="Empl_NombreEmpleado" class="form-control col-md-7 col-xs-12" value="<?php echo($elemento['nombre']); ?>" placeholder="Ingrese el nombre del empleado">
                                </div>
                                <div class="col-md-3">
                                  <label  for="RFC-Client">RFC:</label>
                                      <input type="text" id="RFCClient" id="Empl_RFCEmpleado" name="Empl_RFCEmpleado" class="form-control col-md-7 col-xs-12" value="<?php echo($elemento['rfc']); ?>" placeholder="Ingrse el RFC del cliente">
                                  </div>
                                  <div class="col-md-3">
                                    <label  for="RFC-Client">Referencia:</label>
                                        <input type="text" readonly id="Empl_Referencia" name="Empl_Referencia" class="form-control col-md-7 col-xs-12" value="<?php echo($elemento['identificador']); ?>" placeholder="">
                                    </div>
                            </div>

                            <div class="form-group row">
                              <div class="col-md-6">
                                  <label >Dirección:</label>
                                  <input type="text" id="Empl_DireccionEmpleado" name="Empl_DireccionEmpleado" class="form-control col-md-7 col-xs-12" placeholder="Ingresela la dirección" value="<?php echo($elemento['direccion']); ?>">
                                </div>
                                <div class="col-md-2">
                                    <label>Teléfono de celular:<span class="required">*</span></label>
                                    <input type="number" required="required" id="Empl_CelEmpleado" name="Empl_CelEmpleado" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el número de teléfono celular" value="<?php echo($elemento['movil']); ?>">
                                  </div>
                                  <div class="col-md-2">
                                      <label >Teléfono de oficina:</label>
                                        <input type="text" id="Empl_OficinaEmpleado" name="Empl_OficinaEmpleado" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el número de teléfono de oficina" value="<?php echo($elemento['telefono']); ?>">
                                    </div>
                                    <div class="col-md-2">
                                  <label >Correo:</label>
                                      <input type="email" id="Empl_CorreoEmpleado" name="Empl_CorreoEmpleado" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el correo" value="<?php echo($elemento['email']); ?>">
                                  </div>
                            </div>

                            <div class="form-group row">
                              <div class="col-md-6">
                                <label >Empresa:</label>
                                    <input type="text" id="Empl_EmpresaEmpleado" name="Empl_EmpresaEmpleado" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el nombre de la empresa" value="<?php echo($elemento['empresa']); ?>">
                                </div>
                                <div class="col-md-3">
                                  <label >Giro:</label>
                                      <input type="text" id="Empl_GiroEmpleado" name="Empl_GiroEmpleado" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el giro de la empresa" value="<?php echo($elemento['giro']); ?>">
                                  </div>                                 
                            </div>

                            <div class="form-group row">
                                <div class="col-md-10">
                                <label >Notas:</label>
                                <textarea class="form-control" name="Empl_nota" id="Empl_nota" rows="1" cols="50"><?php echo($elemento['nota']); ?></textarea>
                                </div>
                                <div class="col-md-2">
                                    <label > Da click para</label>
                                    <input type="submit" class="form-control btn btn-success" value="Guardar">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /page content -->



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
          <button class="btn btn-warning" type="button" data-dismiss="modal"  onclick="del('empleados', '<?php echo $id;?>')">Aceptar</button>
          </div>
          <div class="form-group col-md-2">
          <button class="btn btn-secundary" type="button" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div>