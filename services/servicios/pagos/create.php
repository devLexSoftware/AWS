<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../objects/pagos.php';

//--Creamos objeto para la conexion
$database = new Database();
$db = $database->getConnection();

//--Creamos objeto usuario
$pago = new Pago($db);

//--Obtenemos los parametros de la aplicacion
$data = json_decode(file_get_contents("php://input"));

//--Asignamos las parametros a los atributos del usuario
$pago->img          = $data->foto;
$pago->proveedor    = $data->proveedor;
$pago->obra         = $data->obra;
$pago->origen       = $data->origen;


//$product->created = date('Y-m-d H:i:s');

//--Ejecutamos el query de creacion y mostramos la salida
if($pago->create()){
    echo '{';
        echo '"message": "Product was created."';
    echo '}';
}
else{
    echo '{';
        echo '"message": "Unable to create product."';
    echo '}';
}
?>
