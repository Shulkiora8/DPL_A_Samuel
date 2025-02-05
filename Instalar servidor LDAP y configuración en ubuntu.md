# Instalación y configuración de un servidor LDAP en Ubuntu

## 1. Instalación de OpenLDAP

```bash
sudo apt update && sudo apt upgrade -y
sudo apt install -y slapd ldap-utils
```

Durante la instalación, se te pedirá establecer la contraseña de administrador para el directorio LDAP.

## 2. Configuración básica de OpenLDAP

### 2.1 Reconfiguración de `slapd` (opcional)
Si deseas volver a configurar `slapd`, ejecuta:

```bash
sudo dpkg-reconfigure slapd
```

Selecciona las opciones según tus necesidades. Se recomienda:
- No omitir la configuración del backend.
- Usar `MDB` como base de datos.
- Permitir la eliminación de la base de datos cuando `slapd` se desinstale.
- Configurar el nombre de dominio en formato `dc=myserver,dc=com`.

### 2.2 Verificación de la instalación

Ejecuta el siguiente comando para verificar que el servicio esté corriendo:

```bash
sudo systemctl status slapd
```

Si el servicio no está activo, puedes iniciarlo con:

```bash
sudo systemctl start slapd
```

## 3. Agregar una estructura base a LDAP

Crea un archivo `base.ldif` con la siguiente estructura:

```ldif
dn: dc=myserver,dc=com
objectClass: top
objectClass: dcObject
objectClass: organization
o: Mi Organización
dc: myserver

# Grupo de Usuarios
dn: ou=usuarios,dc=myserver,dc=com
objectClass: organizationalUnit
ou: usuarios

# Grupo de Grupos
dn: ou=grupos,dc=myserver,dc=com
objectClass: organizationalUnit
ou: grupos
```

Agrega la configuración a LDAP con:

```bash
ldapadd -x -D "cn=admin,dc=myserver,dc=com" -W -f base.ldif
```

## 4. Agregar un usuario a LDAP

Crea un archivo `usuario.ldif` con el siguiente contenido:

```ldif
dn: uid=usuario1,ou=usuarios,dc=myserver,dc=com
objectClass: inetOrgPerson
objectClass: posixAccount
objectClass: top
cn: Usuario Uno
sn: Uno
uid: usuario1
uidNumber: 1001
gidNumber: 1001
homeDirectory: /home/usuario1
loginShell: /bin/bash
userPassword: {SSHA}contraseña_encriptada
```

Agrega el usuario con:

```bash
ldapadd -x -D "cn=admin,dc=myserver,dc=com" -W -f usuario.ldif
```

## 5. Consultar la base de datos LDAP

Para verificar los datos almacenados en el servidor LDAP, usa:

```bash
ldapsearch -x -LLL -b "dc=myserver,dc=com"
```

## 6. Configuración del Cliente LDAP (opcional)

Si deseas configurar un cliente LDAP en otra máquina para autenticación, instala los paquetes necesarios:

```bash
sudo apt install -y libnss-ldap libpam-ldap ldap-utils
```

Durante la instalación, proporciona la información del servidor y dominio LDAP.

Luego, configura NSS para usar LDAP:

```bash
echo "passwd: files ldap" | sudo tee -a /etc/nsswitch.conf
echo "group: files ldap" | sudo tee -a /etc/nsswitch.conf
echo "shadow: files ldap" | sudo tee -a /etc/nsswitch.conf
```

Finalmente, prueba la autenticación con:

```bash
getent passwd usuario1
```

## 7. Conclusión

Ahora tienes un servidor LDAP básico configurado en Ubuntu. Puedes expandirlo agregando más usuarios, grupos y configuraciones avanzadas como TLS/SSL para mejorar la seguridad.

