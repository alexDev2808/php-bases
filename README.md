# Guía técnica: PHP en Fedora 43 con Apache (httpd)

**Entorno objetivo:**  
- Fedora Linux 43  
- Escritorio GNOME  
- Shell zsh  
- Servidor web Apache (httpd)  

Esta guía explica paso a paso cómo:

- Abrir y editar archivos PHP  
- Ejecutar PHP desde la terminal y vía navegador  
- Configurar Apache (httpd) para servir PHP  
- Crear un proyecto PHP con estructura profesional  
- Configurar VirtualHosts, permisos y SELinux  
- Usar Composer para gestionar dependencias  

---

## 1. Abrir y editar archivos PHP

### 1.1 Editar/ver archivos PHP (sin ejecutarlos)

Opciones en GNOME:

- GNOME Text Editor / Gedit  
  Clic derecho sobre el archivo → “Abrir con Editor de texto”.

- Terminal (zsh) con nano  
  ```zsh
  nano archivo.php
  ```

- VS Code (si está instalado)  
  ```zsh
  code archivo.php
  ```

> Editar un archivo PHP solo muestra el código. Para ejecutarlo necesitas PHP o Apache.

---

## 2. Ejecutar PHP sin Apache (modo rápido)

### 2.1 Ejecutar script PHP desde la terminal

```zsh
php archivo.php
```

### 2.2 Usar el servidor embebido de PHP

```zsh
cd /ruta/a/tu/proyecto
php -S localhost:8000
```

En navegador:

- http://localhost:8000/archivo.php

### 2.3 Instalar PHP si no está disponible

```zsh
sudo dnf install php-cli php-common
```

---

## 3. Usar Apache (httpd) con PHP

### 3.1 DocumentRoot por defecto en Fedora

```
/var/www/html/
```

Mover un archivo PHP:

```zsh
sudo cp archivo.php /var/www/html/
```

Acceso en navegador:

- http://localhost/archivo.php

### 3.2 Instalar PHP para Apache

```zsh
sudo dnf install php
sudo systemctl restart httpd
```

### 3.3 Permisos y SELinux en Fedora

#### Permiso básico de lectura

```zsh
sudo chmod 644 /var/www/html/archivo.php
```

#### Restaurar contexto SELinux

```zsh
sudo restorecon -v /var/www/html/archivo.php
```

### 3.4 Ver errores de Apache

```zsh
sudo tail -f /var/log/httpd/error_log
```

---

## 4. Crear un proyecto PHP profesional (estructura recomendada)

### 4.1 Estructura recomendada

```
mi-proyecto/
  public/      <-- DocumentRoot (index.php, CSS, JS, imágenes)
  src/         <-- Lógica, clases, controladores
  vendor/      <-- Librerías de Composer
  config/      <-- Configuración del proyecto
```

### 4.2 Crear el proyecto en tu HOME

```zsh
mkdir -p ~/Proyectos/mi-app-php/{public,src,config}
cd ~/Proyectos/mi-app-php
```

Archivo de prueba:

```zsh
echo "<?php echo 'Hola desde Fedora 43'; ?>" > public/index.php
```

> Recomendación: abre toda la carpeta del proyecto en VS Code.

---

## 5. Configurar un VirtualHost en Apache

### 5.1 Crear archivo de configuración

```zsh
sudo nano /etc/httpd/conf.d/mi-app.conf
```

Contenido (cambia `tu-usuario`):

```apache
<VirtualHost *:80>
    ServerName mi-app.local
    DocumentRoot /home/tu-usuario/Proyectos/mi-app-php/public

    <Directory /home/tu-usuario/Proyectos/mi-app-php/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog /var/log/httpd/mi-app-error.log
    CustomLog /var/log/httpd/mi-app-access.log combined
</VirtualHost>
```

> `AllowOverride All` permite usar `.htaccess`.

---

## 6. Permisos y SELinux para proyectos en `/home`

### 6.1 Permisos de directorio

```zsh
chmod 711 /home/tu-usuario
chmod 755 /home/tu-usuario/Proyectos
chmod -R 755 /home/tu-usuario/Proyectos/mi-app-php
```

### 6.2 Permitir que Apache lea archivos de usuario (SELinux)

```zsh
sudo setsebool -P httpd_read_user_content 1
sudo chcon -R -t httpd_sys_content_t ~/Proyectos/mi-app-php/public
```

---

## 7. Registrar dominio local en `/etc/hosts`

```zsh
sudo nano /etc/hosts
```

Agregar al final:

```
127.0.0.1   mi-app.local
```

---

## 8. Instalar y usar Composer (gestión de dependencias)

### 8.1 Instalar Composer

```zsh
sudo dnf install composer
```

### 8.2 Inicializar Composer en el proyecto

```zsh
cd ~/Proyectos/mi-app-php
composer init
```

### 8.3 Instalar un paquete con Composer

```zsh
composer require vendor/paquete
```

---

## 9. Reiniciar Apache y probar proyecto

### 9.1 Reiniciar Apache

```zsh
sudo systemctl restart httpd
```

### 9.2 Probar en navegador

- Si configuraste VirtualHost:

  - http://mi-app.local

- Sin VirtualHost:

  - http://localhost/

### 9.3 Supervisar logs de Apache

```zsh
sudo tail -f /var/log/httpd/error_log
```

O logs específicos del VirtualHost:

```zsh
sudo tail -f /var/log/httpd/mi-app-error.log
```

---

## 10. Cheat sheet (resumen rápido de comandos)

```bash
# Editar archivo PHP
nano archivo.php

# Ejecutar PHP en consola
php archivo.php

# Servidor embebido de PHP
php -S localhost:8000

# Instalar PHP
sudo dnf install php php-cli php-common

# Instalar PHP para Apache
sudo dnf install php

# Reiniciar Apache
sudo systemctl restart httpd

# Ver estado de Apache
sudo systemctl status httpd

# Logs de Apache
sudo tail -f /var/log/httpd/error_log

# Ajustes SELinux para /home
sudo setsebool -P httpd_read_user_content 1
sudo chcon -R -t httpd_sys_content_t ~/Proyectos/mi-app-php/public

# Instalar Composer
sudo dnf install composer

# Inicializar Composer
cd ~/Proyectos/mi-app-php
composer init
```