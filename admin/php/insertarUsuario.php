<?php 
include "./conexion.php";
    $nombreP=$_POST['nombre'];
    $apellido=$_POST['ap'];
    $email=$_POST['email'];
    $password=$_POST['p1'];
    $password1=$_POST['p2'];
    $nombre=$_FILES['imagen']['name'];
    $temp=explode(".",$nombre);
    $extension=end($temp);
    $nombreFinal=time().".".$extension;
    if($password != $password1){
        echo "el password es diferente";
        header("Location: ../usuarios.php?error=Los campos no coinciden");
    }else{
        if($extension=='jpg' || $extension=='png'||$extension=='PNG'){
            if(move_uploaded_file($_FILES['imagen']['tmp_name'],"../img/users/".$nombreFinal)){
                $password=sha1($password);
            $conexion->query("insert into usuarios (nombre,apellido,email,password,img_perfil) values
            ('$nombreP','$apellido','$email','$password','$nombreFinal') ") or die($conexion->error);
            echo "Insertado correctamente";
            header("Location: ../usuarios.php"); 
            }else{
                header("Location: ../productos.php?error=Ocurrio un error al subir la imagen");  
            }
    
        }else{
            header("Location: ../productos.php?error=Tipo de archivo no valido");
        }
        die();
    }

    /*
    $password=sha1($password);
        $conexion->query("insert into usuarios (nombre,apellido,email,password,img_perfil) values
        ('$nombreP','$apellido','$email','$password','default.png') ") or die($conexion->error);
        echo "Insertado correctamente";
        header("Location: ../usuarios.php");
    */
?>