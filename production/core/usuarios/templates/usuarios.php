<!-- Page content -->
<div  role="main">
    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>U S U A R I O S</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_title form-group row">
                    <div class="col-md-2">
                        <h2>Nuevo usuario</h2>
                    </div>
                    
                </div>

                    <div class="x_content" id="target" >
                        <br/>
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="production/core/usuarios/actions/addUsuarios.php">
                            <div class="form-group row">
                                <div class="col-md-6">
                                <label >Tipo de usuario:</label>

                                    <select name="usuarios_tipo" id="usuarios_tipo" class="form-control" onchange="obtenerTipo(this.value)"> 
                                        <option>Selecciona el tipo de usuario</option>
                                        <option value="clientes">Clientes</option>
                                        <option value="empleados">Empleados</option>
                                    </select>  
                                </div>                               
                            </div>

                            <div class="form-group row">
                              <div class="col-md-6">
                              <label >Usuario a editar:</label>
                                    <select name="usuarios_lista" id="usuarios_lista" class="form-control" onchange="obtenerValores(this.value)"> 
                                        <option>Seleccione</option>                                        
                                    </select>  
                                </div>                                
                            </div>
                            <br>
                            <hr>


                            <div class="form-group row">
                              <div class="col-md-3">
                                <label >Nombre usuario:</label>
                                    <input type="text" id="usuario_nombre" name="usuario_nombre" class="form-control col-md-7 col-xs-12" placeholder="Ingrese el nombre de usuario">
                                </div>
                                <div class="col-md-3">
                                  <label >Password:</label>
                                      <input type="text" id="usuario_password" name="usuario_password" class="form-control col-md-7 col-xs-12" placeholder="Ingrese la contraseña">
                                  </div>     
                                  <div class="col-md-3">
                                  <label >Tipo de perfil:</label>
                                    <select name="usuario_perfil" id="usuario_perfil" class="form-control"> 
                                        <option>Selecciona el perfil</option>
                                        <option value="cliente">Cliente</option>
                                        <option value="empleado">Empleado</option>
                                        <option value="administrador">Administrador</option>
                                    </select>  
                                  </div>                                  
                            </div>

                            <div class="form-group row">
                                
                                <div class="col-md-2">
                                    <label > Da click para</label>
                                    <input type="hidden" id="usuario_id" name="usuario_id" class="form-control col-md-7 col-xs-12">

                                    <input type="submit" class="form-control btn btn-success" value="Guardar">
                                </div>
                                <div class="col-md-8">
                                </div>

                                <div id="divBorrar" class="col-md-2" style="display:none">
                                    <label > Da click para</label>                                    

                                    <input type="button" class="form-control btn btn-danger" value="Borrar" data-toggle="modal" data-target="#deleteModal">
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
          <button class="btn btn-warning" type="button" data-dismiss="modal"  onclick="borrar()">Aceptar</button>
          </div>
          <div class="form-group col-md-2">
          <button class="btn btn-secundary" type="button" data-dismiss="modal">Cancelar</button>
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

  
 <!-- Modal de satisfactorio -->
 <div class="modal fade" id="modalDel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="">Exito</h3>          
        </div>
        <div class="modal-body row">
          <div class="form-group col-md-12">
            <h4 class="sMargen">Se borro el usuario</h4>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-warning" type="button" data-dismiss="modal">Aceptar</button>          
        </div>
      </div>
    </div>
  </div>
 <!-- /Modal de satisfactorio -->

<!-- /page content -->

<script src="../../../production/components/js/files/usuarios/general.js"></script>




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
       if(vars['p'] == "usuariosOk"){
           $('#modal').modal('show');
       }
       else if(vars['p'] == "usuariosDel"){
           $('#modalDel').modal('show');
       }
     });
</script>

