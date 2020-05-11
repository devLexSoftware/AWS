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
    $result0 = mysqli_query($con,"SELECT * FROM cotizaciones where id = $id;");
    $elemento = mysqli_fetch_array($result0);
    
    $result1 = mysqli_query($con,"SELECT * FROM cotizaciones_detalles where fk_cotizaciones = $id;");
}
?>

<div class="">

    <div class="page-title">
        <div class="title_left">
            <h3>C O T I Z A C I O N</h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_title form-group row">                                
                            </div>

                    <div class="x_content" id="target" >
                        <br/>
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="production/core/cotizaciones/actions/addCotizacion.php">
                        <div class="form-group row">
                                <div class="col-md-6">
                                  <label for="Nom-Client">Nombre de cliente:<span class="required">*</span></label>
                                    <input value="<?php echo $elemento[cliente]; ?>" type="text" name="Nomcliente" required="required" class="form-control " placeholder="Ingrese el nombre del cliente">
                                </div>                                
                            </div>

                            <div class="form-group row">
                            <div class="col-md-6">
                                    <label for="">Obra:<span class="required">*</span></label>
                                        <input value="<?php echo $elemento[obra]; ?>" type="text" name="Obra" required="required" class="form-control" placeholder="Ingrese el nombre de la obra">
                                    </div>
                                <div class="col-md-6">
                                <label for="">Frente:<span class="required">*</span></label>
                                    <input value="<?php echo $elemento[frente]; ?>" type="text" name="Frente" required="required" class="form-control" placeholder="Ingrese el nombre del frente">
                                </div>                                
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4">
                                <label class="control-label" for="">Superficie m2:</label>
                                  <input value="<?php echo $elemento[superficie]; ?>" type="text" name="Superficie" required="required" class="form-control" placeholder="Ingrese la superficie">
                              </div>
                              <div class="col-md-4">
                                <label class="control-label" for="">Costo promedio:</label>
                                  <input value="<?php echo $elemento[costoPromedio]; ?>" type="text" name="costoPromedio" required="required" class="form-control" placeholder="Ingrese el costo promedio">
                              </div>
                              <div class="col-md-4">
                                <label class="control-label" for="">Costo Total:</label>
                                  <input value="<?php echo $elemento[total]; ?>" type="text" readonly name="costoTotal" id="costoTotal" required="required" class="form-control" placeholder="Total de la obra">
                              </div>                              
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                <label class="control-label" for="">Inicio de la obra:</label>
                                  <input value="<?php echo $elemento[inicio]; ?>" type="date" name="Inicio" required="required" class="form-control" placeholder="Inicio">
                              </div>
                              <div class="col-md-4">
                                <label class="control-label" for="">Entrega de la obra:</label>
                                  <input value="<?php echo $elemento[entrega]; ?>" type="date" name="Entrega" required="required" class="form-control" placeholder="Entrega">
                              </div>
                              <div class="col-md-4">
                                <label class="control-label" for="">Inversión promedio semanal:</label>
                                  <input value="<?php echo $elemento[inversionSemanal]; ?>" type="text" name="Inversion" required="required" class="form-control" placeholder="Inversión semanal">
                              </div>
                            </div>

                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <div class="from-group row">
                                  <div class="col-md-3">
                                    <h2>Detalles de la cotización</h2>
                                  </div>
                                  <div class="col-md-7"></div>                                                                    
                                </div>

                                <div style="overflow-x:auto;">
                                <table id="tableDetalles" class="table table-striped table-bordered" style="width:2200px;">
                                <thead>
                                    <tr>                                               
                                        <th width="10%">Proceso general</th>            
                                        <th width="10%">Nombre tarea</th>
                                        <th width="10%">Duración días</th> 
                                        <th width="2%">X</th> 
                                        <th width="10%">Unidad</th>                
                                        <th width="5%">Ancho/Pieza</th>
                                        <th width="5%">Largo</th>   
                                        <th width="5%">Alto</th>   
                                        <th width="5%">Cant</th>
                                        <th width="5%">Costo</th>
                                        <th width="7%">Importe</th>
                                        <th width="7%">Sub x Tarea</th>
                                        <th width="7%">Sub a la fecha</th>
                                        <th width="7%">Sub x Proceso</th>                                        
                                    </tr>
                                </thead>
                                <tbody style="">    
                                <?php

                                    $detalle = 0;
                                    while($elemento1 = mysqli_fetch_array($result1)){                                    
                                        echo '
                                            <tr>
                                                <td><input type="text" class="form-control" value="'.$elemento1[proceso].'" placeholder="Proceso"></td>
                                                <td><textarea  class="form-control">'.$elemento1[descripcion].'</textarea></td>
                                                <td><input type="text" class="form-control" value="'.$elemento1[duracion].'" placeholder="Proceso"></td>
                                                <td><input type="text" class="form-control" value="'.$elemento1[x].'" placeholder="Proceso"></td>
                                                <td><input type="text" class="form-control" value="'.$elemento1[unidad].'" placeholder="Proceso"></td>
                                                <td><input type="text" class="form-control" value="'.$elemento1[anchoPieza].'" placeholder="Proceso"></td>
                                                <td><input type="text" class="form-control" value="'.$elemento1[largo].'" placeholder="Proceso"></td>
                                                <td><input type="text" class="form-control" value="'.$elemento1[alto].'" placeholder="Proceso"></td>
                                                <td><input type="text" class="form-control" value="'.$elemento1[cantidad].'" placeholder="Proceso"></td>
                                                <td><input type="text" class="form-control" value="'.$elemento1[costo].'" placeholder="Proceso"></td>
                                                <td><input type="text" class="form-control" value="'.$elemento1[importe].'" placeholder="Proceso"></td>
                                                <td><input type="text" class="form-control" value="'.$elemento1[subtotalxtarea].'" placeholder="Proceso"></td>
                                                <td><input type="text" class="form-control" value="'.$elemento1[subtotalxfecha].'" placeholder="Proceso"></td>
                                                <td><input type="text" class="form-control" value="'.$elemento1[subtotalxproceso].'" placeholder="Proceso"></td>
                                            </tr>
                                       ';                                        
                                    }
                                    ?>                                
                                </tbody>
                                </table>
                                </div>                               

                                <div class="form-group row">
                                  <div class="col-md-10 col-sm-10 col-xs-10 "></div>
                                    <div class="col-md-2 col-sm-2 col-xs-2 ">
                                        <!-- <button type="button" class="btn btn-success">Imprimir</button> -->
                                        <!-- <button type="button" class="btn btn-success">Imprimir</button> -->
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

              </div>
              </form>
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
                $("#mostrar").text("Ocultar nueva cotización");
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
