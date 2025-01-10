# Configuración de Servidores y Bases de Datos con Apache, MariaDB y PHP

## 1. Actualización del Repositorio y Paquetes
Ejecutamos los siguientes comandos para actualizar el repositorio y los paquetes instalados:

```bash
sudo apt update
sudo apt upgrade
```

## 2. Instalación del Servidor Apache

Instalamos el servidor web Apache con el comando:

```bash
sudo apt install apache2
```

Comprobamos que Apache esté activo:

```bash
sudo systemctl status apache2
```

## 3. Instalación del Servidor de Base de Datos MariaDB

### Instalación de MariaDB
Ejecutamos el siguiente comando para instalar MariaDB:

```bash
sudo apt install mariadb-server mariadb-client
```
![1](https://github.com/user-attachments/assets/ecaa8dd1-0b07-414b-ac69-07c9fda4fb90)

### Comprobar el estado del servidor MariaDB
Verificamos que MariaDB esté en ejecución:

```bash
sudo systemctl status mariadb
```

![2](https://github.com/user-attachments/assets/68f7de8d-e625-43d2-9daa-fb7e659aadfa)


### Configuración para inicio automático

Permitimos que MariaDB se inicie automáticamente al arrancar el sistema:

```bash
sudo systemctl enable mariadb
```

### Verificación de la versión de MariaDB

Comprobamos la versión instalada:

```bash
mariadb --version
```

### Configuración de Seguridad Posterior a la Instalación

Ejecutamos el script de configuración de seguridad:

```bash
sudo mysql_secure_installation
```

Seguimos los pasos indicados:
1. Pulsamos `Intro` cuando solicite la contraseña root.
2. Configuramos una nueva contraseña para el usuario root.
3. Respondemos `y` para eliminar usuarios anónimos, deshabilitar el acceso remoto del usuario root y eliminar la base de datos de prueba.

![3](https://github.com/user-attachments/assets/0be0e476-8093-42c9-96e6-b2e8955d748c)
![4](https://github.com/user-attachments/assets/ec24f5bb-ea66-4145-8408-7d362ba4ff2c)
![5](https://github.com/user-attachments/assets/3851e7d1-1fcf-435a-86a4-61d37dac3d48)

### Autenticación `unix_socket`

Por defecto, MariaDB en Ubuntu usa `unix_socket` para autenticar el acceso. Esto significa que el usuario del sistema operativo que ejecuta el cliente debe coincidir con el usuario de la base de datos.

### Prueba de Acceso a la Base de Datos

Accedemos a MariaDB con la nueva contraseña:

```bash
mysql -u root -p
```
![6](https://github.com/user-attachments/assets/57a667cb-8c6e-47f6-b576-1ec6e03049f6)

### Creación de un Nuevo Usuario

Creamos un usuario llamado `developer` con la contraseña `5t6y7u8i`:

```sql
CREATE USER 'developer'@'localhost' IDENTIFIED BY '5t6y7u8i';
GRANT ALL PRIVILEGES ON *.* TO 'developer'@'localhost' WITH GRANT OPTION;
FLUSH PRIVILEGES;
```
![7](https://github.com/user-attachments/assets/5930ed39-d136-4ecd-96c8-cf9d515c6c07)

Probamos el acceso con el nuevo usuario:

```bash
mysql -u developer -p
```
![8](https://github.com/user-attachments/assets/17c2d967-9cf0-4b58-ad39-5fd30961bd3c)

## 4. Instalación de PHP

Instalamos PHP y los módulos necesarios:

```bash
sudo apt install php7.4 libapache2-mod-php7.4 php7.4-mysql php-common php7.4-cli php7.4-common php7.4-json php7.4-opcache php7.4-readline
```

Habilitamos el módulo PHP para Apache:

```bash
sudo a2enmod php7.4
sudo systemctl restart apache2
```

Verificamos la versión instalada de PHP:

```bash
php --version
```

### Creación del Archivo `info.php`

Creamos un archivo de prueba PHP:

```bash
sudo vim /var/www/html/info.php
```

Contenido del archivo:

```php
<?php phpinfo(); ?>
```

Accedemos al archivo desde el navegador en `http://<direccion-ip>/info.php`.

![9](https://github.com/user-attachments/assets/48ed3a7e-3be3-4568-80ed-9efcce41062f)

## 4.1 Ejecutando Código PHP con PHP-FPM

Deshabilitamos el módulo Apache PHP:

```bash
sudo a2dismod php7.4
```

Instalamos PHP-FPM:

```bash
sudo apt install php7.4-fpm
```

Habilitamos los módulos necesarios:

```bash
sudo a2enmod proxy_fcgi setenvif
```

Habilitamos el archivo de configuración:

```bash
sudo a2enconf php7.4-fpm
sudo systemctl restart apache2
```

Actualizamos la página `info.php` para verificar que la API del servidor ha cambiado a `FPM/FastCGI`.

![10](https://github.com/user-attachments/assets/1ee7ad55-0fd2-4c49-b072-74436ae68ce1)

