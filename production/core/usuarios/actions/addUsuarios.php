<?php
include("../../../config/conexion.php");
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  if (mysqli_connect_errno()) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }
  else {

    //--Datos de usuario
    $usuario_nombre         = $_POST['usuario_nombre'];
    $usuario_password         = $_POST['usuario_password'];
    $usuario_perfil         = $_POST['usuario_perfil'];
    $usuario_id         = $_POST['usuario_id'];
    $usuarios_lista         = $_POST['usuarios_lista'];




    if($usuario_id == null)
    {
        $result = mysqli_query($con,"INSERT INTO users(usuCreacion, usuario, pass, perfil, fk_vinculada)
        VALUES('admin', '$usuario_nombre', '$usuario_password', '$usuario_perfil', '$usuarios_lista')");
    }
    else
    {

      $result = mysqli_query($con,"SET SQL_SAFE_UPDATES = 0;");
      $result = mysqli_query($con,"SET FOREIGN_KEY_CHECKS=0;");      
      $result = mysqli_query($con,"DELETE FROM users WHERE fk_vinculada = '$usuarios_lista' and perfil = 'usuario_perfil';");    
      $result = mysqli_query($con,"SET FOREIGN_KEY_CHECKS=1;");
      $result = mysqli_query($con,"SET SQL_SAFE_UPDATES = 1;");

        $result = mysqli_query($con, "UPDATE users SET usuario = '$usuario_nombre', pass = '$usuario_password'
                                    perfil = '$usuario_perfil'
                                    WHERE id = '$usuario_id'");
    
    }

    // header("Location: ../../../../../index.php?p=usuariosOk");
  }
 ?>
