FROM php:7.4-cli

RUN docker-php-ext-install -j$(nproc) iconv \
pdo \
pdo_mysql \
mysqli

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

WORKDIR /var/www/html

CMD vendor/bin/phpunit --coverage-html tests/reports tests/ --stderr