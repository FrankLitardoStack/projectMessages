<?php

function conexion(){
    $servidor = "localhost";
    $bd = "proyectomensajes";
    $usuario = "root";
    $contraseña = "";
    
    // Establecer conexión
    $conexion = mysqli_connect($servidor, $usuario, $contraseña, $bd);

    // Verificar errores de conexión
    if (mysqli_connect_errno()) {
        die("Error en la conexión: " . mysqli_connect_error());
    }


    return $conexion;
}

?>