FROM php:7.4-alpine

ENV \
    APP_DIR="/app" \
    APP_PORT="8500"

COPY . $APP_DIR

RUN apk add --update \
    curl \
    php \
    php-opcache \
    php-openssl \
    php-pdo \
    php-json \
    php-phar \
    php-dom \
    && rm -rf /var/cache/apk/*

RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/bin --filename=composer

RUN cd $APP_DIR && composer update --ignore-platform-reqs
RUN cd $APP_DIR && php artisan key:generate

WORKDIR $APP_DIR
CMD php artisan serve --host=103.183.75.27 --port=$APP_PORT

EXPOSE $APP_PORT
