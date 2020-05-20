FROM php:7.3-fpm

RUN ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/local/include/

RUN apt-get update
RUN apt-get install -y libzip-dev
RUN apt-get install -y libgmp-dev libgmp3-dev
RUN apt-get install -y zlib1g-dev libpq-dev git libicu-dev libxml2-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
#    && docker-php-ext-configure mysqli -with-mysqli=/usr/local/mysqli \
    && docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-install mysqli && docker-php-ext-enable mysqli \
    && docker-php-ext-install zip xml \
    && docker-php-ext-configure gmp \
    && docker-php-ext-install gmp


RUN curl --insecure https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer

# Set timezone
RUN rm /etc/localtime
RUN ln -s /usr/share/zoneinfo/Europe/London /etc/localtime
RUN "date"

WORKDIR /var/www/symfony
