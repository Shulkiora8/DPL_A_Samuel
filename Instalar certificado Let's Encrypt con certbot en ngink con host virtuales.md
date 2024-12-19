# Instalación de Certificado Let's Encrypt con Certbot en Nginx con Hosts Virtuales

## Paso 1: Instalación de Certbot

1. **Actualizar el sistema**:

   Primero, asegúrate de que tu sistema está actualizado.

   ```bash
   sudo apt update
   sudo apt upgrade
    ```  
    Instalar Certbot y el complemento para Nginx:

    Para instalar Certbot, primero necesitas agregar el repositorio de Certbot y luego instalar el paquete necesario para Nginx.
  ```
    sudo apt install certbot python3-certbot-nginx
  ```
Paso 2: Configurar Nginx con Hosts Virtuales

Antes de obtener el certificado, asegúrate de que Nginx esté configurado correctamente con los hosts virtuales.

  Ubicación de los archivos de configuración:

  Los archivos de configuración de Nginx suelen estar en /etc/nginx/sites-available/ y los enlaces simbólicos en /etc/nginx/sites-enabled/.

  Configuración básica de un host virtual:

  Abre o crea un archivo de configuración para tu dominio en /etc/nginx/sites-available/:
```
sudo nano /etc/nginx/sites-available/empresa1.com
```
Y agrega una configuración básica:
```
server {
    listen 80;
    server_name empresa1.com www.empresa1.com;

    root /var/www/empresa1.com;

    location / {
        try_files $uri $uri/ =404;
    }
}
```
Asegúrate de cambiar tu_dominio.com por tu dominio real y configurar correctamente el directorio raíz del servidor (root).

Habilitar el host virtual:

Crea un enlace simbólico en sites-enabled para habilitar este archivo de configuración.
```
sudo ln -s /etc/nginx/sites-available/empresa1.com /etc/nginx/sites-enabled/
```
Verificar la configuración de Nginx:

Verifica que no haya errores en la configuración de Nginx.
```
sudo nginx -t
```
Recargar Nginx:

Si la verificación es exitosa, recarga Nginx para aplicar la configuración.

    sudo systemctl reload nginx

Paso 3: Obtener el Certificado SSL con Certbot

Ahora que Nginx está configurado y funcionando, puedes usar Certbot para obtener un certificado SSL de Let's Encrypt.

  Ejecutar Certbot:

  Certbot tiene una opción específica para Nginx que puede obtener y configurar el certificado automáticamente. Ejecuta el siguiente comando:
```
sudo certbot --nginx -d empresa1.com -d www.empresa1.com
```
Esto hará que Certbot:

  Solicite un certificado SSL de Let's Encrypt.
  Configure automáticamente Nginx para usar HTTPS.
  Añada las configuraciones necesarias para redirigir el tráfico HTTP a HTTPS.

Configuración automática:

Certbot te pedirá que elijas entre permitir que redirija todo el tráfico a HTTPS o dejarlo como estaba (sin redirección). Lo recomendado es elegir la opción para redirigir todo el tráfico a HTTPS.

Después de completar la solicitud, Certbot actualizará la configuración de Nginx y debería verse algo como esto:
```
    server {
        listen 80;
        server_name empresa1.com www.empresa1.com;
        return 301 https://$host$request_uri;
    }

    server {
        listen 443 ssl;
        server_name empresa1.com www.empresa1.com;

        ssl_certificate /etc/letsencrypt/live/empresa1.com/fullchain.pem;
        ssl_certificate_key /etc/letsencrypt/live/empresa1.com/privkey.pem;
        include /etc/letsencrypt/options-ssl-nginx.conf;
        ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem;

        root /var/www/empresa1.com;
        location / {
            try_files $uri $uri/ =404;
        }
    }
```
Paso 4: Verificar la instalación

  Verificar la renovación automática:

  Certbot configura automáticamente una tarea cron que se ejecuta dos veces al día para renovar los certificados SSL. Para verificar que la renovación automática está configurada correctamente, puedes probarla con:
```
    sudo certbot renew --dry-run
```
  Comprobar la seguridad:

  Visita https://tu_dominio.com en un navegador y asegúrate de que se muestra como "Seguro" y que el certificado SSL está instalado correctamente.

Paso 5: Habilitar HTTPS en otros Hosts Virtuales

Si tienes otros sitios configurados en Nginx, puedes repetir los pasos para cada uno de ellos. Certbot también puede manejar múltiples dominios en un solo comando:
```
sudo certbot --nginx -d empresa1.com -d www.dominio1.com -d dominio2.com
```
