<?php
include("../../../config/conexion.php");
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else {
    $result1 = mysqli_query($con,"SELECT * FROM clientes WHERE estado = 0;");
    $result2 = mysqli_query($con,"SELECT * FROM obras WHERE estado = 0;;");
    $result3 = mysqli_query($con,"SELECT empresa, id FROM proveedores;");
    $result4 = mysqli_query($con,"SELECT empresa, id FROM contratistas;");
}
?>


<!-- Page content -->

<div class="">

    <!--Title page -->
    <div class="page-title">
        <div class="title_left">
            <h3>C O M P R A S</h3>
        </div>

        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12">

            </div>
        </div>
    </div>

    <div class="cleafix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="x_title">
                    <h2>Nueva compra</h2>
                        <button id="BtnVerReportes_Reportes" name="BtnVerReportes_Reportes" type="submit" class="btn btn-primary" style="margin:0 0 0 75%;">
                            <a style="color:white;" href="index.php?p=compras_reportes.php">Listado de compras</a></button>
                    <div class="clearfix"></div>

                </div>

                <div class="x_content">
                    <br/>
                    <form id="form" data-parsley-validate class="form-horizontal form-label-left">
                        <div class="form-group row">
                            <div class="col-md-6">
                            <label  for="Cliente_Reporte">Cliente:<span class="required">*</span></label>
                                <select class="form-control" name="Cliente_Reporte" id="Cliente_Reporte" onchange="obtenerObras(this.value,'obras')">
                                    <option>Selecciona el cliente</option>
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
                                    <option>Selecciona la obra</option>
                                </select>
                            </div>
                            <div class="col-md-3">

                            </div>
                            <div class="col-md-3" style="background-color:#c3daef9c; padding: 10px 10px 10px 10px;" >
                                <label for="totalFact_Reporte">Total Factura:</label>
                                <input type="number"  id="totalFact_Reporte" name="totalFact_Reporte" class="form-control col-md-2 col-xs-12" readonly />
                            </div>
                        </div>

                        <hr>

                         <div class="form-group row">
                            <div class="col-md-2">
                                <label for="Semana_Reporte">Semana:<span class="required">*</span></label>
                                <input type="number" id="Semana_Reporte" name="Semana_Reporte" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingresa la semana">
                            </div>
                            <div class="col-md-2">
                                <label for="NomFactura_Reporte">Factura:<span class="required">*</span></label>
                                <input onchange="obtenerFactura()" type="text" id="NomFactura_Reporte" name="NomFactura_Reporte" required="required" class="form-control col-md-2 col-xs-12" placeholder="Ingresa el nombre de la factura">
                            </div>
                            <div class="col-md-2">
                                <label for="Periodo_Reporte">Fecha de compra:<span class="required">*</span></label>
                                <input type="text" id="fecha_Reporte" name="fecha_Reporte" required="required" placeholder="DD/MM/YYYY" class="form-control col-md-2 col-xs-12" placeholder="Ingresa el inicio de periodo"><br><br>
                            </div>                            
                            <div class="col-md-3">
                                <label >Periodo Inicial: </label><span>Solo días lunes</span>
                                <input onchange="asignarFinal()" required class="form-control" id="fechInicial_Reporte" name="fechInicial_Reporte" placeholder="DD/MM/YYYY" type="text"/>

                            </div>
                            <div class="col-md-3">
                                <label >Periodo Final: </label><span>Solo días domingo</span>
                                <input required readonly class="form-control" id="fechFinal_Reporte" name="fechFinal_Reporte" placeholder="DD/MM/YYYY" type="text"/>
                            </div>
                         </div>

                        <hr>

                        <div class="form-group row">
                            <div class="col-md-1">
                                <label for="CostoUnit_Reporte">Cantidad:<span class="required">*</span></label>
                                <input type="text" id="Cantidad_Reporte" name="Cantidad_Reporte" required="required" class="form-control col-md-2 col-xs-12" placeholder="0">
                            </div>
                            <div class="col-md-3">
                            <label for="Descripcion_Reporte">Descripción:<span class="required">*</span></label>
                                <input type="text" id="Descripcion_Reporte" name="Descripcion_Reporte" required="required" class="form-control col-md-2 col-xs-12" placeholder="Ingresa la descripcion del servcio">
                            </div>
                            <div class="col-md-2">
                                <label  for="Unidad_Reporte">Unidad:<span class="required">*</span></label>
                                <select class="form-control" id="Unidad_Reporte" name="Unidad_Reporte" >
                                    <option value="Default">Selecciona la unidad</option>
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
                                    <option value="Default">Selecciona un frente</option>
                                    <option value="Albañeeria">Albañería</option>
                                    <option value="Carpinteria">Carpintería</option>
                                    <option value="Electricista">Electricista</option>
                                    <option value="Herreria">Herrería</option>
                                    <option value="Jardineria">Jardinería</option>
                                    <option value="Plomeria">Plomería</option>
                                    <option value="Pintura">Pintura</option>
                                    <option value="Piso y Azulejo">Piso y Azulejo</option>
                                    <option value="Redes">Redes</option>
                                    <option value="Tabla Roca">Tabla Roca</option>
                                    <option value="Yeso">Yeso</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                            <label  for="Proveedor_Reporte">Proveedor:<span class="required">*</span></label>
                                <select class="form-control" name="Proveedor_Reporte" id="Proveedor_Reporte" onchange="actualizar(this.value,'proveedores')">
                                    <option value="Default">Selecciona el proveedor</option>
                                    <?php
                                        while($elemento = mysqli_fetch_array($result3)){
                                            echo '
                                                <option id="prv_'.$elemento[id].'" value="prv_'.$elemento[id].'">'.$elemento[empresa].'</option>
                                            ';
                                        }
                                   
                                        while($elemento4 = mysqli_fetch_array($result4)){
                                            echo '
                                                <option id="ctr_'.$elemento4[id].'" value="ctr_'.$elemento4[id].'">'.$elemento4[empresa].'</option>
                                            ';
                                        }
                                    ?>
                                </select>
                            </div>
                           
                        </div>

                         <div class="form-group row">
                            <div class="col-md-2">
                            <label for="CostoUnit_Reporte">Sub-Total:</label>
                                <input onchange="calculos(1)"  step="0.01" type="number" id="Subtotal_Reporte" name="Subtotal_Reporte" class="form-control col-md-2 col-xs-12" placeholder="0">

                            </div>
                            <div class="col-md-1">
                            <label for="CostoUnit_Reporte">IVA(16%):</label>
                                <input onchange="calculos(2)"  step="0.01" type="text" id="Iva_Reporte" readonly name="Iva_Reporte" name="Iva_Reporte" class="form-control col-md-2 col-xs-12" placeholder="0">
                            </div>
                            <div class="col-md-2">
                            <label for="CostoUnit_Reporte">Importe:<span class="required">*</span></label>
                                <input onchange="calculos(3)"  step="0.01" type="number" id="Importe_Reporte" name="Importe_Reporte" class="form-control col-md-2 col-xs-12" placeholder="0">
                            </div>
                            <div class="col-md-2">
                                <label for="CostoUnit_Reporte">Costo Unitario:<span class="required">*</span></label>
                                <input  step="0.01" type="number" id="CostoUnit_Reporte" name="CostoUnit_Reporte" required="required" class="form-control col-md-2 col-xs-12" placeholder="0">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-10">
                                <label >Notas:</label>
                                    <textarea class="form-control" name="Notas_Reporte" id="Notas_Reporte" rows="1" cols="50"></textarea>
                            </div>
                            <div class="col-md-2">
                                <label > Da click para</label>
                                <input type="submit" class="form-control btn btn-success" value="Guardar">
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12" id="divTable">
          <h4>Mis compras</h4>
          <?php
              include("tableComprasHistorial.php");
          ?>
        </div>
    </div>
  </div>



<!-- Modal de satisfactorio -->
<div class="modal fade" id="modalcrear">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="">Exito</h3>
        </div>
        <div class="modal-body row">
          <div class="form-group col-md-12">
            <h4 class="sMargen">Se agrego su registro</h4>
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
 <div class="modal fade" id="modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="">Exito</h3>
        </div>
        <div class="modal-body row">
          <div class="form-group col-md-12">
            <h4 class="sMargen">Se modifico su registro</h4>
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
 <div class="modal fade" id="modalError">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="">Error</h3>
        </div>
        <div class="modal-body row">
          <div class="form-group col-md-12">
            <h4 class="sMargen">Hubo un error al crear el registro</h4>
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
            <h4 class="sMargen">Se borro la compra seleccionado</h4>
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
<script src="../../../production/components/js/files/compras/general.js"></script>
<script src="../../../production/components/js/files/obras/general.js"></script>

<script type="text/javascript">
      function calculos(val){
        debugger;
        var can = document.getElementById("Cantidad_Reporte").value;
        var impor;
        if (val == 1) {
          document.getElementById("Importe_Reporte").value = "";          
          var sub0 = document.getElementById("Subtotal_Reporte").value;
          var sub = sub0.replace(/^0+/, ''); 
          document.getElementById("Subtotal_Reporte").value = sub;
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
        document.getElementById("CostoUnit_Reporte").value = (impor/can).toFixed(2);
      }
</script>
<script>
$(document).ready(function() {
    $("form").submit( function() {
        $.ajax({
            type: "POST",
            url: "../../../production/core/compras/actions/addCompras.php",
            data: $("#form").serialize(),
            success: function(data)
            {
              debugger;
                $('#modalcrear').modal('show');
                $('#Cantidad_Reporte').val(0);
                $('#Descripcion_Reporte').val("");
                $('#Unidad_Reporte').val("Default");
                $('#Frente_Reporte').val("Default");
                $('#Proveedor_Reporte').val("Default");
                $('#CostoUnit_Reporte').val(0);
                $('#Subtotal_Reporte').val(0);
                $('#Iva_Reporte').val(0);
                $('#Importe_Reporte').val(0);
                // $('#NomFactura_Reporte').val(0);
                $('#Notas_Reporte').val("");
                $("#divTable").load('production/core/compras/templates/tableComprasHistorial.php');
                debugger;
                obtenerFactura()
            },
            error: function() {
                $('#modalError').modal('show');
            }
        })
        return false;
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
       if(vars['p'] == "comprasOk"){
           $('#modal').modal('show');
       }
       else if(vars['p'] == "comprasDel"){
           $('#modalDel').modal('show');
       }
     });
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
      $('#datatable2').DataTable();
    } );
</script>
