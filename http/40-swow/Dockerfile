FROM composer:2 as php

WORKDIR /srv

COPY ./composer.json /srv/
COPY ./composer.lock /srv/

RUN composer install --ignore-platform-reqs

FROM benchmark/http:base

COPY --from=php /srv/vendor /srv/vendor
RUN /srv/vendor/bin/swow-builder --install

COPY 900-php.ini /etc/php/8.2/conf.d/900-php.ini
COPY 900-php.ini /etc/php/8.2/cli/conf.d/900-php.ini
COPY entrypoint.sh /entrypoint.sh
COPY . /srv
