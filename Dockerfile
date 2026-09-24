FROM php:8.4-apache

RUN docker-php-ext-install mysqli \
    && a2enmod rewrite \
    && echo 'ServerName localhost' >> /etc/apache2/apache2.conf

WORKDIR /var/www/html

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \;

EXPOSE 80
