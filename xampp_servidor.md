Primero iniciamos los servidores de Apache, MySQL y Filezilla, luego vamos a la configuración de Apache y pulsamos donde dice "phpMyAdmin(config.inc.php). 
![](/Fotos/xammp1.png)
Esto nos abrirá un txt en el que tendremos que cambiar las siguientes cosas. 
Donde pone "auth_type" hay que cambiarlo y poner 'http' y cambiamos también el "password" que será la contraseña que usaremos para acceder al usuario.
![](/Fotos/xammp2.png)
Una vez que está todo esto, nos vamos al phpMyAdmin, para crear un nuevo usuario nos vamos "Cuentas de usuario" y le damos al apartado que dice "Agregar cuenta de usuario". 
![](/Fotos/xammp3.png)
Esto nos llevará a la ventana de creación de usuario. Aquí pondremos el nombre del usuario, el nombre del host, que será localhost, y pondremos la contraseña que queramos. 
Más abajo le damos a "Otorgar todos los privilegios al nombre que contiene comodín". 
Y en cuanto a privilegios globales, le daremos solo a datos y estructura. Le damos a crear usuario. 
![](/Fotos/xammp4.png)
Vemos que se ha creado el usuario. 
![](/Fotos/xammp5.png)
Ahora al ingresar al phpMyAdmin te pedirá un usuario con el que logearte.
![](/Fotos/xamm6.png)
