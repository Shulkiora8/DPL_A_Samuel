<?php
include("conexion.php");
echo "<pre>";

$conn = mysqli_connect('localhost', 'root', 'blacklustersoldier', 'pruebas');



$insert = "insert into users(name,email) values ('Joker', 'joker@dominio.es')";

$return = mysqli_query ($conn, $insert);

print_r($return);

mysqli_close($conn);