<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $con = conexion();
    
    // Obtener los datos del formulario con verificación
    $dni = isset($_POST['dni']) ? intval($_POST['dni']) : 0;
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $apellido = isset($_POST['apellidos']) ? $_POST['apellidos'] : '';
    $fecha_nac = isset($_POST['fecha_nac']) ? $_POST['fecha_nac'] : '';
    $celular = isset($_POST['celular']) ? intval($_POST['celular']) : 0;
    
    // Insertar datos en la base de datos
    $sql = "INSERT INTO persona (dni, nombre, apellido, fecha_nac, celular) 
            VALUES ('$dni', '$nombre', '$apellido', '$fecha_nac', '$celular')";
    
    // Intentar ejecutar la consulta, pero ignorar errores
    mysqli_query($con, $sql);
    
    // Redirigir a la siguiente página sin importar el resultado
    header("Location: Designar_usuario.php?dni=$dni");
    exit; // Asegura que el script se detenga después de la redirección
} else {
    // Redirigir al inicio si no es una solicitud POST
    header("Location: index.html");
    exit;
}
?>