Tarea 1.1- Instalación de servidor web Apache
1. Capas de la Arquitectura Web

La arquitectura web se compone de tres capas principales:
- Capa de Presentación:
  + Función: Es la interfaz de usuario, donde se presentan los datos y se interactúa con el usuario. Incluye HTML, CSS y JavaScript. Esta capa se encarga de mostrar el contenido y de recibir las interacciones del usuario.

- Capa de Lógica de Negocio:
  + Función: Aquí se procesan las reglas de negocio y la lógica del sistema. Esta capa se encarga de la manipulación de datos y la ejecución de las operaciones necesarias, generalmente implementada en lenguajes como PHP, Python, Java, entre otros.

- Capa de Datos:
  + Función: Se encarga del almacenamiento y la gestión de los datos. Utiliza sistemas de gestión de bases de datos (DBMS) como MySQL, PostgreSQL, etc. Esta capa se ocupa de la persistencia de los datos y de las consultas a la base de datos.

2. Plataformas Web

LAMP:
- Componentes: Linux, Apache, MySQL, PHP/Python/Perl.
- Descripción: LAMP es un conjunto de software de código abierto que se utiliza para desarrollar aplicaciones web. Linux es el sistema operativo, Apache es el servidor web, MySQL es el sistema de gestión de bases de datos, y PHP/Python/Perl son los lenguajes de programación para la lógica de negocio. Este stack es conocido por su flexibilidad y comunidad de soporte.

WISA:
- Componentes: Windows, IIS (Internet Information Services), SQL Server, ASP.NET.
- Descripción: WISA es una plataforma que utiliza el sistema operativo Windows, el servidor web IIS, SQL Server como sistema de gestión de bases de datos, y ASP.NET para el desarrollo de la lógica de negocio. Es comúnmente utilizada en entornos empresariales, especialmente aquellos que requieren tecnologías de Microsoft.

3. Pasos para Instalar Apache y Tomcat en Ubuntu 10.04 LTS

1. Instalar el servidor web Apache desde terminal
Abre una terminal y ejecuta los siguientes comandos:
//Actualizar el índice de paquetes
apt-get update

//Instalar el servidor Apache
apt-get install apache2

2. Comprobar que está funcionando el servidor Apache desde terminal
Después de la instalación, puedes verificar el estado del servicio Apache:
//Comprobar el estado de Apache

service apache2 status

También puedes comprobar que está escuchando en el puerto 80:

netstat -tuln | grep :80

3. Comprobar que está funcionando el servidor Apache desde navegador
Abre un navegador web y dirígete a http://localhost/ o http://<tu_dirección_IP>/. Deberías ver la página de bienvenida de Apache.
4. Cambiar el puerto por el cual está escuchando Apache pasándolo al puerto 82

Para cambiar el puerto, edita el archivo de configuración de Apache:
//Abrir el archivo de configuración de Apache

nano /etc/apache2/ports.conf

Busca la línea que dice:

Listen 80

y cámbiala a:

Listen 82

Luego, edita el archivo de configuración del sitio por defecto:
//Abrir el archivo de configuración del sitio por defecto

nano /etc/apache2/sites-available/000-default.conf

Cambia la línea que contiene VirtualHost *:80 a:

<VirtualHost *:82>

Después, guarda y cierra el archivo.
Reinicia el servidor Apache para aplicar los cambios:

service apache2 restart

5. Instalar el servidor de aplicaciones Tomcat

Para instalar Tomcat, primero necesitas asegurarte de tener wget y java instalados. Si no tienes wget, instálalo:

apt-get install wget

Luego, instala Java (si no está instalado):

apt-get install default-jdk

Ahora, descarga la última versión de Tomcat (en este ejemplo, tomaremos Tomcat 7):
//Descargar Tomcat
wget http://apache.mirrors.pair.com/tomcat/tomcat-7/v7.0.100/bin/apache-tomcat-7.0.100.tar.gz

//Descomprimir el archivo
tar xvf apache-tomcat-7.0.100.tar.gz

//Mover a /opt
mv apache-tomcat-7.0.100 /opt/tomcat

Para iniciar Tomcat:
//Navegar al directorio de Tomcat y ejecutar el script de inicio:

cd /opt/tomcat/bin
./startup.sh

Ahora deberías poder acceder a Tomcat desde el navegador en http://localhost:8080.
