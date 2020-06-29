<!-- Page content -->
    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>P R O V E E D O R E S</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

       <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_title form-group row">                
                <div class="col-md-2">
                <button type="button" id="mostrar" name="boton1"  class="btn btn-info">Nuevo proveedor</button>
                </div>
            </div>

                    <div class="x_content" id="target" style="display: none;">
                        <br/>
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="production/core/proveedores/actions/addProveedores.php">

                            <div class="form-group row">
                                <div class="col-md-6">
                                <label>Nombre del proveedor:<span class="required">*</span></label>
                                <input type="text" required="required" name="prv_proveedor" id="prv_proveedor" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el nombre del proveedor">
                                </div>
                                <div class="col-md-6">
                                <label for="RFC-Client">RFC:</label>
                                <input  maxlength="13" minlength="13" type="text"  name="prv_rfc" id="prv_rfc" class="form-control col-md-7 col-xs-12" placeholder="Ingrse el RFC del cliente">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                <label >Nombre de la empresa:</label>
                                <input type="text" name="prv_nombre" id="prv_nombre" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el nombre de la empresa">
                                </div>
                                <div class="col-md-6">
                                <label>Dirección:</label>
                                    <input type="text" name="prv_direccion" id="prv_direccion" class="form-control col-md-7 col-xs-12" placeholder="Ingrese la dirección">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4">
                                <label>Teléfono de celular:<span class="required">*</span></label>
                                <input type="number" required="required" name="prv_celular" id="prv_celular" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el número de teléfono celular">
                                </div>
                                <div class="col-md-4">
                                <label >Teléfono de oficina:</label>
                                <input type="text"  name="prv_telefono" id="prv_telefono" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el número de teléfono de oficina">
                                </div>
                                <div class="col-md-4">
                                <label>Correo:</label>
                                <input type="email"  name="prv_email" id="prv_email" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el correo">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                <label >Descripcion:</label>
                                <input type="text"  name="prv_descripcion" id="prv_descripcion" class="form-control col-md-7 col-xs-12" placeholder="Ingresa descripción">
                                </div>                                
                            </div>


                            <div class="form-group row">
                                <div class="col-md-10">
                                <label >Notas:</label>
                                <textarea class="form-control" name="prv_nota" id="prv_nota" rows="1" cols="50"></textarea>
                                </div>
                                <div class="col-md-2">
                                    <label > Da click para</label>
                                    <input type="submit" class="form-control btn btn-success" value="Guardar">
                                </div>
                            </div>
                            <hr>
                        </form>
                    </div>

                     <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_content">
                                    <h3>Ultimos proveedores agregados</h3>
                                    <?php 
                                        include("tableProveedoresNuevos.php");
                                    ?>                                            
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_content">
                                    <h4>Mis proveedores</h4>
                                    <?php 
                                        include("tableProveedores.php");
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
<!-- /page content -->

<!-- Modal de satisfactorio -->
<div class="modal fade" id="ModalBorrado" tabindex="-1" role="dialog" aria-labelledby="ModalBorradoLabel" aria-hidden="true" >
   <div class="modal-dialog" role="document" >
     <div class="modal-content" >
       <div class="modal-header">
         <h5 class="modal-title" id="ModalBorradoLabel">Aviso</h5>
         <button class="close" type="button" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">×</span>
         </button>
       </div>
       <div class="modal-body">Se ingreso un nuevo cliente</div>
       <div class="modal-footer">
         <button class="btn btn-primary" type="button" data-dismiss="modal">Aceptar</button>
       </div>
     </div>
   </div>
 </div>
 <!-- /Modal de satisfactorio -->

 <!-- Modal de satisfactorio -->
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
 <!-- /Modal de satisfactorio -->

 <!-- Modal de satisfactorio -->
 <div class="modal fade" id="modalDel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="">Exito</h3>          
        </div>
        <div class="modal-body row">
          <div class="form-group col-md-12">
            <h4 class="sMargen">Se borro el proveedor seleccionado</h4>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-warning" type="button" data-dismiss="modal">Aceptar</button>          
        </div>
      </div>
    </div>
  </div>
 <!-- /Modal de satisfactorio -->

<!-- Navegacion -->
<script src="../../../../production/components/js/files/proveedores/General.js"></script>

<script type="text/javascript">
var n = 0;
 $(document).ready(function() {
        $('#mostrar').click(function() {
            $('#target').slideToggle("fast");
            if(n == 0){
                $("#mostrar").text("Ocultar nuevo proveedor");
                n = 1;
            }            
            else{
                $("#mostrar").text("Nuevo proveedor");
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
        if(vars['p'] == "proveedoresOk"){            
            $('#modal').modal('show');
        }    
        else if(vars['p'] == "proveedoresDel"){
            $('#modalDel').modal('show');
        }            
      });
</script>