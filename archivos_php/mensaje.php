<?php
// Iniciar sesión para mantener la información del usuario
session_start();

// Incluir archivo de conexión
include("conexionUsuariosSesion.php");
$con = conexion();

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $emisor = $_POST['emisor'];
    $receptor = $_POST['receptor']; // Esto ya contiene solo el valor del código seleccionado
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];
    
    // Aquí puedes procesar los datos, por ejemplo, insertarlos en la base de datos
    $sql = "INSERT INTO mensajeria (emisor, destino, asunto, mensaje, fecha) 
            VALUES ('$emisor', '$receptor', '$asunto', '$mensaje', NOW() )";
    
    if (mysqli_query($con, $sql)) {
        // Mensaje enviado con éxito
        echo "Mensaje enviado correctamente";
        // Redirigir después de 3 segundos
        header("Refresh: 3; URL=../archivos_html/enviar_mensaje.php");
    } else {
        // Error al enviar el mensaje
        echo "Error al enviar el mensaje: " . mysqli_error($con);
        // Redirigir después de 5 segundos
        header("Refresh: 5; URL=../archivos_html/enviar_mensaje.php");
    }
} else {
    // Si alguien intenta acceder directamente a este archivo sin enviar el formulario
    header("Location: ../index.html");
    exit();
}
?>