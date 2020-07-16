<?php
header('content-type: image/jpeg');


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
    $result0 = mysqli_query($con,"SELECT * FROM compras where id = $id;");
    $elemento = mysqli_fetch_array($result0);
    $result1 = mysqli_query($con,"SELECT * FROM clientes WHERE estado = 0;");
    $result2 = mysqli_query($con,"SELECT * FROM obras;");
    $result3 = mysqli_query($con,"SELECT empresa, id FROM proveedores;");
    $result04 = mysqli_query($con,"SELECT empresa, id FROM contratistas;");


    $result4 = mysqli_query($con,"SELECT * FROM clientes WHERE id = $elemento[fk_clientes];");
    $elemento4 = mysqli_fetch_array($result4);
    $result5 = mysqli_query($con,"SELECT * FROM obras WHERE fk_clientes = $elemento[fk_clientes];");
    $elemento5 = mysqli_fetch_array($result5);
        
    $result6 = mysqli_query($con,"SELECT * FROM proveedores WHERE id = $elemento[fk_proveedor];");
    $elemento6 = mysqli_fetch_array($result6);
    if($elemento6[id] == null)
    {
        $result7 = mysqli_query($con,"SELECT * FROM contratistas WHERE id = $elemento[fk_contratista];");
        $elemento7 = mysqli_fetch_array($result7);
    }
    
    $result10 = mysqli_query($con,"SELECT nombre FROM frentes WHERE estado = 0;");    


}
?>


    <!--Title page -->
    <div class="page-title">
    <div class="row">
        <div class="col-md-6">
            <h3>C O M P R A </h3>
        </div>
        <div class="col-md-2">
        <?php if($elemento["foto"] != null)
        {   
        ?>     
            
                <input type="button" class="form-control btn btn-info" value="Mostrar recibo" data-toggle="modal" data-target="#reciboModal">
            
        <?php 
        }   
        ?>  
        </div>   
        <div class="col-md-2">
        </div>
        <div class="col-md-2">
            <input type="submit" class="form-control btn btn-danger" value="Borrar" data-toggle="modal" data-target="#deleteModal">
        </div>
    </div>
  </div>

    <div class="cleafix"></div>
    <div class="row">
      <div class="x_content">
                    <br/>
                    <form id="form" data-parsley-validate class="form-horizontal form-label-left"  method="post" action="production/core/compras/actions/updateCompras.php">
                        <div class="form-group row">
                            <div class="col-md-6">
                            <label  for="Cliente_Reporte">Cliente:<span class="required">*</span></label>
                                <select class="form-control" name="Cliente_Reporte" id="Cliente_Reporte" onchange="obtenerObras(this.value,'obras')">
                                    <option value="<?php echo($elemento['fk_clientes']); ?>"><?php echo($elemento4['nombre']); ?></option>
                                    <?php
                                            while($elemento1 = mysqli_fetch_array($result1)){
                                                echo '
                                                    <option id="'.$elemento1[id].'" value="'.$elemento1[id].'">'.$elemento1[nombre].'</option>
                                                ';
                                            }
                                        ?>
                                </select>
                                <br>
                                <label for="Obra_Reporte">Obra:<span class="required">*</span></label>
                                <select class="form-control" id="Obra_Reporte" name="Obra_Reporte" id="Obra_Reporte">
                                  <option value="<?php echo($elemento['fk_obra']); ?>"><?php echo($elemento5['nombre']); ?></option>
                                  <?php
                                          while($elemento5 = mysqli_fetch_array($result5)){
                                              echo '
                                                  <option id="'.$elemento5[id].'" value="'.$elemento5[id].'">'.$elemento5[nombre].'</option>
                                              ';
                                          }
                                      ?>
                                </select>
                            </div>
                        </div>

                        <hr>

                         <div class="form-group row">
                            <div class="col-md-2">
                                <label for="Semana_Reporte">Semana:<span class="required">*</span></label>
                                <input type="number" id="Semana_Reporte" name="Semana_Reporte" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingresa la semana" value="<?php echo($elemento['semana']); ?>">
                            </div>
                            <div class="col-md-2">
                                <label for="NomFactura_Reporte">Factura:<span class="required">*</span></label>
                                <input type="text" id="NomFactura_Reporte" name="NomFactura_Reporte" required="required" class="form-control col-md-2 col-xs-12" placeholder="Ingresa el nombre de la factura" value="<?php echo($elemento['factura']); ?>">
                            </div>
                            <div class="col-md-2">
                                <label for="Periodo_Reporte">Fecha de compra:<span class="required">*</span></label>
                                <input type="text" id="fecha_Reporte" name="fecha_Reporte" required="required" class="form-control col-md-2 col-xs-12" placeholder="Ingresa el inicio de periodo" value="<?php echo($elemento['fecha']); ?>"><br><br>
                            </div>                            
                            <div class="col-md-3">
                                <label >Periodo Inicial: </label><span>Solo días lunes</span>
                                <input onchange="asignarFinal()"  required class="form-control" id="fechInicial_Reporte" name="fechInicial_Reporte" placeholder="DD/MM/YYYY" type="text" value="<?php echo($elemento['fechInicial']); ?>"/>

                            </div>
                            <div class="col-md-3">
                                <label >Periodo Final: </label><span>Solo días domingo</span>
                                <input required class="form-control" id="fechFinal_Reporte" name="fechFinal_Reporte" placeholder="DD/MM/YYYY" type="text" value="<?php echo($elemento['fechFinal']); ?>"/>
                            </div>
                         </div>

                        <hr>

                        <div class="form-group row">
                            <div class="col-md-1">
                                <label for="CostoUnit_Reporte">Cantidad:<span class="required">*</span></label>
                                <input type="text" id="Cantidad_Reporte" name="Cantidad_Reporte" required="required" class="form-control col-md-2 col-xs-12" placeholder="0" value="<?php echo($elemento['cantidad']); ?>">
                            </div>
                            <div class="col-md-3">
                            <label for="Descripcion_Reporte">Descripción:<span class="required">*</span></label>
                                <input type="text" id="Descripcion_Reporte" name="Descripcion_Reporte" required="required" class="form-control col-md-2 col-xs-12" placeholder="Ingresa la descripcion del servcio" value="<?php echo($elemento['descripcion']); ?>">
                            </div>
                            <div class="col-md-2">
                                <label  for="Unidad_Reporte">Unidad:<span class="required">*</span></label>
                                <select class="form-control" id="Unidad_Reporte" name="Unidad_Reporte" >
                                    <option value="<?php echo($elemento['unidad']); ?>"><?php echo($elemento['unidad']); ?></option>
                                    <option value="Camion">Camión</option>
                                    <option value="Kilo">Kilo</option>
                                    <option value="Litros">Litros</option>
                                    <option value="Lote">Lote</option>
                                    <option value="Metros">Metros</option>
                                    <option value="Pieza">Pieza</option>
                                    <option value="Pipa">Pipa</option>
                                    <option value="Tonelada">Tonelada</option>

                                </select>
                            </div>
                            <div class="col-md-3">
                                <label  for="Frente_Reporte">Frente:<span class="required">*</span></label>
                                <select class="form-control" id="Frente_Reporte" name="Frente_Reporte">
                                    <option value="<?php echo($elemento['frente']); ?>"><?php echo($elemento['frente']); ?></option>

                                    <?php
                                        while($elemento10 = mysqli_fetch_array($result10)){
                                            echo '
                                                <option id="'.$elemento10[nombre].'" value="'.$elemento10[nombre].'">'.$elemento10[nombre].'</option>
                                            ';
                                        }
                                    ?>    
                                </select>
                            </div>
                           
                            <div class="col-md-3">
                            <label  for="Proveedor_Reporte">Proveedor:<span class="required">*</span></label>
                                <select class="form-control" name="Proveedor_Reporte" id="Proveedor_Reporte" onchange="actualizar(this.value,'proveedores')">                                    
                                    <?php
                                        if($elemento6[id] != null)
                                        {                                            
                                            echo '
                                                <option id="prv_'.$elemento6[id].'" value="prv_'.$elemento6[id].'">'.$elemento6[empresa].'</option>
                                            ';
                                        }
                                        else if($elemento7[id] != null)
                                        {
                                            echo '
                                                <option id="ctr_'.$elemento7[id].'" value="ctr_'.$elemento7[id].'">'.$elemento7[empresa].'</option>
                                            ';
                                        }
                                            while($elemento3 = mysqli_fetch_array($result3)){
                                                echo '
                                                    <option id="prv_'.$elemento3[id].'" value="prv_'.$elemento3[id].'">'.$elemento3[empresa].'</option>
                                                ';
                                            }

                                            while($elemento04 = mysqli_fetch_array($result04)){
                                                echo '
                                                    <option id="ctr_'.$elemento04[id].'" value="ctr_'.$elemento04[id].'">'.$elemento04[empresa].'</option>
                                                ';
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="CostoUnit_Reporte">Proceso:<span class="required">*</span></label>
                                <input type="text" id="Proceso_Reporte" name="Proceso_Reporte" required="required" class="form-control col-md-2 col-xs-12" value="<?php echo($elemento['proceso']); ?>">
                            </div>
                        <div class="col-md-2">
                            <label for="CostoUnit_Reporte">Sub-Total:</label>
                                <input onchange="calculos(1)" type="number" step="0.01" id="Subtotal_Reporte" name="Subtotal_Reporte" class="form-control col-md-2 col-xs-12" placeholder="0" value="<?php echo($elemento['subtotal']); ?>">
                            </div>
                            <div class="col-md-1">
                            <label for="CostoUnit_Reporte">Iva(16%):</label>
                                <input  onchange="calculos(2)"  type="number" id="Iva_Reporte" step="0.01" readonly name="Iva_Reporte"  class="form-control col-md-2 col-xs-12" placeholder="0" value="<?php echo($elemento['iva']); ?>">
                            </div>
                            <div class="col-md-2">
                            <label for="CostoUnit_Reporte">Importe:</label>
                                <input  onchange="calculos(3)"  type="number" step="0.01" id="Importe_Reporte" name="Importe_Reporte" class="form-control col-md-2 col-xs-12" placeholder="0" value="<?php echo($elemento['importe']); ?>">
                            </div>
                            <div class="col-md-2">
                                <label for="CostoUnit_Reporte">Costo Unitario:</label>
                                <input  onchange="calculos(2)" type="number" step="0.01" id="CostoUnit_Reporte" name="CostoUnit_Reporte"  class="form-control col-md-2 col-xs-12" placeholder="0" value="<?php echo($elemento['costo']); ?>">
                            </div>                                                       
                            
                            <div class="col-md-1">
                            <label for="CostoUnit_Reporte">Ref:</label>
                                <input type="number" step="0.01" readonly id="referencia_Reporte" name="referencia_Reporte" class="form-control col-md-2 col-xs-12" placeholder="0" value="<?php echo($elemento['id']); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-10">
                                <label >Notas:</label>
                                    <textarea class="form-control" name="Notas_Reporte" id="Notas_Reporte" rows="1" cols="50"><?php echo($elemento['comentario']); ?></textarea>
                            </div>
                            <div class="col-md-2">
                                <label > Da click para</label>
                                <input type="submit" class="form-control btn btn-success" value="Guardar">
                            </div>
                        </div>
                    </form>
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
            <button class="btn btn-warning" type="button" data-dismiss="modal"  onclick="del('compras', '<?php echo $elemento[id];?>')">Aceptar</button>
            </div>
            <div class="form-group col-md-2">
            <button class="btn btn-secundary" type="button" data-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="reciboModal">
      <div class=" modal-dialog modal-dialog-scrollable"  role="document">
        <div class="modal-content" >
          <div class="modal-header">
            <h3 class="modal-title" id="reciboModalLabel">Recibo de compra</h5>
          </div>
          <div class="modal-body row">
            <div class="form-group col-md-12"  style=" overflow: auto;">                
                <img src="<?php echo ($elemento['foto']); ?> " class="img-rounded" />;
            </div>
          </div>          
        </div>
      </div>
    </div>



    <script src="../../../../production/components/js/files/compras/general.js"></script>
    <script src="../../../../production/components/js/files/obras/general.js"></script>
 <script type="text/javascript">
      function calculos(val){
        var can = document.getElementById("Cantidad_Reporte").value;
        var impor;
        if (val == 1) {
          document.getElementById("Importe_Reporte").value = "";
          var sub = document.getElementById("Subtotal_Reporte").value;
          var iva = sub * 0.16;
          var total = parseFloat(sub) + parseFloat(iva);
          document.getElementById("Iva_Reporte").value = iva;
          document.getElementById("Importe_Reporte").value = total;
          impor = document.getElementById("Importe_Reporte").value;
        }
        else if (val == 3){
          document.getElementById("Subtotal_Reporte").value = "";
          document.getElementById("Iva_Reporte").value = "";
          impor = document.getElementById("Importe_Reporte").value;
        }
        document.getElementById("CostoUnit_Reporte").value = impor/can;
      }
</script>


<script>
    $(document).ready(function() {
    $('#fechInicial_Reporte').datepicker({
        autoclose: true,
        daysOfWeekDisabled: "0,2,3,4,5,6",
        format: 'dd-mm-yyyy'//check change

    });
    $('#fechFinal_Reporte').datepicker({
        autoclose: true,
        daysOfWeekDisabled: "1,2,3,4,5,6",
        format: 'dd-mm-yyyy'//check change
    });
    $('#fecha_Reporte').datepicker({
        autoclose: true,        
        format: 'dd-mm-yyyy'//check change
    });
    
});
</script>


<script type="text/javascript">
    function asignarFinal(){
      var fecha = $("#fechInicial_Reporte").datepicker("getDate");
      fecha.setDate(fecha.getDate() + 6);
      $("#fechFinal_Reporte").datepicker("setDate", fecha);
    }
</script>


<script type="text/javascript">
    $(document).ready(function() {
      $('#datatable3').DataTable();
    } );
</script>
