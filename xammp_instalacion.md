# Instalar el instalador de Xammp
Visita la página de Apache Friends y descarga la versión de XAMPP que incluya PHP 5.5, 5.6 o 7. Una vez descargado, ejecuta el archivo .exe. Es recomendable desactivar temporalmente tu antivirus para evitar interrupciones durante la instalación. Desactiva el Control de Cuentas de Usuario (UAC) para evitar problemas con permisos de escritura en el disco C. Consulta el soporte de Microsoft para saber cómo hacerlo.

#Instalar Xammp
Abre el instalador de XAMPP y haz clic en “Next” para iniciar el proceso. En la pantalla “Select components”, selecciona los módulos que deseas instalar. Para un servidor de prueba local, recomiendo dejar la configuración predeterminada. Seleccionamos la carpeta donde se instalará XAMPP. Por defecto, será C:\xampp. El instalador extraerá y guardará los componentes en el directorio seleccionado. Esto puede tomar unos minutos.

Una vez completada la instalación, cierra el asistente haciendo clic en “Finish”. Puedes abrir el panel de control marcando la opción correspondiente.

#Panel de control de Xammp
En el panel de control, puedes iniciar o detener los módulos de XAMPP individualmente. Los módulos activos aparecerán resaltados en verde.

#Configurar Apache
Si Apache no arranca debido a un conflicto de puertos, podemos cambiar los puertos en Skype desmarcando el uso de los puertos 80 y 443. Modificar los puertos de Apache en los archivos httpd.conf y httpd-ssl.conf. Cerrar Skype mientras Apache está en ejecución.

#Verificar la instalación
Para ello abrimos el directorio C:\xampp\htdocs. Creamos una carpeta y guardamos un archivo test.php con este contenido:
"<html>
    <head>
        <title>Test PHP</title>
    </head>
    <body>
        <?php echo '<p>Hola mundo</p>'; ?>
    </body>
</html>"
Abrimos el navegador y nos dirigimos a localhost/test/test.php. Si vemos el mensaje "Hola mundo", la instalación fue exitosa.

![](/Fotos/xammp.png)



