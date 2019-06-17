FROM antonyharfield/nginx-php-fpm:latest

COPY . /var/www/html

RUN cp .env.production .env
