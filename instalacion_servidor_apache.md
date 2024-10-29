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
  1. Instalar el servidor web Apache
    Descargar Apache: Ve al sitio web de Apache Lounge y descarga el paquete de Apache para Windows.
    Por ejemplo, descarga el archivo ZIP y descomprímelo en C:\Apache24.
    Configurar Apache: Abre PowerShell como administrador y configura Apache:

# Navega al directorio de Apache
cd C:\Apache24\bin

# Ejecuta el comando para instalar Apache como un servicio
.\httpd.exe -k install


  Iniciar el servicio Apache:

Start-Service apache2.4

  2. Comprobar que está funcionando el servidor Apache desde PowerShell

  Verifica que el servicio está corriendo:

Get-Service -Name apache2.4

  3. Comprobar que está funcionando el servidor Apache desde el navegador

  Abre tu navegador y dirígete a:

http://localhost

  Deberías ver la página de bienvenida de Apache.
  4. Cambiar el puerto por el cual está escuchando Apache
    Editar el archivo de configuración: Abre el archivo httpd.conf en un editor de texto, por ejemplo, Notepad. La ruta generalmente es C:\Apache24\conf\httpd.conf.
    Buscar la línea que dice Listen 80 y cambiarla a:

Listen 82

  Guardar el archivo y reiniciar Apache:

  Stop-Service apache2.4
  Start-Service apache2.4

5. Instalar el servidor de aplicaciones Tomcat

    Descargar Tomcat: Ve al sitio web de Apache Tomcat y descarga el archivo ZIP de la versión que desees.

    Descomprimir Tomcat: Descomprime el archivo en un directorio, por ejemplo, C:\apache-tomcat-9.

    Iniciar Tomcat: Abre PowerShell y navega al directorio bin de Tomcat:

cd C:\apache-tomcat-9\bin

  Ejecutar el script de inicio:

.\catalina.bat start

  Comprobación de Tomcat

  Abre tu navegador y dirígete a:

http://localhost:8080

  Deberías ver la página de bienvenida de Tomcat.
