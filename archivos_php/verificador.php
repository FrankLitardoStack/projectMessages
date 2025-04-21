<?php
session_start();
include("conexionUsuariosSesion.php"); // Corrected include file
$con = conexion();

if (!isset($_SESSION['intento'])) {
    $_SESSION['intento'] = 0;
}
$intento = $_SESSION['intento'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];

    // Consulta a la tabla ususarios
    $sql = "SELECT * FROM ususarios WHERE nom_user='$usuario'";
    $datos = mysqli_query($con, $sql);
    
    if ($datos && mysqli_num_rows($datos) > 0) {
        $row = mysqli_fetch_assoc($datos);
        $usuario_bd = $row["nom_user"];
        $contrasena_bd = $row["contrasena"];
        $codigo_P = $row["codigo"]; // Extraer el valor del campo codigo
        
        // Verificar credenciales
        if ($usuario === $usuario_bd && $contrasena === $contrasena_bd) {
            // Reiniciar contador de intentos
            $_SESSION['intento'] = 0;
            
            // Guardar información del usuario en la sesión
            $_SESSION['usuario'] = $usuario;
            $_SESSION['codigo'] = $codigo_P; // Usar la nueva variable
            
            // Redirigir a la página de enviar mensaje sin exponer datos en la URL
            header("Location: ../archivos_html/enviar_mensaje.php");
            exit();
        } else {
            $intento++;
            $_SESSION['intento'] = $intento;
        
            if ($intento <= 3) {
                echo "USUARIO O CONTRASEÑA INCORRECTOS<br>";
                echo "INTENTO " . $intento . " de 3";
                // Redirigir de vuelta al login después de 3 segundos
                header("Refresh: 3; URL=../index.html");
            } else {
                echo "USUARIO BLOQUEADO";
                // Redirigir después de 3 segundos
                header("Refresh: 3; URL=../index.html");
                exit();
            }
        }
    } else {
        echo "USUARIO NO ENCONTRADO";
        // Redirigir después de 3 segundos
        header("Refresh: 3; URL=../index.html");
    }
}
?>