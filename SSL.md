## Documentación para configurar SSL en Apache

1. Obtener acceso de superusuario

Inicia sesión en el servidor y obtén permisos de superusuario:
```
sudo su
```
2. Instalar OpenSSL

Si no tienes OpenSSL instalado, usa el siguiente comando para instalarlo:
```
apt install openssl
```
3. Generar la clave privada

Genera una clave privada de 1024 bits, que se almacenará en el archivo server.key:
v
openssl genrsa -out server.key 1024
```
4. Crear el CSR (Certificate Signing Request)

Genera el archivo de solicitud de firma de certificado (CSR), que contiene los detalles de tu servidor y dominio:
```
openssl req -new -key server.key -out server.csr
```
Este comando te pedirá información como el nombre de la organización, el nombre común (que debe ser el dominio de tu sitio, por ejemplo, prueba1.com), entre otros detalles.
5. Crear el certificado autofirmado

Usa el CSR y la clave privada para generar un certificado SSL autofirmado. Este certificado tendrá una validez de 365 días:
```
openssl x509 -req -days 365 -in server.csr -signkey server.key -out server.crt
```
6. Mover los archivos a la ubicación de certificados de Apache

Copia la clave privada (server.key) y el certificado (server.crt) a la carpeta de certificados de Apache:
```
cp server.key /etc/ssl/certs
cp server.crt /etc/ssl/certs
```
7. Verificar el estado de Apache

Verifica que el servicio de Apache esté activo y funcionando correctamente:
```
systemctl status apache2
```
8. Habilitar el módulo SSL de Apache

Habilita el módulo SSL de Apache, que es necesario para usar HTTPS:
```
a2enmod ssl
```
9. Reiniciar Apache

Reinicia Apache para aplicar los cambios:
```
systemctl restart apache2
```
10. Configurar el VirtualHost para SSL

Edita la configuración de Apache para habilitar el soporte SSL en el dominio prueba1.com. Crea o edita el archivo de configuración del sitio:
```
nano /etc/apache2/sites-available/prueba1.com.conf
```
Añade la siguiente configuración al archivo:
```
<VirtualHost *:443>
    ServerName prueba1.com
    ServerAlias www.prueba1.com
    ServerAdmin webmaster@prueba1.com
    DocumentRoot /var/www/html/prueba1.com/public

    SSLEngine on
    SSLCertificateKeyFile /etc/ssl/certs/server.key
    SSLCertificateFile /etc/ssl/certs/server.crt

    <Directory /var/www/html/prueba1.com/public>
        Options -Indexes +FollowSymLinks
        AllowOverride All
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/prueba1.com-error-log
    CustomLog ${APACHE_LOG_DIR}/prueba1.com-access.log combined
</VirtualHost>
```
Guarda el archivo y cierra el editor.
11. Activar el sitio SSL

Activa el sitio de Apache con la configuración SSL:
```
a2ensite prueba1.com.conf
```
12. Reiniciar Apache nuevamente

Reinicia Apache para aplicar la configuración:
```
systemctl restart apache2
```
13. Verificar el estado de Apache

Verifica que Apache esté funcionando correctamente con SSL habilitado:
```
systemctl status apache2
```
14. Comprobar la configuración en el navegador

Accede a https://prueba1.com desde un navegador web. Si todo está configurado correctamente, deberías ver el sitio cargado con HTTPS, aunque el navegador mostrará una advertencia sobre el certificado autofirmado (lo cual es normal para certificados generados localmente).
