# Configuración e instalación de un servidor DNS Bind9 en Ubuntu 20.04

En esta guía aprenderemos a instalar y configurar nuestro propio servidor DNS Bind9 en **Ubuntu 20.04**. El servidor DNS se encarga de convertir URL (dominios y servicios) en direcciones IP. Por ejemplo, configuraremos el dominio `networld.cu` para que al escribir `www.networld.cu` en un navegador, este se resuelva a una dirección IP como `192.x.x.x`, donde se encontrará un servidor web.

## Razones para usar un servidor DNS:
1. Los usuarios no pueden recordar fácilmente las direcciones IP.
2. Los ordenadores y servidores se comunican mediante direcciones IP, pero los nombres de dominio son más amigables.

### Requisitos previos
Asumimos que ya tienes **Ubuntu Server 20.04** instalado y funcionando. Usaremos los siguientes datos del servidor como ejemplo:

- **Nombre de host**: `ns1`
- **FQDN**: `ns1.networld.cu`
- **Dirección IP**: `10.10.20.13`

Archivos a editar o crear:
- `/etc/bind/named.conf.options`
- `/etc/default/named`
- `/etc/bind/named.conf.local`
- `/etc/bind/zonas/db.networld.cu` (crear)
- `/etc/bind/zonas/db.10.10.20` (crear)

---

### Pasos de configuración

#### 1. Comprobar actualizaciones
```bash
sudo apt update
sudo apt upgrade
```

2. Instalar Bind9 y editor de texto (Nano)
```
sudo apt install bind9 bind9-utils nano
```

3. Verificar si Bind9 está funcionando
```
systemctl status bind9
```
4. Configurar el Firewall para permitir acceso a Bind9
```
sudo ufw allow bind9
```
5. Configuración mínima de Bind9

Editar el archivo /etc/bind/named.conf.options:
```
sudo nano /etc/bind/named.conf.options
```
Contenido del archivo:
```
listen-on { any; };
allow-query { localhost; 10.10.20.0/24; };
forwarders {
    8.8.8.8;
    8.8.4.4;
};
dnssec-validation no;
```
6. Obligar el uso de IPv4

Editar el archivo /etc/default/named:
```
sudo nano /etc/default/named
```
Cambiar la línea por:
```
OPTIONS="-u bind -4"
```
7. Verificar configuración y reiniciar Bind9
```
sudo named-checkconf
sudo systemctl restart bind9
systemctl status bind9
```

8. Configurar zonas DNS

Editar el archivo /etc/bind/named.conf.local:
```
sudo nano /etc/bind/named.conf.local
```
Añadir lo siguiente:
```
zone "networld.cu" IN {
    type master;
    file "/etc/bind/zonas/db.networld.cu";
};

zone "20.10.10.in-addr.arpa" {
    type master;
    file "/etc/bind/zonas/db.10.10.20";
};
```
9. Crear directorio y archivos de zonas
```
sudo mkdir /etc/bind/zonas
```
Crear archivo de zona directa:
```
sudo nano /etc/bind/zonas/db.networld.cu
```
Contenido:
```
$TTL 1D
@ IN SOA ns1.networld.cu. admin.networld.cu. (
    1 ; Serial
    12h ; Refresh
    15m ; Retry
    3w ; Expire
    2h ) ; Negative Cache TTL
IN NS ns1.networld.cu.
ns1 IN A 10.10.20.13
www IN A 10.10.20.13
```
Crear archivo de zona inversa:
```
sudo nano /etc/bind/zonas/db.10.10.20
```
Contenido:
```
$TTL 1D
@ IN SOA ns1.networld.cu. admin.networld.cu. (
    20210222 ; Serial
    12h ; Refresh
    15m ; Retry
    3w ; Expire
    2h ) ; Negative Cache TTL
IN NS ns1.networld.cu.
1 IN PTR www.networld.cu.
```
10. Verificar los archivos de zona
```
sudo named-checkzone networld.cu /etc/bind/zonas/db.networld.cu
sudo named-checkzone 20.10.10.in-addr.arpa /etc/bind/zonas/db.10.10.20
```
11. Reiniciar Bind9
```
sudo systemctl restart bind9
```

12. Conectate desde otra PC mediante la IP
