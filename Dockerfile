FROM php:7.4-apache

WORKDIR /app

ADD docker_files/vhost.conf /etc/apache2/sites-available/000-default.conf
ADD docker_files/apache.conf /etc/apache2/conf-available/z-app.conf
ADD docker_files/php.ini /usr/local/etc/php/conf.d/app.ini
RUN a2enmod rewrite && a2enconf z-app
COPY docker_files/errors /errors

COPY index.php /app/index.php
COPY htaccess.example /app/.htaccess
COPY lib /app/lib
COPY public /app/public
COPY templates /app/templates
RUN mkdir /app/data && chmod a+w /app/data
