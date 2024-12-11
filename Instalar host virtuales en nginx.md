# Configuración de VirtualHosts en Nginx

## Acceso como superusuario
Nos posicionamos en la terminal como superusuario:

```bash
sudo su
```
Creación de carpetas para los hosts virtuales
Creamos las carpetas para los hosts en /var/www/html/:

```
mkdir -p /var/www/html/empresa1.com/public
mkdir -p /var/www/html/empresa2.com/public
mkdir -p /var/www/html/empresa3.com/public

```
Creación de los archivos index.html
Creamos el archivo index.html en la carpeta de la primera empresa y luego lo copiamos para las demás:

```
nano /var/www/html/empresa1.com/public/index.html
cp /var/www/html/empresa1.com/public/index.html /var/www/html/empresa2.com/public/index.html
cp /var/www/html/empresa1.com/public/index.html /var/www/html/empresa3.com/public/index.html
```
El contenido de los archivos debe ser:
```
html
Copiar código
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresa *</title>
</head>
<body>
    <h1>Esta es la empresa *</h1>
</body>
</html
```
Sustituyendo * por el número de la empresa.

Estructura final del directorio:

```
tree /var/www/html/
```
```
/var/www/html/
├── empresa1.com
│   └── public
│       └── index.html
├── empresa2.com
│   └── public
│       └── index.html
├── empresa3.com
│   └── public
│       └── index.html
└── index.html
```
Configuración de permisos
Damos propiedad al usuario www-data para cada carpeta:
```
chown -R www-data: /var/www/html/empresa1.com/
chown -R www-data: /var/www/html/empresa2.com/
chown -R www-data: /var/www/html/empresa3.com/
```
Creación de archivos de configuración para los hosts virtuales
Nos movemos a la ruta de configuraciones de Nginx:
```
cd /etc/nginx/sites-available/
```
Creamos y editamos los archivos de configuración:
```
nano empresaX.com.conf
```
Contenido del archivo:
```
server {
    listen 80;
    server_name empresaX.com www.empresaX.com;

    root /var/www/html/empresaX.com/public;
    index index.html index.htm index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock; # Cambiar versión según la configuración de PHP
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }

    error_log /var/log/nginx/empresaX_error.log;
    access_log /var/log/nginx/empresaX_access.log;
}
```
Reemplazamos X por el número de la empresa.

Habilitación de los hosts virtuales
Creamos un enlace simbólico de los archivos de configuración:
```
ln -s /etc/nginx/sites-available/empresa1.com.conf /etc/nginx/sites-enabled/
ln -s /etc/nginx/sites-available/empresa2.com.conf /etc/nginx/sites-enabled/
ln -s /etc/nginx/sites-available/empresa3.com.conf /etc/nginx/sites-enabled/
```
Comprobamos la estructura:
```
tree /etc/nginx/sites-enabled/
```
```
/etc/nginx/sites-enabled/
├── default -> /etc/nginx/sites-available/default
├── empresa1.com.conf -> /etc/nginx/sites-available/empresa1.com.conf
├── empresa2.com.conf -> /etc/nginx/sites-available/empresa2.com.conf
└── empresa3.com.conf -> /etc/nginx/sites-available/empresa3.com.conf
```
Validación y recarga de Nginx
Comprobamos la configuración:
```
nginx -t
```

nginx: the configuration file /etc/nginx/nginx.conf syntax is ok
nginx: configuration file /etc/nginx/nginx.conf test is successful
Recargamos el servicio:
```
systemctl reload nginx
```
Configuración adicional para localhost
Editamos el archivo nginx.conf:
```
nano /etc/nginx/nginx.conf
```
Añadimos el siguiente bloque dentro de la etiqueta http:
```
server {
    listen 80;
    server_name localhost;

    root /var/www/html;
    index index.html index.htm;

    location / {
        try_files $uri $uri/ =404;
    }
}
```
Validamos y recargamos nuevamente:
```
nginx -t
systemctl reload nginx
```
Modificación del archivo /etc/hosts
Editamos el archivo hosts:
```
nano /etc/hosts
```
Añadimos:
```
127.0.0.1 empresa1.com
127.0.0.1 www.empresa1.com

127.0.0.1 empresa2.com
127.0.0.1 www.empresa2.com

127.0.0.1 empresa3.com
127.0.0.1 www.empresa3.com
```
