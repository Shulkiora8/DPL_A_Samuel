Primero abrimos el xammp e iniciamos los servidores de apache y mysql. Entramos en phpMyAdmin y creamos una nueva base de datos llamada "Pruebas". Dentro de ella creamos 4 tablas, con un id, nombre, email, created, cada uno con su tipo.
![](/Fotos/insert/users.png)
Ahora creamos el fichero conexion.php para conectarnos a la base de datos localmente.
![](/Fotos/insert/codigo.png)
Vemos que nos devuelve el objeto de la base de datos, por lo que se está conectando correctamente.
![](/Fotos/insert/contenidopagina.png)
Creamos el fichero insertar.php para insertar datos a la base de datos. 
![](/Fotos/insert/insert.png)
Si volvemos a la página y cambiamos el nombre de la url por el de insertar.php veremos que la página nos devuelve el objeto de la base de datos y nos pone un 1, eso quiere decir
que nos devolvió True al hacer el insert. 
![](/Fotos/insert/comprobar_insert.png)
Si vamos al phpMyAdmin y miramos la información de la tabla, veremos que ahora contiene la información del insert que hicimos anteriormente.
![](/Fotos/insert/comprobar_insertar.png)
