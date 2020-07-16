<?php
include("../../../config/conexion.php");
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

$usuario = $_POST['Username_Login'];
$password = $_POST['Password_Login'];
$_SESSION['valida'] = 'false';

echo $password;

$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

if (mysqli_connect_errno()) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

else {
    $result = mysqli_query($con,"SELECT id, usuario, pass, perfil FROM users WHERE usuario ='$usuario'");
    $elemento = mysqli_fetch_array($result);
    if($elemento[pass] == $password && ($elemento[perfil] == "administrador" || $elemento[perfil] == "empleado")){
        session_start();
        $_SESSION['usuario'] = $usuario;
        $_SESSION['valida'] = "true";
        $_SESSION['perfil'] = $elemento["perfil"];
        header("location: ../../../../index.php");
    }
    else{
        header("location: ../../../../login.php");
    }
    
}
?>