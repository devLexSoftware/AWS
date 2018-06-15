<?php
include("../../../config/conexion.php");
error_reporting(E_ALL);
ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else {
    $ref = $_POST["ref"];
    $pag = $_POST["pagina"];
        
    $result = mysqli_query($con,"SET SQL_SAFE_UPDATES = 0;");
    $result = mysqli_query($con, "UPDATE clientes SET estado = 1 WHERE identificador = '$ref';");
    //$result = mysqli_query($con,"DELETE FROM clientes WHERE identificador = '$ref';");    
    $result = mysqli_query($con,"SET SQL_SAFE_UPDATES = 1;");
}
?>