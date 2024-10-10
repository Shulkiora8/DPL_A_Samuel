<?php
include("conexion.php");
echo "<pre>";

$conn = mysqli_connect('localhost', 'root', 'blacklustersoldier', 'pruebas');

// Recibe el ID del formulario
$id = $_POST['id'];

// Borra el usuario
$delete = "DELETE FROM users WHERE id = $id";

$return = mysqli_query($conn, $delete);

if ($return) {
    echo "Usuario borrado correctamente.";
} else {
    echo "Error al borrar usuario: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
