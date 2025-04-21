<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $con = conexion();

    $dni = intval($_POST['dni']);
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellidos'];
    $fecha_nac = $_POST['fecha_nac'];
    $celular = intval($_POST['celular']);

    $sql = "INSERT INTO persona VALUES('$dni','$nombre','$apellido','$fecha_nac','$celular')";
    $query = mysqli_query($con, $sql);

    if ($query) {
        header("Location: Designar_usuario.html");
        exit; // Asegura que el script se detenga después de la redirección
    } else {
        echo "ERROR: DATOS NO ALMACENADOS";
    }
}
?>