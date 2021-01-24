<?php
    include "./conexion.php";
    $nombreP=$_POST['nombre'];
    $apellido=$_POST['ap'];
    $email=$_POST['email'];
    $imagenAntigua=$_POST['imagen_antigua'];
    $p1=$_POST['p1'];
    $p2=$_POST['p2'];
    $id=$_POST['id'];
    $nombre=$_FILES['imagen']['name'];
    $temp=explode(".",$nombre);
    $extension=end($temp);
    $nombreFinal=time().".".$extension;
    
    if(trim($nombre)==""){
        if(trim($p1)=="" && trim($p2=="")){
            $conexion -> query("update usuarios set 
            nombre='$nombreP',
            apellido='$apellido',
            email='$email' where id=$id")or die($conexion->error);
            header("Location: ../usuarios.php?succes=Actualizado correctamente");
        }else{
            if($p1 == $p2){
                $pass=sha1($p1);
                $conexion -> query("update usuarios set 
                nombre='$nombreP',
                apellido='$apellido',
                password='$pass',
                email='$email' where id=$id")or die($conexion->error);
                header("Location: ../usuarios.php?succes=Actualizado correctamente");
            }else{
                header("Location: ../usuarios.php?error=Los campos no coinciden");
            }
        }
    }else{
        if(trim($p1)=="" && trim($p2=="")){
            if($extension=='jpg' || $extension=='png'||$extension=='PNG'){
                if(move_uploaded_file($_FILES['imagen']['tmp_name'],"../img/users/".$nombreFinal)){
                    unlink("../img/users/$imagenAntigua");

                    $conexion -> query("update usuarios set 
                    nombre='$nombreP',
                    apellido='$apellido',
                    email='$email',
                    img_perfil='$nombreFinal'
                    where id=$id")or die($conexion->error);
                    header("Location: ../usuarios.php?succes=Actualizado correctamente");

                }else{
                    header("Location: ../usuarios.php?error=Ocurrio un error al subir la imagen");  
                }
        
            }else{
                header("Location: ../usuarios.php?error=Tipo de archivo no valido");
            }
            die();
            
        }else{
            if($p1 == $p2){
                $pass=sha1($p1);
                if($extension=='jpg' || $extension=='png'||$extension=='PNG'){
                    if(move_uploaded_file($_FILES['imagen']['tmp_name'],"../img/users/".$nombreFinal)){
                        unlink("../img/users/$imagenAntigua");
    
                        $conexion -> query("update usuarios set 
                        nombre='$nombreP',
                        apellido='$apellido',
                        password='$pass',
                        email='$email',
                        img_perfil='$nombreFinal'
                        where id=$id")or die($conexion->error);
                        header("Location: ../usuarios.php?succes=Actualizado correctamente");
    
                    }else{
                        header("Location: ../usuarios.php?error=Ocurrio un error al subir la imagen");  
                    }
            
                }else{
                    header("Location: ../usuarios.php?error=Tipo de archivo no valido");
                }
                die();
                
            }else{
                header("Location: ../usuarios.php?error=Los campos no coinciden");
            }
    }
}/*
    
    */
?>