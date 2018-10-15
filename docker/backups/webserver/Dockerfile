FROM php:7.1-apache

## init
RUN apt-get update -y

## install
#RUN apt-get install php php-devel php-pear php-mbstring php-gd php-mysql php-xml php-mcrypt -y
RUN docker-php-ext-install pdo_mysql mysqli

## copy
### backup
# RUN cp /etc/php.ini /etc/php.ini.origin

### copy php.ini
# COPY ./php.ini /etc/php.ini

# RUN service apache2 restart

