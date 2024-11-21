# Configuración de usuarios y condiciones en un servidor Linux

## Paso 1: Crear los usuarios

Para crear los usuarios en el sistema, ejecuta los siguientes comandos:

sudo useradd usuario1

sudo useradd usuario2

sudo useradd usuario3

sudo useradd usuario4

sudo useradd usuario5

sudo useradd usuario6

Paso 2: Enjaular a los usuarios usuario1 y usuario6

Los usuarios usuario1 y usuario6 se deben enjaular en su directorio de trabajo (chroot), de forma que estén restringidos a su propio directorio de inicio y no puedan acceder a otras partes del sistema.

Configurar la jaula en /etc/ssh/sshd_config para usuario1 y usuario6:

Edita el archivo /etc/ssh/sshd_config:

sudo nano /etc/ssh/sshd_config

Añade las siguientes líneas al final del archivo para configurar la jaula:

Match User usuario1
    ChrootDirectory /home/usuario1
    ForceCommand internal-sftp
    AllowTcpForwarding no

Match User usuario6
    ChrootDirectory /home/usuario6
    ForceCommand internal-sftp
    AllowTcpForwarding no

Crear los directorios y establecer permisos:

Asegúrate de que los directorios de los usuarios usuario1 y usuario6 tengan los permisos correctos:

sudo mkdir -p /home/usuario1

sudo mkdir -p /home/usuario6

sudo chown root:root /home/usuario1

sudo chmod 755 /home/usuario1

sudo chown root:root /home/usuario6

sudo chmod 755 /home/usuario6

Crear directorios internos (opcional):

Si deseas crear directorios para SFTP, puedes hacerlo de la siguiente manera:

sudo mkdir /home/usuario1/uploads

sudo mkdir /home/usuario6/uploads

sudo chown usuario1:usuario1 /home/usuario1/uploads

sudo chown usuario6:usuario6 /home/usuario6/uploads

Paso 3: No enjaular a los usuarios usuario2 y usuario5

No es necesario realizar configuraciones especiales para los usuarios usuario2 y usuario5, ya que no se les va a enjaular. Solo asegúrate de que tienen acceso al sistema.

Paso 4: Denegar acceso a los usuarios usuario3 y usuario4

Para denegar el acceso a los usuarios usuario3 y usuario4, puedes bloquear sus cuentas usando el siguiente comando:

sudo passwd -l usuario3
sudo passwd -l usuario4

Paso 5: Activar el log de usuarios

Para activar el registro de acceso de usuarios en el servidor, asegúrate de que el archivo de configuración de SSH esté habilitado para registrar la información de acceso.

Configurar el archivo /etc/ssh/sshd_config:

Edita el archivo /etc/ssh/sshd_config:

sudo nano /etc/ssh/sshd_config

Asegúrate de que la configuración de logging esté activada, añadiendo las siguientes líneas:

# Log de eventos de acceso

LogLevel VERBOSE

Después de realizar estos cambios, reinicia el servicio SSH para que tomen efecto:

sudo systemctl restart sshd


Este es un archivo Markdown que puedes utilizar para documentar el proceso de configuración de usuarios y permisos en un servidor Linux.
