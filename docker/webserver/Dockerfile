FROM php:7.1-apache

## init
RUN apt-get update -y

## install
#RUN apt-get install php php-devel php-pear php-mbstring php-gd php-mysql php-xml php-mcrypt -y
RUN docker-php-ext-install pdo_mysql mysqli

## copy
### vhosts
#RUN cp /var/www/html/docker/webserver/vhosts/driverteach.conf /etc/apache2/sites-enabled
COPY vhosts/driverteach.conf /etc/apache2/sites-enabled/driverteach.conf

### php.ini
#RUN cp /var/www/html/docker/webserver/php/php.ini /usr/local/etc/php
COPY php/php.ini /usr/local/etc/php/php.ini

# RUN service apache2 restart
