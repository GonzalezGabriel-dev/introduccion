<?php
 include "./conexion.php";
$id=$_POST['id'];
$nombreP=$_POST['nombre'];
$precio=$_POST['precio'];
$inventario=$_POST['inventario'];
$imagenAntigua=$_POST['img'];
$nombre=$_FILES['imagen']['name'];
$temp=explode(".",$nombre);
$extension=end($temp);
$nombreFinal=time().".".$extension;
    if(trim($nombre)==""){
        $conexion -> query("update productos set 
            nombre='$nombreP',
            precio='$precio',
            inventario='$inventario' where id=$id")or die($conexion->error);
            header("Location: ../productos.php?succes=Actualizado correctamente");
    }else{
        if($extension=='jpg' || $extension=='png'||$extension=='PNG'){
            if(move_uploaded_file($_FILES['imagen']['tmp_name'],"../img/productos/".$nombreFinal)){
                unlink("../img/productos/$imagenAntigua");

                $conexion -> query("update productos set 
                nombre='$nombreP',
                precio='$precio',
                inventario='$inventario',
                imagen='$nombreFinal'
                where id=$id")or die($conexion->error);
                header("Location: ../productos.php?succes=Actualizado correctamente");

            }else{
                header("Location: ../productos.php?error=Ocurrio un error al subir la imagen");  
            }
    
        }else{
            header("Location: ../productos.php?error=Tipo de archivo no valido");
        }
        die();
        
    }
?>