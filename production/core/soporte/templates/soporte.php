
  <h1>Contacto</h1>
  <hr>

  <form role="form-horizontal" method="post" action="production/core/soporte/actions/email.php" id="formContacto" autocomplete="off" name="Contacto">

    <div class="form-group row ">
      <div class="form-group col-md-10">
        <p>Lex Software esta para ayudarte con tu trabajo, es por ello que si encuentras algun problema o tienes dudas sobre funcionamiento de tu sistema, tienes los siguientes formas para contactarnos:</p>
      </div>
      <div class="form-group col-md-6">
        <h6>Correo: soporte@lexsoftware.net</h6>
        <h6>Teléfono contacto: 462-146-7027</h6>
        <h6>Teléfono desarrollo: 462-629-4473</h6>
      </div>
      <div class="form-group col-md-4">
        <img src="../../../recursos/img/sistema/logoLex.jpg" style="width:50%;" alt="">
      </div>
    </div>
    <hr>
    <div class="form-group row ">
      <div class="form-group col-md-5">
        <p class="sMargen">Manda tus comentarios o problemas, nuestro equipo se pondra en contacto</p>
        <textarea class="form-control" name="cliEmail" rows="3" cols="50"></textarea>
      </div>
    </div>
    <div class="form-group row ">
      <div class="form-group col-md-5">
        <p class="sMargen"  style="color:#949494">Enviar</p>
        <button type="submit" class="btn btn-primary" name="button">Correo</button>
      </div>
    </div>

    
  <div class="modal fade" id="error">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="">Error</h3>          
        </div>
        <div class="modal-body row">
          <div class="form-group col-md-12">
            <h4 class="sMargen">Se produjo un error al enviar el correo.</h4>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-warning" type="button" data-dismiss="modal">Aceptar</button>          
        </div>
      </div>
    </div>
  </div>

  
 <!-- Modal de satisfactorio -->
 <div class="modal fade" id="exito">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="">Exito</h3>          
        </div>
        <div class="modal-body row">
          <div class="form-group col-md-12">
            <h4 class="sMargen">Se envio el correo.</h4>
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
        if(vars['p'] == "soporteExito"){            
            $('#exito').modal('show');
        }     
        else if(vars['p'] == "soporteError"){
            $('#error').modal('show');
        }               
      });
</script>