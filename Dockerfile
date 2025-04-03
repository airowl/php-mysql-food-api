FROM php:8.0-apache
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqliRUN apt-get update && apt-get upgrade -ydo

WORKDIR /var/www/html

COPY index.php .