<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Registro</title>
    <link rel="stylesheet" href="../archivos_css/designarUsuario.css">
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Ondas decorativas de fondo -->
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
    
    <div class="contenedor-principal">
        <!-- Barra superior con degradado -->
        <div class="barra-superior"></div>
        
        <!-- Contenedor del formulario -->
        <div class="sesion-contenedor">
            <h1 class="sesion-titulo">¡Ya estamos por acabar!</h1>
            
            <form class="formulario-registro" action="regist2.php" method="POST">

                <!-- Campo oculto para almacenar el valor de $dni -->
                <input type="hidden" name="dni" value="<?php echo isset($_GET['dni']) ? $_GET['dni'] : ''; ?>">

                <!-- Nombre de Usuario -->
                <div class="grupo-campo">
                    <label class="etiqueta-campo">Nombre de Usuario</label>
                    <div class="campo-con-icono">
                        <i class="fas fa-user-circle icono-campo"></i>
                        <input class="campo-texto" placeholder="Ejemplo: Pepito_Escamiya" type="text" name="nom_user" required>
                    </div>
                </div>

                <!-- Contraseña -->
                <div class="grupo-campo">
                    <label class="etiqueta-campo">Contraseña</label>
                    <div class="campo-con-icono">
                        <i class="fas fa-lock icono-campo"></i>
                        <input class="campo-texto" placeholder="Ejemplo: 782349@" type="password" name="contrasena" id="passwordField" required>
                        <i class="fas fa-eye icono-toggle-password" id="togglePassword"></i>
                    </div>
                </div>

                <!-- Confirmar Contraseña -->
                <div class="grupo-campo">
                    <label class="etiqueta-campo">Confirmar Contraseña</label>
                    <div class="campo-con-icono">
                        <i class="fas fa-lock icono-campo"></i>
                        <input class="campo-texto" placeholder="Repite la contraseña" type="password" name="confirmar_contrasena" id="confirmPasswordField" required>
                        <i class="fas fa-eye icono-toggle-password" id="toggleConfirmPassword"></i>
                    </div>
                </div>

                <!-- Botones -->
                <div class="grupo-botones">
                    <!-- Cambiar a un enlace simple para volver al inicio sin procesar el formulario -->
                    <a href="../index.html" class="boton-registro enlace-registro">
                        <i class="fas fa-arrow-left"></i>
                        <span>Volver al Inicio</span>
                    </a>
                    <button class="boton-iniciar-sesion" type="submit">
                        <span>Registrar</span>
                        <i class="fas fa-check"></i>
                    </button>
                </div>
            </form>
            
            <?php
            // Mostrar mensaje si viene de un intento fallido
            if(isset($_GET['error'])) {
                echo "<div class='mensaje-error'><i class='fas fa-exclamation-circle'></i> El nombre de usuario ya existe. Por favor, elige otro.</div>";
            }
            ?>
        </div>
    </div>

    <!-- Script para animaciones y funcionalidad -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle para mostrar/ocultar contraseña
            const togglePassword = document.getElementById('togglePassword');
            const passwordField = document.getElementById('passwordField');
            
            if (togglePassword && passwordField) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordField.setAttribute('type', type);
                    this.classList.toggle('fa-eye');
                    this.classList.toggle('fa-eye-slash');
                });
            }
            
            // Toggle para mostrar/ocultar confirmación de contraseña
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
            const confirmPasswordField = document.getElementById('confirmPasswordField');
            
            if (toggleConfirmPassword && confirmPasswordField) {
                toggleConfirmPassword.addEventListener('click', function() {
                    const type = confirmPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
                    confirmPasswordField.setAttribute('type', type);
                    this.classList.toggle('fa-eye');
                    this.classList.toggle('fa-eye-slash');
                });
            }
            
            // Animación de campos de texto
            const inputFields = document.querySelectorAll('.campo-texto');
            inputFields.forEach(field => {
                field.addEventListener('focus', function() {
                    this.parentElement.parentElement.classList.add('campo-activo');
                    const icon = this.parentElement.querySelector('.icono-campo');
                    if (icon) {
                        icon.classList.add('icono-activo');
                    }
                });
                
                field.addEventListener('blur', function() {
                    if (this.value === '') {
                        this.parentElement.parentElement.classList.remove('campo-activo');
                        const icon = this.parentElement.querySelector('.icono-campo');
                        if (icon) {
                            icon.classList.remove('icono-activo');
                        }
                    }
                });
            });
            
            // Validación de contraseñas coincidentes
            const form = document.querySelector('.formulario-registro');
            form.addEventListener('submit', function(e) {
                const password = passwordField.value;
                const confirmPassword = confirmPasswordField.value;
                
                if (password !== confirmPassword) {
                    e.preventDefault();
                    
                    // Crear mensaje de error si no existe
                    if (!document.querySelector('.mensaje-error')) {
                        const errorMsg = document.createElement('div');
                        errorMsg.className = 'mensaje-error';
                        errorMsg.innerHTML = '<i class="fas fa-exclamation-circle"></i> Las contraseñas no coinciden. Por favor, inténtalo de nuevo.';
                        form.parentNode.appendChild(errorMsg);
                    }
                    
                    // Resaltar campos con error
                    confirmPasswordField.parentElement.parentElement.classList.add('campo-error');
                    
                    // Efecto de sacudida en el formulario
                    form.classList.add('shake');
                    setTimeout(() => {
                        form.classList.remove('shake');
                    }, 500);
                }
            });
            
            // Efecto de partículas al hacer clic en los botones
            const buttons = document.querySelectorAll('button, .enlace-registro');
            buttons.forEach(button => {
                button.addEventListener('mousedown', function(e) {
                    createParticles(e.clientX, e.clientY);
                });
            });
            
            // Función para crear partículas
            function createParticles(x, y) {
                for (let i = 0; i < 20; i++) {
                    const particle = document.createElement('span');
                    particle.className = 'particle-click';
                    
                    // Colores de la marca
                    const colors = ['#FF4B6E', '#FF8E53', '#FFA07A'];
                    const randomColor = colors[Math.floor(Math.random() * colors.length)];
                    
                    // Tamaño aleatorio
                    const size = Math.floor(Math.random() * 8 + 3);
                    
                    // Posición y estilo
                    particle.style.width = `${size}px`;
                    particle.style.height = `${size}px`;
                    particle.style.background = randomColor;
                    particle.style.position = 'fixed';
                    particle.style.borderRadius = '50%';
                    particle.style.left = `${x}px`;
                    particle.style.top = `${y}px`;
                    particle.style.pointerEvents = 'none';
                    particle.style.zIndex = '1000';
                    
                    document.body.appendChild(particle);
                    
                    // Animación
                    const destinationX = x + (Math.random() - 0.5) * 100;
                    const destinationY = y + (Math.random() - 0.5) * 100;
                    const rotation = Math.random() * 520;
                    
                    particle.style.transition = 'all 0.8s cubic-bezier(0, 0.9, 0.57, 1)';
                    
                    setTimeout(() => {
                        particle.style.transform = `translate(${destinationX - x}px, ${destinationY - y}px) rotate(${rotation}deg)`;
                        particle.style.opacity = '0';
                    }, 10);
                    
                    setTimeout(() => {
                        particle.remove();
                    }, 800);
                }
            }
            
            // Añadir estilo para animación de sacudida
            const style = document.createElement('style');
            style.textContent = `
                @keyframes shake {
                    10%, 90% { transform: translate3d(-1px, 0, 0); }
                    20%, 80% { transform: translate3d(2px, 0, 0); }
                    30%, 50%, 70% { transform: translate3d(-4px, 0, 0); }
                    40%, 60% { transform: translate3d(4px, 0, 0); }
                }
                
                .shake {
                    animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
                }
                
                .campo-con-icono {
                    position: relative;
                    display: flex;
                    align-items: center;
                }
                
                .icono-campo {
                    position: absolute;
                    left: 14px;
                    color: var(--color-texto-secundario);
                    transition: color 0.3s ease;
                    font-size: 16px;
                }
                
                .icono-activo {
                    color: var(--color-primario);
                }
                
                .campo-texto {
                    padding-left: 40px;
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</body>
</html>