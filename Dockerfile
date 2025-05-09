FROM php:8.2-apache

# Actualizar paquetes y agregar extensiones necesarias para Laravel
RUN apt-get update --allow-releaseinfo-change \
    && apt-get install -y --no-install-recommends \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev \
    curl unzip git vim \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mbstring pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

RUN apt-get update && apt-get install -y mysql-client

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar código de Laravel al contenedor
COPY . /var/www/html

# Configurar Apache para Laravel
RUN a2enmod rewrite \
    && chmod -R 755 /var/www/html/public \
    && chown -R www-data:www-data /var/www/html/public

# Copiar configuración de Apache personalizada
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Reiniciar Apache para aplicar cambios
RUN service apache2 restart
