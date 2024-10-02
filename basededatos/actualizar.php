<?php
include("conexion.php");
echo "<pre>";

$conn = mysqli_connect('localhost', 'root', 'blacklustersoldier', 'pruebas');



$update = "Update users set name = 'Joker',email='joker@dominio.es' where id=1";

$return = mysqli_query ($conn, $update);

print_r($return);

mysqli_close($conn);