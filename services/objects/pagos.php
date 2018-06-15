<?php

//---Clase que contiene las funciones de usuarios
class Pago{

    //---Conexion
    private $conn;
    private $table_name = "compras";

    //--Parametros del usuarios
    public $id;
    public $identificador;
    public $proveedor;
    public $obra;    
    public $img;
    public $origen;

    //---Construccion de la bd
    public function __construct($db){
        $this->conn = $db;
    }

  

    //--Query para la creacion de usuario
    function create(){
        $base = "data:image/jpeg;base64";
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    usuCreacion=:origen, identificador='ccc', fk_proveedor=:proveedor, fk_obra=:obra, foto=:img";

        //--Preparando el query para ejecucion
        $stmt = $this->conn->prepare($query);
        
        //$this->identificador   = htmlspecialchars(strip_tags($this->identificador));
        $this->origen = htmlspecialchars(strip_tags($this->origen));
        $this->proveedor = htmlspecialchars(strip_tags($this->proveedor));
        $this->obra    = htmlspecialchars(strip_tags($this->obra));
        $this->img  = htmlspecialchars(strip_tags($this->img));        

        // bind values
        //$stmt->bindParam(":identificador",   $this->identificador);
        $stmt->bindParam(":origen", $this->origen);
        $stmt->bindParam(":proveedor", $this->proveedor);
        $stmt->bindParam(":obra",    $this->obra);
        $stmt->bindParam(":img",    $this->img);
       

        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?>
