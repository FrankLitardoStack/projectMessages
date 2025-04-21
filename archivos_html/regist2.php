
<?php
    include("conexion.php");
    $con = conexion();

    $usuario = $_POST['dni'];
    $nom_user = $_POST['nom_user'];
    $contrasena = $_POST['contrasena'];
    
    // Verificar si el nombre de usuario ya existe
    $sql = "SELECT * FROM ususarios WHERE nom_user = '$nom_user'";
    $query1 = mysqli_query($con, $sql);
    
    if(mysqli_num_rows($query1) > 0){
        // Si el usuario ya existe, redirigir de vuelta al formulario
        Header("Location: Designar_usuario.php?dni=$usuario");
        exit;
    } else {
        // Insertar el nuevo usuario
        $sql2 = "INSERT INTO ususarios (usuario, nom_user, contrasena) 
                VALUES ('$usuario', '$nom_user', '$contrasena')";
        $query2 = mysqli_query($con, $sql2);   
        
        if($query2){
            // Usar ruta absoluta para asegurar la redirección correcta
            Header("Location: /proyectoMensajes/index.html");
            exit;
        } else {
            echo "ERROR: " . mysqli_error($con); 
        }
    }
?>