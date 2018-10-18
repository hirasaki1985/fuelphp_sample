FROM php:7.1-apache

## init
#RUN apt-get update -y

## install
#RUN apt-get install php php-devel php-pear php-mbstring php-gd php-mysql php-xml php-mcrypt -y
RUN docker-php-ext-install pdo_mysql mysqli

## copy
### vhosts
#RUN cp /var/www/html/docker/webserver/vhosts/example.conf /etc/apache2/sites-enabled
COPY vhosts/example.conf /etc/apache2/sites-enabled/example.conf

### php.ini
#RUN cp /var/www/html/docker/webserver/php/php.ini /usr/local/etc/php
RUN cp -p /usr/local/etc/php/php.ini /usr/local/etc/php/php.ini.bkup
COPY php/php.ini /usr/local/etc/php/php.ini

# RUN service apache2 restart
