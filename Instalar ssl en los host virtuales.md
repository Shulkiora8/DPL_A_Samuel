# Instalación de SSL en VirtualHosts con Nginx

## Paso 1: Instalar Certbot
Certbot se utiliza para gestionar los certificados SSL de Let's Encrypt. Instálalo con el siguiente comando:

```
sudo apt update
sudo apt install certbot python3-certbot-nginx -y
```
Paso 2: Solicitar certificados SSL
Genera certificados SSL para cada uno de los dominios configurados en los VirtualHosts. Por ejemplo:
```
sudo certbot --nginx -d empresa1.com -d www.empresa1.com
sudo certbot --nginx -d empresa2.com -d www.empresa2.com
sudo certbot --nginx -d empresa3.com -d www.empresa3.com
```
Durante el proceso, Certbot:

Detectará automáticamente los VirtualHosts configurados.
Te pedirá seleccionar el archivo de configuración correspondiente.
Configurará SSL y redirigirá el tráfico HTTP a HTTPS si seleccionas la opción.
Certbot también editará los archivos .conf en /etc/nginx/sites-available/ para incluir la configuración SSL.

Paso 3: Comprobación de certificados SSL
Certbot verificará automáticamente que los certificados se hayan generado y configurado correctamente. Sin embargo, puedes comprobarlo manualmente revisando las configuraciones actualizadas de tus archivos .conf. Por ejemplo:
```
nano /etc/nginx/sites-available/empresa1.com.conf
```
El archivo debe contener bloques como el siguiente:
```
server {
    listen 443 ssl;  # Puerto HTTPS
    server_name empresa1.com www.empresa1.com;

    ssl_certificate /etc/letsencrypt/live/empresa1.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/empresa1.com/privkey.pem;

    root /var/www/html/empresa1.com/public;
    index index.html index.htm index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }

    error_log /var/log/nginx/empresa1_error.log;
    access_log /var/log/nginx/empresa1_access.log;
}

server {
    listen 80;
    server_name empresa1.com www.empresa1.com;
    return 301 https://$host$request_uri; # Redirección de HTTP a HTTPS
}
```
Paso 4: Validar la configuración de Nginx
Comprueba que la configuración sea válida:
```
sudo nginx -t
```
Si todo está correcto, recarga Nginx:
```
sudo systemctl reload nginx
```
Paso 5: Renovación automática de certificados
Los certificados de Let's Encrypt expiran cada 90 días. Para garantizar su renovación automática, Certbot instala un cron job que se ejecuta periódicamente. Puedes verificarlo con:
```
sudo systemctl list-timers | grep certbot
```
También puedes probar manualmente la renovación con:
```
sudo certbot renew --dry-run
```
Si no hay errores, la renovación automática está configurada correctamente.

Paso 6: Verificar SSL en los dominios
Abre tu navegador y accede a los dominios configurados con https. Por ejemplo:
```
https://empresa1.com
https://www.empresa1.com
```
