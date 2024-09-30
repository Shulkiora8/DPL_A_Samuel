Primero creamos un archivo php con un html dentro:

"<!DOCTYPE html»
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="vieuport” content="width=device-width, initial-scale-
<title>Document</title>
</head>
<body>
<a href="pagina2.php?name=Jorge">Redireccion</a>
</body>
</html>"

Luego creamos el archivo redireccion2.php:
"<?php
echo "redireccion2";
print_r($_GET);"

Ahora creamos el archivo redireccion3.php:
"<?php
echo "redireccion3";
print_r($_GET);"

Si le damos click en la primera página para pasar a la segunda página nos saldrá este mensaje:
"redireccion2Array([nanme]=>Jorge)"

Por último cambiamos el redireccion2.php para poder pasar el nombre a la tercera página:
"<?php
echo "redireccion2";
print_r($_GET);
header("location: redireccion3.php? name=" . $_GET['name']);"

Y así si vamos a la tercera página se debería de ver esto:
"redireccion3Array([nanme]=>Jorge)"
