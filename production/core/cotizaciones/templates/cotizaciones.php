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

    $result1 = mysqli_query($con,"SELECT nombre FROM frentes WHERE estado = 0;");    
}
?>


<div class="">

    <div class="page-title">
        <div class="title_left">
            <h3>C O T I Z A C I O N E S</h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_title form-group row">
                                <div class="col-md-2">
                                <button type="button" id="mostrar" name="boton1"  class="btn btn-info">Nueva cotización</button>
                                </div>
                            </div>

                    <div class="x_content" id="target" style="display: none;">
                        <br/>
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="production/core/cotizaciones/actions/addCotizacion.php">
                            <div class="form-group row">
                                <div class="col-md-6">
                                  <label for="Nom-Client">Nombre de cliente:<span class="required">*</span></label>
                                    <input type="text" name="Nomcliente" required="required" class="form-control " placeholder="Ingrese el nombre del cliente">
                                </div>                                
                            </div>

                            <div class="form-group row">
                            <div class="col-md-6">
                                    <label for="">Obra:<span class="required">*</span></label>
                                        <input type="text" name="Obra" required="required" class="form-control" placeholder="Ingrese el nombre de la obra">
                                    </div>
                                <div class="col-md-6">
                                <label for="">Frente:<span class="required">*</span></label>
                                    <!-- <input type="text" name="Frente" required="required" class="form-control" placeholder="Ingrese el nombre del frente"> -->
                                    <select class="form-control" name="Frente" id="Frente" >
                                    <option>Selecciona el frente</option>
                                    <?php
                                            while($elemento1 = mysqli_fetch_array($result1)){
                                                echo '
                                                    <option id="'.$elemento1[nombre].'" value="'.$elemento1[nombre].'">'.$elemento1[nombre].'</option>
                                                ';
                                            }
                                        ?>
                                </select>
                                </div>                                
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4">
                                <label class="control-label" for="">Superficie m2:</label>
                                  <input type="text" name="Superficie" required="required" class="form-control" placeholder="Ingrese la superficie">
                              </div>
                              <div class="col-md-4">
                                <label class="control-label" for="">Costo promedio:</label>
                                  <input type="text" name="costoPromedio" required="required" class="form-control" placeholder="Ingrese el costo promedio">
                              </div>
                              <div class="col-md-4">
                                <label class="control-label" for="">Costo Total:</label>
                                  <input type="text" readonly name="costoTotal" id="costoTotal" required="required" class="form-control" placeholder="Total de la obra">
                              </div>                              
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                <label class="control-label" for="">Inicio de la obra:</label>
                                  <input type="date" name="Inicio" required="required" class="form-control" placeholder="Inicio">
                              </div>
                              <div class="col-md-4">
                                <label class="control-label" for="">Entrega de la obra:</label>
                                  <input type="date" name="Entrega" required="required" class="form-control" placeholder="Entrega">
                              </div>
                              <div class="col-md-4">
                                <label class="control-label" for="">Inversión promedio semanal:</label>
                                  <input type="text" name="Inversion" required="required" class="form-control" placeholder="Inversión semanal">
                              </div>
                            </div>

                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="x_content">
                                <div class="from-group row">
                                  <div class="col-md-3">
                                    <h2>Detalles de la cotización</h2>
                                  </div>
                                  <div class="col-md-7"></div>
                                  <div class="col-md-1">
                                    <button type="button" onclick="addDetalles()" class="btn btn-success"> Agregar</button>
                                  </div>
                                  <div class="col-md-1">
                                    <input id="detalleCantidad" name="detalleCantidad" readonly class="form-control" value="0">
                                  </div>
                                </div>
                                <div style="overflow-x:auto;">
                                <table id="tableDetalles" class="table table-striped table-bordered" style="width:2200px;">
                                <thead>
                                    <tr>
                                        <th width="5%">Borrar</th>            
                                        <th width="10%">Concepto</th>            
                                        <th width="10%">Unidad</th>
                                        <th width="10%">Cantidad</th>                                                                                            
                                        <th width="10%">Costo</th>                                                                                            
                                        <th width="5%">Util</th>
                                        <th width="5%">Admin</th>   
                                        <th width="5%">Directo</th>   
                                        <th width="5%">C.U.</th>
                                        <th width="5%">Descuento</th>
                                        <th width="7%">Costo Real</th>
                                        <th width="7%">Gancia Real</th>
                                        <th width="7%">Real</th>
                                        <th width="7%">Importe</th>                                        
                                    </tr>
                                </thead>
                                <tbody style="">                                    
                                </tbody>
                                </table>
                                </div>
                                <br>
<!--                                <div class="form-group row">
                                  <div class="col-md-10 col-sm-10 col-xs-10 "></div>
                                    <div class="col-md-2 col-sm-2 col-xs-2 ">
                                        <input name="Subtotal" type="text" class="form-control" readonly="readonly" id="outputSubtotal" placeholder="Subtotal">
                                    </div>
                                </div>

                                <div class="form-group row">
                                  <div class="col-md-10 col-sm-10 col-xs-10 "></div>
                                    <div class="col-md-2 col-sm-2 col-xs-2 ">
                                        <input name="Iva" type="text" class="form-control" readonly="readonly" id="outputIVA" placeholder="IVA">
                                    </div>
                                </div>
-->                                                                

                                <div class="form-group row">
                                  <div class="col-md-10 col-sm-10 col-xs-10 "></div>
                                    <div class="col-md-2 col-sm-2 col-xs-2 ">
                                        <button type="submit" class="btn btn-success"> Guardar</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

              </div>
              </form>
            </div>
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_content">
                        <h3>Ultimas cotizaciones</h3>
                        <?php
                            include("tableCotizacionesNuevas.php");
                        ?>
                    </div>
                </div>
            </div>
        </div>

         <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_content">
                                    <h4>Mis cotizaciones</h4>
                                    <?php
                                        include("tableCotizaciones.php");
                                    ?>
                                </div>
                            </div>
                        </div>
        
        



          <div class="modal fade" id="modalCreado">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="">Exito</h3>
                </div>
                <div class="modal-body row">
                  <div class="form-group col-md-12">
                    <h4 class="sMargen">Se creo el registro correctamente</h4>
                  </div>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-warning" type="button" data-dismiss="modal">Aceptar</button>
                </div>
              </div>
            </div>
          </div>


<script type="text/javascript">
var n = 0;
 $(document).ready(function() {
        $('#mostrar').click(function() {
            $('#target').slideToggle("fast");
            if(n == 0){
                $("#mostrar").text("Ocultar");
                n = 1;
            }
            else{
                $("#mostrar").text("Nueva cotización");
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
        if(vars['p'] == "cotizacionesOk"){
            $('#modalCreado').modal('show');
        }
      });
</script>


<script type="text/javascript">
    $(document).ready(function() {
      $('#datatable').DataTable();
    } );
</script>



<script src="../../../production/components/js/files/cotizaciones/general.js"></script>
