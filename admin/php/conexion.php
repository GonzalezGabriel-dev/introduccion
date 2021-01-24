<?php
    $servidor="localhost";
    $nombreBD="id15978323_soluciones";
    $usuario="id15978323_gabriel";
    $pass='(d]$TO2#)ckHc%%p';
    $conexion = new mysqli($servidor,$usuario,$pass,$nombreBD);
    if($conexion -> connect_error){
        die("No se pudo conectar a la base de datos");
    }
?>