<?php
session_start();

// Verificar si existe la sesión del usuario (seguridad adicional)
if (!isset($_SESSION['usuario']) || !isset($_SESSION['codigo'])) {
    // Si no hay sesión, redirigir al login
    header("Location: ../index.html");
    exit();
}

// Ahora puedes acceder a los datos de la sesión
$usuario_actual = $_SESSION['usuario'];
$codigo_usuario = $_SESSION['codigo'];

// Continuar con el resto del código
include("conexion.php");
$con = conexion();

// Modificar la consulta para ordenar por fecha descendente (más reciente primero)
$sql = "SELECT m.destino, m.asunto, m.mensaje, m.fecha, u.nom_user 
        FROM mensajeria m 
        INNER JOIN ususarios u ON m.emisor = u.codigo 
        WHERE m.destino = '$codigo_usuario' 
        ORDER BY m.fecha DESC";
$query = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajes Recibidos | Emallume</title>
    <link rel="stylesheet" href="../archivos_css/mostrarMensajes.css">
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Cabecera con logo y título -->
    <div class="cabecera-pagina">
        <div class="logo-container">
            <img src="../logo principal.svg" alt="Logo Emallume" class="logo-imagen">
            <h1 class="titulo-principal">Mensajes Recibidos</h1>
        </div>
        <a href="enviar_mensaje.php" class="boton-volver-principal">
            <i class="fas fa-arrow-left"></i> Volver a Mensajes
        </a>
    </div>
    
    <?php
    // Verificar si hay mensajes
    if(mysqli_num_rows($query) > 0) {
        // Iterar a través de los resultados
        while($row = mysqli_fetch_assoc($query)) {
    ?>
        <!-- Cada mensaje tiene su propio contenedor principal -->
        <div class="contenedor-principal mensaje-animado">
            <div class="cabecera">
                <h2 class="titulo-mensajes">Mensaje de <?php echo $row['nom_user']; ?></h2>
            </div>
            
            <div class="lista-mensajes">
                <div class="mensaje-item">
                    <div class="mensaje-cabecera">
                        <div class="mensaje-info">
                            <span class="mensaje-remitente" name="remitente"><?php echo $row['nom_user']; ?></span>
                            <span class="mensaje-fecha" name="fecha"><?php echo $row['fecha']; ?></span>
                        </div>
                        <h3 class="mensaje-asunto" name="asunto"><?php echo $row['asunto']; ?></h3>
                    </div>
                    <div class="mensaje-contenido" name="contenido">
                        <p><?php echo $row['mensaje']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php
        }
    } else {
        // Mostrar mensaje si no hay mensajes
    ?>
        <div class="contenedor-principal">
            <div class="mensaje-vacio">
                <p>No tienes mensajes recibidos.</p>
            </div>
        </div>
    <?php
    }
    ?>

    <!-- JavaScript para animaciones e interactividad -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animación para los mensajes al cargar la página
        const mensajes = document.querySelectorAll('.mensaje-animado');
        mensajes.forEach((mensaje, index) => {
            mensaje.style.opacity = '0';
            mensaje.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                mensaje.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                mensaje.style.opacity = '1';
                mensaje.style.transform = 'translateY(0)';
            }, 100 * index);
        });
        
        // Efecto hover para los mensajes
        const mensajesItems = document.querySelectorAll('.mensaje-item');
        mensajesItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.transition = 'all 0.3s ease';
                this.style.boxShadow = '0 10px 25px rgba(255, 75, 110, 0.15)';
            });
            
            item.addEventListener('mouseleave', function() {
                this.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.05)';
            });
        });
        
        // Animación para el logo
        const logo = document.querySelector('.logo-imagen');
        if (logo) {
            logo.addEventListener('mouseenter', function() {
                this.style.animation = 'pulse 1s infinite';
            });
            
            logo.addEventListener('mouseleave', function() {
                this.style.animation = 'float 3s ease-in-out infinite';
            });
        }
        
        // Efecto para el título principal
        const titulo = document.querySelector('.titulo-principal');
        if (titulo) {
            titulo.addEventListener('mouseenter', function() {
                this.style.textShadow = '0 0 10px rgba(255, 255, 255, 0.8)';
            });
            
            titulo.addEventListener('mouseleave', function() {
                this.style.textShadow = '0 2px 4px rgba(0, 0, 0, 0.1)';
            });
        }
    });
    </script>
</body>
</html>