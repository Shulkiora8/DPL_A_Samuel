Para configurar los usuarios y las condiciones en un servidor Linux se realizarán los siguientes pasos:
Paso 1: Crear los usuarios

sudo useradd usuario1
sudo useradd usuario2
sudo useradd usuario3
sudo useradd usuario4
sudo useradd usuario5
sudo useradd usuario6

Paso 2: Enjaular a los usuarios usuario1 y usuario6

Los usuarios usuario1 y usuario6 se deben enjaular en su directorio de trabajo (jaula chroot), lo que significa que estarán restringidos a su propio directorio de inicio y no podrán acceder a otras partes del sistema.

    Configurar jaula en /etc/ssh/sshd_config para usuario1 y usuario6: Abre el archivo /etc/ssh/sshd_config para editarlo:

sudo nano /etc/ssh/sshd_config

Añadir las siguientes líneas al final del archivo para los usuarios:

Match User usuario1
    ChrootDirectory /home/usuario1
    ForceCommand internal-sftp
    AllowTcpForwarding no

Match User usuario6
    ChrootDirectory /home/usuario6
    ForceCommand internal-sftp
    AllowTcpForwarding no

Crear los directorios y establecer permisos: Asegúrate de que el directorio usuario1 y usuario6 tenga los permisos correctos:

sudo mkdir -p /home/usuario1
sudo mkdir -p /home/usuario6

sudo chown root:root /home/usuario1
sudo chmod 755 /home/usuario1

sudo chown root:root /home/usuario6
sudo chmod 755 /home/usuario6

Crear directorios internos si lo deseas (por ejemplo, para sftp):

    sudo mkdir /home/usuario1/uploads
    sudo mkdir /home/usuario6/uploads
    sudo chown usuario1:usuario1 /home/usuario1/uploads
    sudo chown usuario6:usuario6 /home/usuario6/uploads

Paso 3: No enjaular a los usuarios usuario2 y usuario5

No es necesario hacer ninguna configuración especial para usuario2 y usuario5 ya que no se les va a enjaular. Simplemente asegúrate de que tienen acceso al sistema.
Paso 4: Denegar acceso a los usuarios usuario3 y usuario4

Para denegar el acceso a los usuarios usuario3 y usuario4, se pueden bloquear las cuentas usando passwd para deshabilitar su acceso.

sudo passwd -l usuario3
sudo passwd -l usuario4

Paso 5: Activar el log de usuarios

Para activar el registro de acceso de usuarios en el servidor, aseguramos que el archivo de configuración de SSH permita registrar la información de acceso:

    Configurar el archivo sshd_config: Abre /etc/ssh/sshd_config y asegúrate de que esté habilitado el logging:

sudo nano /etc/ssh/sshd_config

