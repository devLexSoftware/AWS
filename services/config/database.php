<?php
class Database
{
  //--Parametros de conexion
  private $host = "localhost";
  private $db_name = "workshopstudio";
  private $username = "root";
  private $password = "q1w2e3";
  private $conn;

  public function __construct(){}

  //--Funcion para conectar bd
  public function getConnection()
  {
    $this->conn = null;
    try
    {
      $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
      $this->conn->exec("set names utf8");
    }
    catch(PDOException $exception)
    {
      echo "Connection error: " . $exception->getMessage();
    }

    return $this->conn;
  }


  //Obtener parametros para updates
  // function getParams($input)
  // {
  //   $filterParams = [];
  //   foreach($input as $param => $value)
  //   {
  //     $filterParams[] = "$param=:$param";
  //   }
  //   return implode(", ", $filterParams);
  // }
  //
  // //Asociar todos los parametros a un sql
  // function bindAllValues($statement, $params)
  // {
  //   foreach($params as $param => $value)
  //   {
  //     $statement->bindValue(':'.$param, $value);
  //   }
  //   return $statement;
  // }
}
?>
