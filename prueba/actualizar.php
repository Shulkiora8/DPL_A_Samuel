<?php
include("conexion.php");
echo "<pre>";

$conn = mysqli_connect('localhost', 'root', 'blacklustersoldier', 'pruebas');

// Recibe los datos del formulario
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];

// Actualiza el usuario
$update = "UPDATE users SET name = '$name', email = '$email' WHERE id = $id";

$return = mysqli_query($conn, $update);

if ($return) {
    echo "Usuario actualizado correctamente.";
} else {
    echo "Error al actualizar usuario: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
