<?php
include("conexion.php");
echo "<pre>";

$conn = mysqli_connect('localhost', 'root', 'blacklustersoldier', 'pruebas');



$delete = "delete from users where id=3";

$return = mysqli_query ($conn, $delete);

print_r($return);

mysqli_close($conn);