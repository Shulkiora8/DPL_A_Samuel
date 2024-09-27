Primero abrimos el xammp e iniciamos los servidores de apache y mysql. Entramos en phpMyAdmin y creamos una nueva base de datos llamada "Pruebas". Dentro de ella creamos 4 tablas, con un id, nombre, email, created, cada uno con su tipo.
Ahora creamos el fichero conexion.php para conectarnos a la base de datos localmente.
Vemos que nos devuelve el objeto de la base de datos, por lo que se está conectando correctamente.

Creamos el fichero insertar.php para insertar datos a la base de datos. Si volvemos a la página y cambiamos el nombre de la url por el de insertar.php veremos que la página nos devuelve el objeto de la base de datos y nos pone un 1, eso quiere decir
que nos devolvió True al hacer el insert. Si vamos al phpMyAdmin y miramos la información de la tabla, veremos que ahora contiene la información del insert que hicimos anteriormente.
