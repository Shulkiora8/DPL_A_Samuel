<?php
include("conexion.php");
echo "<pre>";

$conn = mysqli_connect('localhost', 'root', 'blacklustersoldier', 'pruebas');

// Recibe los datos del formulario
$name = $_POST['name'];
$email = $_POST['email'];

// Inserta los datos
$insert = "INSERT INTO users (name, email) VALUES ('$name', '$email')";

$return = mysqli_query($conn, $insert);

if ($return) {
    echo "Usuario insertado correctamente.";
} else {
    echo "Error al insertar usuario: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
