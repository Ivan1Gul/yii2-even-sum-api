FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libicu-dev \
    && docker-php-ext-install \
        intl \
        opcache \
    && a2enmod rewrite

#Compooser
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

#Apache
RUN sed -i 's|/var/www/html|/app/web|g' /etc/apache2/sites-available/000-default.conf \
    && echo '<Directory /app/web>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' >> /etc/apache2/sites-available/000-default.conf

WORKDIR /app