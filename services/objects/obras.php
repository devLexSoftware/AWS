<?php

//---Clase que contiene las funciones de usuarios
class Obra{

    //---Conexion
    private $conn;
    private $table_name = "obras";

    //--Parametros del usuarios
    public $id;
    public $identificador;
    public $proveedor;
    public $obra;
    
    public $img;

    //---Construccion de la bd
    public function __construct($db){
        $this->conn = $db;
    }

  

    //--Query para la creacion de usuario
    function listar(){
        $query = "SELECT * FROM
                    " . $this->table_name . " WHERE id = " .$this->id . "";                
     
        //--Preparando el query para ejecucion
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return $stmt;
        }
        return false;
    }
}
?>
