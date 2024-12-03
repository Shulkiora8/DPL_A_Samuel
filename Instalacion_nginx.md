# Guía paso a paso para instalar y configurar Nginx

## 1. Actualizar el sistema

Primero, se actualiza la lista de paquetes del sistema para asegurarse de que estamos trabajando con la versión más reciente de los repositorios.

```bash
sudo apt update
```

2. Instalar Nginx

Una vez que la lista de paquetes está actualizada, instalamos Nginx.
```

sudo apt install nginx
```

3. Verificar el estado de Nginx

Luego de instalar Nginx, verificamos si el servicio está activo y corriendo.
```
systemctl status nginx
```
4. Probar la configuración de Nginx

Antes de reiniciar el servicio, es una buena práctica verificar que la configuración de Nginx esté libre de errores.
```
nginx -t
```
5. Navegar al directorio de configuración de Nginx

El archivo de configuración principal de Nginx se encuentra en /etc/nginx. Accedemos a este directorio para explorar sus contenidos.
```
cd /etc/nginx
ls
```
6. Explorar los sitios disponibles

Dentro de /etc/nginx, encontramos el directorio sites-available donde se almacenan las configuraciones de los sitios que Nginx puede servir. Accedemos a este directorio.
```
cd sites-available
ls
```
7. Explorar los sitios habilitados

Dentro de /etc/nginx, también existe un directorio llamado sites-enabled donde se encuentran los enlaces simbólicos a los sitios que están habilitados. Accedemos a este directorio para ver qué sitios están habilitados.
```
cd sites-enabled
ls -l
```
8. Ver el archivo de configuración por defecto

El archivo de configuración por defecto de Nginx está en default dentro de sites-available. Lo mostramos con el siguiente comando.
```
cat default
```
9. Acceder al directorio de archivos web

Por defecto, los archivos web de Nginx se encuentran en /var/www/html. Accedemos a este directorio para explorar los archivos predeterminados de la página web.
```
cd /var/www/html
ls -l
```
10. Reiniciar Nginx

Si todo está configurado correctamente, reiniciamos Nginx para aplicar cualquier cambio que hayamos hecho.
```
systemctl restart nginx
```
11. Eliminar el archivo HTML predeterminado

El archivo index.nginx-debian.html es el archivo por defecto que Nginx muestra. Lo eliminamos para poder poner nuestro propio archivo index.html.
```
rm index.nginx-debian.html
```
12. Crear un nuevo archivo index.html

Creamos un archivo index.html con el contenido que deseamos mostrar en nuestra página web.
```
nano index.html
```
13. Reiniciar Nginx nuevamente

Después de modificar o agregar archivos, siempre es recomendable reiniciar Nginx para aplicar los cambios.
```
systemctl restart nginx
```
14. Verificar el estado de Nginx

Finalmente, verificamos nuevamente el estado de Nginx para asegurarnos de que todo esté funcionando correctamente.
```
systemctl status nginx
```
