FROM php:7.1-apache

## init
RUN apt-get update -y
RUN apt-get install -y apt-utils git zip unzip

## install
#RUN apt-get install php php-devel php-pear php-mbstring php-gd php-mysql php-xml php-mcrypt -y
RUN docker-php-ext-install pdo_mysql mysqli

## mod rewrite
RUN a2enmod rewrite

## copy
### vhosts
#RUN cp /var/www/html/dev_env/webserver/vhosts/example.conf /etc/apache2/sites-enabled
COPY vhosts/example.conf /etc/apache2/sites-enabled/example.conf

## log
RUN mkdir -p /var/log/fuelphp
RUN chmod -R 777 /var/log/fuelphp
#RUN ln -s /var/log/fuelphp /var/www/html/fuel/app/logs

### php.ini
#RUN cp /var/www/html/dev_env/webserver/php/php.ini /usr/local/etc/php
#RUN cp -p /usr/local/etc/php/php.ini /usr/local/etc/php/php.ini.bkup
COPY php/php.ini /usr/local/etc/php/php.ini

# RUN service apache2 restart
