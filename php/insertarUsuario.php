<?php 
include "./conexion.php";
    $nombre=$_POST['nombre'];
    $apellido=$_POST['ap'];
    $email=$_POST['email'];
    $password=$_POST['p1'];
    $password1=$_POST['p2'];
    if($password != $password1){
        echo "el password es diferente";
        header("Location: ../usuarios.php?error=Los campos no coinciden");
    }else{
        $password=sha1($password);
        $conexion->query("insert into usuarios (nombre,apellido,email,password,img_perfil) values
        ('$nombre','$apellido','$email','$password','default.png') ") or die($conexion->error);
        echo "Insertado correctamente";
        header("Location: ../usuarios.php");
    }
?>