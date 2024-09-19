#Crear rama
Para crear la rama usaremos el comando "git branch v0.2", y para movernos a la rama creada usaremos "git checkout v0.2". Ponemos "git status" para comprobar que estamos en la rama. 
![](/Fotos/rama.png)


#Crear 2.txt y crear rama remota
Creamos el archivo 2.txt. Ahora hacemos un "git add .", un commit con "git commit -m "commit rama" y hacemos un push para configurar la rama "git push --set-upstream origin v0.2.
![](/Fotos/push_rama.png)

#Merge directo
Nos movemos al main con "git checkout main". Juntamos las ramas con git merge v0.2.
![](/Fotos/merge.png)

#Merge con conflicto
Hacemos un "git add .", hacemos un commit "git commit -m "hola en 1.txt."", hacemos un "git push". Ahora hacemos un "git checkout v0.2" para cambiar a esa rama. Y hacemos exactamente los mismos comandos anteriores cambiando únicamente el commit: "git add .", "adios 1.txt", "git push". Hacemos un checkout main para volver a cambiar la rama y hacemos "git merge v0.2" para fusionar el contenido.
![](/Fotos/hola_adios.png)

#Creacion del tag
Para crear el tag ponemos el comando "git tag v0.2 -m "version 2". Hacemos un push con "git push --tags".
![](/Fotos/tagv2.png)

#Borrar la rama
Para borrar la rama usamos el comando "git branch -d v0.2".

#Crear organización
