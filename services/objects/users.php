<?php
class User
{
  // Connection instance
  private $connection;

  // table name
  private $table_name = "users";

  // table columns
  public $fechCreacion;
  public $fechCreado;
  public $usuCreacion;
  public $id;
  public $usuario;
  public $pass;

  public function __construct($connection) { $this->connection = $connection; }

  //C
  public function create(){ }

  //R
  public function read()
  {
    $query = "SELECT * FROM ".$this->table_name;
    $stmt = $this->connection->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  //U
  public function update(){}

  //D
  public function delete(){}
}
