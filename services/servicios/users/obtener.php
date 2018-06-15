<?php
// required headers

header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin' , '*');
header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT');
header('Accept','application/json');
header('content-type','application/json');

include_once '../../config/database.php';
include_once '../../objects/users.php';

//--Creamos objeto para la conexion
$database = new Database();
$db = $database->getConnection();

//--Creamos objeto usuario
$user = new User($db);

/*error_log("DATOS RECIBIDOS");
echo "<pre>";
var_dump($data);
die;
error_log("User: ".$data->user);
error_log("Pass: ".$data->password);
*/

//$user->usuario = $data->usario;
//$user->pass = $data->pass;

//--Obtenemos los parametros de la aplicacion
//$data = json_decode(file_get_contents("php://input"));

//--Asignamos las parametros a los atributos del usuario
//$obra->usuario  = $data->user;

//--Ejecutamos el query de creacion y mostramos la salidas

$stmt = $user->listar();
$num = $stmt->rowCount();

if($num > 0)
{
  // products array
  $users_arr = array();
  $users_arr["error"] = false;
  $users_arr["data"] = array();

  // retrieve our table contents
  // fetch() is faster than fetchAll()
  // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
     // extract row
     // this will make $row['name'] to
     // just $name only
     extract($row);

     $user_item=array("id" => $id, "usuario" => $usuario, "pass" => $pass);
     array_push($users_arr["data"], $user_item);
  }

  echo json_encode($users_arr);
}
else
{
  echo json_encode(array("error" => true));
}
?>
