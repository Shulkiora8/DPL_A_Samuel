<?php
include("conexion.php");
echo "<pre>";

$conn = mysqli_connect('localhost', 'root', 'blacklustersoldier', 'pruebas');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$read = "SELECT * FROM users";
$return = mysqli_query($conn, $read);

if ($return) {
    while ($row = mysqli_fetch_assoc($return)) {
        print_r($row);
    }
} else {
    echo "Error en la consulta: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
