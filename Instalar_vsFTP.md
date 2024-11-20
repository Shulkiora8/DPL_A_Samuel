# Instalación y configuración de vsftpd

## 1. Instalación de vsftpd

sudo apt-get install vsftpd

Las configuraciones de vsftpd se encuentran en el archivo:

sudo gedit /etc/vsftpd.conf

2. Habilitar el usuario anónimo
Configuración en /etc/vsftpd.conf

    Descomentar las siguientes directivas:

anonymous_enable=YES
local_enable=YES
anon_root=/ftp

    Crear el usuario anónimo whoever:

sudo adduser whoever

Se te pedirá la contraseña para este usuario.
Crear la carpeta /ftp

    Crear el directorio /ftp:

sudo mkdir /ftp

    Asignar los permisos al usuario whoever sobre la carpeta /ftp:

sudo chown whoever.whoever -R /ftp

    Verificar el propietario con:

ls -l

    Reiniciar el servicio vsftpd:

sudo service vsftpd restart

3. Conexión desde el cliente (FileZilla)

    Abrir FileZilla y crear un nuevo sitio:
        Servidor: IP del servidor
        Protocolo: FTP - Protocolo de transferencia de archivos
        Cifrado: Use explicit FTP over TLS if available
        Modo de acceso: Anónimo
        Usuario: Dejar en blanco
        Contraseña: Dejar en blanco

    Conectar como usuario anónimo.

    En el servidor:

cd /ftp/

    Crear un archivo de prueba:

sudo cat > anonimo.txt

Problemas de permisos

    Si no se tiene permiso de escritura, cambiar permisos de la carpeta /ftp:

sudo chmod 777 /ftp/

    Crear el archivo anonimo.txt con el contenido:

sudo cat > anonimo.txt
1234

    En el cliente (FileZilla), al intentar conectar, puede mostrar el error 500 ops… porque el usuario anónimo no tiene permisos de escritura en el sistema.

Solución de permisos

    Cambiar permisos de la carpeta /ftp/ para permitir escritura:

sudo chmod 555 /ftp/

    Conectar nuevamente con FileZilla y verificar acceso.

4. Subir archivos al servidor
Crear subcarpeta uploads

    Crear la carpeta uploads dentro de /ftp/:

sudo mkdir /ftp/uploads

    Asignar permisos de escritura a la carpeta uploads:

sudo chmod 777 /ftp/uploads

    Asignar al usuario whoever como propietario de la carpeta uploads:

sudo chown whoever.whoever -R /ftp

    Habilitar las directivas necesarias en el archivo de configuración /etc/vsftpd.conf:

write_enable=YES
anon_upload_enable=YES

    Reiniciar el servicio:

sudo service vsftpd restart

    Volver a probar con FileZilla para asegurarse de que se puede subir un archivo a la carpeta uploads.

5. Enjaular usuarios
Configuración de enjaulamiento de usuarios

    Editar el archivo /etc/vsftpd.conf y asegurarse de que las siguientes directivas estén descomentadas:

chroot_local_user=YES
chroot_list_enable=YES
chroot_list_file=/etc/vsftpd.chroot_list
allow_writeable_chroot=YES

    Crear el archivo /etc/vsftpd.chroot_list y añadir el usuario que no se desea enjaular, por ejemplo:

sudo gedit /etc/vsftpd.chroot_list

Contenido del archivo:

noenjaulado

    Verificar que la directiva local_enable=YES esté habilitada.

    Reiniciar el servicio:

sudo service vsftpd restart

Comprobación del enjaulamiento

    Conectar desde FileZilla con el usuario noenjaulado y verificar que no está enjaulado, es decir, puede navegar por todo el sistema.
    Con el usuario enjaulado, verificar que solo puede acceder a su carpeta de trabajo y no tiene acceso al sistema completo.

6. Configuración de conexión cifrada (SSL/TLS)
Crear un certificado SSL

    Instalar OpenSSL:

sudo apt-get install openssl
