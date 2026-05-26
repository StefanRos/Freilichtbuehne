FROM php:8.3-fpm-alpine
WORKDIR /var/www/html
COPY FLBB_Zuschauer_Zahlen.php .
