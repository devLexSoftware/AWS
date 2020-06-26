<!-- Page content -->        
<div class="">
    
    <div class="page-title">
        <div class="title_left">
            <h3>C L I E N T E S</h3>
        </div>

        
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_title form-group row">                                                            
                                <div class="col-md-2">
                                <button type="button" id="mostrar" name="boton1"  class="btn btn-info">Nuevo cliente</button>
                                </div>
                            </div>

                <div class="x_content" id="target" style="display: none;">
                    <br/>
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="production/core/clientes/actions/addClientes.php">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="Nom-Client">Nombre de cliente:<span class="required">*</span></label>
                                <input type="text" name="cli_nombre" id="cli_nombre" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el nombre del cliente">                            
                            </div>
                            <div class="col-md-6">
                                <label for="RFC-Client">RFC:</label>                            
                                <input type="text" name="cli_rfc" id="cli_rfc" class="form-control col-md-7 col-xs-12" placeholder="Ingrse el RFC del cliente">                                                            
                            </div>
                        </div>


                        <div class="form-group row">                            
                            <div class="col-md-6">
                            <label for="Dir-Client">Calle:</label>                            
                                <input type="text" name="cli_calle" id="cli_calle"  class="form-control col-md-7 col-xs-12" placeholder="Ingrese la calle">
                            </div>
                            <div class="col-md-3">
                                <label  for="CalleNum-Client">Número Ext.:</label>                            
                                <input type="text" name="cli_numext" id="cli_numext"  class="form-control col-md-7 col-xs-12" placeholder="Ingrese el número">
                            </div>                    
                            <div class="col-md-3">
                                <label  for="CalleNum-Client">Número Int.:</label>                            
                                <input type="text" name="cli_numint" id="cli_numint" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el número">
                            </div>                    
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="Col-Client">Colonia:</label>                            
                                <input type="text" name="cli_colonia" id="cli_colonia" class="form-control col-md-7 col-xs-12" placeholder="Ingrese la colonia">
                            </div>                    
                            <div class="col-md-2">
                                <label for="Col-Client">C.P:</label>                            
                                <input type="number" name="cli_cp" id="cli_cp"  class="form-control col-md-7 col-xs-12" placeholder="Ingrese el CP">
                            </div>
                            <div class="col-md-3">
                                <label  for="Ciudad-Client">Ciudad:</label>                            
                                <input type="text" name="cli_ciudad" id="cli_ciudad" class="form-control col-md-7 col-xs-12" placeholder="Ingrese la ciudad">
                            </div>
                            <div class="col-md-3">
                                <label for="Municipio-Client">Estado:</label>                            
                                <input type="text" name="cli_municipio" id="cli_municipio" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el estado">
                            </div>
                        </div>

                        <div class="form-group row">                                                              
                            <div class="col-md-4">
                                <label >Empresa:</label>                            
                                <input type="text" name="cli_empresa" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el nombre de la empresa">
                            </div>
                            <div class="col-md-2">
                                <label >Correo:<span class="required">*</span></label>                            
                                <input type="email" require name="cli_email" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el correo">
                            </div>
                            <div class="col-md-3">
                                <label >Teléfono móvil:<span class="required">*</span></label>                            
                                <input type="number" name="cli_movil" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese número móvil">
                            </div>
                            <div class="col-md-3">
                                <label >Teléfono de oficina:</label>                            
                                <input type="text" name="cli_telefono"  class="form-control col-md-7 col-xs-12" placeholder="Ingrese el número de teléfono de oficina">
                            </div>              
                        </div>

                        <div class="form-group row">
                            <div class="col-md-10">
                            <label >Notas:</label>
                            <textarea class="form-control" name="cli_nota" id="cli_nota" rows="1" cols="50"></textarea>
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
                                <h3>Ultimos clientes agregados</h3>
                                <?php 
                                    include("tableClientesNuevos.php");
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <h4>Mis clientes</h4>
                                <?php 
                                    include("tableClientes.php");
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
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

  
 <!-- Modal de satisfactorio -->
 <div class="modal fade" id="modalDel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="">Exito</h3>          
        </div>
        <div class="modal-body row">
          <div class="form-group col-md-12">
            <h4 class="sMargen">Se borro el cliente seleccionado</h4>
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
                $("#mostrar").text("Ocultar nuevo cliente");
                n = 1;
            }            
            else{
                $("#mostrar").text("Nuevo cliente");
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
        if(vars['p'] == "clientesOk"){            
            $('#modal').modal('show');
        }     
        else if(vars['p'] == "clientesDel"){
            $('#modalDel').modal('show');
        }               
      });
</script>

