# Migración de Infraestructura Dinámica de XAMPP a LAMP

Este documento detalla los pasos necesarios para migrar un proyecto dinámico de XAMPP a un servidor LAMP instalado en un entorno Linux.

---

## **1. Configurar el entorno LAMP**
### Verificar instalación
- **Apache**: Verifica que el servidor Apache está funcionando:
  ```bash
  sudo systemctl status apache2
  ```
- **MariaDB**: Comprueba que MariaDB/MySQL está corriendo:
  ```bash
  sudo systemctl status mysql
  ```
- **PHP**: Confirma la versión instalada:
  ```bash
  php -v
  ```

### Crear directorios
- Configura tu proyecto en el directorio raíz de Apache:
  ```bash
  sudo mkdir -p /var/www/html/proyecto
  sudo chmod -R 775 /var/www/html/proyecto
  sudo chown -R $USER:www-data /var/www/html/proyecto
  ```

---

## **2. Migrar los archivos del proyecto**
1. **Exportar el proyecto desde XAMPP**:
   - Copia los archivos del proyecto desde `C:/xampp/htdocs/proyecto`.
   - Transfiere los archivos al servidor Linux usando `scp` o `rsync`:
     ```bash
     scp -r /path/to/tu_proyecto usuario@ip_del_servidor:/var/www/html/
     ```

---

## **3. Configurar la base de datos**
1. **Exportar la base de datos de XAMPP**:
   - Usa **phpMyAdmin** o el comando MySQL:
     ```bash
     mysqldump -u usuario -p proyecto > proyecto.sql
     ```

2. **Importar en MariaDB**:
   - Copia el archivo SQL al servidor LAMP:
     ```bash
     scp proyecto.sql usuario@127.0.0.1:/Escritorio/
     ```
   - Importa la base de datos:
     ```bash
     mysql -u usuario -p proyecto < /Escritorio/proyecto.sql
     ```

3. **Configurar usuarios y permisos**:
   ```bash
   mysql -u root -p
   GRANT ALL PRIVILEGES ON nombre_bd.* TO 'usuario'@'localhost' IDENTIFIED BY '';
   FLUSH PRIVILEGES;
   ```

---

## **4. Configurar Apache**
1. **Crear un archivo de configuración para el Virtual Host**:
   - Crea el archivo `/etc/apache2/sites-available/tu_proyecto.conf`:
     ```apache
     <VirtualHost *:80>
         ServerName tu_dominio.com
         DocumentRoot /var/www/html/proyecto

         <Directory /var/www/html/proyecto>
             Options Indexes FollowSymLinks
             AllowOverride All
             Require all granted
         </Directory>

         ErrorLog ${APACHE_LOG_DIR}/proyecto_error.log
         CustomLog ${APACHE_LOG_DIR}/proyecto_access.log combined
     </VirtualHost>
     ```

2. **Activar el sitio y reiniciar Apache**:
   ```bash
   sudo a2ensite proyecto
   sudo systemctl reload apache2
   ```

---

## **5. Configurar PHP**
1. **Instalar extensiones necesarias**:
   ```bash
   sudo apt install php-mysql php-curl php-xml php-mbstring
   ```
2. **Reiniciar Apache**:
   ```bash
   sudo systemctl restart apache2
   ```

---

## **6. Probar el proyecto**
1. Accede al dominio o IP del servidor en tu navegador:
   ```plaintext
   http://proyecto.com
