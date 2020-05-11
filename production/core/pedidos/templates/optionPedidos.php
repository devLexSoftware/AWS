<?php
include("../../../config/conexion.php");
error_reporting(E_ALL);
ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else {

    $idPedido = $_GET["ref"];    
    $result = mysqli_query($con,"SELECT pedidos.id, pedidos.frente, pedidos.descripcion, pedidos.estado,  obras.nombre as obraNombre, obras.id as obraId from pedidos
    inner join obras on pedidos.fk_obra = obras.id where pedidos.id = $idPedido ");        
    $elemento = mysqli_fetch_array($result);    

    $result2 = mysqli_query($con,"SELECT * FROM obras;");
    $elemento2 = mysqli_fetch_array($result2);
}
?>

<div class="">
    
<div class="page-title">
<div class="page-title">
    <div class="row">
        <div class="col-md-10">
            <h3>P E D I D O </h3>
        </div>
        <div class="col-md-2">
            <input type="submit" class="form-control btn btn-danger" value="Borrar" data-toggle="modal" data-target="#deleteModal">
        </div>
    </div> 
</div> 

    <div class="x_content" id="target" >
        <br/>
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="production/core/pedidos/actions/updatePedidos.php">
        <div class="form-group row">
            <div class="col-md-6">
            <label for="Obra_Reporte">Obra:<span class="required">*</span></label>
                <select class="form-control" id="pedido_obra" name="pedido_obra" id="pedido_obra">
                    <option value="<?php echo($elemento['obraId']); ?>"><?php echo($elemento['obraNombre']); ?></option>
                    <?php
                            while($elemento2 = mysqli_fetch_array($result2)){
                                echo '
                                    <option id="'.$elemento2[id].'" value="'.$elemento2[id].'">'.$elemento2[nombre].'</option>
                                ';
                            }
                        ?>
                </select>
            </div>

            
            <div class="col-md-6">
                <label for="Frente-Client">Frente:</label>                            
                <select class="form-control" id="pedido_frente" name="pedido_frente">
                    <option value="<?php echo($elemento['frente']); ?>"><?php echo($elemento['frente']); ?></option>                    
                    <option value="Albañileria">Albañileria</option>
                    <option value="Carpinteria">Carpinteria</option>
                    <option value="Electricista">Electricista</option>
                    <option value="Herreria">Herreria</option>
                    <option value="Jardineria">Jardineria</option>
                    <option value="Plomeria">Plomeria</option>
                    <option value="Pintura">Pintura</option>
                    <option value="Piso y Azulejo">Piso y Azulejo</option>
                    <option value="Redes">Redes</option>
                    <option value="Yeso">Yeso</option>                                                                        
                </select>
            </div>
        </div>


        <div class="form-group row">
            <div class="col-md-6">
            <label >Notas:</label>
            <textarea class="form-control" name="pedido_nota" id="pedido_nota" rows="1" cols="50" ><?php echo($elemento['descripcion']); ?></textarea>
            </div>
            <div class="col-md-4">
                <label for="Estatus-Pedidos">Estado:</label>                            
                <select class="form-control" id="pedido_estado" name="pedido_estado">
                    <option value="<?php echo($elemento['estado']); ?>"><?php echo($elemento['estado']); ?></option>                                        
                    <option value="Realizado">Realizado</option>
                    <option value="Aprobado">Aprobado</option>
                    <option value="Rechazado">Rechazado</option>
                    <option value="Pedido">Pedido</option>
                    <option value="Entregado">Entregado</option>                                    
                </select>
            </div>
            <div class="col-md-2">
                <input id="pedido_id" name="pedido_id" value="<?php echo($elemento['id']); ?>" type="hidden">
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
          <button class="btn btn-warning" type="button" data-dismiss="modal"  onclick="del('pedidos', '<?php echo $idPedido;?>')">Aceptar</button>
          </div>
          <div class="form-group col-md-2">
          <button class="btn btn-secundary" type="button" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
