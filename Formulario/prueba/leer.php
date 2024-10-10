<?php
include("conexion.php");

$conn = mysqli_connect('localhost', 'root', 'blacklustersoldier', 'pruebas');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$read = "SELECT * FROM users";
$return = mysqli_query($conn, $read);

if ($return) {
    echo "<table>";
    echo "<thead><tr><th>ID</th><th>Nombre</th><th>Email</th><th>Acción</th></tr></thead><tbody>";
    
    while ($row = mysqli_fetch_assoc($return)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td><a href='borrar.php?id=" . $row['id'] . "' class='action-btn'>Borrar</a></td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
} else {
    echo "Error en la consulta: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
