<?php
include("../../../config/conexion.php");
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else {
    $result1 = mysqli_query($con,"SELECT * FROM clientes;");
    $result2 = mysqli_query($con,"SELECT * FROM obras;");
    $result3 = mysqli_query($con,"SELECT * FROM proveedores;");
}
?>



<!-- Page content -->

    <di class="">

        <!--Title page -->
        <div class="page-title">
            <div class="title_left">
                <h3>Listado de compras</h3>
            </div>
        </div>

        <div class="clearfix"></div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_title form-group row">
            <div class="col-md-2">
                <h2>Filtros para compras</h2>
            </div>
        </div>
                        <div class="x_content" id="target">
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="production/core/obras/actions/addObras.php">
<!--
                            <div class="form-group row">
                                    <div class="col-md-6">
                                        <label >Periodo Inicial:</label><span>Solo días lunes</span>
                                        <input class="form-control" id="com_fechInicial" name="com_fechInicial" placeholder="DD/MM/YYYY" type="text"/>

                                    </div>
                                    <div class="col-md-6">
                                        <label >Periodo Final</label><span>Solo días domingo</span>
                                        <input class="form-control" id="com_fechFinal" name="com_fechFinal" placeholder="DD/MM/YYYY" type="text"/>
                                    </div>
                            </div>
                          -->
                                <div class="form-group row">
                                    <div class="col-md-6">
                                    <label >Nombre de la obra:</label>
                                    <select class="form-control" name="Obra_Reporte" id="Obra_Reporte">
                                    <option selected="true" value="0" disabled="disabled">Selecciona la obra</option>
                                    <?php
                                            while($elemento = mysqli_fetch_array($result2)){
                                                echo '
                                                    <option id="'.$elemento[id].'" value="'.$elemento[id].'" name="'.$elemento[id].'">'.$elemento[nombre].'</option>
                                                ';
                                            }
                                        ?>
                                </select>
                                    </div>
                                    <div class="col-md-2">
                                <label > Da click para</label>
                                <input type="button" class="form-control btn btn-success" onclick="actualizar(Obra_Reporte.value);" value="Buscar compras">
                            </div>
                                </div>



                                </form>
                                </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <p class="text-muted font-13 m-b-30">
                            Mis compras.
                        </p>

                        <!--Table begin-->
                        <div id="tableCompras" style="width:100%; height:100%; overflow-x: scroll;">
                          
                        </div>
                    </div>
                </div>
        </div>

    </di>
<!-- /page content -->

<script src="../../../../production/components/js/files/compras/general.js"></script>

<script>
    $(document).ready(function() {
    $('#com_fechInicial').datepicker({
        autoclose: true,
        daysOfWeekDisabled: "0,2,3,4,5,6",
        format: 'yyyy-mm-dd'//check change

    });
    $('#com_fechFinal').datepicker({
        autoclose: true,
        daysOfWeekDisabled: "1,2,3,4,5,6",
        format: 'yyyy-mm-dd'//check change
    });
});
</script>

<script type="text/javascript">
    $(document).ready(function() {
      $('#datatable2').DataTable();
    } );
</script>
