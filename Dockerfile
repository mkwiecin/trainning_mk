FROM php:7.1-apache

RUN echo "deb http://deb.debian.org/debian stretch main contrib" > /etc/apt/sources.list.d/rep1.list
RUN echo "deb-src http://deb.debian.org/debian stretch main" > /etc/apt/sources.list.d/rep2.list
RUN apt-get update
#RUN apt-get upgrade -

# Download and install wkhtmltopdf
RUN DEBIAN_FRONTEND=noninteractive apt-get install -y build-essential xorg libssl-dev libxrender-dev wget gdebi libpng-dev libjpeg-dev
COPY wkhtmltox_0.12.5-1.stretch_amd64.deb /tmp/wkhtmltox_0.12.5-1.stretch_amd64.deb
RUN gdebi --n /tmp/wkhtmltox_0.12.5-1.stretch_amd64.deb

RUN apt-get install -y curl libcurl4-openssl-dev
RUN apt-get install -y libxml2-dev
RUN apt-get install -y libmcrypt-dev
RUN apt-get install -y vim

COPY powerbody.conf /etc/apache2/sites-enabled/

RUN apt-get install -y libfreetype6-dev
RUN docker-php-ext-configure gd --with-jpeg-dir --with-png-dir --with-freetype-dir
RUN docker-php-ext-install gd curl dom iconv mcrypt pdo pdo_mysql simplexml soap zip
RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_connect_back=on" >> /usr/local/etc/php/conf.d/xdebug.ini
RUN a2enmod rewrite
RUN useradd -u 1000 owner
RUN chsh -s /bin/bash owner
RUN sed -i -e 's/www-data/owner/g' /etc/apache2/envvars