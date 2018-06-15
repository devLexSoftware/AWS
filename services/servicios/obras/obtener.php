<?php
// required headers

header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin' , '*');
header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT');
header('Accept','application/json');
header('content-type','application/json');

include_once '../../config/database.php';
include_once '../../objects/obras.php';

//--Creamos objeto para la conexion
$database = new Database();
$db = $database->getConnection();

//--Creamos objeto usuario
$obra = new Obra($db);

//--Obtenemos los parametros de la aplicacion
$data = json_decode(file_get_contents("php://input"));

//--Asignamos las parametros a los atributos del usuario
$obra->id  = $data->id;

//--Ejecutamos el query de creacion y mostramos la salidas
$stmt = $obra->listar();
$num = $stmt->rowCount();

if($num>0){
  // products array
  $products_arr=array();
  $products_arr["results"]=array();

  // retrieve our table contents
  // fetch() is faster than fetchAll()
  // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
     // extract row
     // this will make $row['name'] to
     // just $name only
     extract($row);

     $product_item=array(
         "id" => $id,  
         "nombre" => $nombre
     );

     array_push($products_arr["results"], $product_item);
  }

  echo json_encode($products_arr);
}

else{
  echo json_encode(
     array("message" => "No products found.")
  );
}



?>
