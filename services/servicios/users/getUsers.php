<?php
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../objects/users.php';

$db = new Database();
$connection = $db->getConnection();

$user = new User($connection);

$stmt = $user->read();
$count = $stmt->rowCount();

if($count > 0)
{
  $users = array();
  $users["error"] = false;
  $users["data"] = array();

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    extract($row);

    $u = array
    (
      "fechCreacion" => $fechCreacion,
      "fechCreado" => $fechCreado,
      "usuCreacion" => $usuCreacion,
      "id" => $id,
      "usuario" => $usuario,
      "pass" => $pass
    );

    array_push($users["data"], $u);
  }

  echo json_encode($users);
}
else
{
  echo json_encode(array("error" => true, "data" => NULL));
}
