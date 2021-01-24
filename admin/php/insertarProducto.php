<?php 
include "./conexion.php";
    $nombreP=$_POST['nombre'];
    $precio=$_POST['precio'];
    $inventario=$_POST['inventario'];
    $nombre=$_FILES['imagen']['name'];
    $temp=explode(".",$nombre);
    $extension=end($temp);
    $nombreFinal=time().".".$extension;
    if($extension=='jpg' || $extension=='png'||$extension=='PNG'){
        if(move_uploaded_file($_FILES['imagen']['tmp_name'],"../img/productos/".$nombreFinal)){
            $conexion->query("insert into productos (nombre,precio,inventario,imagen) values
            ('$nombreP','$precio','$inventario','$nombreFinal') ") or die($conexion->error);
            header("Location: ../productos.php");  
        }else{
            header("Location: ../productos.php?error=Ocurrio un error al subir la imagen");  
        }

    }else{
        header("Location: ../productos.php?error=Tipo de archivo no valido");
    }
    die();
        
     
    
?>