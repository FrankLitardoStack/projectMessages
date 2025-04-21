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

$sql = "SELECT codigo, nom_user FROM ususarios WHERE codigo != '$codigo_usuario'";
$query = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Mensaje | Sistema de Mensajería</title>
    <link rel="stylesheet" href="../archivos_css/enviarMensaje.css">
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="contenedor-principal">
        <!-- Barra superior con degradado -->
        <div class="barra-superior"></div>
        
        <!-- Encabezado con bienvenida y opciones -->
        <div class="encabezado">
            <div class="bienvenida-usuario">
                <span class="saludo-texto">¡Hola de nuevo!</span>
                <span class="nombre-usuario" id="nombreUsuario"><?php echo $usuario_actual; ?></span>
            </div>
            <div class="acciones-usuario">
                <a href="mostrarMensajes.php" class="boton-accion boton-notificaciones">
                    <img src="../imagenes/logocanpana.png" alt="Notificaciones" class="icono-campana">
                    <span>Ver mensajes</span>
                </a>
            </div>
        </div>
        
        <!-- Agregar al final del archivo, justo antes de </body> -->
        <script>
            // Animación interactiva para el nombre de usuario
            document.addEventListener('DOMContentLoaded', function() {
                const nombreUsuario = document.getElementById('nombreUsuario');
                
                // Efecto de partículas al hacer clic en el nombre
                nombreUsuario.addEventListener('click', function(e) {
                    // Crear efecto de partículas
                    for (let i = 0; i < 20; i++) {
                        createParticle(e.clientX, e.clientY);
                    }
                });
                
                // Función para crear partículas
                function createParticle(x, y) {
                    const particle = document.createElement('span');
                    particle.className = 'particle';
                    
                    // Estilos para las partículas
                    particle.style.position = 'fixed';
                    particle.style.width = '8px';
                    particle.style.height = '8px';
                    particle.style.borderRadius = '50%';
                    particle.style.background = `linear-gradient(90deg, 
                        var(--color-gradiente-inicio), 
                        var(--color-gradiente-fin))`;
                    particle.style.left = `${x}px`;
                    particle.style.top = `${y}px`;
                    particle.style.pointerEvents = 'none';
                    particle.style.zIndex = '1000';
                    
                    // Añadir al DOM
                    document.body.appendChild(particle);
                    
                    // Animación de la partícula
                    const size = Math.random() * 15 + 5;
                    const destinationX = x + (Math.random() - 0.5) * 100;
                    const destinationY = y + (Math.random() - 0.5) * 100;
                    const rotation = Math.random() * 520;
                    const delay = Math.random() * 200;
                    
                    // Aplicar animación con CSS
                    particle.style.width = `${size}px`;
                    particle.style.height = `${size}px`;
                    particle.style.transition = `all 0.6s ease-out ${delay}ms`;
                    
                    // Iniciar animación después de un pequeño retraso
                    setTimeout(() => {
                        particle.style.transform = `translate(${destinationX - x}px, ${destinationY - y}px) rotate(${rotation}deg)`;
                        particle.style.opacity = '0';
                    }, 10);
                    
                    // Eliminar partícula después de la animación
                    setTimeout(() => {
                        particle.remove();
                    }, 1000);
                }
                
                // Efecto de brillo al pasar el cursor
                let intervalId;
                nombreUsuario.addEventListener('mouseenter', function() {
                    let hue = 0;
                    intervalId = setInterval(() => {
                        hue = (hue + 1) % 360;
                        nombreUsuario.style.filter = `drop-shadow(0 0 5px hsl(${hue}, 100%, 70%))`;
                    }, 30);
                });
                
                nombreUsuario.addEventListener('mouseleave', function() {
                    clearInterval(intervalId);
                    nombreUsuario.style.filter = '';
                });
            });
        </script>
        
        <!-- Contenedor del formulario -->
        <div class="contenedor-formulario">
            <h2 class="titulo-formulario">Enviar un nuevo mensaje</h2>
            
            <form class="formulario-mensaje" action="../archivos_php/mensaje.php" method="POST">
                <!-- Campo oculto para el emisor -->
                <input type="hidden" name="emisor" value="<?php echo $codigo_usuario; ?>">
                
                <!-- Destinatario -->
                <div class="grupo-campo">
                    <label class="etiqueta-campo">
                        <i class="fas fa-user icono"></i> Destinatario
                    </label>
                    <select name="receptor" id="destinatario" class="campo-texto">
                        <?php
                        // Generar opciones del combobox
                        while ($receptor = mysqli_fetch_assoc($query)) {
                            $selected = ($receptor['codigo'] == $destinatario) ? "selected" : "";
                            echo "<option value='" . $receptor['codigo'] . "'" . $selected . ">" . $receptor['nom_user'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                
                <!-- Asunto -->
                <div class="grupo-campo">
                    <label class="etiqueta-campo">
                        <i class="fas fa-heading icono"></i> Asunto
                    </label>
                    <input class="campo-texto" type="text" placeholder="Escribe el asunto del mensaje" name="asunto" required>
                </div>
                
                <!-- Mensaje -->
                <div class="grupo-campo">
                    <label class="etiqueta-campo">
                        <i class="fas fa-comment-alt icono"></i> Mensaje
                    </label>
                    <textarea class="campo-texto campo-mensaje" placeholder="Escribe tu mensaje aquí..." name="mensaje" required></textarea>
                </div>
                
                <!-- Botones -->
                <div class="grupo-botones">
                    <button class="boton-enviar" type="submit">
                        <i class="fas fa-paper-plane"></i> Enviar mensaje
                    </button>
                    <button class="boton-reset" type="reset">
                        <i class="fas fa-times"></i> Borrar
                    </button>
                </div>
                
                <!-- Cerrar sesión sutil -->
                <div class="cerrar-sesion-sutil">
                    <a href="../archivos_php/cerrar_sesion.php" class="enlace-cerrar-sesion">
                        <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                    </a>
                </div>
            </form>
        </div>
        
        <!-- Pie de página -->
        <div class="pie-pagina">
            <p class="copyright">© <?php echo date('Y'); ?> Sistema de Mensajería</p>
            <div class="enlaces-pie">
                <a href="#" class="enlace-pie">Ayuda</a>
                <a href="#" class="enlace-pie">Privacidad</a>
                <a href="#" class="enlace-pie">Términos</a>
            </div>
        </div>
    </div>
</body>
</html>