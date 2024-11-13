# Instalación y Configuración de Servidor FTP con ProFTPD

## 1. Instalación del Servidor FTP

1. Abrimos una terminal y ejecutamos:

    ```bash
    sudo -i
    ```

2. Actualizamos los repositorios:

    ```bash
    apt-get update
    ```

3. Instalamos el servidor ProFTPD:

    ```bash
    apt-get install proftpd
    ```

    Si se abre un entorno gráfico, seleccionamos la opción *"independiente"* y presionamos *Aceptar*.

4. Verificamos que el servicio esté activo:

    ```bash
    service proftpd status
    ```

    Debería mostrar que el servicio está activo y funcionando.

5. Verificamos la versión de ProFTPD:

    ```bash
    proftpd -v
    ```

6. Verificamos los usuarios creados durante la instalación:

    ```bash
    cat /etc/passwd
    ```

    Aquí deberíamos ver los usuarios del sistema, incluidos los usuarios de ProFTPD.

7. Mostramos los archivos de configuración creados:

    ```bash
    ls /etc/proftpd
    ```

    En la lista veremos varios archivos, siendo el más importante `proftpd.conf`, que es el archivo principal de configuración.

8. Hacemos una copia de seguridad del archivo de configuración:

    ```bash
    cp /etc/proftpd/proftpd.conf /etc/proftpd/proftpd.conf.copia
    ```

## 2. Configuración de ProFTPD

1. Editamos el archivo de configuración con `nano`:

    ```bash
    nano /etc/proftpd/proftpd.conf
    ```

2. Si el archivo es muy largo, podemos utilizar el editor `vi` para eliminar comentarios y líneas en blanco:

    ```bash
    vi /etc/proftpd/proftpd.conf
    ```

    - Para eliminar todos los comentarios:

      ```bash
      :g/^\s*#/d
      ```

    - Para eliminar las líneas en blanco:

      ```bash
      :g/^$/d
      ```

    - Guardamos y salimos de `vi` con:

      ```bash
      :w:q
      ```

3. Volvemos a editar con `nano` para trabajar en el archivo limpio:

    ```bash
    nano /etc/proftpd/proftpd.conf
    ```

4. Buscamos y modificamos los siguientes parámetros según lo indicado:

    ```text
    ServerName "Mi servidor FTP"
    DeferWelcome off
    TimeoutIdle 1200
    Port 21
    MaxInstances 30
    ShowSymlinks
    User proftpd
    Group nogroup
    Umask 022 022
    TransferLog /var/log/proftpd/xferlog
    SystemLog /var/log/proftpd/proftpd.log
    ```

    Guardamos y salimos.

## 3. Verificación de Logs

1. Verificamos los últimos accesos al servidor en el archivo `proftpd.log`:

    ```bash
    tail -n 15 /var/log/proftpd/proftpd.log
    ```

2. Verificamos los últimos problemas de conexión en el archivo `xferlog`:

    ```bash
    tail -n 15 /var/log/proftpd/xferlog
    ```

## 4. Mensajes de Bienvenida y Error

1. Editamos nuevamente el archivo `proftpd.conf`:

    ```bash
    nano /etc/proftpd/proftpd.conf
    ```

2. Añadimos las siguientes directivas:

    ```text
    AccessGrantMSG "Bienvenido al servidor FTP de (mi_nombre)"
    AccessDenyMSG "Error de entrada a mi servidor FTP"
    ```

    Guardamos y salimos.

3. Recargamos el servicio de ProFTPD para aplicar los cambios:

    ```bash
    service proftpd reload
    ```

4. Probamos la conexión desde el cliente con un usuario correcto y uno incorrecto.

    - Usuario correcto: veremos el mensaje de bienvenida.
    - Usuario incorrecto: veremos el mensaje de error.

## 5. Restringir el Acceso del Usuario a su Directorio

1. Editamos el archivo `proftpd.conf` para añadir la directiva `DefaultRoot`:

    ```bash
    nano /etc/proftpd/proftpd.conf
    ```

    Añadimos la siguiente línea:

    ```text
    DefaultRoot ~
    ```

2. Guardamos y salimos, y luego recargamos el servicio de ProFTPD:

    ```bash
    service proftpd reload
    ```

    Ahora, los usuarios solo pueden modificar archivos dentro de su directorio home.

## 6. Modificación de la Máscara Umask

1. Modificamos el archivo `proftpd.conf` para cambiar la máscara Umask. Por defecto está configurada a `022 022`, lo que significa que:

    - Los archivos se crean con permisos `644` (666 - 022).
    - Los directorios se crean con permisos `755` (777 - 022).

2. Si deseamos cambiar la máscara para que los archivos se creen con permisos `rw-------` y los directorios como `drwx------`, configuramos la máscara Umask de la siguiente manera:

    ```text
    Umask 077 077
    ```

    Guardamos y salimos.

## 7. Crear Usuarios Virtuales

1. Editamos el archivo `proftpd.conf` para habilitar la autenticación de usuarios virtuales:

    ```bash
    nano /etc/proftpd/proftpd.conf
    ```

    Añadimos las siguientes líneas al principio del archivo:

    ```text
    Include /etc/proftpd/modules.conf
    Require ValidShell off
    AuthUserFile /etc/proftpd/ftpd.passwd
    ```

    Guardamos y salimos.

2. Creamos un directorio para los usuarios virtuales:

    ```bash
    cd /var
    mkdir ftp
    mkdir /var/ftp/carpetauser1JSR
    ```

3. Creamos un archivo vacío para las contraseñas de los usuarios virtuales:

    ```bash
    touch /etc/proftpd/ftpd.passwd
    ```

4. Añadimos un usuario virtual llamado `user1JSR`:

    ```bash
    ftpasswd --passwd --name=user1JSR --uid=3000 --gid=3000 --home=/var/ftp/carpetauser1JSR --shell=/bin/false
    ```

    Introducimos la contraseña para el usuario.

5. Desbloqueamos al usuario:

    ```bash
    ftpasswd --passwd --name=user1JSR --unlock
    ```

6. Verificamos que el usuario tenga acceso a su directorio:

    ```bash
    cd /var/ftp/carpetauser1JSR
    sudo nano pn.txt
    ```

    Escribimos algo en el archivo y lo guardamos.

## 8. Conexión desde un Cliente FTP

1. Conectamos con FileZilla o cualquier otro cliente FTP utilizando los siguientes parámetros:

    - Servidor: `ip_servidor`
    - Nombre de usuario: `user1JSR`
    - Contraseña: la que definimos
    - Puerto: `21`

2. Verificamos que el usuario pueda acceder y modificar archivos en su directorio.

Con estos pasos hemos instalado y configurado correctamente un servidor FTP con ProFTPD, incluyendo la creación de usuarios virtuales, configuración de permisos y máscaras de archivo, y personalización de los mensajes de bienvenida y error.
