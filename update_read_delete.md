El código para leer el contenido de la tabla es:
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

Esto dará como resultado, si lo ponemos en el navegador, un array con los datos de todos los usuarios:
Array
(
    [id] => 1
    [name] => Joker
    [email] => joker@dominio.es
    [created] => 2024-09-27 16:16:38
)

Para borrar un users de la tabla se usa el siguiente código:
<?php
include("conexion.php");
echo "<pre>";

$conn = mysqli_connect('localhost', 'root', 'blacklustersoldier', 'pruebas');



$delete = "delete from users where id=3";

$return = mysqli_query ($conn, $delete);

print_r($return);

mysqli_close($conn);

En este caso estamos dando como condición que se borre el user con id igual a 3.
Si lo ejecutamos en el navegador nos devolvera un "1", eso quiere decir que el resultado ha sido True y se ha eliminado el user.

Por último para actualizar se usa el siguiente código:
<?php
include("conexion.php");
echo "<pre>";

$conn = mysqli_connect('localhost', 'root', 'blacklustersoldier', 'pruebas');



$update = "Update users set name = 'Joker',email='joker@dominio.es' where id=1";

$return = mysqli_query ($conn, $update);

print_r($return);

mysqli_close($conn);

Ahora estamos usando como condición que se cambie los datos que se meten en el update al user con id igual a "1".
Por lo que si lo ejecutamos en el navegador nos volverá a dar un "1", por lo que se pudo cambiar los datos del user.
Si vamos a la base de datos de Xammp veremos que los datos se han cambiado exitosamente.
