<!-- Page content -->
<div  role="main">
    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>E M P L E A D O S</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_title form-group row">
                                  <div class="col-md-2">
                                      <h2>Nuevo Empleado</h2>
                                  </div>
                                  <div class="col-md-2">
                                  <button type="button" id="mostrar" name="boton1"  class="btn btn-info">Mostrar formulario</button>
                                  </div>
                              </div>

                    <div class="x_content" id="target" style="display: none;">
                        <br/>
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="production/core/empleados/actions/addEmpleados.php">
                            <div class="form-group row">
                              <div class="col-md-6">
                                  <label>Nombre del empleado:<span class="required">*</span></label>
                                    <input type="text" required="required" id="Empl_NombreEmpleado" name="Empl_NombreEmpleado" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el nombre del empleado">
                                </div>
                                <div class="col-md-3">
                                  <label  for="RFC-Client">RFC:</label>
                                      <input type="text"  maxlength="13" minlength="13" id="RFCClient" id="Empl_RFCEmpleado" name="Empl_RFCEmpleado" class="form-control col-md-7 col-xs-12" placeholder="Ingrse el RFC del cliente">
                                  </div>
                                  <div class="col-md-3">
                                  <label  for="RFC-Client">N.S.S:</label>
                                      <input type="text" id="Empl_nss" name="Empl_nss" class="form-control col-md-7 col-xs-12" placeholder="Ingrse el N.S.S">
                                  </div>
                            </div>


                            
                            <div class="form-group row">
                              <div class="col-md-6">
                                <label >Empresa:</label>
                                    <input type="text" id="Empl_EmpresaEmpleado" name="Empl_EmpresaEmpleado" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el nombre de la empresa">
                                </div>
                                <div class="col-md-3">
                                  <label >Giro:</label>
                                      <input type="text" id="Empl_GiroEmpleado" name="Empl_GiroEmpleado" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el giro de la empresa">
                                  </div>     
                                  <div class="col-md-3">
                                  <label >Salario:</label>
                                      <input type="number" id="Empl_Salario" name="Empl_Salario" class="form-control col-md-7 col-xs-12" placeholder="Salario del empleado">
                                  </div>                                  
                            </div>

                            <div class="form-group row">
                              <div class="col-md-6">
                                  <label >Dirección:</label>
                                  <input type="text" id="Empl_DireccionEmpleado" name="Empl_DireccionEmpleado" class="form-control col-md-7 col-xs-12" placeholder="Ingresela la dirección">
                                </div>
                                <div class="col-md-2">
                                    <label>Teléfono de celular:<span class="required">*</span></label>
                                    <input type="number" required="required" id="Empl_CelEmpleado" name="Empl_CelEmpleado" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el número de teléfono celulara">
                                  </div>
                                  <div class="col-md-2">
                                      <label >Teléfono de oficina:</label>
                                        <input type="text" id="Empl_OficinaEmpleado" name="Empl_OficinaEmpleado" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el número de teléfono de oficina">
                                    </div>
                                    <div class="col-md-2">
                                  <label >Correo:</label>
                                      <input type="email" id="Empl_CorreoEmpleado" name="Empl_CorreoEmpleado" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el correo">
                                  </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-10">
                                <label >Notas:</label>
                                <textarea class="form-control" name="Empl_nota" id="Empl_nota" rows="1" cols="50"></textarea>
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
                                    <h4>Mis empleados</h4>
                                    <?php
                                        include("tableEmpleados.php");
                                    ?>
                                    <!--Table begin-->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

    </div>
</div>


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

<!-- /page content -->



 <!-- Modal de satisfactorio -->
 <div class="modal fade" id="modalDel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="">Exito</h3>          
        </div>
        <div class="modal-body row">
          <div class="form-group col-md-12">
            <h4 class="sMargen">Se borro el empleado seleccionado</h4>
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
                $("#mostrar").text("Ocultar formulario");
                n = 1;
            }
            else{
                $("#mostrar").text("Mostrar formulario");
                n = 0;
            }
        });
    });
</script>


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
       if(vars['p'] == "empleadosOk"){
           $('#modal').modal('show');
       }
       else if(vars['p'] == "empleadosDel"){
           $('#modalDel').modal('show');
       }
     });
</script>

<script type="text/javascript">
    $(document).ready(function() {
      $('#datatable').DataTable();
    } );
</script>
