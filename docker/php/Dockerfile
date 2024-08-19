FROM php:8.3-fpm

RUN apt update 
RUN apt install -y zip \
    libzip-dev \
    libpq-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng-dev \
    libcurl4-gnutls-dev \
    libxml2-dev \
    libxslt1-dev

RUN docker-php-ext-install \
    pdo_pgsql \
    pgsql\
    bcmath \
    xml \
    exif \
    zip \
    soap \
    xsl \
    sockets \
    opcache 