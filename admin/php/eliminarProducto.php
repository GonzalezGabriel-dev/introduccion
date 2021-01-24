<?php
    include "./conexion.php";
    $id=$_POST['id'];
    $img=$_POST['img'];
    $conexion->query("delete from productos where id=$id")or die($conexion->error);
    unlink("../img/productos/$img");
    header("Location: ../productos.php");
?>