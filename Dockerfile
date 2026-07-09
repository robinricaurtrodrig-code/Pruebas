# Imagen base con PHP 8.2 y Apache
FROM php:8.2-apache

# Instala las extensiones PDO y PDO MySQL para conexión a base de datos
RUN docker-php-ext-install pdo pdo_mysql

# Habilita el módulo mod_rewrite de Apache para URLs amigables
RUN a2enmod rewrite

# Cambia el DocumentRoot de Apache a /var/www/html/public
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Copia todo el contenido del proyecto al contenedor
COPY . /var/www/html

# Asigna permisos correctos al usuario www-data de Apache
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Expone el puerto 80 para acceder al servidor web
EXPOSE 80
