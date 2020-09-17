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
    $id = $_GET["ref"];
    $result0 = mysqli_query($con,"SELECT * FROM cotizaciones where id = $id;");
    $elemento = mysqli_fetch_array($result0);
    
    $result1 = mysqli_query($con,"SELECT * FROM cotizaciones_detalles where fk_cotizaciones = $id;");

    $result10 = mysqli_query($con,"SELECT nombre FROM frentes WHERE estado = 0;");    

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
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="production/core/cotizaciones/actions/updateCotizacion.php">
                        <div class="form-group row">
                                <div class="col-md-6">
                                  <label for="Nom-Client">Nombre de cliente:<span class="required">*</span></label>
                                    <input value="<?php echo $elemento[cliente]; ?>" type="text" name="Nomcliente" required="required" class="form-control " placeholder="Ingrese el nombre del cliente">
                                </div>        
                                <div class="col-md-2"></div>        
                                <div class="col-md-2 ">
                                    <button type="button" onclick="imprimirReporte(1)" class="btn btn-info"> Imprimir cliente</button>
                                </div>
                                <div class="col-md-2 ">
                                    <button type="button" onclick="imprimirReporte(2)" class="btn btn-danger"> Imprimir</button>
                                </div>
                            </div>

                            <div class="form-group row">
                            <div class="col-md-6">
                                    <label for="">Obra:<span class="required">*</span></label>
                                        <input value="<?php echo $elemento[obra]; ?>" type="text" name="Obra" required="required" class="form-control" placeholder="Ingrese el nombre de la obra">
                                    </div>
                                <div class="col-md-6">
                                <label for="">Frente:<span class="required">*</span></label>
                                    <!-- <input value="<?php echo $elemento[frente]; ?>" type="text" name="Frente" required="required" class="form-control" placeholder="Ingrese el nombre del frente"> -->
                                    <select class="form-control" name="Frente" id="Frente" >
                                    <option id="<?php echo $elemento[frente]; ?>" value="<?php echo $elemento[frente]; ?>"><?php echo $elemento[frente]; ?></option>
                                    <?php
                                            while($elemento10 = mysqli_fetch_array($result10)){
                                                echo '
                                                    <option id="'.$elemento10[nombre].'" value="'.$elemento10[nombre].'">'.$elemento10[nombre].'</option>
                                                ';
                                            }
                                        ?>
                                </select>
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
                                  <div class="col-md-1">
                                    <button type="button" onclick="addDetalles()" class="btn btn-success"> Agregar</button>
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
                                  <tbody>    
                                  <?php
                                      $detalle = 0;
                                      while($elemento1 = mysqli_fetch_array($result1)){                                    
                                        echo '
                                        <tr>
                                        <td><button type="button" id="btnBorrar' . $detalle .'" onclick="deleteDetalle(' . $detalle .')" class="btn btn-info"> <span class="glyphicon glyphicon-trash" ></span></button></td>
                                        
                                        <td><textarea value="'.$elemento1[concepto].'" name="detalleConcepto' . $detalle .'" id="detalleConcepto' . $detalle .'" placeholder="Concepto" class="form-control">'.$elemento1[concepto].'</textarea></td>

                                        <td><select class="form-control" id="detalleUnidad' . $detalle .'" name="detalleUnidad' . $detalle .'" >
                                          <option value="'.$elemento1[unidad].'">'.$elemento1[unidad].'</option>
                                          <option value="Caja">Caja</option>
                                          <option value="Camion">Camión</option>
                                          <option value="Días">Días</option>
                                          <option value="Hora">Hora</option>
                                          <option value="Kilo">Kilo</option>
                                          <option value="Litros">Litros</option>
                                          <option value="Lote">Lote</option>
                                          <option value="Metros">Metros</option>
                                          <option value="Metros cuadrados">Metros cuadrados</option>
                                          <option value="Metros cubicos">Metros cubicos</option>
                                          <option value="Pieza">Pieza</option>
                                          <option value="Pipa">Pipa</option>
                                          <option value="Tonelada">Tonelada</option>
                                          <option value="Viaje">Viaje</option>            
                                        </select></td>
                                        <td><input value="'.$elemento1[cantidad].'" type="text" class="form-control" onchange="calPres('. $detalle.')"  name="detalleCantidad' . $detalle .'" id="detalleCantidad' . $detalle .'" placeholder="Cantidad"></td>
                                        <td><input value="'.$elemento1[costo].'" type="text" class="form-control" onchange="calPres('. $detalle .')" name="detalleCosto' . $detalle .'" id="detalleCosto' . $detalle .'" placeholder="Cantidad"></td>
                                        <td><input value="'.$elemento1[util].'" type="text" class="form-control"  name="detalleUtil' . $detalle .'" id="detalleUtil' . $detalle .'" placeholder="Util"></td>
                                        <td><input value="'.$elemento1[admin].'" type="text" class="form-control"  name="detalleAdmin' . $detalle .'" id="detalleAdmin' . $detalle .'" placeholder="Admin"></td>
                                        <td><input value="'.$elemento1[directo].'" type="text" class="form-control"  name="detalleDirecto' . $detalle .'" id="detalleDirecto' . $detalle .'" placeholder="Directo"></td>
                                        <td><input value="'.$elemento1[cu].'" type="text" class="form-control"  name="detalleCostoUni' . $detalle .'" id="detalleCostoUni' . $detalle .'" placeholder="Costo"></td>
                                        <td><input value="'.$elemento1[descuento].'" type="text" class="form-control"  name="detalleDescuento' . $detalle .'" id="detalleDescuento' . $detalle .'" placeholder="Descuento"></td>
                                        <td><input value="'.$elemento1[costo_real].'" type="text" class="form-control"  name="detalleCReal' . $detalle .'" id="detalleCReal' . $detalle .'" placeholder="Costo Real"></td>
                                        <td><input value="'.$elemento1[ganancia_real].'" type="text" class="form-control"  name="detalleGanancia' . $detalle .'" id="detalleGanancia' . $detalle .'" placeholder="Ganancia"></td>
                                        <td><input value="'.$elemento1[real_valor].'" type="text" class="form-control"  name="detalleReal' . $detalle .'" id="detalleReal' . $detalle .'" placeholder="Real"></td>
                                        <td><input value="'.$elemento1[importe].'" type="text" class="form-control"  name="detalleImporte' . $detalle .'" id="detalleImporte' . $detalle .'" placeholder="Importe"></td>
                                        </tr>
                                        ';  
                                        $detalle++;                                      
                                      }
                                      ?>                                
                                  </tbody>
                                </table>
                                  <div class="col-md-1">
                                    <input id="detalleCantidad" style="display:none" name="detalleCantidad" readonly class="form-control" value="<?php echo (double)$detalle; ?>">
                                  </div>

                                  <div class="col-md-1">
                                    <input id="cotizacionId" style="display:none" name="cotizacionId" readonly class="form-control" value="<?php echo $id; ?>">
                                  </div>
                                </div>                               

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
